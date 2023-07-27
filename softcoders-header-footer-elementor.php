<?php
/**
 * Plugin Name: SoftCoders Framework
 * Plugin URI:  https://themeforest.net/user/SoftCoders/portfolio
 * Description: SoftCoders header footer builder
 * Author:      SoftCoders The
 * Author URI:  https://themeforest.net/user/SoftCoders/portfolio
 * Text Domain: SoftCoders-header-footer-elementor
 * Domain Path: /languages
 * Version: 1.0.0
 */

define( 'softcoderselements_VER', '1.0.0' );
define( 'softcoderselements_FILE', __FILE__ );
define( 'softcoderselements_DIR', plugin_dir_path( __FILE__ ) );
define( 'softcoderselements_URL', plugins_url( '/', __FILE__ ) );
define( 'softcoderselements_PATH', plugin_basename( __FILE__ ) );
define( 'softcoderselements_DOMAIN', trailingslashit( 'https://themeforest.net/user/softcoderes/portfolio' ) );
define( 'softcoderselements_DIR_URL_ADMIN', plugin_dir_url( __FILE__ ) );
define( 'softcoderselements_ASSETS_ADMIN', trailingslashit( softcoderselements_DIR_URL_ADMIN ) );
define( 'softcoderselements_PREFIX', 'softcoders' );

/**
 * All class loader files.
 */
require_once softcoderselements_DIR . '/inc/class-header-footer-elementor.php';
require_once softcoderselements_DIR . '/inc/meta/softcoders-postmeta.php';
require_once softcoderselements_DIR . '/inc/meta/post-meta.php'; // Post Meta

require_once softcoderselements_DIR . 'widgets/init.php';
require_once softcoderselements_DIR . 'widgets/softcoders-widget-fields.php';

/**
 * Active Plugin Class Lade.
 */
function softcoderselements_plugin_activation() {

	$footer_widget = socoders_elements_footer_widget_function();
	update_option( 'socoders_elements_plugin_is_activated', 'yes' );
	update_option( 'softcoderselements_addon_option', $footer_widget );
}
register_activation_hook( softcoderselements_FILE, 'softcoderselements_plugin_activation' );
/**
 * The Plugin Class Load
 */
function softcoderselements_init() {
	Header_Footer_Elementor::instance();
}
add_action( 'plugins_loaded', 'softcoderselements_init' );
function socoders_elements_footer_widget_function() {
	$array = [
        'softcoderselements_copyright' => 'softcoderselements_copyright',
        'softcoderselements_pricing_switcher' => 'softcoderselements_pricing_switcher',
		'softcoderselements_newsletter' => 'softcoderselements_newsletter',
		'softcoderselements_header_button' => 'softcoderselements_header_button',
		'softcoderselements_navigation_menu' => 'softcoderselements_navigation_menu' ,
		'softcoderselements_site_logo' => 'softcoderselements_site_logo',
		'softcoderselements_page_title' => 'softcoderselements_page_title',
		'softcoderselements_search' => 'softcoderselements_search',
		'softcoderselements_service_grid' => 'softcoderselements_service_grid',
		'softcoderselements_counter' => 'softcoderselements_counter',
		'softcoderselements_feature_list' => 'softcoderselements_feature_list',
		'softcoderselements_teamslider' => 'softcoderselements_teamslider',
		'softcoderselements_TeamGrid' => 'softcoderselements_TeamGrid',
		'softcoderselements_blogslider' => 'softcoderselements_blogslider',
		'softcoderselements_BlogGrid' => 'softcoderselements_BlogGrid',
		'softcoderselements_contactform' => 'softcoderselements_contactform',
		'softcoderselements_projectslider' => 'softcoderselements_projectslider',
		'softcoderselements_testimonial' => 'softcoderselements_testimonial',
		'softcoderselements_brandslider' => 'softcoderselements_brandslider',
		'softcoderselements_pricetable' => 'softcoderselements_pricetable',
		'softcoderselements_heroslider' => 'softcoderselements_heroslider',
		'softcoderselements_SC_Accordion' => 'softcoderselements_SC_Accordion',
		'softcoderselements_service_slider' => 'softcoderselements_service_slider',
		'softcoderselements_working_process' => 'softcoderselements_working_process',
		'softcoderselements_sc_breadcrumb' => 'softcoderselements_sc_breadcrumb',
		'softcoderselements_ProjectGrid' => 'softcoderselements_ProjectGrid',
		'softcoderselements_SCoffcanvas' => 'softcoderselements_SCoffcanvas',
	];
	return $array;
}


