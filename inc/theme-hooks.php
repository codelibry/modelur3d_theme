<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/theme-hooks/*.php') as $file) {
    require $file;
}
