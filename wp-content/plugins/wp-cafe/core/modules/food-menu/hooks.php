<?php

namespace WpCafe\Core\Modules\Food_Menu;
use WpCafe_Pro\Utils\Utilities as Pro_Utilities;

defined( 'ABSPATH' ) || exit;

class Hooks {

    use \WpCafe\Traits\Wpc_Singleton;

    /**
     * Fire all hooks
     */
    public function init(){
        add_action( 'woocommerce_thankyou', [$this,'wpc_checkout_callback'], 10, 1 );
        add_action( 'woocommerce_admin_order_data_after_billing_address', [$this,'show_order_details_meta'], 10, 1 );
        //Filter food by location validation
        add_filter( 'woocommerce_cart_redirect_after_error', '__return_false'); 
        add_filter( 'woocommerce_add_to_cart_validation', [$this,'food_location_add_to_cart_validation'], 10, 3 );
    }

    /**
     * Discard items from cart , if
     * Items is adding from different location
     * to cart
     */
    public function food_location_add_to_cart_validation( $passed, $product_id, $quantity ){
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        // before add to cart product check if location exist
        $wpc_location_id = !empty($_POST['wpc_location_id']) ? $_POST['wpc_location_id'] : "";
        
        if ( $wpc_location_id !=="" ) {
            if ( !empty( $items ) ) {
                foreach($items as $item => $values) { 
                    $cart_product_id = $values['data']->get_id(); 
                    $location = wp_get_post_terms($cart_product_id,'wpcafe_location',array('fields'=>'ids'));
                    if ( !empty($location) && ( !in_array( $wpc_location_id , $location ) ) ) {
                        return $passed = false;
                    }
                } 
            }
        }

        return $passed ;
    }

    /**
     * Show Food location , order meta in order details
     */
    public function show_order_details_meta($order){
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        // Food location
        if(get_post_meta( $order_id, 'wpc_location_name', true ) != ''):
        ?>
            <p><strong><?php echo esc_html__('Food Delivery Location:', 'wpcafe');
            ?></strong> <?php echo get_post_meta( $order_id, 'wpc_location_name', true ); ?></p>
        <?php
        endif;
        
        if (class_exists("Wpcafe_Pro")) {
            // Order type and schedule
            $order_data = Pro_Utilities::get_order_type();
            if (Pro_Utilities::data_validation_check_arr($order_data)) {
                foreach ($order_data as $key => $value) {
                    if (get_post_meta($order_id, $value, true) != '') {
                        ?>
                        <p>
                            <strong><?php echo esc_html($key); ?>: </strong>
                            <?php echo get_post_meta($order_id, $value, true); ?>
                        </p>
                        <?php
                    }
                }
            }

        }
    }

    /**
     * after successful checkout, some data are returned from woocommerce
     * we can use these data to update our own data storage / tables
     */
    public function wpc_checkout_callback( $order_id ) {
        if ( !$order_id ) {
            return;
        }
        global $wpdb;
        $order = wc_get_order( $order_id );
        
        do_action("wpcafe/after_thankyou");

    }

}
