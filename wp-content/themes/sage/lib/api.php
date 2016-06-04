<?php

namespace Miigle\Rest;

use Miigle\Models\Product;

/**
 * Create a product
 */
function product_post($data) {
  if(Product\create($data)) {
    return 'success';
  }
  else {
    return 'error';
  }  
}
add_action('rest_api_init', function() {
  register_rest_route('mgl/v1', '/product', array(
    'methods' => 'POST',
    'callback' => __NAMESPACE__ . '\\product_post'
  ));
});