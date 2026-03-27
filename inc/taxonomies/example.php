<?php

/* This is an example of how to register custom taxonomy

add_action('init', function (): void {
    $labels = [
        'name'                       => _x('Example Categories', 'Taxonomy General Name', 'codelibry'),
        'singular_name'              => _x('Example Category', 'Taxonomy Singular Name', 'codelibry'),
        'menu_name'                  => __('Example Categories', 'codelibry'),
        'all_items'                  => __('All Example Categories', 'codelibry'),
        'parent_item'                => __('Parent Example Category', 'codelibry'),
        'parent_item_colon'          => __('Parent Example Category:', 'codelibry'),
        'new_item_name'              => __('New Example Category Name', 'codelibry'),
        'add_new_item'               => __('Add New Example Category', 'codelibry'),
        'edit_item'                  => __('Edit Example Category', 'codelibry'),
        'update_item'                => __('Update Example Category', 'codelibry'),
        'view_item'                  => __('View Example Category', 'codelibry'),
        'separate_items_with_commas' => __('Separate Example Categories with commas', 'codelibry'),
        'add_or_remove_items'        => __('Add or remove Example Categories', 'codelibry'),
        'choose_from_most_used'      => __('Choose from the most used', 'codelibry'),
        'popular_items'              => __('Popular Example Categories', 'codelibry'),
        'search_items'               => __('Search Example Categories', 'codelibry'),
        'not_found'                  => __('Not Found', 'codelibry'),
        'no_terms'                   => __('No Example Categories', 'codelibry'),
        'items_list'                 => __('Example Categories list', 'codelibry'),
        'items_list_navigation'      => __('Example Categories list navigation', 'codelibry'),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
    ];

    register_taxonomy('example', ['example-post-type'], $args);
});

*/
