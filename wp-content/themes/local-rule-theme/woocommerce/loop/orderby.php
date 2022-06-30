<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sizes = get_terms('pa_size');
$colors = get_terms('pa_color');
$selected_size = $_GET['pa_size'] ?? false;
$selected_color = $_GET['pa_color'] ?? false;
?>
<!--<form class="woocommerce-ordering" method="get">-->
<!--	<select name="orderby" class="orderby" aria-label="--><?php //esc_attr_e( 'Shop order', 'woocommerce' ); ?><!--">-->
<!--		--><?php //foreach ( $catalog_orderby_options as $id => $name ) : ?>
<!--			<option value="--><?php //echo esc_attr( $id ); ?><!--" --><?php //selected( $orderby, $id ); ?><!-- > --><?php //echo esc_html( $name ); ?><!--</option>-->
<!--		--><?php //endforeach; ?>
<!--	</select>-->
<!--	<input type="hidden" name="paged" value="1" />-->
<!--	--><?php //wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
<!--</form>-->
<div class="listing_top">
	<div class="categories_listing">
		<?php wc_get_template_part( 'category', 'links' ); ?>
	</div>
	<div class="filter-block">
		<h3>Filters <em class="fa-regular fa-filter"></em></h3>
		<div class="form_container">
			<form id="form_filter_id_for_submit" class="form_filter">
				<?php if (isset($_GET['status'])) : ?>
					<input class="hidden_input" type="text" name="status" value="<?php echo $_GET['status']; ?>">
				<?php endif; ?>
				<h5>Filter By</h5>
				<h5>size</h5>
				<ul>
					<li>
						<input type="radio" id="id_show_all_size" class="artform form_submit_jj" <?php echo (!isset($_GET['pa_size'])) ? 'checked' : ''; ?>>
						<label for="id_show_all_size">Show All</label>
					</li>
					<?php foreach ($sizes as $size) : ?>
						<li>
							<input type="radio" id="id_<?php echo $size->slug; ?>" name="pa_size" value="<?php echo $size->slug; ?>" class="artform form_submit_jj form_uncheck_size" <?php echo ($size->slug === $selected_size) ? 'checked' : ''; ?>>
							<label for="id_<?php echo $size->slug; ?>"><?php echo $size->name; ?></label>
						</li>
					<?php endforeach; ?>
				</ul>
				<h5>color</h5>
				<ul>
					<li>
						<input type="radio" id="id_show_all_color" class="artform form_submit_jj" <?php echo (!isset($_GET['pa_color'])) ? 'checked' : ''; ?>>
						<label for="id_show_all_color">Show All</label>
					</li>
					<?php foreach ($colors as $color) : ?>
						<li>
							<input type="radio" id="id_<?php echo $color->slug; ?>" name="pa_color" value="<?php echo $color->slug; ?>" class="artform form_submit_jj form_uncheck_color" <?php echo ($color->slug === $selected_color) ? 'checked' : ''; ?>>
							<label for="id_<?php echo $color->slug; ?>"><?php echo $color->name; ?></label>
						</li>
					<?php endforeach; ?>
				</ul>
				<h5>View Options</h5>
				<ul>
					<li>
						<input type="radio" id="id_default" name="sort-by" value="default" class="artform form_submit_jj" <?php echo (!isset($_GET['sort-by']) || isset($_GET['sort-by']) && $_GET['sort-by'] === 'default') ? 'checked' : ''; ?>>
						<label for="id_default">Default Sort Order</label>
					</li>
					<li>
						<input type="radio" id="id_lowest_price" name="sort-by" value="lowest_price" class="artform form_submit_jj" <?php echo (isset($_GET['sort-by']) && $_GET['sort-by'] === 'lowest_price') ? 'checked' : ''; ?>>
						<label for="id_lowest_price">Lowest price to highest</label>
					</li>
					<li>
						<input type="radio" id="id_highest_price" name="sort-by" value="highest_price" class="artform form_submit_jj" <?php echo (isset($_GET['sort-by']) && $_GET['sort-by'] === 'highest_price') ? 'checked' : ''; ?>>
						<label for="id_highest_price">Highest price to Lowest</label>
					</li>
					<li>
						<input type="radio" id="id_latest" name="sort-by" value="latest" class="artform form_submit_jj" <?php echo (isset($_GET['sort-by']) && $_GET['sort-by'] === 'latest') ? 'checked' : ''; ?>>
						<label for="id_latest">Sort by latest</label>
					</li>
					<li>
						<input type="radio" id="id_newest" name="sort-by" value="newest" class="artform form_submit_jj" <?php echo (isset($_GET['sort-by']) && $_GET['sort-by'] === 'newest') ? 'checked' : ''; ?>>
						<label for="id_newest">Sort by newest</label>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>
