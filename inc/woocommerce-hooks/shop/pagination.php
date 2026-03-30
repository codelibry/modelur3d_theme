<?php

/*
 * Modify shop pagination
 */
add_filter( 'woocommerce_pagination_args', function( $args ) {
	$args['end_size'] = 1; // Number of pages at the beginning and end
	$args['mid_size'] = 1; // Number of pages around the current page
	return $args;
});

/**
 * Change WooCommerce pagination arrows
 */
add_filter( 'woocommerce_pagination_args', 'custom_woo_pagination_arrows' );

function custom_woo_pagination_arrows( $args ) {
    $args['prev_text'] = '<svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M4.27002 7.81L0.750019 4.28L4.27002 0.75" stroke="#383838" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
	'; 
    
    $args['next_text'] = '<svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M0.75 7.81L4.27 4.28L0.75 0.75" stroke="#383838" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>';

    return $args;
}