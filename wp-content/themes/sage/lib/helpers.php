<?php

namespace Miigle\Helpers;

/**
 * Pagination with bootstrap classes
 */
function bootstrap_pagination($query) {
  $big = 999999999; // need an unlikely integer
  $pages = paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $query->max_num_pages,
    'type'  => 'array',
    'prev_next'   => true,
    'prev_text'    => __('« Prev'),
    'next_text'    => __('Next »'),
  ));

  if(is_array($pages)) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    $pagination = '<ul class="pagination">';

    foreach ( $pages as $page ) {
        $pagination .= "<li>$page</li>";
    }

    $pagination .= '</ul>';

    return $pagination;
  }
}

/**
 * Pagination with bootstrap classes
 */
function format_url($url) {
  if (0 !== strpos($url, 'http://') && 0 !== strpos($url, 'https://')) {
   $url = "http://{$url}";
  }

  return $url;
}