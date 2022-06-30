<div class="checkout_wrap">
<?php
/**
 * Klarna Checkout page
 *
 * Overrides /checkout/form-checkout.php.
 *
 * @package klarna-checkout-for-woocommerce
 */

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', WC()->checkout() );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

$settings = get_option( 'woocommerce_kco_settings' );
?>

<form name="checkout" class="checkout woocommerce-checkout">
	<?php do_action( 'kco_wc_before_wrapper' ); ?>
	<div id="kco-wrapper">
		<div id="kco-order-review">
			<form name="checkout" method="post" class="checkout woocommerce-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

				<div class="checkout-review-order-block">
					<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
					<div class="store-address hidden" id="shop_address_id">
						<?php
							$address = get_field('field_62826a1223e9e', 'options');
							$location_link = get_field('field_62827a12eb0aa', 'options');
						?>
						<?php if ($location_link): ?>
							<a href="<?php echo $location_link; ?>" target="_blank">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 20.9l4.95-4.95a7 7 0 1 0-9.9 0L12 20.9zm0 2.828l-6.364-6.364a9 9 0 1 1 12.728 0L12 23.728zM12 13a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/></svg>
								<span><?php echo $address; ?></span>
							</a>
						<?php else: ?>
							<?php echo $address; ?>
						<?php endif; ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</form>
		</div>

		<div id="kco-iframe">
			<?php do_action( 'kco_wc_before_snippet' ); ?>
			<?php kco_wc_show_snippet(); ?>
			<?php do_action( 'kco_wc_after_snippet' ); ?>
		</div>
	</div>
	<?php do_action( 'kco_wc_after_wrapper' ); ?>
</form>

<?php do_action( 'woocommerce_after_checkout_form', WC()->checkout() ); ?>

</div>
