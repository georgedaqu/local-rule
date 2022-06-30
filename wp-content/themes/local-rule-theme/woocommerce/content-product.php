<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_status = get_field('field_629de8cc72263');
if($product->is_type('variable')){
	$unique_variations = false;
	$product_variations = $product->get_available_variations();
}
?>

<?php if ($product_variations) :?>
	<?php foreach ($product_variations as $single_variation) : ?>
		<?php if ($single_variation['attributes']['attribute_pa_color'] !== $unique_variations) : ?>
			<?php
			$variation_id = $single_variation['variation_id'];
			$product_var = wc_get_product( $variation_id );
			$current_color = $single_variation['attributes']['attribute_pa_color'];
			$image_id = $product_var->image_id;
			?>
			<li class="product type-product post-1542 status-publish last instock product_cat-accessories product_cat-golf-bags has-post-thumbnail taxable shipping-taxable purchasable product-type-simple">
				<a href="<?php echo get_the_permalink(); ?>?attribute_pa_color=<?php echo $current_color; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
					<img width="1651" height="2201" src="<?php echo wp_get_attachment_image_url($image_id, 'archive-image'); ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy">
				</a>
				<h2 class="woocommerce-loop-product__title"><?php echo get_the_title(); ?> <span><?php echo $current_color; ?></span></h2>
				<span class="price woocommerce-Price-amount amount"><?php echo $product->get_variation_price() . ' ' . get_woocommerce_currency_symbol(); ?></span>
				<!--	<span class="product_color">1 Color Available</span>-->
				<span class="product_availability"><?php echo ($product_status === 'in_stock') ? 'In Stock' : 'Pre-order';?></span>
			</li>
		<?php endif; ?>
		<?php $unique_variations = $single_variation['attributes']['attribute_pa_color']; ?>
	<?php endforeach; ?>
<?php else : ?>
	<li <?php wc_product_class( '', $product ); ?>>
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		<span class="product_availability"><?php echo ($product_status === 'in_stock') ? 'In Stock' : 'Pre-order'; ?></span>
	</li>
<?php endif; ?>
