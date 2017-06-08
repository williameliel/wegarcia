<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

$sage_includes = [
    'lib/constants.php',                    // Constants
    'lib/environment.php',                  // Layout wrapper
    'lib/assets.php',                       // Scripts and stylesheets
    'lib/custom-post-type.php',             // Custom post type
    // 'lib/custom-taxonomies.php',            // Custom Taxonomies
    //'lib/custom-fields.php',                // Custom fields // Using json for now
    'lib/extras.php',                       // Custom functions
    'lib/setup.php',                        // Theme setup
    'lib/titles.php',                       // Page titles
    'lib/wrapper.php',                      // Theme wrapper class
    // 'lib/customizer.php',                   // Theme customizer
    // 'lib/layouts.php',                      // Layout wrapper
    //'lib/rest.php'                          // REST API filters
];

foreach ($sage_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}

unset($file, $filepath);

/*
 * Add Meta Options page for each site.
 */
if ( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Meta Info',
		'menu_title'	=> 'Meta Info',
		'menu_slug' 	=> 'meta'
	));
}

add_image_size('custom-300x300', 300, 300, true);
add_image_size('custom-600x600', 600, 600, true);
add_image_size('custom-460x500', 460, 500, true);
add_image_size('custom-586x396', 586, 396, true);
add_image_size('custom-464x630', 464, 630, true);
add_image_size('custom-900x600', 900, 600, true);

/*
 * Ajax recipient for Group Booking Form
 */
add_action( 'wp_ajax_handle_group_booking_form', 'handle_group_booking_form' );
add_action( 'wp_ajax_nopriv_handle_group_booking_form', 'handle_group_booking_form' );

function create_group_booking_email_html($data) {
    $html = "GROUP BOOKING REQUEST\n";
    foreach ($data as $item_key => $item_value) {
        $html .= str_replace('_', ' ', $item_key) . ": " . $item_value . "\n";
    }
    return $html;
}

function handle_group_booking_form() {
    $data = $_POST['data'];
    $mail_to = Contact_Form_Handler::strip_at_domain_from_email($data['recipient']) . '@domain.com';
    $mail_subject = 'Group Booking Reservation';
    $mail_message = create_group_booking_email_html($data);
    echo wp_mail($mail_to, $mail_subject, $mail_message);
    die;
}

/*
 * Use theme templates for single Facebook events
 */

function get_fbe_custom_post_type_template_override($single_template) {
    global $post;

    if ($post->post_type == 'facebook_events') {
         $single_template = TEMPLATEPATH . '/index.php'; // loads content-facebook_events.php
    }

    return $single_template;
}

add_filter( 'single_template', 'get_fbe_custom_post_type_template_override', 11 );

/*
 * Prevent Facebook Events Importer from loading Google Maps API
 * ACF is also loading it and it's causing JS errors in the admin
 * https://github.com/Yoast/wordpress-seo/issues/3949
 */
function fbei_gmaps_dequeue_script() {
    wp_dequeue_script( 'fbe_map' );
}
add_action( 'wp_print_scripts', 'fbei_gmaps_dequeue_script', 100 );

/*
 * Add custom body_class for theme stylesheets
 */
add_filter('body_class', function($classes) {

    $site_id = get_current_blog_id();

    if ($site_id == 1) {
        return $classes;
    }

    $site_details = get_blog_details($site_id);
    $slug = str_replace('/','',$site_details->path);
    return array_merge($classes, array('theme--' . $slug));
});

/*
 * Does the URL point at an MP4
 */
function is_url_mp4($url) {
    if(substr($url, -4) === '.mp4') {
        return true;
    }
    return false;
}

/*
 * Is this array key set, and is it truthy?
 */
function isset_truthy($array, $key) {
    return (isset($array[$key]) && $array[$key]);
}


function parse_email_string(
    /* string */ $subject,
    array        $variables,
    /* string */ $escapeChar = "\\",
    /* string */ $errPlaceholder = null
) {
    $esc = preg_quote($escapeChar);
    $expr = "/
        $esc$esc(?=$esc*+{)
      | $esc{
      | {(\w+)}
    /x";

    $callback = function($match) use($variables, $escapeChar, $errPlaceholder) {
        switch ($match[0]) {
            case $escapeChar . $escapeChar:
                return $escapeChar;

            case $escapeChar . '{':
                return '{';

            default:
                if (isset($variables[$match[1]])) {
                    return $variables[$match[1]];
                }

                return isset($errPlaceholder) ? $errPlaceholder : $match[0];
        }
    };

    return preg_replace_callback($expr, $callback, $subject);
}


/* Event form ajax function: */
add_action( 'wp_ajax_nopriv_submit-exacttarget-form', 'submit_exacttarget_form' );
add_action( 'wp_ajax_submit-exacttarget-form', 'submit_exacttarget_form' );

function submit_exacttarget_form() {


  $data_array =  $_REQUEST['data'];
  
  if(empty($data_array)) return false;

  $Email = $data_array['Email'];
  $formSourceName = $data_array['formSourceName'];
  $sp_exp = $data_array['sp_exp'];
  $Last = isset($data_array['Last']) && ($data_array['Last'] != "Last Name") ? $data_array['Last'] : '';
  $First = isset($data_array['First']) && ($data_array['First'] != "First Name") ? $data_array['First'] : '';
  $Location = isset($data_array['Location']) ? $data_array['Location'][0] : '';
  $Location .= isset($data_array['Location'][1]) ? ';' . $data_array['Location'][1] : '';
  $exacttarget_url = "http://cl.s7.exct.net/subscribe.aspx"; // change depending on your form
  $lid = "491";
  $mid = "7218647";
  $subaction = "sub_add_update";
 
  $postVars = 'lid=' . urlencode($lid) . '&mid=' . urlencode($mid) . '&SubAction=' . urlencode($subaction) . '&Email%20Address=' . $Email . '&formSourceName=' . urlencode($formSourceName) . '&sp_exp=' . urlencode($sp_exp) . '&Last%20Name=' . urlencode($Last) . '&First%20Name=' . urlencode($First) . '&Location=' . urlencode($Location);
  
 
  $response = wp_remote_post( $exacttarget_url, array('body'=>$postVars, 'method'=>'POST') );
  
  echo $response['response']['code'];
    
  exit;
}


function be_menu_item_classes( $classes, $item, $args ) {

    $url = $_SERVER['REQUEST_URI'];
    
    if( ( is_singular( 'blog' ) || get_post_type()=='blog' ) && 'Blog' == $item->title )
        $classes[] = 'current-menu-item';
        
    if(  $url == $item->url )
        $classes[] = 'current-menu-item';
  
    if( strpos( $url, str_replace('/','',$item->url ) ) !== false )
        $classes[] = 'current-menu-item';

    return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );




