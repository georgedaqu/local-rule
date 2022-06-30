<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$status = $_GET['status'] ?? '';
$selected_size = $_GET['pa_size'] ?? false;
$selected_color = $_GET['pa_color'] ?? false;
$sort_by = $_GET['sort-by'] ?? false;

$tax_query = array('relation' => 'AND');
$cat = get_queried_object();
$cat_slug = $cat->slug ?? false;

if($cat_slug) {
	$tax_query[] = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms'    => $cat_slug,
		'relation' => 'AND',
	);
}
if($selected_size){
	$tax_query[] = array(
		'taxonomy' => 'pa_size',
		'field' => 'slug',
		'terms' => $selected_size,
		'relation' => 'AND',
	);
}
if($selected_color){
	$tax_query[] = array(
		'taxonomy' => 'pa_color',
		'field' => 'slug',
		'terms' => $selected_color,
		'relation' => 'AND',
	);
}

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = [
	'post_status' 	=> 'publish',
	'post_type' 	=> 'product',
	'posts_per_page'=> -1,
	'paged' 		=> $paged,
	'meta_value'	=> $status,
	'tax_query' 	=> $tax_query,
];

if($sort_by){
	if($sort_by === 'latest'){
		$args['orderby'] = array(
			'date' =>'ASC',
		);
	}elseif($sort_by === 'newest' || $sort_by === 'default'){
		$args['orderby'] = array(
			'date' =>'DESC',
		);
	}elseif($sort_by === 'highest_price'){
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'DESC';
	}elseif($sort_by === 'lowest_price'){
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'ASC';
	}
}
$products = new WP_Query($args);

?>
<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
<?php endif; ?>
<?php
/**
 * Hook: woocommerce_archive_description.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action( 'woocommerce_archive_description' );

//if ( woocommerce_product_loop() ) {

/**
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_output_all_notices - 10
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 * custom link - loop orderby.php
 */
 do_action( 'woocommerce_before_shop_loop' );
 ?>
<?php if ( $products->have_posts() ) : ?>
	<?php
	woocommerce_product_loop_start();
	while ( $products->have_posts() ) {
		$products->the_post();

		/**
		 * Hook: woocommerce_shop_loop.
		 */
		do_action( 'woocommerce_shop_loop' );

		wc_get_template_part( 'content', 'product' );
	}
	woocommerce_product_loop_end();
	?>
<?php else : ?>
	<div class="no_products">No products were found matching your selection.</div>
<?php endif; ?>
<?php
/**
 * Hook: woocommerce_after_shop_loop.
 *
 * @hooked woocommerce_pagination - 10
 */
// do_action( 'woocommerce_after_shop_loop' );
?>
<!--	<nav class="woocommerce-pagination">-->
<!--		--><?php
//		echo paginate_links( array(
//			'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
//			'format' => '?paged=%#%',
//			'current' => max( 1, get_query_var('paged') ),
//			'total' => $products->max_num_pages,
//			'prev_text' => '',
//			'next_text' => '',
//			'add_args'  => false,
//			'type'      => 'list',
//			'end_size'  => 3,
//			'mid_size'  => 3,
//		) );
//		?>
<!--	</nav>-->
<?php
//} else {
//	/**
//	 * Hook: woocommerce_no_products_found.
//	 *
//	 * @hooked wc_no_products_found - 10
//	 */
//	do_action( 'woocommerce_no_products_found' );
//}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */

// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
?>
