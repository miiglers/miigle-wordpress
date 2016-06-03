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
    'supports'    => array('title', 'editor', 'author'),
    'capability_type' => array('mgl_role_request', 'mgl_role_requests'),
    'map_meta_cap' => true
  );
  register_post_type('mgl_role_request', $args);
}

/**
 * When a role-request gets published
 */
function mgl_on_role_request_publish($ID, $post) {
  $current_user = get_user_by('ID', $post->post_author);
  $current_user->add_role('subscriber-approved');
  error_log('>>>>>>>>>>>>>>>current user : '.$current_user->has_cap('subscriber-approved'));
}
