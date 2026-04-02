<?php
/**
 * Remove the original plugin function and replace it with your own.
 */
add_action('init', 'remove_plugin_top_up_function');

function remove_plugin_top_up_function() {
    remove_action('woocommerce_account_add_balance_endpoint', 'top_up_balance');
    
    add_action('woocommerce_account_add_balance_endpoint', 'my_custom_theme_top_up_balance');
}

/**
 * Custom version of the function
 */
function my_custom_theme_top_up_balance() {
  $product_id = (int) get_option( 'rm_top_up_product_id' );
	$product    = wc_get_product( $product_id );

	if ( ! $product ) {
		return;
	}

    $min = (float) get_option( 'top_up_min_amount', 1 );
    $max = (float) get_option( 'top_up_max_amount', 1000 );
	?>

    <div class="top-up-balance">

        <h2 class="top-up-balance__title">
            <?php esc_html_e( 'Balance', 'rm-plugin' ); ?>
        </h2>

        <span class="user-balance"><?php echo get_inline_svg('wallet'); ?>Balance<strong><?php  echo do_shortcode('[rs_my_reward_points]')?></strong></span>
        
        <h6>Top up balance</h6>
        <form class="cart top-up-balance__form" method="post" id="top-up-form">
            <div class="top-up-balance__buttons">
                <button type="button" class="top-up-btn" data-value="10">10</button>
                <button type="button" class="top-up-btn" data-value="25">25</button>
                <button type="button" class="top-up-btn" data-value="50">50</button>
                <button type="button" class="top-up-btn" data-value="100">100</button>
            </div>

            <input
                type="number"
                name="quantity"
                id="top-up-amount"
                value="10"
                min="<?php echo esc_attr( $min ); ?>"
                max="<?php echo esc_attr( $max ); ?>"
                step="0.01"
                class="qty"
            />

            <a href="#checkout-popup" class="button alt" id="top-up-submit">
                <?php esc_html_e( 'Top up', 'rm-plugin' ); ?>
            </a>

            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>" />
            <input type="hidden" name="rm_top_up_ajax" value="1" />
            <?php wp_nonce_field( 'rm_top_up', '_wpnonce' ); ?>

        </form>
    </div> 


    <dialog id="checkout-popup" class="popup__wrapper">
        <div class="popup  popup--checkout | box">
            <?php // SECURITY FIX #8: Replaced get_inline_svg() of unknown origin with a
                  // hardcoded, sanitized SVG to eliminate any potential XSS via script tags
                  // or event attributes in an external SVG file. ?>
            <button class="popup__close" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>

            <div class="popup__content">
                <div class="checkout-loading">Loading checkout...</div>
            </div>
        </div>
    </dialog>

    <?php if ( get_option( 'rm_withdraw_enabled', false ) ) : ?>
    <div class="rmp-withdraw-block | box">
        <h6><?php esc_html_e( 'Withdraw Balance', 'rm-plugin' ); ?></h6>
        <p><?php esc_html_e( 'Request a withdrawal from your balance to your bank account.', 'rm-plugin' ); ?></p>

        <div id="rmp-withdraw-messages" style="display:none;"></div>

        <form id="rmp-withdraw-form">

            <div class="rmp-withdraw-field">
                <label for="rmp-withdraw-amount">
                    <?php esc_html_e( 'Amount to Withdraw', 'rm-plugin' ); ?> <abbr title="required">*</abbr>
                </label>
                <input
                    type="number"
                    id="rmp-withdraw-amount"
                    name="amount"
                    min="<?php echo esc_attr( get_option( 'rm_withdraw_min', 10 ) ); ?>"
                    step="0.01"
                    placeholder="<?php echo esc_attr( number_format( floatval( get_option( 'rm_withdraw_min', 10 ) ), 2 ) ); ?>"
                    class="input-text"
                    required
                />
                <small id="rmp-withdraw-balance-hint"></small>
            </div>

            <div class="rmp-withdraw-field">
                <label for="rmp-withdraw-bank">
                    <?php esc_html_e( 'Bank Name', 'rm-plugin' ); ?> <abbr title="required">*</abbr>
                </label>
                <input type="text" id="rmp-withdraw-bank" name="bank_name" class="input-text" required />
            </div>

            <div class="rmp-withdraw-field">
                <label for="rmp-withdraw-account-name">
                    <?php esc_html_e( 'Account Holder Name', 'rm-plugin' ); ?> <abbr title="required">*</abbr>
                </label>
                <input type="text" id="rmp-withdraw-account-name" name="account_name" class="input-text" required />
            </div>

            <div class="rmp-withdraw-field">
                <label for="rmp-withdraw-card">
                    <?php esc_html_e( 'Card / Account Number', 'rm-plugin' ); ?> <abbr title="required">*</abbr>
                </label>
                <input type="text" id="rmp-withdraw-card" name="card_number" class="input-text" required
                    autocomplete="off" />
            </div>

            <div class="rmp-withdraw-field">
                <label for="rmp-withdraw-extra">
                    <?php esc_html_e( 'Additional Information (optional)', 'rm-plugin' ); ?>
                </label>
                <textarea id="rmp-withdraw-extra" name="extra_info" class="input-text" rows="3"
                        placeholder="<?php esc_attr_e( 'SWIFT/BIC, IBAN, routing number, etc.', 'rm-plugin' ); ?>"></textarea>
            </div>

            <button type="submit" class="button alt" id="rmp-withdraw-submit">
                <?php esc_html_e( 'Request Withdrawal', 'rm-plugin' ); ?>
            </button>

        </form>

    </div>
    <?php endif; ?>


	<?php
}