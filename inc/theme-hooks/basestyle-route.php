<?php

/**
 * Registers a custom rewrite rule and template for the 'BaseStyle' route.
 * The route can be accessed at /BaseStyle/ in the site's permalink structure.
 * The template file used for this route is 'basestyle.php' in the theme's root directory.
 * The document title for this route is set to 'Base Style'.
 */

const BASESTYLE_ROUTE_NAME = 'BaseStyle';

add_action('init', function (): void {
    $routeName = BASESTYLE_ROUTE_NAME;

    add_rewrite_rule("{$routeName}/?$", "index.php?pagename={$routeName}", 'top');
    add_rewrite_tag("%{$routeName}%", '([^&]+)');
});

add_filter('template_include', function (string $template): string {
    global $wp_query;

    $routeName = BASESTYLE_ROUTE_NAME;

    if (isset($wp_query->query['pagename']) && $wp_query->query['pagename'] === $routeName) {
        basestyle_set_document_title();
        add_filter('wp_robots', 'wp_robots_no_robots');
        return get_template_directory() . '/basestyle.php';
    }

    return $template;
});

function basestyle_set_document_title(): void
{
    add_filter('pre_get_document_title', '__return_empty_string', 99);

    add_filter('document_title_parts', function (array $title): array {
        $title['title'] = 'Base Style';
        return $title;
    }, 99);
}
