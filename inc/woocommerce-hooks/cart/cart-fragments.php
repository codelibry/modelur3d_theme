<?php

/*
 * Update header cart count via AJAX fragments
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
	ob_start();
	?>
	<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
	<span class="header-cart__count<?php echo $cart_count ? '' : ' is-empty'; ?>">
		<?php echo $cart_count ? $cart_count : ''; ?>
	</span>
	<?php
	$fragments['span.header-cart__count'] = ob_get_clean();
	return $fragments;
});
