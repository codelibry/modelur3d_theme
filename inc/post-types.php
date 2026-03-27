<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/post-types/*.php') as $file) {
    require $file;
}
