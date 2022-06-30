<?php
/* Template Name: Basic Template */
get_header();
?>
<main>
	<div class="container">
		<div class="container_basic">
			<h1><?php echo get_the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
