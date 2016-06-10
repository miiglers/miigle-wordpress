<?php

namespace Miigle\Models\Product;

add_action('init', __NAMESPACE__ . '\\register');
add_action('cmb2_admin_init', __NAMESPACE__ . '\\register_meta');
add_action('pre_get_posts', __NAMESPACE__ . '\\pre_get_posts');

/**
 * Produt Post Type
 */
function register() {
  $args = array(
    'public'      => true,
    'label'       => 'Products',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'products'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author', 'excerpt', 'comments'),
    'capability_type' => array('mgl_product', 'mgl_products'),
    'map_meta_cap' => true
  );
  register_post_type('mgl_product', $args);
  
  register_taxonomy(
		'mgl_product_category',
		'mgl_product',
		array(
			'label' => __('Category'),
			'rewrite' => array('slug' => 'category', 'hierarchical' => true),
      'show_in_rest'=> true,
			'hierarchical' => true,
		)
	);
}


/**
 * Define the metabox and field configurations.
 */
function register_meta() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_mgl_product_';

  /**
    * Initiate the metabox
    */
  $cmb = new_cmb2_box(array(
    'id'            => $prefix,
    'title'         => __('Product Fields', 'cmb2'),
    'object_types'  => array('mgl_product'), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
  ));

  // Brand ID
  $cmb->add_field(array(
    'name'       => __('Brand ID', 'cmb2'),
    'desc'       => __('do not edit', 'cmb2'),
    'id'         => $prefix . 'brand_id',
    'type'       => 'text'
  ));
  
  // URL
  $cmb->add_field(array(
    'name'       => __('URL', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'url',
    'type'       => 'text_url'
  ));
  
  // Upvotes
  $cmb->add_field(array(
    'name'       => __('Upvotes', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'upvotes',
    'type'       => 'text'
  ));
  
  // Image group
  $group_field_id = $cmb->add_field(array(
    'id'          => $prefix . 'image_gallery',
    'type'        => 'group',
    'description' => __('Image Gallery', 'cmb2'),
    // 'repeatable'  => false, // use false if you want non-repeatable group
    'options'     => array(
      'group_title'   => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
      'add_button'    => __( 'Add Another Entry', 'cmb2' ),
      'remove_button' => __( 'Remove Entry', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ));

  // Id's for group's fields only need to be unique for the group. Prefix is not needed.
  $cmb->add_group_field($group_field_id, array(
    'name' => 'Image',
    'id'   => 'image',
    'type' => 'file',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ));

}

/**
 * Modify the archive query
 */
function pre_get_posts($query) {
  if(isset($_GET['sort']) && $_GET['sort'] == 'popular') {
    if(is_post_type_archive('mgl_product') || is_tax('mgl_product_category')) {
      
      $query->set('meta_query', array(
        'upvotes_clause' => array(
          'key' => '_mgl_product_upvotes',
          'compare' => 'EXISTS',
        )
      ));

      $query->set('orderby', array('upvotes_clause' => 'DESC'));

    }
  }
  
}

/**
 * Create a product
 */
function create($data, $user) {  
  $new_post = array(
    'post_title'    => $data['title'],
    'post_status'   => 'pending',
    'post_date'     => date('Y-m-d H:i:s'),
    'post_author'   => $user->ID,
    'post_type'     => 'mgl_product',
    'post_content'  => $data['content'],
    'post_name'     => sanitize_title($data['title'])
  );

  $post_id = wp_insert_post($new_post);

  add_post_meta($post_id, '_mgl_product_upvotes', '0', true);
  add_post_meta($post_id, '_mgl_product_brand_id', $data['_mgl_product_brand_id'], true);
  add_post_meta($post_id, '_mgl_product_url', $data['_mgl_product_url'], true);

  wp_set_object_terms($post_id, intval($data['mgl_product_category']), 'mgl_product_category');

  return $post_id;
}
 
/**
 * Get all products posted by a user
 */
function get_user_products($user_id) {
  return get_posts(array(
    'post_type' => 'mgl_product',
    'post_status' => 'any',
    'author' => $user_id
  ));
}
 
/**
 * Get the product brand
 */
function get_brand($post_id) {
  $brand_id = get_post_meta($post_id, '_mgl_product_brand_id', true);    
  $brand = get_posts(array(
    'post_type' => 'mgl_brand',
    'p' => $brand_id
  ));
  
  if($brand) {
    return $brand[0];
  }
  else {
    return false;
  }
}
 
/**
 * Get the product brand's title
 */
function get_brand_title($post_id) {
  $brand = get_brand($post_id);
  
  if($brand) {
    return $brand->post_title;
  }
  else {
    return '';
  }
}
 
/**
 * Get the product url
 */
function get_url($post_id) {
  return get_post_meta($post_id, '_mgl_product_url', true);
}
 
/**
 * Get the product upvotes
 */
function get_upvotes($post_id) {
  return intval(get_post_meta($post_id, '_mgl_product_upvotes', true));
}

/**
 * Upvote
 */
function upvote($post_id) {
  $upvotes = get_upvotes($post_id) + 1;  
  update_post_meta($post_id, '_mgl_product_upvotes', $upvotes);
  
  return $upvotes;
}

/**
 * Upvote
 */
function downvote($post_id) {
  $upvotes = get_upvotes($post_id) - 1;  
  update_post_meta($post_id, '_mgl_product_upvotes', $upvotes);
  
  return $upvotes;
}

/**
 * Get the image gallery
 */
function get_image_gallery($post_id) {
  return get_post_meta($post_id, '_mgl_product_image_gallery', true);
}

/**
 * Get the image gallery
 */
function get_thumbnail($post_id) {
  $gallery = get_image_gallery($post_id);

  if($gallery) {
    return $gallery[0]['image'];
  }
  else {
    return '';
  }  
}

/**
 * Get the product comments
 */
function get_comments($post_id) {
  // escape to get out of this namespace
  return \get_comments(array(
    'post_id' => $post_id
  ));
}

/**
 * Get a count of the product comments
 */
function get_comments_count($post_id) {
  return count(get_comments($post_id));
}

/**
 * Get product categories
 */
function get_categories($post_id=false) {
  if($post_id) {
    return wp_get_post_terms($post_id, 'mgl_product_category');
  }
  else {
    return get_terms(array(
      'taxonomy' => 'mgl_product_category',
      'hide_empty' => false,
    ));
  }
}
