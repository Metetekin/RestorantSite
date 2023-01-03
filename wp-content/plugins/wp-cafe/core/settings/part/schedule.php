<?php
use WpCafe\Utils\Wpc_Utilities;

?>
<h3 class="wpc-tab-title"><?php

esc_html_e('Schedule Options', 'wpcafe'); ?></h3>
    <?php
    if ( !class_exists( 'Wpcafe_Pro' ) ) {

        if( !empty( $get_data['capacity']) ){
            $wpc_no_range = $get_data['capacity'];
        }else{
            $wpc_no_range = 20;
        }
    ?>
        <div class="wpc-label-item">
            <div class="wpc-label">
                <label for="wpc_min_guest_no"><?php esc_html_e('Minimum Guest Number', 'wpcafe'); ?></label>
                <div class="wpc-desc"> <?php esc_html_e('Number of minimum allowed guest for a single reservation', 'wpcafe'); ?> </div>
            </div>
            <div class="wpc-meta">
                <select id="wpc_min_guest_no" class="wpc-settings-input mb-2" name="wpc_min_guest_no">
                    <option value=""><?php echo esc_html__('Select Number of Guests', 'wpcafe'); ?></option>
                    <?php
                    $min_geust_no = isset( $settings['wpc_min_guest_no'] ) && $settings['wpc_min_guest_no'] !== '' ? $settings['wpc_min_guest_no'] : 1;
                    for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                        <option <?php selected( $min_geust_no , $i , true ); ?> value='<?php echo esc_attr($i); ?>'> <?php echo esc_html( $i ); ?> </option>
                    <?php }
                    ?>
                </select>
                <div class="wpc-row min_error hide_field wpc-default-guest-message"><b><?php echo esc_html__('Minimum', 'wpcafe'); ?></b><?php echo esc_html__(' guest number must be less than ', 'wpcafe'); ?><b><?php echo esc_html__('Maximum', 'wpcafe'); ?></b> <?php echo esc_html__('guest number', 'wpcafe'); ?></div>
            </div>
        </div>

        <div class="wpc-label-item">
            <div class="wpc-label">
                <label for="wpc_max_guest_no"><?php esc_html_e('Maximum Guest Number', 'wpcafe'); ?></label>
                <div class="wpc-desc"> <?php esc_html_e('Number of maximum allowed guest for a single reservation', 'wpcafe'); ?> </div>
            </div>
            <div class="wpc-meta">
                <select id="wpc_max_guest_no" class="wpc-settings-input mb-2" name="wpc_max_guest_no">
                <option value=""><?php echo esc_html__('Select Number of Guests', 'wpcafe'); ?></option>
                    <?php
                    $max_geust_no = isset( $settings['wpc_max_guest_no'] ) && $settings['wpc_max_guest_no'] !== '' ? $settings['wpc_max_guest_no'] : $wpc_no_range;
                    for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                        <option <?php selected( $max_geust_no , $i  ); ?> value='<?php echo esc_attr($i); ?>'> <?php echo esc_html( $i ); ?> </option>
                    <?php } ?>
                </select>
                <div class="wpc-row max_error hide_field wpc-default-guest-message"><b><?php echo esc_html__('Maximum', 'wpcafe'); ?></b> <?php echo esc_html__('guest number must be grater than ', 'wpcafe'); ?><b><?php echo esc_html__('Minimum', 'wpcafe'); ?></b> <?php echo esc_html__('guest number', 'wpcafe'); ?></div>
            </div>
        </div>

    <?php } ?>

    <div class="wpc-label-item">
        <?php
            // render reservation schedule settings
            if( !empty( $get_data['reservation_schedule'] ) && file_exists( $get_data['reservation_schedule'] )){
                include_once  $get_data['reservation_schedule'] ;
            }

            $weekly_active = '';
            $daily_active = '';
            if(!empty($settings['wpc_all_day_start_time'])){
                $daily_active = 'wpc-active';
            } else {
                $weekly_active = 'wpc-active';
            }

        ?>
        <div class="single_schedule">
            <div class="wpc-label">
                <label for="wpc_schedule" class="wpc-settings-label"><?php esc_html_e('Schedule', 'wpcafe'); ?></label>
                <p class="wpc-desc"> <?php esc_html_e('Set weekly or opening and closing schedule of your restaurant', 'wpcafe'); ?> </p>
            </div>
            <div class="wpc-meta">
                <!--schedule tab start -->
                <div class="wpc-tab-wrapper single-slot-schedule">
                    <ul class="wpc-nav mb-30">
                        <li>
                            <a class="wpc-tab-a <?php echo esc_attr($weekly_active); ?> wpc-tooltip" data-title="<?php echo esc_attr__('Set weekly opening and closing schedule','wpcafe'); ?>" data-id="single-weekly-schedule"
                            id="weekly_valid" data-weekly_valid="<?php echo esc_attr__('You have already set weekly schedule. Please unset weekly schedule.','wpcafe') ?>"
                            data-exist_warning="<?php echo esc_attr__('day exist. Please check another day','wpcafe') ?>"
                            >
                                <?php echo esc_html__('Weekly Schedule', 'wpcafe'); ?>
                                <small class="wpc-tooltip-angle"></small>
                            </a>
                        </li>
                        <li>
                            <a class="wpc-tab-a <?php echo esc_attr($daily_active); ?> wpc-tooltip" data-title="<?php echo esc_attr__('Set schedule for all days', 'wpcafe'); ?>"
                             data-id="single-daily-schedule" id="every_day_valid" data-every_day_valid="<?php echo esc_attr__('You have already set everyday schedule. Please unset everyday schedule.','wpcafe') ?>">
                                <?php echo esc_html__('Everyday Schedule', 'wpcafe'); ?>
                                <small class="wpc-tooltip-angle"></small>
                            </a>
                        </li>
                    </ul>
                    <div class="wpc-tab-content">
                        <div class="wpc-tab <?php echo esc_attr($weekly_active); ?>" data-id="single-weekly-schedule">
                            <div class="schedule_main_block">
                                <h5 class="wpc_pb_two"><?php esc_html_e('Weekly (Set opening and closing schedule for each day of a week separately)', 'wpcafe'); ?></h5>
                                <?php
                                $wpc_schedule['wpc_weekly_schedule'] = isset( $settings['wpc_weekly_schedule'] ) ? $settings['wpc_weekly_schedule'] : [];
                                $wpc_schedule['wpc_weekly_schedule_start_time'] = isset( $settings['wpc_weekly_schedule_start_time'] ) ? $settings['wpc_weekly_schedule_start_time'] : [];
                                $wpc_schedule['wpc_weekly_schedule_end_time']   = isset( $settings['wpc_weekly_schedule_end_time'] ) ? $settings['wpc_weekly_schedule_end_time'] : [];
                                //  For weekly schedule 
                                if( is_array( $wpc_schedule['wpc_weekly_schedule']  ) && count( $wpc_schedule['wpc_weekly_schedule']  ) >0 ){
                                    for ( $index=0; $index < count( $wpc_schedule['wpc_weekly_schedule']   ) ; $index ++) { ?>
                                        <div class="schedule_block week_schedule_wrap week_schedule_wrap_<?php echo esc_attr( $index ); ?>" data-id="<?php echo esc_attr( $index ); ?>">
                                            <div class="wpc-weekly-schedule-list">
                                                <?php foreach ($week_days as $key => $value) { ?>
                                                    <input type="checkbox" name="wpc_weekly_schedule[<?php echo intval($index)?>][<?php echo esc_attr($value);?>]" 
                                                    class="<?php echo esc_attr(strtolower($value));?>" id="weekly_<?php echo esc_attr(strtolower($value).'_'.intval($index));?>"
                                                    <?php echo isset( $wpc_schedule['wpc_weekly_schedule'][$index][$value] ) ? 'checked' : ''?>
                                                    /><label for="weekly_<?php echo esc_attr(strtolower($value).'_'.intval($index));?>"><?php echo esc_html($value); ?></label>
                                                <?php } ?>
                                            </div>

                                            <div class="wpc-schedule-field multi_schedule_wrap mb-2">
                                                <p class="wpc-desc wpc-settings-input attr-form-control"><?php echo esc_html__('Start Time', 'wpcafe'); ?></p>
                                                <p class="wpc-desc wpc-settings-input attr-form-control"><?php echo esc_html__('End Time', 'wpcafe'); ?></p>
                                            </div>
                                            
                                            <div class="schedule_block wpc-schedule-field">
                                                <?php
                                                    $weekly_start_time = $wpc_schedule['wpc_weekly_schedule_start_time'][ $index ];
                                                    $weekly_end_time   = $wpc_schedule['wpc_weekly_schedule_end_time'][ $index ];
                                                ?>
                                                <div class="wpc_weekly_start_wrap">
                                                    <input type="text"  name="wpc_weekly_schedule_start_time[]" id="<?php echo intval($index) ?>" value="<?php echo Wpc_Utilities::wpc_render( $weekly_start_time ); ?>" class="wpc_weekly_schedule_start_time wpc_weekly_schedule_start_time_<?php echo Wpc_Utilities::wpc_numeric($index) ?> ml-2 mr-1 wpc-settings-input attr-form-control <?php echo empty( $weekly_start_time ) ? 'wpc_field_error' : '' ?>" id="<?php echo intval($index);?>" placeholder="<?php echo esc_attr__('Start Time' , 'wpcafe'); ?>"/>
                                                    <?php if( empty( $weekly_start_time ) ) { ?>
                                                        <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                                    <?php } ?>
                                                </div>

                                                <div class="wpc_weekly_end_wrap">
                                                    <input type="text" name="wpc_weekly_schedule_end_time[]"   id="<?php echo intval($index) ?>" value="<?php echo Wpc_Utilities::wpc_render( $weekly_end_time ); ?>" class="wpc_weekly_schedule_end_time wpc_weekly_schedule_end_time_<?php echo Wpc_Utilities::wpc_numeric($index) ?> ml-2 wpc-settings-input attr-form-control <?php echo empty( $weekly_end_time ) ? 'wpc_field_error' : '' ?>" id="<?php echo intval($index);?>" placeholder="<?php echo esc_attr__('End Time', 'wpcafe'); ?>"/>
                                                    <?php if( empty( $weekly_end_time ) ) { ?>
                                                        <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                                    <?php } ?>
                                                </div>

                                                <div class="wpc_weekly_clear" id="<?php echo intval($index) ?>" >
                                                    <span class="dashicons dashicons-update-alt wpc-tooltip" data-title="<?php echo esc_attr__('Reset fields', 'wpcafe'); ?>"> <small class="wpc-tooltip-angle"></small>
                                                    </span>
                                                </div> 
                                            </div>
                                            <div class="weekly_message_<?php echo intval($index) ?> wpc-default-guest-message"></div>
                                            <?php if( $index != 0 ) { ?>
                                            <span class="dashicons wpc-btn dashicons dashicons-no-alt remove_schedule_block pl-1"></span>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                }
                                else {
                                ?>
                                    <div class="schedule_block week_schedule_wrap week_schedule_wrap_0" data-id="<?php echo esc_attr( 0 )?>">
                                        <div class="wpc-weekly-schedule-list">
                                        <?php foreach ($week_days as $key => $value) { ?>
                                                <input type="checkbox" name="wpc_weekly_schedule[0][<?php echo esc_attr($value);?>]" 
                                                class="<?php echo esc_attr(strtolower($value));?>" id="schedule_<?php echo esc_attr(strtolower($value));?>"
                                                /><label for="schedule_<?php echo esc_attr(strtolower($value));?>"><?php echo esc_html($value); ?></label>
                                        <?php } ?>
                                        </div>
                                        <div class="wpc-schedule-field">
                                            <div class="wpc_weekly_start_wrap">
                                                <input type="text" name="wpc_weekly_schedule_start_time[]" id="0" class="wpc_weekly_schedule_start_time wpc_weekly_schedule_start_time_0 mr-1 wpc-settings-input attr-form-control" disabled placeholder="<?php echo esc_attr__('Start Time', 'wpcafe'); ?>"/>
                                            </div>
                                            <div class="wpc_weekly_end_wrap">
                                                <input type="text" name="wpc_weekly_schedule_end_time[]" id="0" class="wpc_weekly_schedule_end_time wpc_weekly_schedule_end_time_0 wpc-settings-input attr-form-control" disabled placeholder="<?php echo esc_attr__('End Time', 'wpcafe'); ?>"/>
                                            </div>
                                            <div class="wpc_weekly_clear" id="0" style="display: none;">
                                                <span class="dashicons dashicons-update-alt wpc-tooltip" data-title="<?php echo esc_attr__('Reset field', 'wpcafe'); ?>"> <small class="wpc-tooltip-angle"></small>
                                                </span> 
                                             </div>  
                                        </div>
                                        <div class="weekly_message_0 wpc-default-guest-message"></div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="wpc_flex_reverse wpc-weekly-schedule-btn">
                                <span class="add_schedule_block wpc-btn wpc-tooltip" data-clear_text="<?php echo esc_attr__( 'Reset Fields', 'wpcafe' ); ?>" data-remove_text="<?php echo esc_attr__( 'Remove Weekly Schedule' , 'wpcafe' )  ?>" data-title="<?php echo esc_attr__('Add Weekly Schedule', 'wpcafe'); ?>" data-start_time="<?php echo esc_attr__('Start Time', 'wpcafe'); ?>" data-end_time="<?php echo esc_attr__('End Time', 'wpcafe'); ?>">
                                        <i class="dashicons icon_cursor text-right dashicons-plus-alt  pl-1"></i>
                                        <small class="wpc-tooltip-angle"></small>
                                </span>
                            </div>
                        </div>
                        <div class="wpc-tab <?php echo esc_attr($daily_active); ?>" data-id="single-daily-schedule">
                            <div class="wpc-all-day-schedule">
                                <h5 class="wpc_pb_two"><?php esc_html_e('All day (Set opening and closing schedule for all days of a week)', 'wpcafe'); ?></h5>  
                                <?php
                                    //  For everyday schedule 
                                    $all_day_start_time = isset($settings['wpc_all_day_start_time'] ) ? $settings['wpc_all_day_start_time'] : '';
                                    $all_day_end_time   = isset($settings['wpc_all_day_end_time'] ) ? $settings['wpc_all_day_end_time'] : '';

                                    $all_day_start_error = ( empty( $all_day_start_time ) && ! empty( $all_day_end_time ) ) ? true : false;
                                    $all_day_end_error   = ( empty( $all_day_end_time ) && ! empty( $all_day_start_time ) ) ? true : false;
                                ?>
                                <div class="wpc-schedule-field mb-2">
                                    <div class="wpc_all_day_start_wrap">
                                        <input type="text" name="wpc_all_day_start_time" value="<?php echo esc_attr( $all_day_start_time ); ?>"
                                        class="wpc_all_day_start mb-1 wpc-settings-input attr-form-control <?php echo ( $all_day_start_error ) ? 'wpc_field_error' : '' ?>" placeholder="<?php echo esc_attr__('Start time', 'wpcafe'); ?>" />
                                        <?php if( $all_day_start_error ) { ?>
                                            <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="wpc_all_day_end_wrap">
                                        <input type="text" name="wpc_all_day_end_time" value="<?php echo esc_attr( $all_day_end_time ); ?>" 
                                        class="wpc_all_day_end wpc-settings-input attr-form-control <?php echo ( $all_day_end_error ) ? 'wpc_field_error' : '' ?>" <?php echo ( empty ( $all_day_start_time ) && empty ( $all_day_end_time ) ) ? 'disabled' : '' ?> placeholder="<?php echo esc_attr__('End Time', 'wpcafe' ); ?>"/> 
                                        <?php if( $all_day_end_error ) { ?>
                                            <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="wpc_all_day_clear" style="<?php echo ( empty ( $all_day_start_time ) && empty ( $all_day_end_time ) ) ? 'display: none;' : '' ?>"><span class="dashicons dashicons-update-alt wpc-tooltip" data-title="<?php echo esc_attr__('Reset fields', 'wpcafe'); ?>"> <small class="wpc-tooltip-angle"></small></span> </div> 
                                </div>
                                <div class="all_day_message wpc-default-guest-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>

    <?php            
    if ( class_exists( 'Wpcafe_Pro' ) && file_exists($get_data['reservation_holiday_settings']) ) {
        include $get_data['reservation_holiday_settings']; 
    }
    ?>
    
    <div class="wpc-label-item wpc-shcedule-event-item">
        <div class="wpc-label">
            <label for="wpc_exceptions"><?php esc_html_e('Exception Schedule', 'wpcafe'); ?></label>
            <div class="wpc-desc"> <?php esc_html_e('Set opening and closing schedule for any special day', 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta exception_section">
            <div class="exception_main_block">
                <?php
                $wpc_exception['wpc_exception_date']       = isset( $settings['wpc_exception_date'] ) ? $settings['wpc_exception_date'] : [];
                $wpc_exception['wpc_exception_start_time'] = isset( $settings['wpc_exception_start_time'] ) ? $settings['wpc_exception_start_time'] : [];
                $wpc_exception['wpc_exception_end_time']   = isset( $settings['wpc_exception_end_time'] ) ? $settings['wpc_exception_end_time'] : [];
                if( is_array( $wpc_exception['wpc_exception_date'] ) && count($wpc_exception['wpc_exception_date']) > 0 && $wpc_exception['wpc_exception_date']['0'] !== ''){
                    ?>
                    <div class="wpc-schedule-field multi_schedule_wrap mb-2">
                        <p class="wpc-desc wpc-settings-input attr-form-control"><?php echo esc_html__('Date', 'wpcafe'); ?></p>
                        <p class="wpc-desc wpc-settings-input attr-form-control"><?php echo esc_html__('Start Time', 'wpcafe'); ?></p>
                        <p class="wpc-desc wpc-settings-input attr-form-control"><?php echo esc_html__('End Time', 'wpcafe'); ?></p>
                    </div>
                    <?php
                    for ( $index=0; $index < count( $wpc_exception['wpc_exception_date'] ) ; $index ++) {
                        $exception_start_time = $wpc_exception['wpc_exception_start_time'][ $index ];
                        $exception_end_time   = $wpc_exception['wpc_exception_end_time'][ $index ];
                        ?>

                        <div class="exception_block d-flex mb-2">
                            <input type="text" name="wpc_exception_date[]" value="<?php echo Wpc_Utilities::wpc_render( $wpc_exception['wpc_exception_date'][ $index ] ); ?>" class="wpc_exception_date wpc_exception_date_<?php echo intval( $index )?> mr-1 wpc-settings-input attr-form-control" id="exception_date_<?php echo Wpc_Utilities::wpc_render( $index )?>" data-current_id="<?php echo intval( $index ) ?>" placeholder="<?php esc_attr_e('Date', 'wpcafe' ); ?>" />
                            <div class="wpc_exception_start_time_wrap">
                                <input type="text" name="wpc_exception_start_time[]" value="<?php echo Wpc_Utilities::wpc_render( $exception_start_time ); ?>" class="wpc_exception_start_time wpc_exception_start_time_<?php echo intval( $index )?> mr-1 wpc-settings-input attr-form-control <?php echo empty( $exception_start_time ) ? 'wpc_field_error' : '' ?>" id="<?php echo intval( $index ) ?>"  placeholder="<?php esc_attr_e('Start Time', 'wpcafe'); ?>" />
                                <?php if( empty( $exception_start_time ) ) { ?>
                                    <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                <?php } ?>
                            </div>
                            <div class="wpc_exception_end_time_wrap">
                                <input type="text"  name="wpc_exception_end_time[]" value="<?php echo Wpc_Utilities::wpc_render( $exception_end_time ); ?>" class="wpc_exception_end_time wpc_exception_end_time_<?php echo intval( $index )?> wpc-settings-input attr-form-control <?php echo empty( $exception_end_time ) ? 'wpc_field_error' : '' ?>" id="<?php echo intval( $index ) ?>"  placeholder="<?php esc_attr_e('End Time', 'wpcafe' ); ?>"/>
                                <?php if( empty( $exception_end_time ) ) { ?>
                                    <span class="wpc_field_error_msg"><?php echo esc_html__('This field should be filled up', 'wpcafe'); ?></span>
                                <?php } ?>
                            </div>
                            <div class="exception_time_clear" id="<?php echo intval( $index )?>" ><span class="dashicons dashicons-update-alt wpc-tooltip" data-title="<?php echo esc_attr__('Reset fields', 'wpcafe'); ?>"> <small class="wpc-tooltip-angle"></small></span> </div>
                            <?php if( $index != 0 ) { ?>
                                <span class="wpc-btn dashicons dashicons-no-alt remove_exception_block wpc_icon_middle_position"></span>
                            <?php } ?>
                        </div>
                        <div class=" wpc-default-guest-message schedule_exception_message_<?php echo intval( $index );?>"></div>
                        <?php
                    }
                }
                else {
                ?>
                    <div class="exception_block d-flex mb-2">
                        <input type="text" name="wpc_exception_date[]" value="" class="wpc_exception_date wpc_exception_date_0 mr-1 wpc-settings-input attr-form-control" data-current_id="0" placeholder="<?php esc_attr_e('Date', 'wpcafe'  )?>" />
                        <div class="wpc_exception_start_time_wrap">
                            <input type="text" name="wpc_exception_start_time[]" value="" id="0" class="wpc_exception_start_time wpc_exception_start_time_0 mr-1 wpc-settings-input attr-form-control" disabled placeholder="<?php esc_attr_e('Start Time', 'wpcafe'); ?>" />
                        </div>
                        <div class="wpc_exception_end_time_wrap">
                            <input type="text" name="wpc_exception_end_time[]" value="" id="0" class="wpc_exception_end_time wpc_exception_end_time_0 wpc-settings-input attr-form-control" disabled placeholder="<?php esc_attr_e('End Time', 'wpcafe'); ?>"/>
                        </div>
                        <div class="exception_time_clear" id="0" style="display: none;"><span class="dashicons dashicons-update-alt wpc-tooltip" data-title="<?php echo esc_attr__('Reset fields', 'wpcafe'); ?>"> <small class="wpc-tooltip-angle"></small></span></div>
                    </div>
                    <div class=" wpc-default-guest-message schedule_exception_message_0"></div>
                <?php
                }
                ?>
            </div>
            <div class="wpc_flex_reverse">
                <span class="add_exception_block wpc-btn wpc-tooltip" data-tooltip-remove ="<?php echo esc_attr__('Remove Schedule', 'wpcafe') ?>" data-tooltip-reset="<?php echo esc_attr__('Reset fields' , 'wpcafe' ); ?>" data-title="<?php echo esc_attr__('Add more', 'wpcafe'); ?>" data-start_time="<?php echo esc_attr__('Start Time', 'wpcafe'); ?>" data-end_time="<?php echo esc_attr__('End Time', 'wpcafe'); ?>">
                    <i class="dashicons icon_cursor text-right dashicons-plus-alt  pl-1"></i>
                    <small class="wpc-tooltip-angle"></small>
                </span>
            </div>
        </div>
    </div>
    <div class="wpc-label-item">
        <div class="wpc-label">
            <label for="wpc_early_bookings"><?php esc_html_e('Earliest Time Limit for Reservation', 'wpcafe'  ); ?></label>
            <div class="wpc-desc"> <?php esc_html_e('Set initial time for early reservation. User can not place reservation before the defined time', 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta">
            <select id="wpc_early_bookings" class="wpc-settings-input" name="wpc_early_bookings">
                <?php
                $selected_early_booking = !empty( $settings['wpc_early_bookings'] ) ? $settings['wpc_early_bookings'] : "";
                
                $wpc_early_bookings= array( 
                    'any_time'     => esc_html__( 'Any time', 'wpcafe' ),
                    'day'          => esc_html__( 'Day', 'wpcafe' ),
                    'week'         => esc_html__( 'Week', 'wpcafe' ),
                    'month'        => esc_html__( 'Month', 'wpcafe' ),
                    );
                    foreach( $wpc_early_bookings as $key => $value ) { ?>
                        <option <?php selected( $selected_early_booking , $key , true ); ?> value='<?php echo esc_attr( $key ); ?>'><?php echo esc_html( $value ); ?></option>
                    <?php }
                ?>
            </select>
            <input type="number" name="wpc_early_bookings_value" value="<?php echo ( !empty( $settings['wpc_early_bookings_value'] ) ) ? Wpc_Utilities::wpc_render( $settings['wpc_early_bookings_value'] ) : ''; ?>"  min="0" class="wpc-settings-input <?php echo ( empty( $settings['wpc_early_bookings'] ) || $settings['wpc_early_bookings'] == 'any_time') ? 'wpc-d-none' : ''; ?>" required <?php echo ( empty($settings['wpc_early_bookings'] ) || $settings['wpc_early_bookings'] == 'any_time') ? 'disabled="disabled"' : ''; ?>>
        </div>
    </div>
    <div class="wpc-label-item">
        <div class="wpc-label">
            <label for="wpc_late_bookings"><?php esc_html_e('Last Time for Reservation', 'wpcafe'); ?></label>
            <div class="wpc-desc"> <?php esc_html_e('Set final time for late reservation. User can not place reservation after the defined time', 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta">
            <select id="wpc_late_bookings" class="wpc-settings-input" name="wpc_late_bookings">
                <?php
                $selected_late_booking = !empty( $settings['wpc_late_bookings'] ) ? $settings['wpc_late_bookings'] : "";
                $wpc_late_bookings= array( 
                    '1'       => esc_html__( 'Up to the last minute', 'wpcafe' ),
                    '15'      => esc_html__( 'At least 15 minutes in advance', 'wpcafe' ),
                    '30'      => esc_html__( 'At least 30 minutes in advance', 'wpcafe' ),
                    '45'      => esc_html__( 'At least 45 minutes in advance', 'wpcafe' ),
                    );
                    foreach( $wpc_late_bookings as $key => $value ) { ?>
                        <option <?php selected( $selected_late_booking , $key , true ); ?> value='<?php echo esc_attr( $key ); ?>'><?php echo esc_html( $value ); ?></option>
                    <?php }
                ?>
            </select>
        </div>
    </div>
<?php
return;