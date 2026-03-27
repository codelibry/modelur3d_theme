Create a new AJAX handler for the theme. The action name is: $ARGUMENTS

## Steps

1. **Create the AJAX handler file** at `inc/ajax/{action-name}.php`

   Use this pattern:

   ```php
   <?php

   function {action_name}_callback() {
       // Verify nonce
       check_ajax_referer('{action_name}_nonce', 'nonce');

       // Get and sanitize input
       $data = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';

       // Process and respond
       wp_send_json_success([
           'message' => 'OK',
       ]);

       wp_die();
   }

   add_action('wp_ajax_{action_name}', '{action_name}_callback');
   add_action('wp_ajax_nopriv_{action_name}', '{action_name}_callback');  // remove if logged-in only
   ```

   The file is auto-loaded via `glob()` in `inc/ajax.php` — no manual require needed.

2. **Enqueue the nonce** in `inc/theme-hooks/enqueue-scripts.php` if needed:
   ```php
   wp_localize_script('main', '{action_name}_ajax', [
       'ajax_url' => admin_url('admin-ajax.php'),
       'nonce'    => wp_create_nonce('{action_name}_nonce'),
   ]);
   ```

3. **Call from JavaScript**:
   ```js
   fetch(window.{action_name}_ajax.ajax_url, {
       method: 'POST',
       headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
       body: new URLSearchParams({
           action: '{action_name}',
           nonce: window.{action_name}_ajax.nonce,
           data: 'your-data',
       }),
   }).then(r => r.json()).then(console.log);
   ```

## Notes
- Remove the `wp_ajax_nopriv_` hook if the action should only be available to logged-in users
- Always sanitize input (`sanitize_text_field`, `absint`, `wp_kses_post`, etc.)
- Always verify nonce for mutating actions
- Use `wp_send_json_success()` / `wp_send_json_error()` for consistent JSON responses
- File and action name use snake_case
