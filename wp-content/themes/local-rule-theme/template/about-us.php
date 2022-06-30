<?php
/* Template Name: About Us */
get_header();

$hero_type = get_field('field_62ab0f7256f4e');
if ($hero_type === 'image') {
	$image = get_field( 'field_62ab1170bafac' );
}elseif ($hero_type === 'video') {
	$video = get_field( 'field_62ab118cbafad' );
	$video_poster = get_field( 'field_62ab11a9bafae' );
}
$hero_title = get_field('field_62ab11d835cd1');
$hero_text = get_field('field_62ab11fa35cd2');
$slider = get_field('field_62ab122b35cd3');
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
		<div class="hero_content hero_about">
			<div class="hero_story">
				<h2><?php echo $hero_title; ?></h2>
				<div class="hero_story_text"><?php echo $hero_text; ?></div>
			</div>
			<h1 class="small">
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
		</div>
	</div>
</section>
<section class="detail">
	<div class="container-fluid">
		<ul>
			<?php if( have_rows('field_62ab127835cd4') ): ?>
				<?php while ( have_rows('field_62ab127835cd4') ) : the_row(); ?>
					<?php
					$imageID = get_sub_field('field_62ab12ee35cd5');
					$image_label = get_sub_field('field_62ab131135cd6') ?? false;
					$image_button = get_sub_field('field_62ab132f35cd7') ?? false;
					$description = get_sub_field('field_62ab134135cd8');
					?>
					<li class="d-flex align-items-center flex-wrap">
						<div class="about-image w-50">
							<img src="<?php echo wp_get_attachment_image_url($imageID, 'about-us-text-image'); ?>" alt="">
							<?php if ($image_label) : ?>
								<div class="slogan">
									<h3>
										<?php echo $image_label; ?>
									</h3>
									<?php if ($image_button) : ?>
										<div class="more">
											<a href="<?php echo $image_button['url']; ?>" class="btn primary" title="<?php echo $image_button['title']; ?>" target="<?php echo $image_button['target']; ?>"><?php echo $image_button['title']; ?></a>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="about-description w-50">
							<div class="text-content">
								<?php echo $description; ?>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</ul>
	</div>
</section>
<section class="image-gallery">
	<div class="swiper about-slider">
		<div class="swiper-wrapper">
			<?php if ($slider): ?>
				<?php foreach ($slider as $slide) : ?>
					<div class="swiper-slide">
						<figure>
							<img src="<?php echo wp_get_attachment_image_url($slide, 'about-us-slider-image'); ?>" class="slide-image" alt="">
						</figure>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
