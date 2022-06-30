<?php

// Events post type
// function events_post_type(){
// 	register_post_type('events', [
// 		'label'  => null,
// 		'labels' => [
// 			'name'				=> 'Events',
// 			'singular_name'		=> 'Event',
// 			'add_new'			=> 'Add Event',
// 			'add_new_item'		=> 'Add Event',
// 			'edit_item'			=> 'Edit Event',
// 			'new_item'			=> 'New Event',
// 			'view_item'			=> 'Watch Event',
// 			'search_items'		=> 'Search Event',
// 			'not_found'			=> 'Not found',
// 		],
// 		'description'		=> 'Post for Event',
// 		'public'			=> true,
// 		'show_in_menu'		=> true,
// 		'show_in_rest'		=> true,
// 		'rest_base'			=> true,
// 		'menu_position'		=> true,
// 		'menu_icon'			=> 'dashicons-megaphone',
// 		'hierarchical'		=> true,
// 		'supports'			=> ['title', 'thumbnail', 'editor'],
// 		'taxonomies'		=> [],
// 		'has_archive'		=> true,
// 		'rewrite'			=> true,
// 		'query_var'			=> true,
// 	]);
// }
//add_action('init', 'events_post_type');


// Size Chart post type
function custom_post_type(){
	register_post_type('size-chart', [
		'label'  => null,
		'labels' => [
		    'name'				=> 'Size Chart',
		    'singular_name'		=> 'Size Chart',
		    'add_new'			=> 'Add Size Chart',
		    'add_new_item'		=> 'Add Size Chart',
		    'edit_item'			=> 'Edit Size Chart',
		    'new_item'			=> 'New Size Chart',
		    'view_item'			=> 'Watch Size Chart',
		    'search_items'		=> 'Search Size Chart',
		    'not_found'			=> 'Not found',
		],
		'description'		=> 'Post for Size Chart',
		'public'			=> true,
		'show_in_menu'		=> true,
		'show_in_rest'		=> true,
		'rest_base'			=> true,
		'menu_position'		=> true,
		'menu_icon'			=> 'dashicons-editor-table',
		'hierarchical'		=> true,
		'supports'			=> ['title', 'thumbnail'],
		'taxonomies'		=> [],
		'has_archive'		=> true,
		'rewrite'			=> true,
		'query_var'			=> true,
	]);
}
add_action('init', 'custom_post_type');

// Create shortcode.
function size_chart($attrs){
	ob_start();
	set_query_var('size_chart_attrs', $attrs);
	get_template_part('template-parts/sections/section', 'size-chart');
	return ob_get_clean();
}
add_shortcode('size_chart_in', 'size_chart');

// Display shortcode in admin area.
function wpso_custom_columns_head($defaults) {
	$defaults['shortcode']  = 'Shortcode';
	return $defaults;
}
add_filter('manage_size-chart_posts_columns', 'wpso_custom_columns_head');

function wpso_custom_columns_content( $column_name, $post_ID ) {
	if ( 'shortcode' === $column_name ) {
		echo '[size_chart_in id="' . $post_ID . '"]';
	}
}
add_action('manage_size-chart_posts_custom_column', 'wpso_custom_columns_content', 10, 2);

?>
