<?php

namespace Miigle\Controllers\User;

/**
 * Update a user
 */
function put($data) {
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
    'user_email' => $data['email'],
    'first_name' => $data['first_name'],
    'last_name' => $data['last_name']
  ));
}