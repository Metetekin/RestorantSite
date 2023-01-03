<?php
// food location list
use WpCafe\Utils\Wpc_Utilities;

$food_location  = Wpc_Utilities::get_location_data ( esc_html__("Select food location", "wpcafe") , esc_html__("No location is set", "wpcafe"),"id" );
?>
    <!-- select location -->
    <form>
        <select id="filter_location" name="filter_location" class="filter-location <?php echo esc_attr($location_alignment); ?>">
            <?php foreach ( $food_location as $key => $value ) { ?>
                <option value="<?php echo esc_attr($key); ?>"><?php echo sprintf( esc_html__("%s","wpcafe") , $value ) ?></option>
            <?php } ?>
        </select>
    </form>
    
    <?php

    global $woocommerce;
    
    if ( is_object(WC()->cart) && WC()->cart->cart_contents_count == 0) {
        $cart_empty = 1;
    }else{
        $cart_empty = 0;
    }

    ?>
    <div id="location_change" class="location_modal hide_field location_change">
        <div class="modal-content">
            <div>
                <?php echo esc_html__("By changing your current location, You will 
                        lose your selected item from the cart.","wpcafe");?>
            </div>
            <button class="change_yes wpc-btn wpc-btn-primary"><?php echo esc_html__( "Yes", "wpcafe" );?></button>
            <button class="change_no wpc-btn wpc-btn-primary"><?php echo esc_html__( "No", "wpcafe" );?></button>
        </div>
    </div>
    <!-- render html -->
    <div class="food_location" data-cart_empty="<?php echo esc_attr( $cart_empty );?>">
            <?php
            if ( !empty( $products ) ) { 
                include \Wpcafe::plugin_dir() . "widgets/wpc-menus-list/style/${style}.php";

            }else{
                ?>
                    <div><?php esc_html_e( 'No menu found' , 'wpcafe')?></div>
                <?php
            }
            ?>
    </div>
</div>



