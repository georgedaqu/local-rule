<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

//$attribute_keys  = array_keys( $attributes );
//$variations_json = wp_json_encode( $available_variations );
//$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
$variations_map = [];
foreach ($available_variations as $item) {
	$variations_map[$item['variation_id']] = $item['attributes'];
}
$variations_map_json = json_encode( $variations_map );

do_action( 'woocommerce_before_add_to_cart_form' );
?>
	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations='<?php echo $variations_map_json; ?>'>
		<?php do_action( 'woocommerce_before_variations_form' ); ?>

		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
		<?php else : ?>
			<div class="variations">
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<?php
						$variations = get_terms([
							'taxonomy' => $attribute_name,
						]);
					?>
					<?php if ($attribute_name === 'pa_color') : ?>
						<div class="colors">
							<div class="color_name"><?php echo wc_attribute_label( $attribute_name ); ?><span class="color_span"></span></div>
							<div class="color_options">
								<ul>
									<?php foreach ($variations as $variation) : ?>
										<?php if ( in_array( $variation->slug, $options ) ) : ?>
											<?php
											$color_variation_obj = get_term_meta($variation->term_id);
											$color = $color_variation_obj['product_attribute_color'][0];
											$name = $variation->name;
											$slug = $variation->slug;
											?>
											<li>
												<span class="tooltip"><?php echo $name; ?></span>
												<input type="radio" id="id_<?php echo $name; ?>" class="color_input pa-color-ajax-class variation-ajax-class" name="attribute_pa_color" value="<?php echo $slug; ?>" data-color="<?php echo $slug; ?>" data-name="<?php echo $name; ?>" <?php echo (isset($_GET['attribute_pa_color']) && $_GET['attribute_pa_color'] === $slug) ? 'checked': '';?>>
												<label for="id_<?php echo $name; ?>" style="border-color: <?php echo $color; ?>;" ></label>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php elseif ($attribute_name === 'pa_size') : ?>
						<div class="sizes">
							<span><?php echo wc_attribute_label( $attribute_name ); ?><span class="size_span"></span></span>
							<div class="size_options">
								<ul>
									<?php foreach ($variations as $variation) : ?>
										<?php if ( in_array( $variation->slug, $options ) ) : ?>
											<?php
											$name = $variation->name;
											$slug = $variation->slug;
											?>
											<li>
												<input type="radio" id="id_<?php echo $slug; ?>" class="size_input pa-size-ajax-class variation-ajax-class" name="attribute_pa_size" value="<?php echo $slug; ?>" data-size="<?php echo $slug; ?>">
												<label for="id_<?php echo $slug; ?>"><?php echo $name; ?></label>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php do_action( 'woocommerce_after_variations_table' ); ?>

			<div class="single_variation_wrap">
				<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
