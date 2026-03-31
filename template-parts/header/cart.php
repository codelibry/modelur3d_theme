<div class="header-cart">
  <a href='/cart' class='header-cart__link'>
    <?php echo get_inline_svg('bag'); ?>
    <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
    <span class="header-cart__count<?php echo $cart_count ? '' : ' is-empty'; ?>">
      <?php echo $cart_count ? $cart_count : ''; ?>
    </span>
  </a>
  <div class="header-cart-mini">
    <div class="widget_shopping_cart_content">
      <?php woocommerce_mini_cart(); ?>
    </div>
  </div>
</div>
