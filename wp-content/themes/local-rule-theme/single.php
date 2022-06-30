<?php get_header(); ?>

<main>
	<div class="container">
		<div class="news_wrapper">
			<div class="news_content">
				<div class="news">
					<figure>
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
					</figure>
					<h1><?php echo get_the_title(); ?></h1>
					<div class="news_desc">
						<div><?php echo get_the_content(); ?></div>
					</div>
				</div>
				<div class="social_links">
					<ul>
						<li>
							<a target="_blank" href="https://www.instagram.com/">
								<em class="fa-brands fa-instagram"></em>
							</a>
						</li>
						<li>
							<a target="_blank" href="https://www.facebook.com/">
								<em class="fa-brands fa-twitter"></em>
							</a>
						</li>
						<li>
							<a target="_blank" href="https://www.youtube.com/">
								<em class="fa-brands fa-facebook-f"></em>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<aside class="similar_news">
				<h2>Similar Articles</h2>
				<ul>
					<?php
					$postID = get_the_ID();
					$args = array(
						'post_type' => 'post',
						'post__not_in' => array($postID),
					);
					$similar_products = new WP_Query($args);
					?>
					<?php if ($similar_products->have_posts()) : ?>
						<?php while ($similar_products->have_posts()) : $similar_products->the_post(); ?>
							<li>
								<div class="similar_news">
									<figure>
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</figure>
									<div class="simiar_news_desc">
										<h3><?php echo get_the_title(); ?></h3>
										<p><?php echo get_the_excerpt(); ?> […]</p>
										<a class="btn read_more" href="<?php echo get_permalink(); ?>" title="What Café said about us!">Read article</a>
									</div>
								</div>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</aside>
		</div>
	</div>
</main>

<?php get_footer(); ?>
