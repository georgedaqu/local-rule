<?php

add_action( 'after_setup_theme', function() {
	add_theme_support( 'woocommerce' );
});

// permalink
add_filter('request', function( $vars ) {
	global $wpdb;
	if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] ) ) {
		$slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
		$exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
		if( $exists ){
			$old_vars = $vars;
			$vars = array('product_cat' => $slug );
			if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
				$vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
			if ( !empty( $old_vars['orderby'] ) )
				$vars['orderby'] = $old_vars['orderby'];
			if ( !empty( $old_vars['order'] ) )
				$vars['order'] = $old_vars['order'];
		}
	}
	return $vars;
});

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'localrule_woocommerce_breadcrumbs' );
function localrule_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav class="breadcrumbs"><ul>',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    );
}

// Password strength
add_filter( 'woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement' );
function reduce_woocommerce_min_strength_requirement( $strength ) {
	return 2;
}

// For adding confirm password field on the register form under My Accounts.
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);

function woocommerce_register_form_password_repeat() {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" placeholder="Confirm Password*" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
}
add_action( 'woocommerce_register_form', 'woocommerce_register_form_password_repeat' );

// For product tabs
function woo_care_tab_content() {
	echo get_field('care_section', get_the_ID());
}

function woo_details_tab_content() {
	echo get_field('details_section', get_the_ID());
}

function woo_size_tab_content() {
	$size = get_field('field_626a9c38d77be', get_the_ID());
	echo do_shortcode($size);
}

// Customize woocommerce my-account menu
function wpb_woo_my_account_order() {
	$myorder = array(
		'orders'            => __( 'My purchases & returns', 'woocommerce' ),
		'edit-account'      => __( 'Personal details', 'woocommerce' ),
		'edit-address' 		=> __( 'Addresses', 'woocommerce' ),
		'newsletter'        => __( 'Newsletter', 'woocommerce' ),
		'help-contact'      => __( 'Help & contact', 'woocommerce' ),
		'privacy'       	=> __( 'Privacy policy', 'woocommerce' ),
		'customer-logout'   => __( 'Logout', 'woocommerce' ),
	);
	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );

// remove meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// Update quantity
add_action( 'woocommerce_after_quantity_input_field', 'localrule_display_quantity_plus' );
function localrule_display_quantity_plus() {
	if ( ! is_product() ) return;
	echo '<div class="plus">+</div>';
}
add_action( 'woocommerce_before_quantity_input_field', 'localrule_display_quantity_minus' );
function localrule_display_quantity_minus() {
	if ( ! is_product() ) return;
	echo '<div class="minus">-</div>';
}

// Separate variations in cart
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );

// Edit proceed to checkout button
function woocommerce_button_proceed_to_checkout() { ?>
	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn primary">
		<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
	</a>
<?php }

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 100 );

// tax label changed to custom
function custom_cart_totals_order_total_html( $value ){
	$value = '<strong>' . WC()->cart->get_total() . '</strong> ';

	// If prices are tax inclusive, show taxes here.
	if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
		$tax_string_array = array();
		$cart_tax_totals  = WC()->cart->get_tax_totals();
		if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
			foreach ( $cart_tax_totals as $code => $tax ) {
				$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
			}
		} elseif ( ! empty( $cart_tax_totals ) ) {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

		if ( ! empty( $tax_string_array ) ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';
			$value .= '<small class="includes_tax">' . sprintf( __( '(Inc. VAT)', 'woocommerce' ), implode( ', ', $tax_string_array ) . $estimated_text ) . '</small>';
		}
	}
	return $value;
}

add_filter( 'woocommerce_cart_totals_order_total_html', 'custom_cart_totals_order_total_html', 20, 1 );

// Store notice text
function localrule_demo_store_filter($text) {
	$text = str_replace(array('<p class="woocommerce-store-notice demo_store">', '</p>', 'Dismiss'), array('<div class="woo-notice-container"><p class="woocommerce-store-notice demo_store">', '</p></div>', 'Close'), $text);
	return $text;
}
add_filter('woocommerce_demo_store', 'localrule_demo_store_filter', 10, 1);

?>
