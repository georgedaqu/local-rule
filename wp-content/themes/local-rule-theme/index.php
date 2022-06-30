<?php

global $wp_query;
get_header();
?>

<main>
	<?php if (have_posts()) : ?>
		<?php  while ( have_posts() ) : the_post(); ?>
			<div class="latest_blog">
				<figure>
					<img src="<?php echo get_the_post_thumbnail_url($post, 'hero-image'); ?>" alt="">
				</figure>
				<div class="container">
					<div class="latest_blog_desc">
						<h1><?php echo get_the_title(); ?></h1>
						<p><?php echo get_the_excerpt(); ?> […]</p>
						<a href="<?php echo get_permalink(); ?>" class="btn primary read_more">Read Article</a>
					</div>
				</div>
			</div>
			<?php break; ?>
		<?php endwhile; ?>
	<?php endif; ?>
    <div class="container">
        <div class="recent_blog">
            <h2>Recent blog posts</h2>
            <div class="blog_list">
				<?php if (have_posts()) : ?>
					<?php  while ( have_posts() ) : the_post(); ?>
						<div class="most_recent_blog">
							<a href="<?php echo get_permalink(); ?>">
								<figure>
									<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
								</figure>
							</a>
							<div class="blog_description">
								<div class="blog_top">
									<span class="date"><?php echo get_the_date('d M Y'); ?></span>
									<h3><?php echo get_the_title(); ?></h3>
									<p><?php echo get_the_excerpt(); ?> […]</p>
								</div>
								<a href="<?php echo get_permalink(); ?>" class="btn light read_more">Read Article</a>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
