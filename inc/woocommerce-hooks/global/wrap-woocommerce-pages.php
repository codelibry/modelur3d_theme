<?php

/*
 * Wrap archive + single product pages inside custom wrappers
 */
add_action('after_setup_theme', function () {
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);

		add_action('woocommerce_before_main_content', function () { ?>
      <main class="main" id="main"><div class="woocommerce-page">
		<?php }, 10);

		add_action('woocommerce_after_main_content',  function() { ?>
      </div></main>
		<?php }, 10);
});
