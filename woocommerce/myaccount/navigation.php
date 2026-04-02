<?php
/**
 * My Account Navigation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon_map = [
	'dashboard'          => 'dashboard-icon', 
	'orders'             => 'prch',
	'customer-logout'    => 'logout',
	'submit-product'     => 'selling', 
	'my-submissions'     => 'my-3d', 
	'my-products'        => 'my-3d', 
	'my-withdrawals'        => 'my-3d', 
	'add_balance'        => 'wallet'
];
?>

<?php do_action( 'woocommerce_before_account_navigation' ); ?>

<nav class="woocommerce-MyAccount-navigation account-nav myaccount-navigation-column">
	<?php echo do_shortcode('[rs_my_rewards_log]'); ?>

	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
					<?php if ( isset( $icon_map[ $endpoint ] ) ) : ?>
						<span class="account-nav__icon"><?php echo get_inline_svg( $icon_map[ $endpoint ] ); ?></span>
					<?php endif; ?>
					<span class="account-nav__label"><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
