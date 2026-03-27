Create a new helper function for the theme. The helper details are: $ARGUMENTS

## Steps

1. **Create the helper file** at `inc/helpers/{helper-name}.php`

   Use this pattern:

   ```php
   <?php

   function {helper_name}($param) {
       // implementation
   }
   ```

   The file is auto-loaded via `glob()` in `inc/helpers.php` — no manual require needed.

## Existing helpers for reference

- **`get($field_name, $post_id = null)`** — wrapper around `get_field()` from ACF; reads a field from the current post or a specific post ID
- **`get_array_value($array, $key, $default = null)`** — safely reads a key from an array, returning `$default` if missing
- **`get_image_src($image_id, $size = 'full')`** — returns the URL of an attachment by ID
- **`get_inline_svg($filename)`** — reads and outputs an SVG file from `assets/icons/`

## Notes
- Helper functions are globally available throughout templates and PHP files
- Use descriptive snake_case function names prefixed with the action (e.g., `get_`, `render_`, `format_`)
- Keep helpers focused on a single responsibility
- Avoid adding helpers that duplicate existing WordPress core functions
