<?php

namespace Miigle\Models\Model;

use Miigle\Models\Product;
use Miigle\Models\User;
use Miigle\Models\Brand;

/**
 * Upvote
 */
function upvote($post_id, $user_id, $post_type, $meta_key_prefix) {
  if($post_type == 'mgl_brand') {
    $upvotes = Brand\get_upvotes($post_id) + 1;
    $upvotes_users = Brand\get_upvotes_users($post_id);
  }
  else {
    $upvotes = Product\get_upvotes($post_id) + 1;
    $upvotes_users = Product\get_upvotes_users($post_id);
  }  
  
  if($upvotes_users && is_array($upvotes_users)) {
    array_push($upvotes_users, $user_id);
  }
  else {
    $upvotes_users = array($user_id);
  }

  update_post_meta($post_id, $meta_key_prefix . '_upvotes', $upvotes);
  update_post_meta($post_id, $meta_key_prefix . '_upvotes_users', $upvotes_users);
  
  return $upvotes;
}

/**
 * Downvote
 */
function downvote($post_id, $user_id, $post_type, $meta_key_prefix) {
  if($post_type == 'mgl_brand') {
    $upvotes = Brand\get_upvotes($post_id) - 1;
    $upvotes_users = Brand\get_upvotes_users($post_id);
  }
  else {
    $upvotes = Product\get_upvotes($post_id) - 1;
    $upvotes_users = Product\get_upvotes_users($post_id);
  } 

  if($upvotes_users && is_array($upvotes_users)) {
    $key = array_search($user_id, $upvotes_users);
    array_splice($upvotes_users, $key, 1);
  }

  update_post_meta($post_id, $meta_key_prefix . '_upvotes', $upvotes);
  update_post_meta($post_id, $meta_key_prefix . '_upvotes_users', $upvotes_users);
  
  return $upvotes;
}