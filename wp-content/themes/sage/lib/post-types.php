<?php

/**
 * WP Action to register all custom post types
 */
function mgl_register_post_types() {
    mgl_register_product();
    mgl_register_role_request();
}
add_action('init', 'mgl_register_post_types');

/**
 * Produt Post Type
 */
function mgl_register_product() {
  $args = array(
    'public'      => true,
    'label'       => 'Products',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'products'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
  );
  register_post_type('mgl_product', $args);
  
  register_taxonomy(
		'mgl_product_category',
		'mgl_product',
		array(
			'label' => __( 'Category' ),
			'rewrite' => array( 'slug' => 'category' ),
      'show_in_rest'=> true,
			'hierarchical' => true,
		)
	);
}

/**
 * Role-Request post type
 */
function mgl_register_role_request() {
  $args = array(
    'public'      => true,
    'label'       => 'Requests',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'role-requests'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author')
  );
  register_post_type('mgl_role_request', $args);
}