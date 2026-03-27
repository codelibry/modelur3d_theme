<?php

function get_best_selling_products(int $count = 4): array|null {
	$args = [
		'post_type'      => 'product',
		'posts_per_page' => $count,
		'meta_key'       => 'total_sales',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
		'post_status'    => 'publish'
	];

	$products = get_posts($args);

	if (!empty($products)) {
		return $products;
	}

	return null;
}
