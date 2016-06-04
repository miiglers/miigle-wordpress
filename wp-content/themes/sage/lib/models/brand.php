<?php

namespace Miigle\Models\Brand;

add_action('init', __NAMESPACE__ . '\\register');

/**
 * Produt Post Type
 */
function register() {
  $args = array(
    'public'      => true,
    'label'       => 'Brands',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'brands'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
  );
  register_post_type('mgl_brand', $args);
  
  register_taxonomy(
		'mgl_brand_badge',
		'mgl_brand',
		array(
			'label' => __( 'Badges' ),
			'rewrite' => array( 'slug' => 'badge' ),
      'show_in_rest'=> true,
			'hierarchical' => false,
		)
	);
}

/**
 * Get all products posted by a user
 */
function get_posts() {
  $query = new \WP_Query(array(
    'post_type' => 'mgl_brand',
    'post_status' => 'publish',
    'posts_per_page' => -1
  ));
  
  wp_reset_postdata();
  
  return $query;
}

/**
 * Get the badges for a brand
 */
function get_badges($post_id) {
  return wp_get_post_terms($post_id, 'mgl_brand_badge');
}