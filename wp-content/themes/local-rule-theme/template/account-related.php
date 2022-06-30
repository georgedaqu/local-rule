<?php
/* Template Name: Account Related */
get_header();
?>
<main>
	<div class="container">
		<div class="account_related">
			<div class="account_related_content">
				<h1><?php echo get_the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
			<?php do_action( 'woocommerce_account_navigation' ); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
