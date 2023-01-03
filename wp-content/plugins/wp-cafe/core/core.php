<?php
namespace WpCafe\Core;

defined( "ABSPATH" ) || exit;

/**
 * Load all admin class
 */
class Core {
    
    use \WpCafe\Traits\Wpc_Singleton;

    /**
     *  Call admin function
     */
    function init() {

        //register all menu
        \WpCafe\Core\Menu\Wpc_Menus::instance()->init();
        
        // Settings field for bookings
        $setting_field = \WpCafe\Core\Base\Wpc_Settings_Field::instance();
        
        $this->dispatch_actions( $setting_field );
        // All modules register
        $this->register_backend_actions();
    }

    /**
     * Register  for backend
     */
    public function register_backend_actions() {
        remove_filter( 'the_content', 'wpautop' );
        //register reservation report dashboard
        \WpCafe\Core\Modules\Reservation\Wpc_Reservation_Report::instance()->init();
    }

    /**
     * Register modules
     */
    public function register_modules() {
        //register food menu module
        \WpCafe\Core\Modules\Food_Menu\Hooks::instance()->init();
    }

    /**
     * Save settings
     */
    public function dispatch_actions( $setting_field ) {
        add_action( 'admin_init', [$setting_field, 'form_handler'] );
    }

}
