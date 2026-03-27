<?php

add_filter('woocommerce_login_form', 'inject_password_toggles_in_html');
add_filter('woocommerce_register_form', 'inject_password_toggles_in_html');

add_filter('login_form', 'inject_password_toggles_in_html');


add_filter('widget_text', 'inject_password_toggles_in_html', 20);
add_filter('do_shortcode_tag', 'inject_password_toggles_in_html', 20);

function inject_password_toggles_in_html($content) {
    if (
        strpos($content, 'type="password"') === false &&
        strpos($content, "type='password'") === false
    ) {
        return $content;
    }

    $eye = get_inline_svg('eye');
    $eye_off = get_inline_svg('eye-password');


    if (!$eye && !$eye_off) {
        return $content;
    }

    $toggle = '<span class="show-password-input">' .
              '<span class="show-password-input__icon show-password-input__icon--show">' . $eye . '</span>' .
              '<span class="show-password-input__icon show-password-input__icon--hide">' . $eye_off . '</span>' .
              '</span>';


    return preg_replace(
        '/(<input[^>]+type=[\'"]password[\'"][^>]*>)(?!\s*<span class="show-password-input")/',
        '$1' . $toggle,
        $content
    ) ?? $content;
}