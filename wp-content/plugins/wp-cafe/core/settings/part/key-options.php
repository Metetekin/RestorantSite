<div class="wpc-tab-wrapper wpc-tab-style2">
    <ul class="wpc-nav mb-30">
        <li>
            <a class="wpc-tab-a wpc-active"  data-id="general-key-option">
                <?php echo esc_html__('General Options', 'wpcafe'); ?>
            </a>
        </li>
        <li>
            <a class="wpc-tab-a" data-id="general-reservation-form-option">
                <?php echo esc_html__('Reservation Form Options', 'wpcafe'); ?>
            </a>
        </li>
    </ul>
    <div class="wpc-tab-content">
        <!-- General Settings options -->
        <div class="wpc-tab wpc-active" data-id="general-key-option">             
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="reservation_form_display_page"><?php esc_html_e('Display Pages', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Display Reservation Form only in the selected page', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <select disabled id="reservation_form_display_page" class="wpc-settings-input" name="wpc_reservation_form_display_page">
                        <option><?php echo esc_html__('Select a Page', 'wpcafe'); ?></option>
                        <?php
                            foreach ( get_pages() as $key => $value ) { ?>
                            <option <?php selected( $wpc_reservation_form_display_page , $value->ID , true ); ?> value='<?php echo esc_attr($value->ID); ?>'> <?php echo esc_html( $value->post_title ); ?> </option>
                        <?php }
                        ?>
                    </select>
                    <span class="wpc-pro-text"> <?php esc_html_e('pro version only', 'wpcafe'); ?></span>
                </div>
            </div>
            <?php
                // render key settings
                if( !empty( $get_data['key_options']) && file_exists( $get_data['key_options'] )){
                    require_once $get_data['key_options'] ;
                }
            ?>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_default_guest_no"><?php esc_html_e('Automatically Confirmed Guest No.', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Confirmed a reservation if number. of guests is the selected number. This number. must be between minimum and maximum guest number.', 'wpcafe'); ?> </div>
                </div>

                <div class="wpc-meta">
                    <select id="wpc_default_guest_no" class="wpc-settings-input mb-2" name="wpc_default_guest_no">
                        <option value=""><?php echo esc_html__('Select Number of Guests', 'wpcafe'); ?></option>
                        <?php
                        if( isset( $settings['reser_multi_schedule'] ) && $settings['reser_multi_schedule'] =="on" ){
                            if( !empty( $settings['seat_capacity'] ) ){
                                $wpc_no_range = max( $settings['seat_capacity'] );
                            }elseif( !empty( $settings['diff_seat_capacity'] ) ){
                                array_walk_recursive($settings['diff_seat_capacity'], function($v)use(&$wpc_no_range){if($wpc_no_range === null || $v > $wpc_no_range) $wpc_no_range = $v;});
                            }
                        }elseif( !empty( $get_data['capacity']) ){
                            $wpc_no_range = $get_data['capacity'];
                        }else{
                            $wpc_no_range = 20;
                        }

                        $default_geust_no = isset( $settings['wpc_default_guest_no'] ) && $settings['wpc_default_guest_no'] !== '' ? $settings['wpc_default_guest_no'] : 1;

                        for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                            <option <?php selected( $default_geust_no , $i , true ); ?> value='<?php echo esc_attr($i); ?>'><?php echo esc_html( $i ); ?></option>
                        <?php } ?>
                        <option <?php selected( $default_geust_no , 0 , true ); ?> value="0"><?php echo esc_html__('No. Auto Confirmation', 'wpcafe'); ?></option>
                    </select>
                    <div class="wpc-row default_error hide_field wpc-default-guest-message"><?php echo esc_html__('This value must be in between ', 'wpcafe'); ?><b><?php echo esc_html__('minimum', 'wpcafe'); ?></b> &amp; <b><?php echo esc_html__('maximum', 'wpcafe'); ?></b> <?php echo esc_html__(' guest no.', 'wpcafe'); ?></div>
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_allow_cancellation"><?php esc_html_e('Allow Cancellations?', 'wpcafe'  ); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Allow user to cancelled reservation through cancellation form', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <input name="wpc_allow_cancellation" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $wpc_checked_allow_cancellation == 'off' ? 'checked' : ''  ); ?> />
                    <input id='wpc_allow_cancellation' type="checkbox" <?php echo esc_attr( $wpc_checked_allow_cancellation == 'on' ? 'checked' : ''  ); ?> class="wpcafe-admin-control-input"
                    name="wpc_allow_cancellation"/>
                    <label for="wpc_allow_cancellation" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="require_phone"><?php esc_html_e('Require Phone?', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Make phone/contact no. required while placing reservation', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                <input id='require_phone' type="checkbox" 
                    <?php echo esc_attr( $checked_require_phone ); ?> 
                    class="wpcafe-admin-control-input "
                    name="wpc_require_phone" />
                    <label for="require_phone" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="pending_message"><?php esc_html_e('Pending Message', 'wpcafe'  ); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Message that will show up when a user successfully place a reservation', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <textarea id="pending_message" class="wpc-settings-input wpc-msg-box" name="wpc_pending_message" rows="7" cols="30"><?php echo esc_html( $wpc_pending_message ); ?></textarea>    
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="confirm_message"><?php esc_html_e('Reservation Confirmed Message', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Message that will show up when a user\'s reservation is confirmed', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <textarea id="confirm_message" class="wpc-settings-input wpc-msg-box" name="wpc_booking_confirmed_message" rows="7" cols="30"><?php echo esc_html( $wpc_booking_confirmed_message ) ?></textarea>    
                </div>
            </div>
            <?php            
            if ( class_exists( 'Wpcafe_Pro' ) && file_exists($get_data['integration_settings']) ) { 
                include $get_data['integration_settings']; 
            }
            ?>
        </div>
        <!-- Reservation Form Options -->
        <div class="wpc-tab" data-id="general-reservation-form-option"> 
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="reserv_form_local"><?php esc_html_e('Calendar Language', 'wpcafe'); ?></label>
                    <div class="wpc-desc">
                        <?php 
                        echo sprintf(
                            '%s <a href="%s" class="%s" target="_blank">%s</a> %s',
                            esc_html__('Translate reservation form, order type (Delivery/Pickup) day and month name. Visit the', 'wpcafe'),
                            'https://support.themewinter.com/docs/plugins/wp-cafe/booking-form-settings/',
                            esc_attr('doc-link'),
                            esc_html__('documentation', 'wpcafe'),
                            esc_html__('for details.', 'wpcafe')
                        ) ?>
                    </div>
                </div>
                <div class="wpc-meta">
                    <select id="reserv_form_local" name="reserv_form_local" class="wpc-settings-input">
                        <?php
                        $reserv_form_local = isset( $settings["reserv_form_local"] )?  $settings["reserv_form_local"] : "en";
                        
                        $lang_arr = ['en'=>esc_html__('English','wpcafe'), 'ru'=>esc_html__('Russian','wpcafe') ,
                        'ar'=> esc_html__('Arabic','wpcafe') ,'es'=> esc_html__('Spanish','wpcafe'),
                        'de' => esc_html__('German','wpcafe'),'ja' => esc_html__('Japanese','wpcafe') ];

                        foreach ( $lang_arr as $key => $value ) { ?>
                            <option <?php selected( $reserv_form_local, $key, true ); ?> value='<?php echo esc_attr( $key ); ?>'> <?php echo esc_html( $value ); ?> </option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div> 
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_date_format"><?php esc_html_e('Date Format', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Reservation and order type (Delivery/Pickup) date format', 'wpcafe' ); ?> </div>
                </div>
                <div class="wpc-meta">
                    <select id="wpc_date_format" name="wpc_date_format" class="wpc-settings-input">
                        <?php
                        $selected_date_format = !empty( $settings["wpc_date_format"] ) ? $settings["wpc_date_format"] : "";
                        foreach ( $date_options as $key => $date_option ) { ?>
                            <option <?php selected( $selected_date_format, $key, true); ?> value='<?php echo esc_attr( $key ); ?>'> <?php echo esc_html( $date_option ); ?> </option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>  
            <?php
            $selected_time_format = !empty( $settings['wpc_time_format'] ) ? $settings['wpc_time_format'] : "";
            ?>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_time_format"><?php esc_html_e('Time Format', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Reservation and order type (Delivery/Pickup) time format', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <select id="wpc_time_format" name="wpc_time_format" class="wpc-settings-input">
                        <option value="24" <?php selected($selected_time_format, '24', true); ?>><?php echo esc_html__('24h', 'wpcafe'); ?></option>
                        <option value="12" <?php selected($selected_time_format, '12', true); ?>><?php echo esc_html__('12h', 'wpcafe'); ?></option>
                    </select>
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_time_format"><?php esc_html_e('Reservation Schedule Interval', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Reservation schedule time difference ', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                        <?php
                        $interval = array( 5,10,15,20,25,30,35,40,45,50,55,60 );
                        $reserv_time_interval = !empty( $settings['reserv_time_interval'] ) ? $settings['reserv_time_interval'] : 30;
                        ?>
                        <select class="wpc-settings-input" id="reserv_time_interval" name="reserv_time_interval">
                            <?php
                            foreach ($interval as $key => $value) {
                                $selected = $reserv_time_interval == $value ? "selected" : ''; ?>
                                <option <?php echo esc_html($selected); ?> value="<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="reserv_message"><?php esc_html_e('Empty Schedule Message', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e(' This message will be shown on reservation form when there is no reservation schedule set from admin settings.', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <textarea id="confirm_message" class="wpc-settings-input wpc-msg-box" name="reserve_dynamic_message" rows="7" cols="30"><?php echo esc_html( $reserve_dynamic_message ) ?></textarea>    
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="wpc_allow_cancellation"><?php esc_html_e('Show Branch Name?', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Show branches in reservation form', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                    <input id="show_branches" type="checkbox" <?php echo esc_attr( $show_branches ); ?> class="wpcafe-admin-control-input"
                    name="show_branches"/>
                    <label for="show_branches" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                </div>
            </div>
            <div class="wpc-label-item">
                <div class="wpc-label">
                    <label for="require_branch"><?php esc_html_e('Is Branch Name Required?', 'wpcafe'); ?></label>
                    <div class="wpc-desc"> <?php esc_html_e('Keep branch name as required during order placement.', 'wpcafe'); ?> </div>
                </div>
                <div class="wpc-meta">
                <input id='require_branch' type="checkbox" 
                    <?php echo esc_attr( $checked_require_branch ); ?> 
                    class="wpcafe-admin-control-input "
                    name="require_branch" />
                    <label for="require_branch" class="wpcafe_switch_button_label" data-text="<?php echo esc_attr__('YES', 'wpcafe'); ?>" data-textalt="<?php echo esc_attr__('NO', 'wpcafe'); ?>"></label>
                </div>
            </div>
            <?php
            // render reservation form settings settings
            if( !empty( $get_data['reservation_form_settings'] ) && file_exists(  $get_data['reservation_form_settings'] )){
                include_once $get_data['reservation_form_settings'];
            }

            if( !empty( $get_data["license_settings"] ) && file_exists($get_data["license_settings"])){
                include_once $get_data["license_settings"];
            }
            ?>
        </div>
    </div>                    
</div>

