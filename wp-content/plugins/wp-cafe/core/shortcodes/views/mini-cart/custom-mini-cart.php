<?php 
     $settings       = $this->settings_obj;
     do_action('wpc_before_minicart');
?>

<?php  
if ( !empty($settings['minicart_style']) && $settings['minicart_style'] === 'style-1' ) { 
    ?>
    <ul class="wpc_cart_block wpc-cart_main_block">

    <a href="#" class="wpc_cart_icon">
    <div class="wpc-cart-message"><?php echo esc_html__('Product has been added', 'wpcafe'); ?></div>

            <i class="<?php echo esc_attr($wpc_cart_icon); ?>"></i>
            <sup class="basket-item-count" style="display: inline-block;">
                <span class="cart-items-count count" id="wpc-mini-cart-count">
                </span>
            </sup>
        </a>
        <li class="wpc-menu-mini-cart wpc_background_color">
            <div class="widget_shopping_cart_content">
                <?php
                is_object(WC()->cart) ? woocommerce_mini_cart() : '';
                ?>
            </div>
        </li>
    </ul>
    <?php  
}else{ 
    ?>
    <div class="wpc-minicart-wrapper wpc-cart_main_block">
        <a href="#" class="wpc_cart_icon">
            <div class="wpc-cart-message"><?php echo esc_html__('Product has been added', 'wpcafe'); ?></div>

            <i class="<?php echo esc_attr($wpc_cart_icon); ?>"></i>
            <sup class="basket-item-count" style="display: inline-block;">
                <span class="cart-items-count count" id="wpc-mini-cart-count">
                </span>
            </sup>
        </a>
        <ul class="wpc_cart_block">
            <li class="wpc-menu-mini-cart wpc_background_color">
                <button type="button" class="minicart-close wpc-btn-border wpc-btn">X</button>
                <div class="widget_shopping_cart_content">
                    <?php
                    is_object(WC()->cart) ? woocommerce_mini_cart() : '';
                    ?>
                </div>
                
            </li>
        </ul>
    </div>
    <?php
}
?>

<?php do_action('wpc_after_minicart');?>