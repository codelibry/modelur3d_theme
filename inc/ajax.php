<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/ajax/*.php') as $file) {
    require $file;
}
