<?php

namespace Miigle\Models\User;

/**
 * Get a user and their meta
 */
function current() {
  $current_user = wp_get_current_user();
  $avatar = get_user_meta($current_user->ID, 'thechamp_large_avatar', true);
  $socials = get_user_meta($current_user->ID, 'thechamp_linked_accounts', true);
  $socials = unserialize($socials);
  
  return array(
    'ID'          => $current_user->ID,
    'username'    => $current_user->user_login,
    'email'       => $current_user->user_email,
    'first_name'  => $current_user->user_firstname,
    'last_name'   => $current_user->user_lastname,
    'website'     => $current_user->user_url,
    'avatar'      => $avatar
  );
}

/**
 * Get array of upvoted product id's
 */
function get_upvoted_products($user_id) {
  return get_user_meta($user_id, '_mgl_user_upvoted', true);
  
  /*if($upvoted && is_array($upvoted)) {
    return unserialize($upvoted);
  }
  else {
    return false;
  }*/
}

/**
 * Get a count of upvotes
 */
function get_upvoted_products_count($user_id) {
  $upvoted = get_upvoted_products($user_id);
  
  if($upvoted && is_array($upvoted)) {
    return count($upvoted);
  }
  else {
    return 0;
  }
}

/**
 * Check if a user has upvoted a product
 */
function has_upvoted_product($user_id, $product_id) {
  $upvoted = get_upvoted_products($user_id);
  
  if($upvoted && is_array($upvoted)) {
    if(array_search($product_id, $upvoted) === false) {
      return false;
    }
    else {
      return true;
    }
  }
  
  return false; 
}

/**
 * Upvote a product
 */
function upvote_product($user_id, $product_id) {
  $upvoted = get_upvoted_products($user_id);
  
  if($upvoted && is_array($upvoted)) {
    array_push($upvoted, $product_id);
  }
  else {
    $upvoted = array($product_id);
  }  
  
  return update_user_meta($user_id, '_mgl_user_upvoted', $upvoted);
}

/**
 * Downvote a product
 */
function downvote_product($user_id, $product_id) {
  $upvoted = get_upvoted_products($user_id);
  
  if($upvoted && is_array($upvoted)) {
    $key = array_search($product_id, $upvoted);
    array_splice($upvoted, $key, 1);
    
    return update_user_meta($user_id, '_mgl_user_upvoted', $upvoted);
  }
  
  return true;
}