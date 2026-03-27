<?php

foreach (glob(CODELIBRY_THEME_PATH . '/inc/helpers/*.php') as $file) {
    require $file;
}
