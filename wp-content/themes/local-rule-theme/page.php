<?php get_header(); ?>

<main>
	<?php if (is_account_page() && !is_user_logged_in()) : ?>
		<div class="account_hero">
			<figure>
				<img src="<?php echo get_the_post_thumbnail_url($post, 'hero-image'); ?>" alt="">
			</figure>
		</div>
	<?php endif; ?>
	<div class="container">
		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : ?>
				<?php the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
