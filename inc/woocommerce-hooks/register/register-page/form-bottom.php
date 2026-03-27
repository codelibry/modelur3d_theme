<?php

/**
 * Close last box around register form and add link to the login page
 */

add_action('woocommerce_register_form_end', function() { ?>
    
        <div class="content-block woocommerce-form-login__register-text">
            Already have an account? <a href="<?php echo get_home_url() . '/login/';?>">Sign in</a>
        </div>

    </div>

    <?php 
});