<?php
namespace WpCafe\Core\Menu;

defined( 'ABSPATH' ) || exit;

/**
 * Menu handle class
 */
class Wpc_Menus {

    use \WpCafe\Traits\Wpc_Singleton;

    public $settings;
    private $pages;
    private $sub_pages;

    /**
     * Call all action
     */
    public function init() {

        // create cafe  menu
        $this->pages = [
            [
                "page_title"  => esc_html__( 'Settings', 'wpcafe' ),
                "menu_title"  => esc_html__( 'WPCafe', 'wpcafe' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'cafe_menu',
                "cb_function" => [$this, 'admin_settings_view'],
                "icon"        => '',
                'position'    => 9,
            ],
        ];

        // create cafe sub menu
        $this->sub_pages = [
            [
                "parent_slug" => 'cafe_menu',
                "page_title"  => esc_html__( 'Add new bookings', 'wpcafe' ),
                "menu_title"  => esc_html__( 'Reservation List', 'wpcafe' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'edit.php?post_type=wpc_reservation',
                "cb_function" => false,
                'position'    => 1,
            ],
            [
                "parent_slug" => 'cafe_menu',
                "page_title"  => esc_html__( 'Shortcodes', 'wpcafe' ),
                "menu_title"  => esc_html__( 'Available Shortcodes', 'wpcafe' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'wpc_shortcode',
                "cb_function" => [$this, 'available_shortcode_view'],
                'position'    => 2,
            ],
       
        ];

        // add sub menus from pro
        if ( class_exists('Wpcafe_Pro') ) {

            $sub_menus = array(
                "parent_slug" => 'cafe_menu',
                "page_title"  => esc_html__( 'Product Addons', 'wpcafe-pro' ),
                "menu_title"  => esc_html__( 'Product Addons', 'wpcafe-pro' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'wpc_product_addons',
                "cb_function" => [$this,'addons_menu_pages'],
                'position'    => 2,
            );

            array_push( $this->sub_pages , $sub_menus ); 

        }


        // register menu and sub menu pages
        new \WpCafe\Core\Base\Wpc_Menu_Build( 
            $this->pages, 
            esc_html__( 'Settings', 'wpcafe' ), 
            $this->sub_pages 
        );

    }

    public function addons_menu_pages(){
        return apply_filters("wpcafe_pro/menus/admin_submenu_pages", null );
    }

    /**
     * Show Settings Page
     */
    public function admin_settings_view() {
        \WpCafe\Core\Settings\Wpc_Key_Options::instance()->wpc_key_options();
    }

    /**
     * Show Shortcode Page
     */
    public function available_shortcode_view() {
        \WpCafe\Core\Settings\Wpc_Key_Options::instance()->shortcode_menu_view();
    }

    /**
     * WpCafe app settings page
     */
    public function wpc_app_banner() {
        include_once \Wpcafe::core_dir() . "settings/part/app_banner.php";
    }

}
