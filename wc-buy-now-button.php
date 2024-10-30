<?php 
/* =====================================
Plugin Name:       WC Buy Now Button
Plugin URI:        https://plugin.habibcoder.com/wc-buy-now/
Author:            HabibCoder
Author URI:        http://habibcoder.com
Version:           2.0.0
Tested up to:      6.6
Requires at least: 6.0
Requires PHP:      7.0
License:           GNU General Public License 
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Tags:              Buy Now, WooCommerce Buy Now, Buy Now Button, WooCommerce buy now button, WooCommerce buy now
Description:       WC Buy Now Button is an easy and simple plugin for adding a Buy Now Button in your WooCommerce Store. "WooCommerce" is Required for this plugin.
Text Domain:       wc-buy-now-button
===================================== */

// ABSPATH Defined
if(!defined('ABSPATH')){
    exit('not valid');
}


// if active woocommerce
if (in_array('woocommerce/woocommerce.php', get_option('active_plugins'))) {
    
    /* ==========================
        Register Text Domain
    ========================== */
    add_action('plugins_loaded', 'wcbuynow_load_textdomain');
    function wcbuynow_load_textdomain(){
        load_plugin_textdomain('wc-buy-now-button', false, dirname(plugin_basename( __FILE__ ) ) . '/lang');
    }


    /* ==================================================
        Get Plugin Directory & URL and Define Constant
    ================================================== */
    //Plugin Dir & Url
    $wcbuynow_dir = plugin_dir_path( __FILE__ ); 
    $wcbuynow_url = plugin_dir_url( __FILE__ );

    //Define Dir & Url as a Constants
    define( 'WCBUYNOW_PLUGIN_DIR', $wcbuynow_dir );
    define( 'WCBUYNOW_PLUGIN_URL', $wcbuynow_url );


    /* ==========================
        Requires File
    ========================== */
    // Dashboard Require
    $wcbuynow_admin_dir = WCBUYNOW_PLUGIN_DIR .'admin/wbn-admin.php';
    if(file_exists( $wcbuynow_admin_dir )){
        require_once( $wcbuynow_admin_dir );
    }
    // Frontend
    $wcbuynow_frontend_dir = WCBUYNOW_PLUGIN_DIR .'frontend/wcbuynow-frontend.php';
    if(file_exists( $wcbuynow_frontend_dir )){
        require_once( $wcbuynow_frontend_dir );
    }


    /* ==========================
        Enqueue in Admin Panel
    ========================== */
    add_action('admin_enqueue_scripts', 'wcbuynow_admin_enqueues');
    function wcbuynow_admin_enqueues(){
        // Scripts
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('wc-buy-now-button-scripts', PLUGINS_URL('js/wcbuynow-admin.js', __FILE__), array('jquery'), '1.0.0', true);
        // Style
        wp_enqueue_style('wc-buy-now-button-style', PLUGINS_URL('css/wbn-admin.css', __FILE__), array(), '1.0.0', 'all');
    }


    /* ==========================
        Enqueue in Front-End
    ========================== */
    add_action('wp_enqueue_scripts', 'wcbuynow_stylejs_enqueues');
    function wcbuynow_stylejs_enqueues(){
        wp_enqueue_style('wc-buy-now-button-style', PLUGINS_URL('css/wbn-style.css', __FILE__), array(), '1.0.0', 'all');
    }

    /* ==========================
        Redirect to plugin
    ========================== */
    register_activation_hook( __FILE__, 'wcbuynowbtn_plugin_activation' );
    function wcbuynowbtn_plugin_activation(){
        add_option('wcbuynowbtn_plugin_do_activate', true);
    }

    add_action('admin_init', 'wcbuynowbtn_plugin_redirect');
    function wcbuynowbtn_plugin_redirect(){
        if (is_admin() && get_option('wcbuynowbtn_plugin_do_activate', false)) {
            delete_option('wcbuynowbtn_plugin_do_activate');

            if (!isset($_GET['active_multi'])) {
                wp_safe_redirect( admin_url('admin.php?page=wc-buy-now-button') );
                exit;
            }

        }
    };

}else{
    // WooCommerce not active
    add_action('admin_notices', 'hc_wcbuynowbtn_missing_notice');
    function hc_wcbuynowbtn_missing_notice() {
        $message = '"WC Buy Now Button" is required WooCommerce. Please activate WooCommerce before using this plugin.';
        echo '<div class="notice notice-error is-dismissible"><p>' . $message . '</p></div>';
    };

    add_action('admin_init', 'hc_wcbuynowbtn_deactivate_plugin');
    function hc_wcbuynowbtn_deactivate_plugin() {
        deactivate_plugins(plugin_basename(__FILE__));
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    };

} //end active Woo check condition
