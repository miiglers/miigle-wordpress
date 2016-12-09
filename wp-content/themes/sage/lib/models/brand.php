<?php

namespace Miigle\Models\Brand;

use Miigle\Models\Model;

add_action( 'init', __NAMESPACE__ . '\\register' );
add_action( 'cmb2_admin_init', __NAMESPACE__ . '\\register_meta' );
add_action( 'rest_api_init', __NAMESPACE__ . '\\api_register_meta' );
add_action( 'pre_get_posts', __NAMESPACE__ . '\\pre_get_posts' );

/**
 * Produt Post Type
 */
function register() {
	$args = array(
		'public'       => true,
		'label'        => 'Brands',
		'has_archive'  => true,
		'rewrite'      => array( 'slug' => 'brands' ),
		'show_in_rest' => true,
		'rest_base'    => 'brands',
		'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);
	register_post_type( 'mgl_brand', $args );

	register_taxonomy(
		'mgl_brand_badge',
		'mgl_brand',
		array(
			'label'        => __( 'Badges' ),
			'rewrite'      => array( 'slug' => 'badge' ),
			'show_in_rest' => true,
			'rest_base'    => 'brands-badges',
			'hierarchical' => true,
		)
	);
}

/**
 * Define the metabox and field configurations.
 */
function register_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mgl_brand_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'           => $prefix,
		'title'        => __( 'Brand Fields', 'cmb2' ),
		'object_types' => array( 'mgl_brand' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// URL
	$cmb->add_field( array(
		'name' => __( 'URL', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url'
	) );

}

function api_register_meta() {
	$prefix = '_mgl_brand_';

	register_rest_field(
		'mgl_brand',
		$prefix . 'url',
		array(
			'get_callback'    => __NAMESPACE__ . '\\get_miigle_slug',
			'update_callback' => __NAMESPACE__ . '\\update_miigle_slug',
			'schema'          => null,
		)
	);
}

/**
 * Modify the archive query
 */
function pre_get_posts( $query ) {
	$is_brands = ( isset( $_GET['brands'] ) || is_post_type_archive( 'mgl_brand' ) );

	if ( ! $is_brands ) {
		return;
	}

	// the tax pages must have either ?products or ?brands
	if ( is_tax( 'mgl_product_category' ) ) {
		$query->set( 'post_type', 'mgl_brand' );
	}

	// popular sort
	if ( isset( $_GET['sort'] ) && $_GET['sort'] == 'popular' ) {

		$query->set( 'meta_query', array(
			//'relation' => 'OR',
			'upvotes_clause' => array(
				'key'     => '_mgl_brand_upvotes',
				'compare' => 'EXISTS',
				//'type' => 'NUMERIC'
			)
		) );

		$query->set( 'orderby', array(
			'upvotes_clause' => 'DESC'
		) );

	}

}

/**
 * Get all products posted by a user
 */
function get_posts() {
	$query = new \WP_Query( array(
		'post_type'      => 'mgl_brand',
		'post_status'    => 'publish',
		'posts_per_page' => - 1
	) );

	wp_reset_postdata();

	return $query;
}

/**
 * Get the badges for a brand
 */
function get_badges( $post_id ) {
	return wp_get_post_terms( $post_id, 'mgl_brand_badge' );
}

/**
 * Get the product upvotes
 */
function get_upvotes( $post_id ) {
	return intval( get_post_meta( $post_id, '_mgl_brand_upvotes', true ) );
}

/**
 * Get the users who have upvoted the product
 */
function get_upvotes_users( $post_id ) {
	return get_post_meta( $post_id, '_mgl_brand_upvotes_users', true );
}

/**
 * Upvote
 */
function upvote( $post_id, $user_id ) {
	return Model\upvote( $post_id, $user_id, 'mgl_brand', '_mgl_brand' );
}

/**
 * Downvote
 */
function downvote( $post_id, $user_id ) {
	return Model\downvote( $post_id, $user_id, 'mgl_brand', '_mgl_brand' );
}

/**
 * Get the url
 */
function get_url( $post_id ) {
	return get_post_meta( $post_id, '_mgl_brand_url', true );
}

/**
 * Get the value of the "slug" field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function get_miigle_slug( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * Handler for updating custom field data.
 *
 * @since 0.1.0
 *
 * @param mixed $value The value of the field
 * @param object $object The object from the response
 * @param string $field_name Name of field
 *
 * @return bool|int
 */
function update_miigle_slug( $value, $object, $field_name ) {
	if ( ! $value || ! is_string( $value ) ) {
		return 'Missing value';
	}

	return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
}