<?php
/* Register Custom Post Type
* Use this to register custom post types.
* You're going to have to delete the 'specials' Post type. Maybe?
* WG
*/

function exclude_post_type_from_site($excluded_sites_array) {
    return in_array(get_current_blog_id(), $excluded_sites_array);
}

function custom_post_type_setup() {

    /* to add a new post type: Append a member to the array below */
    $post_types = array(
        array(
            'name' => 'projects',
            'singular_label' => 'Project',
            'plural_label' => 'Projects',
            'exclude_sites' => []
        ),
       
       
    );

  foreach ($post_types as $post_type) {

    if (exclude_post_type_from_site($post_type['exclude_sites'])) {
        continue;
    };

    $labels = array(
        'name'                => _x( $post_type['plural_label'], 'Post Type General Name'),
        'singular_name'       => _x( $post_type['singular_label'], 'Post Type Singular Name'),
        'menu_name'           => __( $post_type['plural_label']),
        'name_admin_bar'      => __( $post_type['plural_label']),
        'parent_item_colon'   => __( 'Parent Item:'),
        'all_items'           => __( 'All '. $post_type['plural_label'] ),
        'add_new_item'        => __( 'Add New '. $post_type['singular_label']),
        'add_new'             => __( 'Add New'),
        'new_item'            => __( 'New '. $post_type['plural_label']),
        'edit_item'           => __( 'Edit '. $post_type['plural_label']),
        'update_item'         => __( 'Update '. $post_type['plural_label']),
        'view_item'           => __( 'View '. $post_type['plural_label'] ),
        'search_items'        => __( 'Search '. $post_type['plural_label']),
        'not_found'           => __( $post_type['plural_label'].' Not found'),
        'not_found_in_trash'  => __( $post_type['plural_label'].' Not found in Trash'),
    );

    $args = array(
        'label'               => __( $post_type['name']),
        'description'         => __( 'The post type for '. $post_type['name']),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail' ,'editor', 'excerpt', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'          => array( 'tags' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => isset($post_type['has_archive']) && !$post_type['has_archive'] ? false : true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type(  $post_type['name'] , $args );

  }

}

add_action( 'init', __NAMESPACE__ . '\\custom_post_type_setup' );

function add_custom_post_type_to_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array('post', 'projects') );
    }
}
add_action( 'pre_get_posts',  __NAMESPACE__ . '\\add_custom_post_type_to_query' );