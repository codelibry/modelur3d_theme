<?php

function get_related_products(int $product_id, int $count = 4): array|null {
  $current_product = get_post($product_id);

  if (!$current_product || 'product' !== get_post_type($product_id)) {
    return [];
  }

  // Get product categories and tags
  $categories = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids']);
  $tags       = wp_get_post_terms($product_id, 'product_tag', ['fields' => 'ids']);

  $tax_query = ['relation' => 'OR'];

  if (!empty($categories)) {
    $tax_query[] = [
      'taxonomy' => 'product_cat',
      'terms'    => $categories,
      'field'    => 'term_id',
    ];
  }

  if (!empty($tags)) {
    $tax_query[] = [
      'taxonomy' => 'product_tag',
      'terms'    => $tags,
      'field'    => 'term_id',
    ];
  }

  $args = [
    'post__not_in'   => [$product_id],   // Exclude current product
    'post_type'      => 'product',       // Query products only
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'tax_query'      => $tax_query,
  ];

  $products = get_posts($args);

  return !empty($products) ? $products : null;
}
