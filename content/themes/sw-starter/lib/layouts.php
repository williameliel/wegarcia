<?php
namespace Roots\Sage\Layout;
use Roots\Sage\Environment;

/*
 * Loop trough page layouts and add /partials/<layout name> to the page.
 * Needs ACF by Elliot Condom to be set up. https://www.advancedcustomfields.com
 */

function sections() {
    return Layout::get_layouts();
}

class Layout {

    private static $layout_field_name = 'layouts';

    function __construct() {}

    public static function get_layouts() {
        $layouts = Self::get_layout_fields();

        if (!empty($layouts)) {

            foreach ($layouts as $l => $layout) {
                if (!empty($layout['acf_fc_layout'])) {
                    include(locate_template('templates/layouts-section.php'));
                    $layout = '';
                }

            }
        }
    }

    public static function is_in_layout($field_name) {

        $layouts = self::get_layout_fields();

        if (!empty($layouts)) {
            foreach ($layouts as $l => $layout) {
                if (!empty($layout['acf_fc_layout'])) {
                    if ($layout['acf_fc_layout'] == $field_name) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public static function get_layout_fields() {
        if(function_exists('get_field')){
            return get_field( Self::$layout_field_name );
        }
    }

    public static function get_layout_nav() {

        $layouts = Self::get_layout_fields();

        $nav = '';

        if(!empty($layouts)){
            $nav .= '<ul class="navbar-collapse nav navbar-nav">';
            foreach ($layouts as $key => $value) {
                $layout_slug = strtolower(str_replace(array(' ', '&'), '-', $value['nav_item']));
                if(!empty($value['nav_item'])){
                    $nav .= '<li>';
                    $nav .= '<a href="#' . $layout_slug . '">';
                    $nav .= $value['nav_item'];
                    $nav .= '</a>';
                    $nav .= '</li>';
                    $nav .= "\n";
                }
            }
            $nav .= '</ul>';
        }

        echo $nav;
    }

    public function get_acf($id) {
        if(function_exists('get_fields')){
            return get_fields($id);
        }
    }
}
