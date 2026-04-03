<?php

require_once CODELIBRY_THEME_PATH . '/vendor/autoload.php';

// Register Theme Options parent page
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug'  => 'theme-options',
            'capability' => 'edit_theme_options',
            'redirect'   => true,
        ]);
    }
});

// Shared fields — auto-load all files in inc/acf/shared-fields/
foreach (glob(CODELIBRY_THEME_PATH . '/inc/acf/shared-fields/*.php') as $file) {
    require $file;
}

// Blocks — auto-load all files in inc/acf/blocks/
foreach (glob(CODELIBRY_THEME_PATH . '/inc/acf/blocks/*.php') as $file) {
    require $file;
}

// Templates — auto-load all files in inc/acf/templates/
foreach (glob(CODELIBRY_THEME_PATH . '/inc/acf/templates/*.php') as $file) {
    require $file;
}

// Post Types — auto-load all files in inc/acf/post-types/
foreach (glob(CODELIBRY_THEME_PATH . '/inc/acf/post-types/*.php') as $file) {
    require $file;
}

// Options — auto-load all files in inc/acf/options/
foreach (glob(CODELIBRY_THEME_PATH . '/inc/acf/options/*.php') as $file) {
    require $file;
}
