<?php

function localrule_process_registration_errors($validation_error, $username, $password, $email)
{
	if ( empty( $email ) || empty( $password ) ) {
		return $validation_error;
	}
	if ( empty( $_POST['password2'] )) {
		return new WP_Error( 'registration-error-missing-password2', __( 'Please enter an account confirm password.', 'woocommerce' ) );
	}
	if ($_POST['password2'] != $password) {
		return new WP_Error( 'registration-error-password-non-equal-password2', __( 'Password and confirm password should be equal.', 'woocommerce' ) );
	}
	if ($password && strlen($password) < 12) {
		return new WP_Error( 'registration-error-invalid-password', 'The password should be at least 12 characters long.');
	}
	return $validation_error;
}
add_filter( 'woocommerce_process_registration_errors', 'localrule_process_registration_errors', 10, 4);

function localrule_account_menu_items($items, $endpoints)
{
	$items = [
		'orders' => __( 'My purchases & returns', 'woocommerce' ),
		'edit-account'    => __( 'Personal details', 'woocommerce' ),
		'newsletter'       => __( 'Newsletter', 'woocommerce' ),
		'help-contact'          => __( 'Help & contact', 'woocommerce' ),
		'privacy'       => __( 'Privacy policy', 'woocommerce' ),
		'customer-logout' => __( 'Log out', 'woocommerce' ),
	];
	return $items;
}
add_filter( 'woocommerce_account_menu_items', 'localrule_account_menu_items', 10, 2);

function localrule_get_address( $load_address = 'billing' )
{
	$current_user = wp_get_current_user();
	$load_address = sanitize_key( $load_address );
	$country      = get_user_meta( get_current_user_id(), $load_address . '_country', true );

	if ( ! $country ) {
		$country = WC()->countries->get_base_country();
	}

	if ( 'billing' === $load_address ) {
		$allowed_countries = WC()->countries->get_allowed_countries();

		if ( ! array_key_exists( $country, $allowed_countries ) ) {
			$country = current( array_keys( $allowed_countries ) );
		}
	}

	if ( 'shipping' === $load_address ) {
		$allowed_countries = WC()->countries->get_shipping_countries();

		if ( ! array_key_exists( $country, $allowed_countries ) ) {
			$country = current( array_keys( $allowed_countries ) );
		}
	}

	$address = WC()->countries->get_address_fields( $country, $load_address . '_' );

	foreach ( $address as $key => $field ) {

		$value = get_user_meta( get_current_user_id(), $key, true );

		if ( ! $value ) {
			switch ( $key ) {
				case 'billing_email':
				case 'shipping_email':
					$value = $current_user->user_email;
					break;
			}
		}

		$address[ $key ]['value'] = apply_filters( 'woocommerce_my_account_edit_address_field_value', $value, $key, $load_address );
	}
	return $address;
}

add_action( 'template_redirect', 'localrule_save_account_details' );
function localrule_save_account_details()
{
	$nonce_value = wc_get_var( $_REQUEST['localrule-save-account-details-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

	if ( ! wp_verify_nonce( $nonce_value, 'localrule_save_account_details' ) ) {
		return;
	}

	if ( empty( $_POST['action'] ) || 'localrule_save_account_details' !== $_POST['action'] ) {
		return;
	}

	wc_nocache_headers();

	$user_id = get_current_user_id();

	if ( $user_id <= 0 ) {
		return;
	}

	$customer = new WC_Customer( $user_id );

	if ( ! $customer ) {
		return;
	}

	$account_first_name   = ! empty( $_POST['account_first_name'] ) ? wc_clean( wp_unslash( $_POST['account_first_name'] ) ) : '';
	$account_last_name    = ! empty( $_POST['account_last_name'] ) ? wc_clean( wp_unslash( $_POST['account_last_name'] ) ) : '';
	$account_email        = ! empty( $_POST['account_email'] ) ? wc_clean( wp_unslash( $_POST['account_email'] ) ) : '';
	$pass_cur             = ! empty( $_POST['password_current'] ) ? $_POST['password_current'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	$pass1                = ! empty( $_POST['password_1'] ) ? $_POST['password_1'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	$pass2                = ! empty( $_POST['password_2'] ) ? $_POST['password_2'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	$save_pass            = true;

	// Current user data.
	$current_user       = get_user_by( 'id', $user_id );

	$current_first_name = $current_user->first_name;
	$current_last_name  = $current_user->last_name;
	$current_email      = $current_user->user_email;

	// New user data.
	$user               = new stdClass();
	$user->ID           = $user_id;
	$user->first_name   = $account_first_name;
	$user->last_name    = $account_last_name;

	$required_fields = array(
		'account_first_name'   => __( 'First name', 'woocommerce' ),
		'account_last_name'    => __( 'Last name', 'woocommerce' ),
		'account_email'        => __( 'Email address', 'woocommerce' ),
	);

	foreach ( $required_fields as $field_key => $field_name ) {
		if ( empty( $_POST[ $field_key ] ) ) {
			/* translators: %s: Field name. */
			wc_add_notice( sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . esc_html( $field_name ) . '</strong>' ), 'error', array( 'id' => $field_key ) );
		}
	}

	if ( $account_email ) {
		$account_email = sanitize_email( $account_email );
		if ( ! is_email( $account_email ) ) {
			wc_add_notice( __( 'Please provide a valid email address.', 'woocommerce' ), 'error' );
		} elseif ( email_exists( $account_email ) && $account_email !== $current_user->user_email ) {
			wc_add_notice( __( 'This email address is already registered.', 'woocommerce' ), 'error' );
		}
		$user->user_email = $account_email;
	}

	if ( ! empty( $pass_cur ) && empty( $pass1 ) && empty( $pass2 ) ) {
		wc_add_notice( __( 'Please fill out all password fields.', 'woocommerce' ), 'error' );
		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && empty( $pass_cur ) ) {
		wc_add_notice( __( 'Please enter your current password.', 'woocommerce' ), 'error' );
		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
		wc_add_notice( __( 'Please re-enter your password.', 'woocommerce' ), 'error' );
		$save_pass = false;
	} elseif ( ( ! empty( $pass1 ) || ! empty( $pass2 ) ) && $pass1 !== $pass2 ) {
		wc_add_notice( __( 'New passwords do not match.', 'woocommerce' ), 'error' );
		$save_pass = false;
	} elseif ( ! empty( $pass1 ) && ! wp_check_password( $pass_cur, $current_user->user_pass, $current_user->ID ) ) {
		wc_add_notice( __( 'Your current password is incorrect.', 'woocommerce' ), 'error' );
		$save_pass = false;
	}

	if ( $pass1 && $save_pass ) {
		$user->user_pass = $pass1;
	}

	$address_fields = [
		'billing' => [
			'billing_phone',
			'billing_country',
			'billing_address_1',
			'billing_postcode',
			'billing_city',
		]
	];

	if ( isset( $_POST['ship_to_different_address' ] ) ) {
		$address_fields['shipping'] = [
			'shipping_country',
			'shipping_first_name',
			'shipping_last_name',
			'shipping_address_1',
			'shipping_address_2',
			'shipping_city',
			'shipping_state',
			'shipping_postcode'
		];
	}

	foreach ($address_fields as $load_address => $fields_keys) {

		if ( ! isset( $_POST[ $load_address . '_country' ] ) ) {
			return;
		}

		$address = WC()->countries->get_address_fields( wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) ), $load_address . '_' );

		foreach ( $address as $key => $field ) {
			if (!in_array($key, $fields_keys)) {
				continue;
			}
			if ( ! isset( $field['type'] ) ) {
				$field['type'] = 'text';
			}

			// Get Value.
			if ( 'checkbox' === $field['type'] ) {
				$value = (int) isset( $_POST[ $key ] );
			} else {
				$value = isset( $_POST[ $key ] ) ? wc_clean( wp_unslash( $_POST[ $key ] ) ) : '';
			}

			// Hook to allow modification of value.
			$value = apply_filters( 'woocommerce_process_myaccount_field_' . $key, $value );

			// Validation: Required fields.
			if ( ! empty( $field['required'] ) && empty( $value ) ) {
				/* translators: %s: Field name. */
				wc_add_notice( sprintf( __( '%s is a required field.', 'woocommerce' ), $field['label'] ), 'error', array( 'id' => $key ) );
			}

			if ( ! empty( $value ) ) {
				// Validation and formatting rules.
				if ( ! empty( $field['validate'] ) && is_array( $field['validate'] ) ) {
					foreach ( $field['validate'] as $rule ) {
						switch ( $rule ) {
							case 'postcode':
								$country = wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) );
								$value   = wc_format_postcode( $value, $country );

								if ( '' !== $value && ! WC_Validation::is_postcode( $value, $country ) ) {
									switch ( $country ) {
										case 'IE':
											$postcode_validation_notice = __( 'Please enter a valid Eircode.', 'woocommerce' );
											break;
										default:
											$postcode_validation_notice = __( 'Please enter a valid postcode / ZIP.', 'woocommerce' );
									}
									wc_add_notice( $postcode_validation_notice, 'error' );
								}
								break;
							case 'phone':
								if ( '' !== $value && ! WC_Validation::is_phone( $value ) ) {
									/* translators: %s: Phone number. */
									wc_add_notice( sprintf( __( '%s is not a valid phone number.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
								}
								break;
							case 'email':
								$value = strtolower( $value );

								if ( ! is_email( $value ) ) {
									/* translators: %s: Email address. */
									wc_add_notice( sprintf( __( '%s is not a valid email address.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
								}
								break;
						}
					}
				}
			}

			try {
				// Set prop in customer object.
				if ( is_callable( array( $customer, "set_$key" ) ) ) {
					$customer->{"set_$key"}( $value );
				} else {
					$customer->update_meta_data( $key, $value );
				}
			} catch ( WC_Data_Exception $e ) {
				// Set notices. Ignore invalid billing email, since is already validated.
				if ( 'customer_invalid_billing_email' !== $e->getErrorCode() ) {
					wc_add_notice( $e->getMessage(), 'error' );
				}
			}
		}
	}

	// Allow plugins to return their own errors.
	$errors = new WP_Error();

	if ( $errors->get_error_messages() ) {
		foreach ( $errors->get_error_messages() as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	if ( wc_notice_count( 'error' ) === 0 ) {
		wp_update_user( $user );
		// Keep billing data in sync if data changed.
		if ( is_email( $user->user_email ) && $current_email !== $user->user_email ) {
			$customer->set_billing_email( $user->user_email );
		}

		if ( $current_first_name !== $user->first_name ) {
			$customer->set_billing_first_name( $user->first_name );
		}

		if ( $current_last_name !== $user->last_name ) {
			$customer->set_billing_last_name( $user->last_name );
		}

		$customer->save();

		wc_add_notice( __( 'Account details changed successfully.', 'woocommerce' ) );

		wp_safe_redirect( wc_get_endpoint_url( 'edit-account' ) );
		exit;
	}
}

function localrule_login_redirect($redirect, $user)
{
	return wc_get_page_permalink( 'shop' );
}
add_filter( 'woocommerce_login_redirect', 'localrule_login_redirect', 10, 2);
