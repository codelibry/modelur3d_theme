<?php

/*
 * Modify shop pagination
 */
add_filter( 'woocommerce_pagination_args', function( $args ) {
	$args['end_size'] = 2; // Number of pages at the beginning and end
	$args['mid_size'] = 2; // Number of pages around the current page
	return $args;
});
