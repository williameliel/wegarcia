<?php
/*
Plugin Name: DsgnWrks Instagram Importer Debug
Plugin URI: http://dsgnwrks.pro/plugins/dsgnwrks-instagram-importer-debug
Description: Enables a debug mode option for troubleshooting issues with the DsgnWrks Instagram Importer plugin
Author URI: http://dsgnwrks.pro
Author: DsgnWrks
Donate link: http://dsgnwrks.pro/give/
Version: 0.1.6
*/

define( 'DW_INST_DEBUG_MIN_VERSION', '1.3.7' );
define( 'DW_INST_DEBUG_PLUGIN', plugin_basename( __FILE__ ) );

add_action( 'plugins_loaded', 'dsgnwrks_instagram_check_for_main_plugin', 99 );
function dsgnwrks_instagram_check_for_main_plugin() {
	// is main plugin active?
	if ( ! class_exists( 'DsgnWrksInstagram' ) ) {
		add_action( 'all_admin_notices', 'dsgnwrks_instagram_debug_admin_notice' );
		return;
	}

	include 'DsgnWrksInstagramDebug.class.php';
}

function dsgnwrks_instagram_debug_admin_notice() {
	// Main plugin not active
	echo '<div id="message" class="error"><p>'. sprintf( __( '"DsgnWrks Instagram Importer" (version %s) plugin is required for "DsgnWrks Instagram Importer Debug."', 'dsgnwrks' ), DW_INST_DEBUG_MIN_VERSION ) .'</p></div>';
	// Deactivate
	deactivate_plugins( DW_INST_DEBUG_PLUGIN, true );
}

register_uninstall_hook( __FILE__, 'dsgnwrks_instagram_debug_deactivate_uninstall' );
register_deactivation_hook( __FILE__, 'dsgnwrks_instagram_debug_deactivate_uninstall' );
function dsgnwrks_instagram_debug_deactivate_uninstall() {
	delete_option( 'dsgnwrks-import-debug-sent' );
}
