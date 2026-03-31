<?php
// Balance

add_action( 'woocommerce_after_checkout_form', 'custom_checkout_end_block' );
function custom_checkout_end_block() {
    // 1. Get the raw balance from shortcode
    $raw_balance = do_shortcode('[rs_my_reward_points]');
    
    // 2. Clean the balance (Remove commas so "2,232.00" becomes "2232.00")
    $clean_balance = (float) str_replace(',', '', $raw_balance);
    
    // 3. Get the current cart total as a float
    $cart_total = (float) WC()->cart->get_total('edit');

    ?>
    <div class="custom-checkout-footer-block | box">
        <div class="checkout-footer-content">
            <h2><?php esc_html_e( 'Payment method', 'woocommerce' ); ?></h2>    
              <div class="balance">
                  <?php echo get_inline_svg('wallet'); ?>
                  <span>Balance</span>
                  <strong><?php echo $raw_balance; ?></strong>
              </div>

              <?php if ( $clean_balance < $cart_total ) : ?>
                <div class="error-wrapper">
                  <div class="balance-status error-status">
                      <p><?php esc_html_e( 'Not enough to complete the purchase.', 'woocommerce' ); ?></p>
                  </div>
                  <a href="/my-account/add_balance/" class="button button--secondary top-up-button">
                      <?php esc_html_e( 'Top Up', 'woocommerce' ); ?>
                  </a>
                </div>
              <?php else : ?>
                  <div class="balance-status success-status">
                      <p><?php esc_html_e( 'Sufficient to complete the purchase', 'woocommerce' ); ?></p>
                  </div>
              <?php endif; ?>
        </div>
    </div>
    
    <?php
}

