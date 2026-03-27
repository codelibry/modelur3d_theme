<div class="header__mobile-menu | display-none display-lg-block">
  <button class="header__mobile-menu-button">
    <?php echo get_inline_svg('menu-icon') ?>
    <span class="visually-hidden"><?php esc_html_e('Mobile Menu', 'codelibry') ?></span>
  </button>

  <!-- Mobile Menu -->
  <div class="mobile-menu">
    <button class="popup__close" type="button">
      <?php echo get_inline_svg('close-icon') ?>
      <span class="visually-hidden"><?php esc_html_e('Close mobile menu', 'codelibry') ?></span>
    </button>

    <div class="container">
      <div class="mobile-menu__menu">
        <?php
          wp_nav_menu([
            'theme_location' => 'mobile-menu',
         ]);
        ?>
      </div>
    </div>
  </div>
  <!-- Mobile Menu End -->

</div>
