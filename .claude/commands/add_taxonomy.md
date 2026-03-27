Create a new custom taxonomy for the theme. The taxonomy details are: $ARGUMENTS

## Steps

1. **Create the taxonomy registration file** at `inc/taxonomies/{taxonomy-slug}.php`

   Use this pattern (replace "Example Category" / "example" with the actual taxonomy name and slug):

   ```php
   <?php

   add_action('init', function (): void {
       $labels = [
           'name'                       => _x('{PluralName}', 'Taxonomy General Name', 'codelibry'),
           'singular_name'              => _x('{SingularName}', 'Taxonomy Singular Name', 'codelibry'),
           'menu_name'                  => __('{PluralName}', 'codelibry'),
           'all_items'                  => __('All {PluralName}', 'codelibry'),
           'parent_item'                => __('Parent {SingularName}', 'codelibry'),
           'parent_item_colon'          => __('Parent {SingularName}:', 'codelibry'),
           'new_item_name'              => __('New {SingularName} Name', 'codelibry'),
           'add_new_item'               => __('Add New {SingularName}', 'codelibry'),
           'edit_item'                  => __('Edit {SingularName}', 'codelibry'),
           'update_item'                => __('Update {SingularName}', 'codelibry'),
           'view_item'                  => __('View {SingularName}', 'codelibry'),
           'separate_items_with_commas' => __('Separate {PluralName} with commas', 'codelibry'),
           'add_or_remove_items'        => __('Add or remove {PluralName}', 'codelibry'),
           'choose_from_most_used'      => __('Choose from the most used', 'codelibry'),
           'popular_items'              => __('Popular {PluralName}', 'codelibry'),
           'search_items'               => __('Search {PluralName}', 'codelibry'),
           'not_found'                  => __('Not Found', 'codelibry'),
           'no_terms'                   => __('No {PluralName}', 'codelibry'),
           'items_list'                 => __('{PluralName} list', 'codelibry'),
           'items_list_navigation'      => __('{PluralName} list navigation', 'codelibry'),
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

       register_taxonomy('{taxonomy-slug}', ['{post-type-slug}'], $args);
   });
   ```

   The file is auto-loaded via `glob()` in `inc/taxonomies.php` — no manual require needed.

## Notes
- Set `'hierarchical' => true` for category-like (parent/child) taxonomies
- Set `'hierarchical' => false` for tag-like taxonomies
- The second argument to `register_taxonomy()` is an array of post type slugs the taxonomy applies to
- File name and taxonomy slug should use kebab-case
