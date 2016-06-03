<?php

add_action('init', 'mgl_register_brand');

/**
 * Produt Post Type
 */
function mgl_register_brand() {
  $args = array(
    'public'      => true,
    'label'       => 'Brands',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'brands'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
  );
  register_post_type('mgl_brand', $args);
}