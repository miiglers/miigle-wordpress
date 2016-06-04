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