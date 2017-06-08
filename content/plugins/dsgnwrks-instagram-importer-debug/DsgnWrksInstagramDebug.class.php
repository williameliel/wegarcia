<?php

/**
 * Adds debug options to the DsgnWrks Instagram Importer plugin
 */
class DsgnWrksInstagramDebug {

	public static function hooks() {
		// hook into the plugin
		add_action( 'dsgnwrks_instagram_univeral_options', array( __CLASS__, 'start_outputbuffer' ), 5 );
		add_action( 'dsgnwrks_instagram_univeral_options', array( __CLASS__, 'debug_mode_option' ), 20 );
		add_filter( 'dsgnwrks_instagram_option_save', array( __CLASS__, 'save_debug_mode' ), 10, 2 );
		if ( DsgnWrksInstagram::get_instance()->plugin_version < DW_INST_DEBUG_MIN_VERSION ) {
			add_action( 'all_admin_notices', 'dsgnwrks_instagram_debug_admin_notice' );
		}
	}

	/**
	 * Adds a debug mode option
	 */
	public static function start_outputbuffer() { ob_start(); }

	/**
	 * Adds a debug mode option
	 */
	public static function debug_mode_option( $opts ) {
		// grab the data from the output buffer and add it to our $content variable
		$content = ob_get_clean();

		ob_start();
		?>
		<tr valign="top">
			<th scope="row">
				<strong><?php _e( 'Enable Debug Mode:', 'dsgnwrks' ); ?></strong>
				<br/><?php _e( 'only enable if you\'re experiencing issues with the importer.', 'dsgnwrks' ); ?>
			</th>
			<td>
				<input type="checkbox" name="dsgnwrks_insta_options[debugmode]" <?php checked( isset( $opts['debugmode'] ) && $opts['debugmode'] == 'on' ); ?> value="on"/>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<strong class="warning"><?php _e( 'Delete all users and options:', 'dsgnwrks' ); ?></strong>
				<br/><?php _e( 'occasionally required if there was an issue with Instagram authentication.', 'dsgnwrks' ); ?></th>
			<td>
				<input type="checkbox" name="dsgnwrks_insta_options[delete-all]" <?php checked( isset( $opts['delete-all'] ) && $opts['delete-all'] == 'yes' ); ?> value="yes"/>
			</td>
		</tr>
		<?php
		$debug_content = ob_get_clean();

		echo str_replace( '</tbody>', $debug_content . '</tbody>', $content );
	}

	/**
	 * Saves the debug mode option
	 */
	public static function save_debug_mode( $opts, $old_opts ) {
		$instagram = DsgnWrksInstagram::get_instance();

		// loop through options (users)
		foreach ( $opts as $user => $useropts ) {

			switch ( $user ) {

				// if Debug Mode was set
				case 'debugmode':
					$opts[ $user ] = esc_attr( $useropts );
					// and if our newly saved 'debugmode' is different
					// clear the debug sent option
					if ( ( !isset( $old_opts['debugmode'] ) || $old_opts['debugmode'] != 'on' ) && $opts[ $user ] == 'on' )
						delete_option( 'dsgnwrks-import-debug-sent' );
					break;

				// if Delete All was set
				case 'delete-all':
					$opts[ $user ] = false;
					$opts = array();

					$instagram->settings->all_opts['debugmode'] = 'on';
					// send a debug report
					$instagram->debugsend( 'delete-all', 'DsgnWrksInstagramDebug', array(
						'OPTION: \'dsgnwrks_insta_options\'' => get_option( 'dsgnwrks_insta_options' ),
						'OPTION: \'dsgnwrks_insta_users\'' => get_option( 'dsgnwrks_insta_users' ),
					) );
					// delete options
					DsgnWrksInstagram::delete_options();

					remove_filter( 'dsgnwrks_instagram_option_save', array( __CLASS__, 'save_debug_mode' ), 10, 2 );

					deactivate_plugins( DW_INST_DEBUG_PLUGIN, true );

					break;

			}
		}

		return $opts;
	}

}
// init our class
DsgnWrksInstagramDebug::hooks();
