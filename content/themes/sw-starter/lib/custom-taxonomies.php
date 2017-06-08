<?php
/* Register Custom Taxonomies
* Use this to register custom Taxonomies. 
* WG
*/

function custom_taxonomies_setup() {
  register_taxonomy( 'blog_categories', 'blog',
    array( 
      'hierarchical' => true,
      'label' => 'Blog Categories',
      'show_ui' => true,
      'query_var' => true,
      'show_admin_column' => false,
      'rewrite' => array('slug' => 'blog_category', 'with_front' => false),
      'labels' => array (
        'search_items' => 'Blog Category',
        'popular_items' => '',
        'all_items' => '',
        'parent_item' => '',
        'parent_item_colon' => '',
        'edit_item' => '',
        'update_item' => '',
        'add_new_item' => '',
        'new_item_name' => '',
        'separate_items_with_commas' => '',
        'add_or_remove_items' => '',
        'choose_from_most_used' => '',
      )
  )); 
}
add_action( 'init', __NAMESPACE__ . '\\custom_taxonomies_setup' );

