<?php

/*
 * Wrap "Product Gallery" and "Product Summary" into container
 */
add_action( 'woocommerce_before_single_product_summary', function() { ?>
	<section class="single-product-wrapper">
		<div class="container">
			<div class="single-product-grid | grid">
<?php }, 0 );

add_action( 'woocommerce_after_single_product_summary', function() { ?>
			</div>
		</div>
	</section>
<?php }, 0 );
