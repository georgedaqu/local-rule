<?php
	$id = 'hero-' . $block['id'];
	if(!empty($block['anchor'])){
		$id = $block['anchor'];
	}
	$media_type = get_field('media_type');
	$image = get_field('image');
	$picture = $image['sizes']['hero-image'];
?>

<section class="hero trans-all-4">
	<figure>
		<?php if($media_type == 'image') : ?>
			<img src="<?php echo $picture; ?>" alt="">
		<?php elseif($media_type == 'video') : ?>
			<video autoplay muted playsinline loop>
				<source src="<?php echo $video['url']; ?>" type="video/mp4">
			</video>
		<?php endif; ?>
	</figure>
	<div class="hero_texts">
		<?php
			$allowed_blocks = array('core/heading', 'core/paragraph');
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode($allowed_blocks)) . '" />';
		?>
	</div>
</section>