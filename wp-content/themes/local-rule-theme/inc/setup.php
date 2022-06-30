<?php

// Theme support
add_theme_support('title-tag');
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// Remove Wordpres Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove default image sizes
add_image_size('thumbnail', false);
add_image_size('medium', false);
add_image_size('medium_large', false);
add_image_size('large', false);
remove_image_size('1536x1536');
remove_image_size('2048x2048');
// Add custom image sizes
add_image_size('hero-image', 1920, 1080, true);
add_image_size('about-us-text-image', 960, 1280, true);
add_image_size('about-us-slider-image', 610, 820, true);
add_image_size('archive-image', 535, 710, true);
add_image_size('front-categories-image', 465, 700, true);
add_image_size('shop-menu-image', 400, 200, true);
add_image_size('gallery-thumbnail-image', 130, 130, true);
add_image_size('checkout-klarna-thumbnail-image', 70, 95, true);

// Excerpt length
function localrule_custom_excerpt_length($length){
	return 15;
}
add_filter('excerpt_length', 'localrule_custom_excerpt_length', 999);
function localrule_excerpt_more($more){
	return '';
}
add_filter('excerpt_more', 'localrule_excerpt_more');

// Pagination
function pagination_bar($custom_query){
	$total_pages = $custom_query->max_num_pages;
	$big = 999999999;
	if ($total_pages > 1){
		$current_page = max(1, get_query_var('paged'));
		echo paginate_links(array(
			'base'			=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'		=> '?paged=%#%',
			'current'		=> $current_page,
			'total'			=> $total_pages,
			'prev_text'		=> __('<em class="fal fa-angle-left"></em>'),
			'next_text'		=> __('<em class="fal fa-angle-right"></em>')
		));
	}
}

// options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

?>
