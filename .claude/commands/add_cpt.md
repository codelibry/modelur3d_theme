Create a new Custom Post Type for the theme. The CPT name is: $ARGUMENTS

## Steps

1. **Create the CPT registration file** at `inc/post-types/{cpt-slug}.php`

   Use this pattern (replace all occurrences of "Example" / "example" with the actual CPT name):

   ```php
   <?php

   add_action('init', function (): void {
       $labels = [
           'name'                  => _x('{PluralName}', 'Post Type General Name', 'codelibry'),
           'singular_name'         => _x('{SingularName}', 'Post Type Singular Name', 'codelibry'),
           'menu_name'             => __('{PluralName}', 'codelibry'),
           'name_admin_bar'        => __('{SingularName}', 'codelibry'),
           'archives'              => __('{SingularName} Archives', 'codelibry'),
           'attributes'            => __('{SingularName} Attributes', 'codelibry'),
           'parent_item_colon'     => __('Parent {SingularName}:', 'codelibry'),
           'all_items'             => __('All {PluralName}', 'codelibry'),
           'add_new_item'          => __('Add New {SingularName}', 'codelibry'),
           'add_new'               => __('Add New', 'codelibry'),
           'new_item'              => __('New {SingularName}', 'codelibry'),
           'edit_item'             => __('Edit {SingularName}', 'codelibry'),
           'update_item'           => __('Update {SingularName}', 'codelibry'),
           'view_item'             => __('View {SingularName}', 'codelibry'),
           'view_items'            => __('View {PluralName}', 'codelibry'),
           'search_items'          => __('Search {SingularName}', 'codelibry'),
           'not_found'             => __('Not found', 'codelibry'),
           'not_found_in_trash'    => __('Not found in Trash', 'codelibry'),
           'featured_image'        => __('Featured Image', 'codelibry'),
           'set_featured_image'    => __('Set featured image', 'codelibry'),
           'remove_featured_image' => __('Remove featured image', 'codelibry'),
           'use_featured_image'    => __('Use as featured image', 'codelibry'),
           'insert_into_item'      => __('Insert into {SingularName}', 'codelibry'),
           'uploaded_to_this_item' => __('Uploaded to this {SingularName}', 'codelibry'),
           'items_list'            => __('{PluralName} list', 'codelibry'),
           'items_list_navigation' => __('{PluralName} list navigation', 'codelibry'),
           'filter_items_list'     => __('Filter {PluralName} list', 'codelibry'),
       ];

       $args = [
           'label'               => __('{PluralName}', 'codelibry'),
           'description'         => __('{SingularName} post type', 'codelibry'),
           'labels'              => $labels,
           'supports'            => ['title', 'editor'],
           'taxonomies'          => [],
           'hierarchical'        => false,
           'public'              => true,
           'show_ui'             => true,
           'show_in_menu'        => true,
           'menu_position'       => 5,
           'show_in_admin_bar'   => true,
           'show_in_nav_menus'   => true,
           'show_in_rest'        => true,
           'can_export'          => true,
           'has_archive'         => true,
           'exclude_from_search' => false,
           'publicly_queryable'  => true,
           'capability_type'     => 'post',
       ];

       register_post_type('{cpt-slug}', $args);
   });
   ```

   The file is auto-loaded via `glob()` in `inc/post-types.php` — no manual require needed.

## Naming conventions
- File name: kebab-case slug, e.g. `team-members.php`
- CPT slug: kebab-case, e.g. `team-members`
- Adjust `supports`, `has_archive`, `public`, `hierarchical` as appropriate for the CPT's purpose
- If the CPT should be admin-only (like `reusable-blocks`), set `public => false`, `publicly_queryable => false`, `has_archive => false`, `show_in_nav_menus => false`
