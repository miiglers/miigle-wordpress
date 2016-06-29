<?php

namespace Miigle\Controllers\Product;

use Miigle\Models\Product;
use Miigle\Models\Brand;
use Miigle\Models\User;

/**
 * Create a product
 */
function post($data) {
  $user = wp_get_current_user();
  
  if($product = Product\create($data, $user)) {
    return 'success';
  }
  else {
    return 'error';
  }  
}

/**
 * Upvote a product
 */
function upvote_post($data) {
  $user = wp_get_current_user();
  $user_has_upvoted = User\has_upvoted_product($user->ID, $data['product_id']);

  if($user_has_upvoted) {
    return false;
  }

  User\upvote_product($user->ID, $data['product_id']);
  Product\upvote($data['product_id'], $user->ID);
  
  $brand = Product\get_brand($data['product_id']);
  Brand\upvote($brand->ID, $user->ID);
  User\upvote_brand($user->ID, $brand->ID);
  
  return 'success';
}

/**
 * Downvote a product
 */
function downvote_post($data) {
  $user = wp_get_current_user();
  $user_has_upvoted = User\has_upvoted_product($user->ID, $data['product_id']);

  if(!$user_has_upvoted) {
    return false;
  }

  User\downvote_product($user->ID, $data['product_id']);
  Product\downvote($data['product_id'], $user->ID);
  
  $brand = Product\get_brand($data['product_id']);
  Brand\downvote($brand->ID, $user->ID);
  User\downvote_brand($user->ID, $brand->ID);
  
  return 'success';
}