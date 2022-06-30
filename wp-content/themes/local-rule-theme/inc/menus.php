<?php

// Register menus
function localrule_register_nav_menu(){
	register_nav_menu('header_menu', 'Header Menu');
}
add_action('after_setup_theme', 'localrule_register_nav_menu');

// sub menu images
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2 );

function my_wp_nav_menu_objects( $items ) {
	foreach ( $items as $item ) {
		$html = '';
		$title = $item->title;
		$imageID = get_field( 'image', $item );
		$image = wp_get_attachment_image_url( $imageID, 'shop-menu-image' );
		if ( ! empty( $image ) ) {
			$item->classes[] = 'image';
			$html .= '<span>' . $title . '</span>';
			$item->title = '<img class="lazyloaded" src="' . $image . '" alt="aa">' . $html;
		}

	}
	return $items;
}

?>
