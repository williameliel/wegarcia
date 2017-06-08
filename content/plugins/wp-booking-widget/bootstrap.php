<?php
/*
Plugin Name: WordPress Booking Widget
Plugin URI:  https://github.com/williameliel/WP-Booking-Widget
Description: The booking widget
Version:     1.0
Author:      William Garcia
Author URI:  http://wegarcia.com
*/


if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'WPBW_NAME',                 'WordPress Booking Widget' );
define( 'WPBW_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'WPBW_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function wpbw_requirements_met() {
	global $wp_version;
	//require_once( ABSPATH . '/wp-admin/includes/plugin.php' );		// to get is_plugin_active() early

	if ( version_compare( PHP_VERSION, WPBW_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, WPBW_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	/*
	if ( ! is_plugin_active( 'plugin-directory/plugin-file.php' ) ) {
		return false;
	}
	*/

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function wpbw_requirements_error() {
	global $wp_version;

	require_once( dirname( __FILE__ ) . '/views/requirements-error.php' );
}

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. Otherwise older PHP installations could crash when trying to parse it.
 */
if ( wpbw_requirements_met() ) {
	require_once( __DIR__ . '/classes/wpbw-module.php' );
	require_once( __DIR__ . '/classes/wordpress-plugin-skeleton.php' );
	require_once( __DIR__ . '/includes/admin-notice-helper/admin-notice-helper.php' );
	require_once( __DIR__ . '/classes/wpbw-widget.php' );
	require_once( __DIR__ . '/classes/wpbw-settings.php' );
	require_once( __DIR__ . '/classes/wpbw-instance-class.php' );

	if ( class_exists( 'WP_Booking_Widget' ) ) {
		$GLOBALS['wpbw'] = WP_Booking_Widget::get_instance();
		register_activation_hook(   __FILE__, array( $GLOBALS['wpbw'], 'activate' ) );
		register_deactivation_hook( __FILE__, array( $GLOBALS['wpbw'], 'deactivate' ) );
	}
} else {
	add_action( 'admin_notices', 'wpbw_requirements_error' );
}
