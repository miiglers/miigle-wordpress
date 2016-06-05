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