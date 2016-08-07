<?php

namespace Miigle\Models\Product;

use Miigle\Models\Model;
use Miigle\Models\User;

add_action('init', __NAMESPACE__ . '\\register');
add_action('cmb2_admin_init', __NAMESPACE__ . '\\register_meta');
add_action('pre_get_posts', __NAMESPACE__ . '\\pre_get_posts');
add_action('save_post', __NAMESPACE__ . '\\save_post', 99, 3);

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
		array('mgl_product', 'mgl_brand'),
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

  // Brand URL
  $cmb->add_field(array(
    'name'       => __('URL', 'cmb2'),
    'desc'       => __('This is used when there is no brand created', 'cmb2'),
    'id'         => $prefix . 'brand_url',
    'type'       => 'text_url'
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

  // Price
  $cmb->add_field(array(
    'name'       => __('Price', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'price',
    'type'       => 'text'
  ));

  // Comment
  $cmb->add_field(array(
    'name'       => __('User Comment', 'cmb2'),
    'desc'       => __('', 'cmb2'),
    'id'         => $prefix . 'author_comment',
    'type'       => 'textarea'
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
 * Hook for the save_post action
 */
function save_post($post_id, $post, $update) {
  if($post->post_type == 'mgl_product' && get_upvotes($post_id) == 0) {
    update_post_meta($post_id, '_mgl_product_upvotes', '0');
  }
}

/**
 * Modify the archive query
 */
function pre_get_posts($query) {
  $is_homepage = ($query->get('page_id') == get_option('page_on_front'));
  $is_products = (isset($_GET['products']) || is_post_type_archive('mgl_product') || $is_homepage);

  if(!$is_products || is_admin()) {
    return;
  }

  if($is_homepage) {
    $paged = (isset($_GET['paged']) ? $_GET['paged'] : '');
    $query->set('post_type', 'mgl_product');
    $query->set('page_id', '');
    $query->set('paged', $paged);

    $query->is_page = 0;
    $query->is_singular = 0;
    $query->is_post_type_archive = 1;
    $query->is_archive = 1;
  }

  $query->set('posts_per_page', 30);

  // the tax pages must have either ?products or ?brands
  if(is_tax('mgl_product_category')) {
    $query->set('post_type', 'mgl_product');
  }

  // popular sort
  if(isset($_GET['sort']) && $_GET['sort'] == 'popular') {
    
    $query->set('meta_query', array(
      //'relation' => 'OR',
      'upvotes_clause' => array(
        'key' => '_mgl_product_upvotes',
        'compare' => 'EXISTS',
        //'type' => 'NUMERIC'
      )
    ));

    $query->set('orderby', array(
      'upvotes_clause' => 'DESC'
    ));

  }
  
}

/**
 * Create a product
 */
function create($data, $user) {  
  $new_post = array(
    'post_title'    => date('Y-m-d'),
    'post_status'   => 'pending',
    'post_date'     => date('Y-m-d H:i:s'),
    'post_author'   => $user->ID,
    'post_type'     => 'mgl_product',
    //'post_content'  => $data['content'],
    //'post_name'     => sanitize_title($data['title'])
  );

  $post_id = wp_insert_post($new_post);

  add_post_meta($post_id, '_mgl_product_upvotes', '0', true);
  add_post_meta($post_id, '_mgl_product_url', $data['_mgl_product_url'], true);
  add_post_meta($post_id, '_mgl_product_author_comment', $data['_mgl_product_author_comment'], true);

  if($data['mgl_product_category']) {
    $categories = array();

    foreach($data['mgl_product_category'] as $cat) {
      array_push($categories, intval($cat));
    }

    wp_set_object_terms($post_id, $categories, 'mgl_product_category');
  }

  return $post_id;
}
 
/**
 * Get all products posted by a user
 */
function get_user_products($user_id, $get_pending=false) {
  if($get_pending) {
    $status = 'publish';
  }
  else {
    $status = 'publish';
  }

  return get_posts(array(
    'post_type' => 'mgl_product',
    'author' => $user_id,
    'posts_per_page' => -1,
    'post_status' => $status
  ));
}

/**
 * Get all products upvoted by a user
 */
function get_user_products_upvoted($user_id) {
  $user_upvoted = User\get_upvotes($user_id);

  return get_posts(array(
    'post_type' => 'mgl_product',
    'post__in' => $user_upvoted,
    'posts_per_page' => -1
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
 * Get the author comment
 */
function get_brand_url($post_id) {
  return get_post_meta($post_id, '_mgl_product_brand_url', true);
}

/**
 * Get the author comment
 */
function get_author_comment($post_id) {
  return get_post_meta($post_id, '_mgl_product_author_comment', true);
}

/**
 * Get the product url
 */
function get_price($post_id) {
  return get_post_meta($post_id, '_mgl_product_price', true);
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
 * Get the users who have upvoted the product
 */
function get_upvotes_users($post_id) {
  return get_post_meta($post_id, '_mgl_product_upvotes_users', true);
}

/**
 * Upvote
 */
function upvote($post_id, $user_id) {
  return Model\upvote($post_id, $user_id, 'mgl_product', '_mgl_product');
}

/**
 * Downvote
 */
function downvote($post_id, $user_id) {
  return Model\downvote($post_id, $user_id, 'mgl_product', '_mgl_product');
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
function get_categories($post_id=false, $hide_empty=true) {
  if($post_id) {
    return wp_get_post_terms($post_id, 'mgl_product_category');
  }
  else {
    return get_terms(array(
      'taxonomy' => 'mgl_product_category',
      'hide_empty' => $hide_empty,
    ));
  }
}
