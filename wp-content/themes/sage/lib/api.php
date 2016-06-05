<?php

namespace Miigle\Rest;

use Miigle\Models\Product;
use Miigle\Models\User;

add_action('rest_api_init', __NAMESPACE__ . '\\register');

function register() {
  
  register_rest_route('mgl/v1', '/product', array(
    'methods' => 'POST',
    'callback' => __NAMESPACE__ . '\\product_post'
  ));
  
  register_rest_route('mgl/v1', '/product/upvote', array(
    'methods' => 'POST',
    'callback' => __NAMESPACE__ . '\\product_upvote_post'
  ));
  
  register_rest_route('mgl/v1', '/product/downvote', array(
    'methods' => 'POST',
    'callback' => __NAMESPACE__ . '\\product_downvote_post'
  ));
  
  register_rest_route('mgl/v1', '/user', array(
    'methods' => 'PUT',
    'callback' => __NAMESPACE__ . '\\user_put'
  ));
  
}

/**
 * Create a product
 */
function product_post($data) {
  $user = wp_get_current_user();
  
  if(Product\create($data, $user)) {
    return 'success';
  }
  else {
    return 'error';
  }  
}

/**
 * Upvote a product
 */
function product_upvote_post($data) {
  $user = wp_get_current_user();
  
  if(!User\has_upvoted_product($user->ID, $data['product_id'])) {
    if(User\upvote_product($user->ID, $data['product_id'])) {
      return Product\upvote($data['product_id']);
    }
  }
  
  return 'success';
}

/**
 * Downvote a product
 */
function product_downvote_post($data) {
  $user = wp_get_current_user();
  
  if(User\has_upvoted_product($user->ID, $data['product_id'])) {
    if(User\downvote_product($user->ID, $data['product_id'])) {
      return Product\downvote($data['product_id']);
    }
  }
  
  return 'success';
}

/**
 * Update a user
 */
function user_put($data) {
  global $wpdb;
  $user = wp_get_current_user();
  
  update_user_meta($user->ID, '_mgl_user_title', $data['_mgl_user_title']);
  update_user_meta($user->ID, '_mgl_user_username', $data['_mgl_user_username']);
  update_user_meta($user->ID, '_mgl_user_website', $data['_mgl_user_website']);
  update_user_meta($user->ID, '_mgl_user_facebook', $data['_mgl_user_facebook']);
  update_user_meta($user->ID, '_mgl_user_twitter', $data['_mgl_user_twitter']);
  update_user_meta($user->ID, '_mgl_user_company', $data['_mgl_user_company']);
  
  return wp_update_user(array(
    'ID' => $user->ID,
    'user_email' => $data['email']
  ));
}