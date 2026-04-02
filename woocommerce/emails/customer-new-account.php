<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

/**
 * Build the email confirmation URL for this user.
 * modelur_get_confirmation_url() is defined in inc/email-confirmation.php.
 */
$confirmation_url = '';
if ( isset( $user_pass ) && function_exists( 'modelur_get_confirmation_url' ) ) {
    // $user_pass is the WP_User object passed to WooCommerce email templates
    // In WooCommerce new-account emails the variable is $user_login (string) and $user_pass.
    // We retrieve the user by login to get the ID.
    $user_obj = get_user_by( 'login', $user_login );
    if ( $user_obj ) {
        $token = get_user_meta( $user_obj->ID, '_email_confirmation_token', true );
        if ( $token ) {
            $confirmation_url = modelur_get_confirmation_url( $user_obj->ID, $token );
        }
    }
}

/**
 * Fires to output the email header.
 *
 * @hooked WC_Emails::email_header()
 *
 * @since 3.7.0
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php echo $email_improvements_enabled ? '<div class="email-introduction">' : ''; ?>
<?php /* translators: %s: Customer username */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $user_login ) ); ?></p>
<?php if ( $email_improvements_enabled ) : ?>
    <?php /* translators: %s: Site title */ ?>
    <p><?php printf( esc_html__( 'Thanks for creating an account on %s.', 'woocommerce' ), esc_html( $blogname ) ); ?></p>

    <?php if ( $confirmation_url ) : ?>
        <div class="hr hr-top"></div>
        <p><strong><?php esc_html_e( 'One more step — confirm your email address', 'modelur3d' ); ?></strong></p>
        <p><?php esc_html_e( 'To activate your account and start using it, please click the button below:', 'modelur3d' ); ?></p>
        <p style="text-align:center; margin: 24px 0;">
            <a href="<?php echo esc_url( $confirmation_url ); ?>"
               style="background-color:#000; color:#fff; padding:14px 28px; border-radius:4px; text-decoration:none; font-weight:600; display:inline-block;">
                <?php esc_html_e( 'Confirm my email', 'modelur3d' ); ?>
            </a>
        </p>
        <p style="font-size:12px; color:#666;">
            <?php esc_html_e( "Or copy and paste this link into your browser:", 'modelur3d' ); ?><br>
            <a href="<?php echo esc_url( $confirmation_url ); ?>"><?php echo esc_html( $confirmation_url ); ?></a>
        </p>
        <div class="hr hr-bottom"></div>
        <p><?php esc_html_e( 'If you did not create an account, you can safely ignore this email.', 'modelur3d' ); ?></p>
    <?php else : ?>
        <div class="hr hr-top"></div>
        <?php /* translators: %s: Username */ ?>
        <p><?php echo wp_kses( sprintf( __( 'Username: <b>%s</b>', 'woocommerce' ), esc_html( $user_login ) ), array( 'b' => array() ) ); ?></p>
        <?php if ( $password_generated && $set_password_url ) : ?>
            <p><a href="<?php echo esc_attr( $set_password_url ); ?>"><?php esc_html_e( 'Set your new password.', 'woocommerce' ); ?></a></p>
        <?php endif; ?>
        <div class="hr hr-bottom"></div>
        <p><?php esc_html_e( 'You can access your account area to view orders, change your password, and more via the link below:', 'woocommerce' ); ?></p>
        <p><a href="<?php echo esc_attr( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a></p>
    <?php endif; ?>

<?php else : ?>

    <?php if ( $confirmation_url ) : ?>
        <p>
            <?php
            printf(
                /* translators: %1$s: site title, %2$s: username */
                esc_html__( 'Thanks for creating an account on %1$s. Your username is %2$s.', 'woocommerce' ),
                esc_html( $blogname ),
                '<strong>' . esc_html( $user_login ) . '</strong>'
            ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
        </p>
        <p><strong><?php esc_html_e( 'Please confirm your email address to activate your account:', 'modelur3d' ); ?></strong></p>
        <p><a href="<?php echo esc_url( $confirmation_url ); ?>"><?php esc_html_e( 'Confirm my email address', 'modelur3d' ); ?></a></p>
        <p style="font-size:12px; color:#666;">
            <?php esc_html_e( 'Or paste this link into your browser:', 'modelur3d' ); ?><br>
            <?php echo make_clickable( esc_url( $confirmation_url ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </p>
    <?php else : ?>
        <?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>
        <p><?php printf( esc_html__( 'Thanks for creating an account on %1$s. Your username is %2$s. You can access your account area to view orders, change your password, and more at: %3$s', 'woocommerce' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>', make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php if ( $password_generated && $set_password_url ) : ?>
            <p><a href="<?php echo esc_attr( $set_password_url ); ?>"><?php esc_html_e( 'Click here to set your new password.', 'woocommerce' ); ?></a></p>
        <?php endif; ?>
    <?php endif; ?>

<?php endif; ?>
<?php echo $email_improvements_enabled ? '</div>' : ''; ?>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
    echo $email_improvements_enabled ? '<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation"><tr><td class="email-additional-content email-additional-content-aligned">' : '';
    echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
    echo $email_improvements_enabled ? '</td></tr></table>' : '';
}

/**
 * Fires to output the email footer.
 *
 * @hooked WC_Emails::email_footer()
 *
 * @since 3.7.0
 */
do_action( 'woocommerce_email_footer', $email );