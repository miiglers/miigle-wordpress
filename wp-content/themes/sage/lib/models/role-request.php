<?php

add_action('init', 'mgl_register_role_request');

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