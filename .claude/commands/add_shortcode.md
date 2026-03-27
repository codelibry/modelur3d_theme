Create a new shortcode for the theme. The shortcode name is: $ARGUMENTS

## Steps

1. **Create the shortcode file** at `inc/shortcodes/{shortcode-name}.php`

   Use this pattern:

   ```php
   <?php

   function {shortcode_name}_callback($atts, $content = null) {
       $params = shortcode_atts(
           [
               'option' => '',
               // add more default attributes here
           ],
           $atts
       );

       ob_start();
       ?>

       <div class="{shortcode-name}">
           <?php if ($content): ?>
               <?php echo do_shortcode($content); ?>
           <?php endif; ?>
       </div>

       <?php
       return ob_get_clean();
   }

   add_shortcode('{shortcode_name}', '{shortcode_name}_callback');
   ```

   The file is auto-loaded via `glob()` in `inc/shortcodes.php` — no manual require needed.

## Notes
- Shortcode name (tag) uses snake_case or kebab-case: `[my_shortcode]` or `[my-shortcode]`
- `shortcode_atts()` merges user-supplied attributes with defaults and sanitizes keys
- Use `ob_start()` / `ob_get_clean()` to capture HTML output
- Use `do_shortcode($content)` if the shortcode wraps other content (enclosing shortcode)
- For self-closing shortcodes (no content), remove the `$content` parameter
- Sanitize attribute values before use (`sanitize_text_field`, `absint`, `esc_url`, etc.)
- Escape output with `esc_html()`, `esc_attr()`, `esc_url()` as appropriate
