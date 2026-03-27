<?php

/*
 * Open popup instead of a page
 */
add_filter('lostpassword_url', function ($url) {
    if (is_admin()) {
        return $url;
    }

    return '#popup-reset-form';
});
