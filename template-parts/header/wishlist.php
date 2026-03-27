<?php

if ( !function_exists( 'YITH_WCWL' ) ) {
  return;
}

$wishlist_instance = YITH_WCWL();
$wishlist_items_count = $wishlist_instance->count_products();

?>

<div class="header-wishlist">
  <a href='/wishlist' class='header-wishlist__link'>
    <?php echo get_inline_svg('heart'); ?>
    <span class="header-cart__count">
      <?php echo $wishlist_items_count; ?>
    </span>
  </a>
</div>
