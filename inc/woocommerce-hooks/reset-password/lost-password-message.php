<?php

/*
 * Custom lost password message
 */
add_filter('woocommerce_lost_password_message', function() {
  $custom_text = get('auth_popup_reset_text', $options = true);
  if (!empty($custom_text)) {
    return '';
  }

  return esc_html__('Enter your email address and we’ll send you a link to create a new password.', 'ragnarock');
});
