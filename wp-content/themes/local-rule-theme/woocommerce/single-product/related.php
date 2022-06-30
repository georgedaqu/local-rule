<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related_products">
		<div class="container">
			<div class="related_products_top">
				<?php $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) ); ?>
				<?php if ( $heading ) : ?>
					<h3><?php echo esc_html( $heading ); ?></h3>
				<?php endif; ?>
				<?php if (count($related_products) > 4) : ?>
					<div class="related_products_slider_nav">
						<a href="javascript:void(0);" class="related_products_slider_prev">
							<div class="related_products_slider_arrow arrow_prev">
								<em class="fa-regular fa-chevron-left"></em>
							</div>
						</a>
						<a href="javascript:void(0);" class="related_products_slider_next">
							<div class="related_products_slider_arrow arrow_next">
								<em class="fa-regular fa-chevron-right"></em>
							</div>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<div class="swiper related_products_slider">
				<div class="swiper-wrapper">
					<?php foreach ( $related_products as $related_product ) : ?>
						<div class="swiper-slide">
							<?php
							$post_object = get_post( $related_product->get_id() );
							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
							$postID = get_the_ID();
							$product = wc_get_product($postID);
							?>
							<figure>
								<a href="<?php echo get_the_permalink(); ?>">
									<img src="<?php echo get_the_post_thumbnail_url($postID, 'front-categories-image'); ?>" alt="">
								</a>
							</figure>
							<h3><?php echo get_the_title(); ?></h3>
							<h5><?php echo wc_get_product_category_list($postID); ?></h5>
							<h4><?php echo $product->get_price_html(); ?></h4>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
