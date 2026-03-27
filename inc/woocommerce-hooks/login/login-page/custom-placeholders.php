<?php

/*
 * Add placeholders to the login form fields
 */
add_action('woocommerce_login_form', function() { ?>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      // Modify placeholders
      $('input#username').attr('placeholder', 'Enter your username or email');
      $('input#reg_username').attr('placeholder', 'Enter your username');
      $('input#reg_email').attr('placeholder', 'Enter your email');
      $('input#password').attr('placeholder', 'Enter your password');
      $('input#reg_password').attr('placeholder', 'Enter your password');
      $('input#reg_password2').attr('placeholder', 'Confirm your password');
    });
  </script>
<?php }, 10);
