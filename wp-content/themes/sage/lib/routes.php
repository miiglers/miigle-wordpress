<?php

namespace Miigle\Rest;

use Miigle\Controllers\Application;
use Miigle\Controllers\Product;
use Miigle\Controllers\User;

add_action('rest_api_init', __NAMESPACE__ . '\\register');

function register() {
  
  register_rest_route('mgl/v1', '/product', array(
    'methods' => 'POST',
    'callback' => 'Miigle\\Controllers\\Product\\post',
    'permission_callback' => function () {
			return current_user_can('subscriber-approved');
		}
  ));
  
  register_rest_route('mgl/v1', '/product/upvote', array(
    'methods' => 'POST',
    'callback' => 'Miigle\\Controllers\\Product\\upvote_post',
    'permission_callback' => function () {
			return is_user_logged_in();
		}
  ));
  
  register_rest_route('mgl/v1', '/product/downvote', array(
    'methods' => 'POST',
    'callback' => 'Miigle\\Controllers\\Product\\downvote_post',
    'permission_callback' => function () {
			return is_user_logged_in();
		}
  ));
  
  register_rest_route('mgl/v1', '/user', array(
    'methods' => 'PUT',
    'callback' => 'Miigle\\Controllers\\User\\put',
    'permission_callback' => function () {
			return is_user_logged_in();
		}
  ));
  
}

