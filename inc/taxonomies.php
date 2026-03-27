<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/taxonomies/*.php') as $file) {
    require $file;
}
