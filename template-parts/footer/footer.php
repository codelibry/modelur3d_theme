<?php

// ACF Options
$footer_description = get('footer__description', $options = true);
$footer_company_name = get('footer__company-name', $options = true);
$footer_payment_methods = get('footer__payment_methods', $options = true);

// get all menu locations
$locations = get_nav_menu_locations();

// filter to get only footer menus
$locations = array_filter($locations, fn($location) => str_contains($location, 'footer-menu'), ARRAY_FILTER_USE_KEY);
$locations = array_filter($locations, fn($location) => $location !== 0);

// create array menus to render in html
$menus = array_map(function($menu_id, $location) {
	$menu = wp_get_nav_menu_object($menu_id);

	return [
		'title' => $menu->name ?? 'Menu Title',
		'menu' => wp_nav_menu([
			'theme_location' => $location,
			'echo' => false,
		])
	];
}, $locations, array_keys($locations), array_values($locations));

?>

<footer class="footer" id="footer">
	<div class="container">
    <div class="footer__inner | flow box">
      <div class="footer__main | repel">
        <div class="footer__info | flow">
          <a href="<?php echo home_url() ?>" class="footer__logo">
            <?php echo get_inline_svg('logo') ?>
            <span class="visually-hidden"><?php esc_html_e('Go to homepage', 'codelibry') ?></span>
          </a>

          <?php if($footer_description): ?>
            <div class="footer__description | flow">
              <?php echo wpautop($footer_description) ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="footer__menu-wrapper | cluster">
          <?php foreach ($menus as $menu): ?>
            <div class="footer__column | flow">
              <h4>
                <?php echo $menu['title'] ?>
              </h4>
              <?php echo $menu['menu'] ?>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="cluster">
          <?php if(shortcode_exists('woocs')): ?>
            <div class="currency-switcher | footer__currency-switcher">
              <?php echo do_shortcode('[woocs sd=1]'); ?>
            </div>
          <?php endif; ?>
          
          <div class="footer__payments">
            <?php if($footer_payment_methods): ?>
              <?php echo wp_get_attachment_image($footer_payment_methods, false, [
                'loading' => 'lazy'
              ]) ?>
            <?php else: ?>
              <img src="<?php echo get_image_src('payment-methods.png') ?>" alt="visa and mastercard payment methods" />
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="footer__bottom | repel">
        <p class="footer__copyright">
          <?php echo date('Y') ?> © <?php echo $footer_company_name ?>
        </p>

    </div>
	</div>
</footer>
