<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/shortcodes/*.php') as $file) {
    require $file;
}
