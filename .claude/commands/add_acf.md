Create an ACF field group for a post type or page template. The target is: $ARGUMENTS

## Steps

1. **Determine the location** — is this for a post type or a page template?
   - Post type → create `inc/acf/post-types/{post-type-slug}.php`, location: `post_type == {slug}`
   - Page template → create `inc/acf/templates/{template-name}.php`, location: `page_template == {template-file}`

2. **Create the ACF file** using `ACFComposer::registerFieldGroup()`:

   ```php
   <?php

   use ACFComposer\ACFComposer;

   add_action('acf/init', function () {
       ACFComposer::registerFieldGroup([
           'name'   => '{groupName}',        // camelCase, used for key generation
           'title'  => '{Group Title}',
           'fields' => [
               [
                   'label' => '{Field Label}',
                   'name'  => '{field_name}',
                   'type'  => 'text',
               ],
               // ... more fields
           ],
           'location' => [[
               [
                   'param'    => 'post_type',  // or 'page_template'
                   'operator' => '==',
                   'value'    => '{slug}',
               ],
           ]],
           'menu_order' => 0,
       ]);
   });
   ```

   The file is auto-loaded via `glob()` in `inc/acf.php` — no manual require needed.

## ACF field type reference
- `text` — single-line text
- `textarea` — multi-line text (add `'rows' => 3`)
- `wysiwyg` — rich text editor (add `'media_upload' => 0` to disable media upload)
- `image` — image picker (use `'return_format' => 'id'`, `'preview_size' => 'medium'`)
- `link` — URL + title + target (returns array with `url`, `title`, `target`)
- `post_object` — post picker (add `'post_type' => ['{slug}']`, `'return_format' => 'id'`)
- `repeater` — list of items (add `'min' => 1`, `'layout' => 'block'`, `'sub_fields' => [...]`)
- `flexible_content` — layout picker (add `'button_label'`, `'layouts' => [...]`)

## Notes
- Do NOT add `key` properties — ACFComposer generates unique keys from the field hierarchy
- Each key/value pair on its own line
- If reusing fields from a block in `inc/acf/blocks/`, call `codelibry_acf_fields_{block_name}()` in `sub_fields`
- For flexible_content layouts, each layout needs `'name'`, `'label'`, `'display' => 'block'`, `'sub_fields'`
