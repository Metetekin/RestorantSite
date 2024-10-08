<?php
namespace WpCafe\Core\Settings;

defined( "ABSPATH" ) || exit;

use WpCafe\Utils\Wpc_Utilities;


class Wpc_Key_Options {

    use \WpCafe\Traits\Wpc_Singleton;

    public $wpc_settings_field;

    /**
     * Settings field
     *
     * @return void
     */
    public function wpc_key_options() {
        if (isset($_GET['action']) && sanitize_text_field($_GET['action']) == 'reservation_details') {
            apply_filters('wpcafe/key_options/reservation_details','wpc_pro_reservation_details');
        } else {
            if ( isset($_GET['saved']) && sanitize_text_field($_GET['saved']) == 1 ) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php echo esc_html__("Your settings have been saved","wpcafe")?></p>
                </div>
                <?php
            }
            ?>
            <div class="wrap wpc-settings">
                <h1 class="wpc-settings-title"> <i class="wpcafe-icon4"></i> <?php echo esc_html__('Settings', 'wpcafe' ) ?></h1>
                <div id="setting_message" class="hide_field"></div>
                <?php
                    $visit          = esc_html__('Visit the', 'wpcafe');
                    $documentation  = esc_html__('documentation', 'wpcafe');
                    $schedule_text  = esc_html__('reservation settings section for reservation schedule of your restaurant.', 'wpcafe');
                    $menu_text      = esc_html__(' for food menu options of your restaurant.', 'wpcafe');
                    $sched_doc_link = Wpc_Utilities::wpc_kses( '<a href="https://support.themewinter.com/docs/plugins/wp-cafe/reservation-form/" target="_blank" class="doc-link">'. $documentation .'</a> ' );
                    $fmenu_doc_link = Wpc_Utilities::wpc_kses( '<a href="https://support.themewinter.com/docs/plugins/wp-cafe/food-menu/" target="_blank" class="doc-link"> '. $documentation .'</a> ' );
                    // show tab
                    $settings_tabs = array(
                        'menu_settings' => [esc_html__('Food Menu', 'wpcafe') ],
                        'schedule'      => [esc_html__('Reservation Schedule', 'wpcafe')],
                        'notification'  => [esc_html__('Reservation Email', 'wpcafe')],
                        'key_options'   => [esc_html__('Reservation Options', 'wpcafe')],
                    );
                    $wpc_doc_link = array(
                        'schedule'      => $visit .' '.$sched_doc_link .' '. $schedule_text .'',
                        'menu_settings' => $visit .' '.$fmenu_doc_link .' '. $menu_text .'',
                    );
                    $tab_arr    = [ $settings_tabs , $wpc_doc_link ];
                    $settings   =  \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();

                    if( isset( $_GET['settings-tab'] ) ){
                        $recent_tab = $_GET['settings-tab'];
                    }else{
                        $recent_tab = "menu_settings";
                    }

                ?>
                <ul class="nav nav-tabs wpc-tab">
                    <?php
                    $filterd_tab = apply_filters('wpcafe/key_options/settings_tab_item', $tab_arr );

                    if( isset( $filterd_tab['settings_tab']) ){
                        $tabs = $filterd_tab['settings_tab'][0];
                        $wpc_doc_link = $filterd_tab['settings_tab'][1];
                    }else{
                        $tabs = $tab_arr[0];
                    }

                    $i=0;
                    foreach ($tabs as $key => $value){
                        $i++
                        ?>
                        <li>
                            <a href="#" class="nav-tab <?php echo esc_html($recent_tab) == $key ? 'nav-tab-active': '';?>" data-id="<?php echo esc_html($key) ?>">
                                <i class="wpcafe-settings-<?php echo Wpc_Utilities::wpc_numeric($i);?>"></i>
                                <span><?php echo esc_html( $value[0]); ?></span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content settings-content-wraps">
                    <?php
                    $week_days = ['Sat','Sun','Mon','Tue','Wed','Thu','Fri'];

                    $sample_date = strtotime(date('Y-m-d'));
                    $date_options         = [
                        'Y-m-d' => date('Y-m-d', $sample_date),
                        'y/m/d' => date('y/m/d', $sample_date),
                        'm/d/Y' => date('m/d/Y', $sample_date),
                        'd/m/Y' => date('j/n/Y', $sample_date),
                        'd/m/Y' => date('d/m/Y', $sample_date),
                        'd-m-Y' => date('n-j-Y', $sample_date),
                        'm-d-Y' => date('m-d-Y', $sample_date),
                        'd-m-Y' => date('d-m-Y', $sample_date),
                        'Y.m.d' => date('Y.m.d', $sample_date),
                        'm.d.Y'  => date('m.d.Y', $sample_date),
                        'd.m.Y' => date('d.m.Y', $sample_date),
                    ];
                    $get_data                                     = apply_filters('wpcafe/key_options/menu_settings', $settings);
                    $wpc_reservation_form_display_page            =  (isset($settings['wpc_reservation_form_display_page'] ) ?  $settings['wpc_reservation_form_display_page'] : '');
                    $wpcafe_food_location                         =  isset($settings['wpcafe_food_location']) ? "checked" : "";
                    $wpcafe_allow_cart                            =  (! isset($settings['wpcafe_allow_cart'] ) || isset($settings['wpcafe_allow_cart'] ) && $settings['wpcafe_allow_cart'] == 'on' ) ? 'on' : 'off';
                    $minicart_style                               = isset($settings['minicart_style']) ? $settings['minicart_style'] : 'style-1';

                    $show_branches                                =  isset($settings['show_branches'] )   ? "checked" : "";
                    $wpc_checked_allow_cancellation               =  (! isset($settings['wpc_allow_cancellation'] ) || isset($settings['wpc_allow_cancellation'] ) && $settings['wpc_allow_cancellation'] == 'on' ) ? 'on' : 'off';
                    $checked_require_phone                        =  (isset($settings['wpc_require_phone']) ? "checked" : "");
                    $checked_require_branch                       =  (isset($settings['require_branch']) ? "checked" : "");
                    $allow_admin_notif_book_req                   =  (! isset($settings['wpc_admin_notification_for_booking_req'] ) || isset($settings['wpc_admin_notification_for_booking_req'] ) && $settings['wpc_admin_notification_for_booking_req'] == 'on' )  ? 'on' : 'off';
                    $allow_user_notif_book_req                    =  (! isset($settings['wpc_user_notification_for_booking_req'] ) || isset($settings['wpc_user_notification_for_booking_req'] ) && $settings['wpc_user_notification_for_booking_req'] == 'on' )  ? 'on' : 'off';

                    $admin_notif_confirm_book                     =  (isset($get_data['notification_settings']['admin_notif_confirm_book']) ? $get_data['notification_settings']['admin_notif_confirm_book'] : 'off');
                    $user_notif_confirm_book                      =  (isset($get_data['notification_settings']['user_notif_confirm_book']) ? $get_data['notification_settings']['user_notif_confirm_book'] : 'off');

                    $admin_notif_cancel_req                       =  (isset($get_data['notification_settings']['admin_notif_cancel_req']) ? $get_data['notification_settings']['admin_notif_cancel_req'] : 'off');
                    $user_notif_cancel_req                        =  (isset($get_data['notification_settings']['user_notif_cancel_req']) ? $get_data['notification_settings']['user_notif_cancel_req'] : 'off');
                    $reserve_dynamic_message                      =  (isset($settings['reserve_dynamic_message']) ? $settings['reserve_dynamic_message'] : '');

                    $wpc_booking_confirmed =  esc_html__('Thank you for booking. Your booking is confirmed. Please check your email.', 'wpcafe');
                    $wpc_booking_confirmed_message = $wpc_booking_confirmed;
                    $wpc_pending = esc_html__('Thank you for booking. Your booking is pending. Please check your email.', 'wpcafe');
                    $wpc_pending_message = $wpc_pending;
                    if ( isset($settings['wpc_pending_message'])) {
                        if ($settings['wpc_pending_message'] == '') {
                            $wpc_pending_message = $wpc_pending;
                        }else {
                            $wpc_pending_message = $settings['wpc_pending_message'];
                        }
                    }

                    if ( isset($settings['wpc_booking_confirmed_message'])) {
                        if ($settings['wpc_booking_confirmed_message'] == '') {
                            $wpc_booking_confirmed_message = $wpc_booking_confirmed;
                        }else {
                            $wpc_booking_confirmed_message = $settings['wpc_booking_confirmed_message'];
                        }
                    }
                    ?>
                    <form method='post' class='wpc_pb_two wpc_tab_content' id='wpc_settings_form' >
                        <input type="hidden" name="settings_tab" class="settings_tab" value="<?php echo esc_attr( $recent_tab ); ?>"/>
                        <?php
                        foreach ($tabs as $item => $content) {
                            $active_class = (  ( $item == $recent_tab ) ? 'active' : '' );
                            if ( in_array( $item, array_keys( $settings_tabs ) ) ) {
                                ?>
                                <div id='<?php echo esc_attr( $item );?>' data-id='tab_<?php echo esc_attr( $item ); ?>' class='tab-pane <?php echo esc_attr( $active_class );?>'>
                                    <?php
                                    if ( isset( $wpc_doc_link[$item] ) ) { 
                                        ?>
                                        <!-- documentation link -->
                                        <div class="mb-25">
                                        <?php echo Wpc_Utilities::wpc_kses( $wpc_doc_link[$item] ); ?>
                                        </div>
                                        <?php
                                    }
                                    //Schedule
                                    if ( $item == 'schedule' && file_exists(  \Wpcafe::core_dir() ."settings/part/schedule.php" ) ) {
                                        include_once \Wpcafe::core_dir() ."settings/part/schedule.php";
                                    } elseif ( $item == 'key_options' && file_exists(  \Wpcafe::core_dir() ."settings/part/key-options.php" ) ) {
                                        include_once \Wpcafe::core_dir() ."settings/part/key-options.php";
                                    } elseif ( $item == 'notification'  && file_exists(  \Wpcafe::core_dir() ."settings/part/notifications.php" ) ) {
                                        include_once \Wpcafe::core_dir() ."settings/part/notifications.php";
                                    } elseif ( $item == 'menu_settings' ) {
                                        ?>
                                        <div class="wpc-tab-wrapper wpc-tab-style2">
                                            <ul class="wpc-nav mb-30">
                                                <li>
                                                    <a class="wpc-tab-a wpc-active"  data-id="food-menu-option">
                                                        <?php echo esc_html__('Food Menu Options', 'wpcafe'); ?>
                                                    </a>
                                                </li>

                                                <?php if( !empty( $get_data['live_order_notification'] ) && file_exists( $get_data['live_order_notification'] )){ ?>
                                                    <li>
                                                        <a class="wpc-tab-a" data-id="live-order-notification">
                                                            <?php echo esc_html__('Live Order Notification Options', 'wpcafe'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php  if( !empty( $get_data['tip_settings'] ) && file_exists( $get_data['tip_settings'] )){ ?>
                                                    <li>
                                                        <a class="wpc-tab-a" data-id="tip-option">
                                                            <?php echo esc_html__('Tip Options', 'wpcafe'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                <?php  if( !empty( $get_data['discount_settings'] ) && file_exists( $get_data['discount_settings'] )){ ?>
                                                    <li>
                                                        <a class="wpc-tab-a" data-id="discount-option">
                                                            <?php echo esc_html__('Discount Options', 'wpcafe'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php  if( !empty( $get_data['special_menus'] ) && file_exists( $get_data['special_menus'] )){ ?>
                                                    <li>
                                                        <a class="wpc-tab-a" data-id="special_menus">
                                                            <?php echo esc_html__('Special Menus', 'wpcafe'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <div class="wpc-tab-content">
                                                <!-- food menu Settings options -->
                                                <div class="wpc-tab wpc-active" data-id="food-menu-option">
                                                    <?php do_action('wpc_before_admin_location_settings');?>
                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpcafe_food_location"><?php esc_html_e('Allow Location', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Show location pop-up on front-end to get user location for food delivery', 'wpcafe'); ?> </div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input id='wpcafe_food_location' type="checkbox" <?php echo esc_attr( $wpcafe_food_location ) ; ?> class="wpcafe-admin-control-input"
                                                                name="wpcafe_food_location" />
                                                            <label for="wpcafe_food_location" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                                                        </div>
                                                    </div>

                                                    <?php do_action('wpc_after_admin_location_settings');?>

                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpc_primary_color"><?php esc_html_e('Primary Color', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Choose a primary color for menu', 'wpcafe'); ?> </div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input type="text" name="wpc_primary_color" id="wpc_primary_color"
                                                                value="<?php echo esc_attr( isset($settings['wpc_primary_color'] ) ? $settings['wpc_primary_color'] : ''); ?>"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpc_secondary_color"><?php esc_html_e('Secondary Color', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Choose a secondary color for menu', 'wpcafe'); ?> </div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input type="text" name="wpc_secondary_color" id="wpc_secondary_color"
                                                                value="<?php echo esc_attr( isset($settings['wpc_secondary_color'] ) ? $settings['wpc_secondary_color'] : ''); ?>"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpcafe_allow_cart"><?php esc_html_e('Allow Cart', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Show cart on the frontend', 'wpcafe'); ?> </div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input name="wpcafe_allow_cart" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $wpcafe_allow_cart == 'off' ? 'checked' : ''  ) ; ?>/>
                                                            <input id='wpcafe_allow_cart' type="checkbox" <?php echo esc_attr( $wpcafe_allow_cart == 'on' ? 'checked' : ''  ) ; ?> class="wpcafe-admin-control-input "
                                                                name="wpcafe_allow_cart" />
                                                            <label for="wpcafe_allow_cart" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="minicart_style"><?php esc_html_e('Mini Cart Style', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('You can choose mini cart style ', 'wpcafe'); ?></div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <?php
                                                            $args = array( 'style-1'=>esc_html__('Style 1','wpcafe') , 'style-2'=>esc_html__('Style 2','wpcafe'));
                                                            ?>
                                                            <select class="wpc-settings-input" id="minicart_style" name="minicart_style">
                                                                <?php
                                                                foreach ($args as $key => $value) {
                                                                    $selected = $minicart_style == $key ? "selected" : '';
                                                                ?>
                                                                    <option <?php echo esc_html($selected); ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpc_mini_cart_icon"><?php esc_html_e('Mini-cart Icon', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Icon class for mini cart. Any icon library which is available in your site will work. Example:  font-awesome, dash-icon etc.', 'wpcafe'); ?> <a href="<?php echo esc_url( '//support.themewinter.com/docs/plugins/wp-cafe/general-settings-2/#15-toc-title' ); ?>" target="_blank" ><?php esc_html_e('Documentation', 'wpcafe'); ?></a></div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input type="text" class="wpc-settings-input" name="wpc_mini_cart_icon" id="wpc_mini_cart_icon"
                                                                value="<?php echo esc_attr( isset($settings['wpc_mini_cart_icon'] ) ? $settings['wpc_mini_cart_icon'] : ''); ?>"
                                                                placeholder="<?php esc_attr_e('icon here', 'wpcafe'); ?>" />
                                                            <span class="wpc-admin-settings-message"><?php echo esc_html_e( 'For instance : fa fa-shopping-cart', 'wpcafe'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="wpc-label-item">
                                                        <div class="wpc-label">
                                                            <label for="wpc_cart_icon"><?php esc_html_e('Cart Icon', 'wpcafe'); ?></label>
                                                            <div class="wpc-desc"> <?php esc_html_e('Icon class for simple,group menu icon. Any icon library which is available in your site will work. Example:  font-awesome, dash-icon etc.', 'wpcafe'); ?></div>
                                                        </div>
                                                        <div class="wpc-meta">
                                                            <input type="text" class="wpc-settings-input" name="wpc_cart_icon" id="wpc_cart_icon"
                                                                value="<?php echo esc_attr( isset($settings['wpc_cart_icon'] ) ? $settings['wpc_cart_icon'] : ''); ?>"
                                                                placeholder="<?php esc_attr_e('icon here', 'wpcafe'); ?>" />
                                                            <span class="wpc-admin-settings-message"><?php echo esc_html_e( 'For instance : fa fa-shopping-basket', 'wpcafe'); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                         //render menu settings
                                                          if( !empty( $get_data['menu_settings'] ) && file_exists( $get_data['menu_settings'] )){
                                                              include_once $get_data['menu_settings'];
                                                          }
                                                    ?>
                                                  
                                                </div>
                                                <?php if( !empty( $get_data['live_order_notification'] ) && file_exists( $get_data['live_order_notification'] )){ ?>
                                                    <div class="wpc-tab" data-id="live-order-notification">
                                                        <?php 
                                                            include_once $get_data['live_order_notification'];
                                                        ?>
                                                    </div>
                                                <?php } 
                                                
                                                  if( !empty( $get_data['tip_settings'] ) && file_exists( $get_data['tip_settings'] )){ ?>
                                                    <div class="wpc-tab" data-id="tip-option">
                                                        <?php
                                                            include_once $get_data['tip_settings'];
                                                        ?>
                                                    </div>
                                                <?php } 

                                                    if( !empty( $get_data['discount_settings'] ) && file_exists( $get_data['discount_settings'] )){ ?>
                                                    <div class="wpc-tab" data-id="discount-option">
                                                        <?php  include_once $get_data['discount_settings']; ?>
                                                    </div>
                                                <?php }

                                                    if( !empty( $get_data['special_menus'] ) && file_exists( $get_data['special_menus'] )){ ?>
                                                        <div class="wpc-tab" data-id="special_menus">
                                                            <?php  include_once $get_data['special_menus']; ?>
                                                        </div>
                                                    <?php }
                                                 ?>
                                             </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php }
                        }

                        apply_filters('wpcafe/key_options/tab_content', $settings,$wpc_doc_link,$recent_tab);
                        
                        ?>
                        <input type="hidden" name="wpcafe_settings_key_options_action" value="save">
                        <input type="submit" name="submit" id="cafe_settings_submit" class="wpc_mt_two wpc-btn" value="<?php esc_attr_e('Save Changes', 'wpcafe'); ?>">
                        <?php wp_nonce_field('wpcafe-settings-page', 'wpcafe-settings-page'); ?>
                    </form>
                </div>
            </div>
            <?php
        }
    }


    /**
     * Short code View
     *
     * @return void
     */
    public function shortcode_menu_view() {
        ?>
        <div class="wrap wpc-settings wpc-shortcode-setttings">
            <div class="tab-content settings-content-wraps">
             <h1 class="wpc-settings-title"> <i class="wpcafe-shortcode_icon1"></i> <?php esc_html_e('Shortcodes', 'wpcafe'  ); ?></h1>

                <div class='wpc-shortcode-inner-wrap'>
                    <?php
                    //hooks
                    if (  file_exists( \Wpcafe::core_dir() ."settings/part/hooks.php") ) {
                        include_once \Wpcafe::core_dir() ."settings/part/hooks.php";
                    }
                    ?>
                </div>    
            </div>
        </div>
        <?php
    }
}

