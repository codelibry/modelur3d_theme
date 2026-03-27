<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks/*/*.php') as $file) {
    require $file;
}
$display_popup = get('header__login-popup', $options = true);

if($display_popup):

    foreach (glob(CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks/login/login-popup/*.php') as $file) {
        require $file;
    }

    foreach (glob(CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks/register/register-popup/*.php') as $file) {
        require $file;
    }

else:

  // Login Page Hooks
    foreach (glob(CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks/login/login-page/*.php') as $file) {
        require $file;
    }

    foreach (glob(CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks/login/login-page/*.php') as $file) {
        require $file;
    }

endif;
