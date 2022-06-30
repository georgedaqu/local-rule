<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
$id = [];
?>

<div class="cart_wrap trans-all-4">
	<?php do_action( 'woocommerce_before_cart' ); ?>
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<div class="cart_columns">
			<div class="cart-section">
				<div class="woocommerce-cart-form-holder">
					<?php woocommerce_output_all_notices(); ?>
					<?php woocommerce_breadcrumb(); ?>
					<h1>My Bag</h1>
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
					<div class="cart_table">
						<div class="cart_head">
							<div>Item</div>
							<div>Item Price</div>
							<div><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></div>
							<div>Total Price</div>
						</div>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
								$id[] = $product_id;
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
									?>
									<div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

										<div class="product-surati">
											<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
										</div>

										<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
											<div class="product-name-top">

												<div class="name">
													<?php
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ); ?>
												</div>

												<?php
												$terms = get_the_terms( $product_id, 'product_cat' );
												foreach ($terms as $term) {
													$product_cat = $term->name;
												}

												if($product_cat) { ?>
													<div class="category">
														<?php echo $product_cat; ?>
													</div>
												<?php }

												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

												// Meta data.
												echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

												// Backorder notification.
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												}

												?>
											</div>
										</div>

										<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
											<div class="hidden_quantity">
												<?php
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input(
															array(
																'input_name'   => "cart[{$cart_item_key}][qty]",
																'input_value'  => $cart_item['quantity'],
																'max_value'    => $_product->get_max_purchase_quantity(),
																'min_value'    => '0',
																'product_name' => $_product->get_name(),
															),
															$_product,
															false
														);
													}

													echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
												?>
											</div>
											<div class="plus_minus">
												<a class="incdec" href="javascript:void(0)">-</a>
												<input type="text" value="<?php echo $cart_item['quantity']; ?>" class="input-text" readonly>
												<a class="incdec" href="javascript:void(0)">+</a>
											</div>
										</div>

										<div class="product-subtotal" data-title="<?php esc_attr_e( 'Total Price', 'woocommerce' ); ?>">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.

												echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
													sprintf(
														'<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s">
															<em class="fa-solid fa-trash-can"></em>
														</a>',
														esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
														esc_html__( 'Remove this item', 'woocommerce' ),
														esc_attr( $product_id ),
														esc_attr( $_product->get_sku() )
													),
													$cart_item_key
												);
											?>
											<?php do_action( 'woocommerce_cart_contents' ); ?>

											<button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

											<?php do_action( 'woocommerce_cart_actions' ); ?>

											<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
											<?php do_action( 'woocommerce_after_cart_contents' ); ?>
										</div>
									</div>
									<?php
								}
							}
						?>
					</div>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</div>

			</div>
			<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

			<div class="cart-collaterals">
				<?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display ---- removed
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action( 'woocommerce_cart_collaterals' );
				?>
			</div>
		</div>
	</form>
</div>
<?php woocommerce_cross_sell_display(); ?>
<?php do_action( 'woocommerce_after_cart' ); ?>
