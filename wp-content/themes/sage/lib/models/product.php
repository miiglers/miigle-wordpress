<?php

add_action('init', 'mgl_register_product');
add_action('cmb2_admin_init', 'mgl_register_product_meta');

/**
 * Produt Post Type
 */
function mgl_register_product() {
  $args = array(
    'public'      => true,
    'label'       => 'Products',
    'has_archive' => true,
    'rewrite'     => array('slug' => 'products'),
    'show_in_rest'=> true,
    'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
  );
  register_post_type('mgl_product', $args);
  
  register_taxonomy(
		'mgl_product_category',
		'mgl_product',
		array(
			'label' => __( 'Category' ),
			'rewrite' => array( 'slug' => 'category' ),
      'show_in_rest'=> true,
			'hierarchical' => true,
		)
	);
}


/**
 * Define the metabox and field configurations.
 */
function mgl_register_product_meta() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_mgl_product_';

  /**
    * Initiate the metabox
    */
  $cmb = new_cmb2_box(array(
    'id'            => 'test_metabox',
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

}