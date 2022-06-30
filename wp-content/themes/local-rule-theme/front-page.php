<?php
get_header();

$hero_type = get_field('field_62a9a36a5b334');
if ($hero_type === 'image') {
	$image = get_field( 'field_62a9a3a55b335' );
}elseif ($hero_type === 'video') {
	$video = get_field( 'field_62a9a3d15b336' );
	$video_poster = get_field( 'field_62a9a3eb5b337' );
}
$button = get_field('field_62a9a4515b339') ?? false;
if($button){
	$button_Link = $button[0]['button_link'];
	$button_color = $button[0]['button_color'];
	$button_style = $button[0]['button_style'];
}


$categories = get_terms([
	'taxonomy'   => "product_cat",
	'hide_empty' => false,
	'parent'	 => 0,
]);

$latest_products = new WP_Query([
	'post_type' => 'product',
	'posts_per_page' => 8,
	'orderby' => 'rand',
	'meta_query' => [
		[
			'key' => 'show_in_latest_products',
			'value' => 'enable',
			'compare' => 'LIKE',
		]
	]
]);
$productCount = $latest_products->found_posts;
?>
<section class="hero">
	<figure class="hero_bg">
		<?php if ($image) : ?>
			<img src="<?php echo wp_get_attachment_image_url( $image, 'hero-image' ); ?>" alt="">
		<?php elseif ($video) : ?>
			<video autoplay muted loop playsinline poster="<?php echo wp_get_attachment_image_url( $video_poster, 'hero-image' ); ?>">
				<source src="<?php echo $video['url'] ?>" type="video/mp4">
			</video>
		<?php endif; ?>
	</figure>
	<div class="container trans-all-2">
		<div class="hero_content">
			<h1>
				<strong>
					<span>L</span>
					<span>o</span>
					<span>c</span>
					<span>a</span>
					<span>l</span>
				</strong>
				<strong>
					<span>R</span>
					<span>u</span>
					<span>l</span>
					<span>e</span>
				</strong>
			</h1>
			<!-- <?php //if ($button) : ?>
				<div class="more">
					<a href="<?php //echo $button_Link['url']; ?>" class="btn primary big" title="<?php //echo $button_Link['title']; ?>" target="<?php //echo $button_Link['target']; ?>"><?php //echo $button_Link['title']; ?></a>
				</div>
			<?php //endif; ?> -->
			<div class="more">
				<a href="/shop/?status=in_stock" class="btn primary big" title="In Stock">In Stock</a>
				<a href="/shop/?status=pre_order" class="btn transparent big" title="Pre-order">Pre-order</a>
			</div>
		</div>
	</div>
	<div class="front_categories swiper">
		<div class="swiper-wrapper">
			<?php foreach ($categories as $cat) : ?>
				<?php
					$catID = $cat->term_id;
					$name = $cat->name;
					$catLink = get_category_link($catID);
					$sliderImageID = get_term_meta( $catID, 'thumbnail_id', true);
				?>
				<div class="swiper-slide">
					<h3>
						<a href="<?php echo $catLink; ?>" title="Tops">
							<span><?php echo $name; ?></span>
							<em class="fa-regular fa-chevron-right"></em>
						</a>
					</h3>
					<figure>
						<a href="<?php echo $catLink; ?>" title="Tops">
							<img src="<?php echo wp_get_attachment_image_url( $sliderImageID, 'front-categories-image' ); ?>" alt="">
						</a>
					</figure>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="front_categories_nav front_categories_prev">
			<em class="fa-regular fa-chevron-left"></em>
		</div>
		<div class="front_categories_nav front_categories_next">
			<em class="fa-regular fa-chevron-right"></em>
		</div>
	</div>
</section>

<section class="latest-products-alt">
	<div class="container">
		<div class="latest_products_top">
			<h3>Latest Products</h3>
			<?php if ($productCount > 4) : ?>
				<div class="latest_products_slider_nav">
					<a href="javascript:void(0);" class="latest_products_slider_prev">
						<div class="latest_products_slider_arrow arrow_prev">
							<em class="fa-regular fa-chevron-left"></em>
						</div>
					</a>
					<a href="javascript:void(0);" class="latest_products_slider_next">
						<div class="latest_products_slider_arrow arrow_next">
							<em class="fa-regular fa-chevron-right"></em>
						</div>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="swiper latest_products_slider">
			<div class="swiper-wrapper">
				<?php if ($latest_products->have_posts()) : ?>
					<?php while ($latest_products->have_posts()) : $latest_products->the_post(); global $product; ?>
						<div class="swiper-slide">
							<figure>
								<a href="<?php echo get_permalink($latest_products->post->ID); ?>">
									<?php //woocommerce_show_product_sale_flash($post, $product); ?>
									<img src="<?php echo get_the_post_thumbnail_url($post, 'front-categories-image'); ?>" alt="">
								</a>
							</figure>
							<h3><?php echo get_the_title(); ?></h3>
							<h5>
								<?php
//								$cat_str = $product->get_categories();
//								$cat_arr = explode(',', $cat_str);
//								$new_cat = [];
//
//								foreach ($cat_arr as $cat){
//									if(ltrim($cat) == '<a href="https://local-rule.com/product-category/new-arrivals/" rel="tag">New Arrivals</a>'){
//										array_unshift($new_cat, $cat);
//									}else{
//										array_push($new_cat, ltrim($cat));
//									}
//								}
//								foreach ($new_cat as $key => $cat){
//									echo ltrim($cat);
//									if ($key !== array_key_last($new_cat)) {
//										echo ', ';
//									}
//								}
								echo wc_get_product_category_list($latest_products->post->ID);
								?>
							</h5>
							<h4><?php echo $product->get_price_html(); ?></h4>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="instagram_feed">
	<div class="container">
		<div class="insta_images">
			<?php
				$userMedia = json_decode(do_shortcode("[tct_ig_media]"), true);
				$igLink = do_shortcode("[tct_ig_link]");
			?>
			<div class="left_images">
				<div class="header_texts">
					<h3>
						<a href="https://www.instagram.com/localrule" target="_blank">@Local Rule...</a>
					</h3>
					<p class="description">Check out our Instagram ✌️</p>
				</div>
				<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[0]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[0]["media_url"]; ?>">
				</a>
				<div class="custom_images">
					<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[1]["permalink"]; ?>">
						<img class="high" src="<?php echo $userMedia[1]["media_url"]; ?>">
					</a>
					<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[2]["permalink"]; ?>">
						<img class="high" src="<?php echo $userMedia[2]["media_url"]; ?>">
					</a>
				</div>
			</div>
			<div class="right_images">
				<a class="large permalink insta_pic" target="_blank" href="<?php echo $userMedia[3]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[3]["media_url"]; ?>">
				</a>
				<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[4]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[4]["media_url"]; ?>">
				</a>
				<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[5]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[5]["media_url"]; ?>">
				</a>
				<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[6]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[6]["media_url"]; ?>">
				</a>
				<a class="permalink insta_pic" target="_blank" href="<?php echo $userMedia[7]["permalink"]; ?>">
					<img class="high" src="<?php echo $userMedia[7]["media_url"]; ?>">
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
