<?php
$status = $_GET['status'] ?? false;

$current_category = get_queried_object();
$active_category_id = $current_category->term_id ?? false;
$categories = get_categories(array(
	'hide_empty' => 0,
	'taxonomy' => 'product_cat',
	'parent' => 0,
));
?>
<ul>
	<li>
		<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?><?php if($status) : ?>?status=<?php echo $status; ?><?php endif; ?>">Shop All</a>
	</li>
	<?php foreach($categories as $category): ?>
		<li <?php echo ($active_category_id === $category->term_id) ? 'class="active"' : ''; ?>>
			<a href="<?php echo get_category_link($category->term_id); ?><?php if($status) : ?>?status=<?php echo $status; ?><?php endif; ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
		</li>
	<?php endforeach; ?>
</ul>
