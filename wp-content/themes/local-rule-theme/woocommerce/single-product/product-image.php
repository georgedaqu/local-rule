<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */
global $product;

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}
?>

<div class="product_wrap">
	<div id="product-gallery-container" data-productid="<?php echo get_the_ID(); ?>" class="product_gallery_wrap">
		<?php
			if($product->is_type('variable')){
				$variations = $product->get_available_variations();
			}

			if (isset($variations) && $variations) {
				if (isset($color) && $color)
					$attribute_pa_color = $color;
				elseif (isset($_GET['attribute_pa_color']) && $_GET['attribute_pa_color'])
					$attribute_pa_color = $_GET['attribute_pa_color'];
				else
					$attribute_pa_color = false;

				if($attribute_pa_color){
					$color = $attribute_pa_color;
				}else{
					$d_color = $product->get_variation_attributes();
					$color = $d_color['pa_color'][0];
				}
				foreach ($variations as $item) {
					if ($item['attributes']['attribute_pa_color'] == $color) {
						$active_variationID = $item['variation_id'];
						break;
					}
				}
				$gallery = get_field('field_6273ba5e019c4', $active_variationID ?? null);
				$variation_video = get_field('field_6273baa0019c6', $active_variationID ?? null);
				$has_video = false;
				if(is_array($variation_video) && in_array('enable', $variation_video)){
					$video_thumbnail = get_field('field_6273ba6f019c5', isset($active_variationID) ? $active_variationID : null);
					$video = get_field('field_6273baf0019c7', isset($active_variationID) ? $active_variationID : null);
					$has_video = true;
				}
			}else {
				$attachment_ids = $product->get_gallery_image_ids();

				$product_video_options = get_field('product_video_options');
				$has_video = false;

				if(is_array($product_video_options) && in_array('productVideo', $product_video_options)){
					$video_thumbnail = get_field('product_video_thumbnail');
					$video = get_field('product_video_file');
					$has_video = true;
				}
			}

			// thumbnail gallery container
			$results = '<div class="thumbs_wrapper">';
			$results .= '<div thumbsSlider="" class="swiper thumbs_gallery">';
			$results .= '<div class="swiper-wrapper">';

			if ($has_video) {
				$results .= '<div class="swiper-slide video">';
				$results .= '<img src="'.wp_get_attachment_image_url( $video_thumbnail, 'gallery-thumbnail-image' ).'" alt="" />';
				$results .=	'</div>';
			}
			if(isset($gallery) && $gallery) {
				foreach ( $gallery as $image ) {
					$results .= '<div class="swiper-slide">';
					$results .= '<img src="' . wp_get_attachment_image_url( $image, 'gallery-thumbnail-image' ) . '" alt="" />';
					$results .=	'</div>';
				}
			}elseif (isset($attachment_ids) && $attachment_ids) {
				foreach ( $attachment_ids as $id ) {
					$results .= '<div class="swiper-slide">';
					$results .= '<img src="' . wp_get_attachment_image_url( $id, 'gallery-thumbnail-image' ) . '" alt="" />';
					$results .=	'</div>';
				}
			}
			$results .= '</div>';
			$results .= '</div>';
			$results .= '</div>';

			// gallery images
			$results .= '<div class="gallery_wrapper">';
			$results .= '<div class="swiper image_gallery">';
			$results .= '<div class="swiper-wrapper" id="main_gallery">';
			if ($has_video) {
				$results .= '<div class="swiper-slide video">';
				$results .= '<video muted="" playsinline="" poster="' . wp_get_attachment_image_url( $video_thumbnail ) . '">';
				$results .= '<source src="'.$video['url'].'" type="video/mp4">';
				$results .= '</video>';
				$results .= '<div class="play-trigger"></div>';
				$results .=	'</div>';
			}
			if(isset($gallery) && $gallery) {
				foreach ( $gallery as $image ) {
					$results .= '<div class="swiper-slide image" data-src="' . wp_get_attachment_image_url( $image ) . '">';
					$results .= '<img src="' . wp_get_attachment_image_url( $image ) . '" />';
					$results .= '</div>';
				}
			}elseif (isset($attachment_ids) && $attachment_ids) {
				foreach ( $attachment_ids as $id ) {
					$results .= '<div class="swiper-slide image" data-src="' . wp_get_attachment_image_url( $id ) . '">';
					$results .= '<img src="' . wp_get_attachment_image_url( $id ) . '" />';
					$results .= '</div>';
				}
			}
			$results .= '</div>';

			// gallery slider arrows
			$results .= '<div class="swiper_buttons"><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
			$results .= '</div>';
			$results .= '</div>';
			echo $results;
		?>
	</div>
