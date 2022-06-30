<?php
/**
 * Local Rule functions and definitions
 *
 * @package Local Rule
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

$localrule_inc_dir = get_template_directory() . '/inc';

// Array of files to include
$localrule_includes = array(
	'/setup.php',
	'/widgets.php',
	'/menus.php',
	'/blocks.php',
	'/post_types.php',
	'/woocommerce.php',
	'/product-variation-gallery.php',
	'/single-product-gallery.php',
);

// Include files
foreach($localrule_includes as $file){
	require_once $localrule_inc_dir . $file;
}

// disable admin bar
add_filter( 'show_admin_bar', '__return_false' );

// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );
// Disable Gutenberg for widgets.
add_filter( 'use_widgets_blog_editor', '__return_false' );
add_action( 'wp_enqueue_scripts', function() {
	// Remove CSS on the front end.
	wp_dequeue_style( 'wp-block-library' );
	// Remove Gutenberg theme.
	wp_dequeue_style( 'wp-block-library-theme' );
	// Remove inline global CSS on the front end.
	wp_dequeue_style( 'global-styles' );
}, 20 );

// woocommerce sidebar
//require_once get_template_directory(). '/woocommerce/global/sidebar.php';

?>
