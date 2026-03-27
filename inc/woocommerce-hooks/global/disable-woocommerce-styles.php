<?php

/*
 * Disable default woocommerce CSS
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
