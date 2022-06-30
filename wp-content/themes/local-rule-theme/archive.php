<?php get_header(); ?>

<?php

$the_query = new WP_Query($args);

?>

<?php if($the_query->have_posts()): ?>

	<?php while($the_query->have_posts()): ?>
		<?php $the_query->the_post(); ?>
		<?php the_title(); ?>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php else: ?>
	<?php _e('Sorry, no posts matched your criteria.'); ?>
<?php endif; ?>

<?php get_footer(); ?>
