<?php

/**
 * WP Action to register all custom post types
 */
function mgl_register_post_types() {
    mgl_register_product();
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
}