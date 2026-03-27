<?php

$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
$display_popup = get('header__login-popup', $options = true);

?>

<?php if($display_popup): ?>

    <!-- Display link to Login Popup -->
    <?php if(is_user_logged_in()): ?>
      <a href="<?php echo $account_link ?>">
        <?php echo get_inline_svg('account-icon') ?>
        <span class="visually-hidden"><?php esc_html_e('My account', 'codelibry') ?></span>
      </a>
    <?php else: ?>
      <a href="#popup-login-form">
        <?php echo get_inline_svg('account-icon') ?>
        <span class="visually-hidden"><?php esc_html_e('Sign in', 'codelibry') ?></span>
      </a>
    <?php endif; ?>

<?php else: ?>

    <!-- Display link to Login Page -->
    <?php if(is_user_logged_in()): ?>
      <a href="<?php echo $account_link ?>">
        <?php echo get_inline_svg('account-icon') ?>
        <span class="visually-hidden"><?php esc_html_e('My account', 'codelibry') ?></span>
      </a>
    <?php else: ?>
      <a href="/login">
        <?php echo get_inline_svg('account-icon') ?>
        <span class="visually-hidden"><?php esc_html_e('Sign in', 'codelibry') ?></span>
      </a>
    <?php endif; ?> 

<?php endif; ?>
