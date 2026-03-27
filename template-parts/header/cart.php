<div class="header-cart">
  <a href='#' class='header-cart__link'>
    <?php echo get_inline_svg('cart-icon'); ?>
    <span class="header-cart__count">
      <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
  </a>
  <div class="header-cart-mini">
    <div class="widget_shopping_cart_content">
      <?php woocommerce_mini_cart(); ?>
    </div>
  </div>
</div>
