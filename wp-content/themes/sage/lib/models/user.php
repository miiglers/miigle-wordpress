<?php

namespace Miigle\Models\User;

/**
 * Get a user and their meta
 */
function get($id) {
  $user = new \WP_User($id);
  $avatar = get_user_meta($id, 'thechamp_large_avatar', true);
  $socials = get_user_meta($id, 'thechamp_linked_accounts', true);
  $socials = unserialize($socials);
  
  return array(
    'ID'          => $id,
    'username'    => get_username($id),
    'email'       => $user->user_email,
    'first_name'  => $user->user_firstname,
    'last_name'   => $user->user_lastname,
    'full_name'   => $user->user_firstname . ' ' . $user->user_lastname,
    'website'     => $user->user_url,
    'avatar'      => $avatar,
    '_mgl_user_title' => get_title($id),
    '_mgl_user_website' => get_website($id),
    '_mgl_user_facebook' => get_facebook($id),
    '_mgl_user_twitter' => get_twitter($id),
    '_mgl_user_company' => get_company($id)
  );
}

/**
 * Get the current user
 */
function current() {
  return get(wp_get_current_user()->ID);
}

/**
 * Define the metabox and field configurations.
 */
function register_meta() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_mgl_user_';

  /**
    * Initiate the metabox
    */
  $cmb = new_cmb2_box(array(
    'id'            => $prefix,
    'title'         => __('User Fields', 'cmb2'),
    'object_types'  => array('user'), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
  ));

  // Brand ID
  $cmb->add_field(array(
    'name'       => __('Title & Company', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'title',
    'type'       => 'text'
  ));
  
  // Username
  $cmb->add_field(array(
    'name'       => __('Username', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'username',
    'type'       => 'text'
  ));
  
  // Website
  $cmb->add_field(array(
    'name'       => __('Username', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'website',
    'type'       => 'text_url'
  ));
  
  // Facebook
  $cmb->add_field(array(
    'name'       => __('Username', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'facebook',
    'type'       => 'text_url'
  ));
  
  // Twitter
  $cmb->add_field(array(
    'name'       => __('Username', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'twitter',
    'type'       => 'text_url'
  ));

}

/**
 * Get user title
 */
function get_title($user_id) {
  return get_user_meta($user_id, '_mgl_user_title', true);
}

/**
 * Get user avatar
 */
function get_avatar($user_id) {
  return get_user_meta($user_id, 'thechamp_large_avatar', true);
}

/**
 * Get user website
 */
function get_website($user_id) {
  return get_user_meta($user_id, '_mgl_user_website', true);
}

/**
 * Get user facebook
 */
function get_facebook($user_id) {
  return get_user_meta($user_id, '_mgl_user_facebook', true);
}

/**
 * Get user twitter
 */
function get_twitter($user_id) {
  return get_user_meta($user_id, '_mgl_user_twitter', true);
}

/**
 * Get user company
 */
function get_company($user_id) {
  return get_user_meta($user_id, '_mgl_user_company', true);
}

/**
 * Get username
 */
function get_username($user_id) {
  $username = get_user_meta($user_id, '_mgl_user_username', true);
  if($username) {
    return $username;
  }
  else {
    $userdata = get_userdata($user_id);
    if($userdata) {
      return $userdata->user_login;
    }
    else {
      return '';
    }
  }
}

/**
 * Get array of upvoted product id's
 */
function get_upvoted_products($user_id) {
  return get_user_meta($user_id, '_mgl_user_upvoted', true);
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