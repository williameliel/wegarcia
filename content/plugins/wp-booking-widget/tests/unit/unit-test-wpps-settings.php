<?php

require_once( WP_PLUGIN_DIR . '/simpletest-for-wordpress/WpSimpleTest.php' );
require_once( dirname( dirname( __DIR__ ) ) . '/classes/wpbw-settings.php' );

/**
 * Unit tests for the WPBW_Settings class
 *
 * Uses the SimpleTest For WordPress plugin
 *
 * @link http://wordpress.org/extend/plugins/simpletest-for-wordpress/
 */
if ( ! class_exists( 'UnitTestWPBW_Settings' ) ) {
	class UnitTestWPBW_Settings extends UnitTestCase {
		public function __construct() {
			$this->WPBW_Settings = WPBW_Settings::get_instance();
		}

		/*
		 * validate_settings()
		 */
		public function test_validate_settings() {
			// Valid settings
			$this->WPBW_Settings->init();
			$valid_settings = array(
				'basic'    => array(
					'field-example1' => 'valid data'
				),

				'advanced' => array(
					'field-example2' => 5
				)
			);

			$clean_settings = $this->WPBW_Settings->validate_settings( $valid_settings );

			$this->assertEqual( $valid_settings['basic']['field-example1'], $clean_settings['basic']['field-example1'] );
			$this->assertEqual( $valid_settings['advanced']['field-example2'], $clean_settings['advanced']['field-example2'] );


			// Invalid settings
			$this->WPBW_Settings->init();
			$invalid_settings = array(
				'basic'    => array(
					'field-example1' => 'invalid data'
				),

				'advanced' => array(
					'field-example2' => - 5
				)
			);

			$clean_settings = $this->WPBW_Settings->validate_settings( $invalid_settings );
			$this->assertNotEqual( $invalid_settings['basic']['field-example1'], $clean_settings['basic']['field-example1'] );
			$this->assertNotEqual( $invalid_settings['advanced']['field-example2'], $clean_settings['advanced']['field-example2'] );
		}

		/*
		 * __set()
		 */
		public function test_magic_set() {
			// Test that fields are validated
			$this->WPBW_Settings->init();
			$this->WPBW_Settings->settings = array( 'db-version' => array() );
			$this->assertEqual( $this->WPBW_Settings->settings['db-version'], WP_Booking_Widget::VERSION );

			// Test that values gets written to database
			$this->WPBW_Settings->settings = array( 'db-version' => '5' );
			$this->WPBW_Settings->init();
			$this->assertEqual( $this->WPBW_Settings->settings['db-version'], '5' );
			$this->WPBW_Settings->settings = array( 'db-version' => WP_Booking_Widget::VERSION );

			// Test that setting deep values triggers error
			$this->expectError( new PatternExpectation( '/Indirect modification of overloaded property/i' ) );
			$this->WPBW_Settings->settings['db-version'] = WP_Booking_Widget::VERSION;
		}
	} // end UnitTestWPBW_Settings
}

?>