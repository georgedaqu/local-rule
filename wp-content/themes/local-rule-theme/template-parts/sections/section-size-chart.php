<?php

$size_chart_attrs = get_query_var('size_chart_attrs');
$postID = $size_chart_attrs['id'];

$query = new WP_Query([
    'post_per_page' => 0,
    'post_type'     => 'size-chart',
    'p'             => $postID,
]);

?>
<?php while ($query->have_posts()) : $query->the_post() ?>
    <?php $size_chart = get_field('field_62ab0a86bdfa4'); ?>
	<div class="size_chart">
		<?php foreach ($size_chart as $sizes) : ?>
			<?php
			$head = $sizes['heading'];
			$all_sizes = $sizes['sizes'];

			?>
			<div class="size_column">
				<div class="size_head"><?php echo $head; ?></div>
					<?php foreach ($all_sizes as $size) : ?>
						<div class="size_value"><?php echo $size['size']; ?></div>
					<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
