<?php

namespace Miigle\Models\Brand;

use Miigle\Models\Model;

add_action('init', __NAMESPACE__ . '\\register');
add_action('pre_get_posts', __NAMESPACE__ . '\\pre_get_posts');

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
			'hierarchical' => true,
		)
	);
}

/**
 * Modify the archive query
 */
function pre_get_posts($query) {
  $is_brands = (isset($_GET['brands']) || is_post_type_archive('mgl_brand'));

  if(!$is_brands) {
    return;
  }

  // the tax pages must have either ?products or ?brands
  if(is_tax('mgl_product_category')) {
    $query->set('post_type', 'mgl_brand');
  }

  // popular sort
  if(isset($_GET['sort']) && $_GET['sort'] == 'popular') {
    
    $query->set('meta_query', array(
      //'relation' => 'OR',
      'upvotes_clause' => array(
        'key' => '_mgl_brand_upvotes',
        'compare' => 'EXISTS',
        //'type' => 'NUMERIC'
      )
    ));

    $query->set('orderby', array(
      'upvotes_clause' => 'DESC'
    ));

  }
  
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

/**
 * Get the product upvotes
 */
function get_upvotes($post_id) {
  return intval(get_post_meta($post_id, '_mgl_brand_upvotes', true));
}

/**
 * Get the users who have upvoted the product
 */
function get_upvotes_users($post_id) {
  return get_post_meta($post_id, '_mgl_brand_upvotes_users', true);
}

/**
 * Upvote
 */
function upvote($post_id, $user_id) {
  return Model\upvote($post_id, $user_id, 'mgl_brand', '_mgl_brand');
}

/**
 * Downvote
 */
function downvote($post_id, $user_id) {
  return Model\downvote($post_id, $user_id, 'mgl_brand', '_mgl_brand');
}