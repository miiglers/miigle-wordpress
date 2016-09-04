<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/models/model.php',         // Shared model functions
  'lib/models/product.php',       // Product post type
  'lib/models/role-request.php',  // Role-request post type
  'lib/models/brand.php',         // Brand post type
  'lib/models/user.php',          // User functions
  'lib/controllers/application.php',
  'lib/controllers/user.php',
  'lib/controllers/product.php',
  'lib/setup.php',                // Theme setup
  'lib/titles.php',               // Page titles
  'lib/wrapper.php',              // Theme wrapper class
  'lib/routes.php',                // Rest API routes
  'lib/helpers.php',                // Template Helpers
  'lib/options.php'                // CMB2 Options page
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}