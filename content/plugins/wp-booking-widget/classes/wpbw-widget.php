<?php

if ( ! class_exists( 'WPBW_Widget' ) ) {

  /**
   * Creates a custom post type and associated taxonomies
   */
  class WPBW_Widget extends WPBW_Module  {
    protected static $readable_properties  = array();
    protected static $writeable_properties = array();
    const VERSION    = '1a';
    const PREFIX     = 'wpbw_';
    const DEBUG_MODE = false;

    /*
     * Magic methods
     */

    /**
     * Constructor
     *
     * @mvc Controller
     */
    protected function __construct() {
      $this->register_hook_callbacks();
    }


    /*
     * Static methods
     */

    /**
     * Defines the [wpbw-cpt-shortcode] shortcode
     *
     * @mvc Controller
     *
     * @param array $attributes
     * return string
     */
    public static function cpt_shortcode_example( $attributes ) {
      $attributes = apply_filters( 'wpbw_cpt-shortcode-example-attributes', $attributes );
      $attributes = self::validate_cpt_shortcode_example_attributes( $attributes );

      return self::render_template( 'wpbw-widget/widget-shortcode.php', array( 'attributes' => $attributes ) );
    }

    /**
     * Validates the attributes for the [cpt-shortcode-example] shortcode
     *
     * @mvc Model
     *
     * @param array $attributes
     * return array
     */
    protected static function validate_cpt_shortcode_example_attributes( $attributes ) {
      $defaults   = self::get_default_cpt_shortcode_example_attributes();
      $attributes = shortcode_atts( $defaults, $attributes );

      if ( $attributes['foo'] != 'valid data' ) {
        $attributes['foo'] = $defaults['foo'];
      }

      return apply_filters( 'wpbw_validate-cpt-shortcode-example-attributes', $attributes );
    }

    /**
     * Defines the default arguments for the [cpt-shortcode-example] shortcode
     *
     * @mvc Model
     *
     * @return array
     */
    protected static function get_default_cpt_shortcode_example_attributes() {
      $attributes = array(
        'foo' => 'bar',
        'bar' => 'foo'
      );

      return apply_filters( 'wpbw_default-cpt-shortcode-example-attributes', $attributes );
    }


    /*
     * Instance methods
     */

    /**
     * Register callbacks for actions and filters
     *
     * @mvc Controller
     */
    public function register_hook_callbacks() {
      
      add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_assets' );

      add_action( 'init',                     array( $this, 'init' ) );

      add_shortcode( 'cpt-shortcode-example', __CLASS__ . '::cpt_shortcode_example' );
    }

   
      /**
     * Theme assets
     */
    public static function enqueue_assets() { 

      wp_register_script(
        self::PREFIX . 'scripts',
        plugins_url( 'javascript/wordpress-booking-widget.js', dirname( __FILE__ ) ),
        array( 'jquery' ),
        self::VERSION,
        true
      );

      wp_register_style(
        self::PREFIX . 'styles',
        plugins_url( 'css/main.css', dirname( __FILE__ ) ),
        array(),
        self::VERSION,
        'all'
      );

      if(!is_admin()){

        wp_enqueue_script( self::PREFIX . 'scripts' );
        wp_enqueue_style( self::PREFIX . 'styles' );
       
      }
    
    }
  
   /**
     * Rolls back activation procedures when de-activating the plugin
     *
     * @mvc Controller
     */
    public function activate($network_wide) {
    }
    /**
     * Rolls back activation procedures when de-activating the plugin
     *
     * @mvc Controller
     */
    public function deactivate() {
    }

    /**
     * Initializes variables
     *
     * @mvc Controller
     */
    public function init() {
    }

    /**
     * Executes the logic of upgrading from specific older versions of the plugin to the current version
     *
     * @mvc Model
     *
     * @param string $db_version
     */
    public function upgrade( $db_version = 0 ) {
      /*
      if( version_compare( $db_version, 'x.y.z', '<' ) )
      {
        // Do stuff
      }
      */
    }

    /**
     * Checks that the object is in a correct state
     *
     * @mvc Model
     *
     * @param string $property An individual property to check, or 'all' to check all of them
     *
     * @return bool
     */
    protected function is_valid( $property = 'all' ) {
      return true;
    }
  } // end WPBW_Widget
}