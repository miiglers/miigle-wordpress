<?php

add_action('init', 'mgl_register_role_request');
add_action('publish_mgl_role_request', 'mgl_on_role_request_publish', 10, 2);

/**
 * Role-Request post type
 */
function mgl_register_role_request() {
  $args = array(
    'public'      => true,
    'label'       => 'Requests',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'role-requests'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author')
  );
  register_post_type('mgl_role_request', $args);
}

/**
 * When a role-request gets published
 */
function mgl_on_role_request_publish($ID, $post) {
  
}
