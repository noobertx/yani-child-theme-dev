<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Invoice_Helper' ) ) {
	class _Yani_Invoice_Helper{
		private static $instance = null;		
		public function generate_invoice( $billingFor, $billionType, $packageID, $invoiceDate, $userID, $featured, $upgrade, $paypalTaxID, $paymentMethod, $is_package = 0 ) {

        $total_taxes = 0;
        $price_per_submission = _yani_theme()->get_option('price_listing_submission');
        $price_featured_submission = _yani_theme()->get_option('price_featured_listing_submission');

        $price_per_submission      = floatval( $price_per_submission );
        $price_featured_submission = floatval( $price_featured_submission );

        $args = array(
            'post_title'    => 'Invoice ',
            'post_status'   => 'publish',
            'post_type'     => 'yani_invoice'
        );
        $inserted_post_id =  wp_insert_post( $args );

        if( $billionType != 'one_time' ) {
            $billionType = __( 'Recurring', _yani_theme()->get_text_domain() );
        } else {
            $billionType = __( 'One Time', _yani_theme()->get_text_domain() );
        }

        if( $is_package == 0 ) {
            if( $upgrade == 1 ) {
                $total_price = $price_featured_submission;

            } else {
                if( $featured == 1 ) {
                    $total_price = $price_per_submission+$price_featured_submission;
                } else {
                    $total_price = $price_per_submission;
                }
            }
        } else {
            $pack_price = get_post_meta( $packageID, 'yani_package_price', true);
            $pack_tax = get_post_meta( $packageID, 'yani_package_tax', true );

            if( !empty($pack_tax) && !empty($pack_price) ) {
                $total_taxes = intval($pack_tax)/100 * $pack_price;
                $total_taxes = round($total_taxes, 2);
            }
            
            $total_price = $pack_price + $total_taxes;
        }
        
        $yani_meta = array();

        $yani_meta['invoice_billion_for'] = $billingFor;
        $yani_meta['invoice_billing_type'] = $billionType;
        $yani_meta['invoice_item_id'] = $packageID;
        $yani_meta['invoice_item_price'] = $total_price;
        $yani_meta['invoice_tax'] = $total_taxes;
        $yani_meta['invoice_purchase_date'] = $invoiceDate;
        $yani_meta['invoice_buyer_id'] = $userID;
        $yani_meta['paypal_txn_id'] = $paypalTaxID;
        $yani_meta['invoice_payment_method'] = $paymentMethod;

        update_post_meta( $inserted_post_id, 'YANI_invoice_buyer', $userID );
        update_post_meta( $inserted_post_id, 'YANI_invoice_type', $billionType );
        update_post_meta( $inserted_post_id, 'YANI_invoice_for', $billingFor );
        update_post_meta( $inserted_post_id, 'YANI_invoice_item_id', $packageID );
        update_post_meta( $inserted_post_id, 'YANI_invoice_price', $total_price );
        update_post_meta( $inserted_post_id, 'YANI_invoice_tax', $total_taxes );
        update_post_meta( $inserted_post_id, 'YANI_invoice_date', $invoiceDate );
        update_post_meta( $inserted_post_id, 'YANI_paypal_txn_id', $paypalTaxID );
        update_post_meta( $inserted_post_id, 'YANI_invoice_payment_method', $paymentMethod );

        update_post_meta( $inserted_post_id, '_yani_invoice_meta', $yani_meta );

        // Update post title
        $update_post = array(
            'ID'         => $inserted_post_id,
            'post_title' => 'Invoice '.$inserted_post_id,
        );
        wp_update_post( $update_post );
        return $inserted_post_id;
    }

    public function get_billing_period($biling_period) {

            if ($biling_period == 'Day') {
                return esc_html__('day', $this->get_text_domain());
            } else if ($biling_period == 'Days') {
                return esc_html__('days', $this->get_text_domain());
            } else if ($biling_period == 'Week') {
                return esc_html__('week', $this->get_text_domain());
            } else if ($biling_period == 'Weeks') {
                return esc_html__('weeks', $this->get_text_domain());
            } else if ($biling_period == 'Month') {
                return esc_html__('month', $this->get_text_domain());
            } else if ($biling_period == 'Months') {
                return esc_html__('months', $this->get_text_domain());
            } else if ($biling_period == 'Year') {
                return esc_html__('year', $this->get_text_domain());
            } else if ($biling_period == 'Years') {
                return esc_html__('years', $this->get_text_domain());
            }
        }

    public  function get_invoice_meta( $post_id, $field = false ) {

        $defaults = array(
            'invoice_billion_for' => '',
            'invoice_billing_type' => '',
            'invoice_item_id' => '',
            'invoice_item_price' => '',
            'invoice_tax' => '',
            'invoice_payment_method' => '',
            'invoice_purchase_date' => '',
            'invoice_buyer_id' => ''
        );

        $meta = get_post_meta( $post_id, '_yani_invoice_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }

    public function get_invoice_price ( $invoice_price ) {

        $invoice_price = doubleval( $invoice_price );

        //if( $invoice_price ) {

            if ( class_exists( 'FCC_Rates' ) && _yani_theme()->check_theme_option("currency_switcher_enable",true,true) && isset( $_COOKIE[ "yani_set_current_currency" ] ) ) {

                $listing_price = apply_filters( 'yani_currency_switcher_filter', $invoice_price );
                return $listing_price;
            }

            $multi_currency = _yani_theme()->get_option('multi_currency');

            if($multi_currency == 1) {
                $default_currency = _yani_theme()->get_option('default_multi_currency');
                if(empty($default_currency)) {
                    $default_currency = 'USD';
                }
                $currency = yani_Currencies::get_currency_by_code($default_currency);
                $invoice_currency = $currency['currency_symbol'];
                $price_decimals  = $currency['currency_decimal'];
                $invoice_currency_pos  = $currency['currency_position'];
                $thousands_separator  = $currency['currency_thousand_separator'];
                $decimal_point_separator  = $currency['currency_decimal_separator'];

            } else {

                $invoice_currency = _yani_price()->get_currency();
                $price_decimals = 2;
                $invoice_currency_pos = _yani_theme()->get_option( 'currency_position', '$' );
                $thousands_separator = _yani_theme()->get_option( 'thousands_separator', ',' );
                $decimal_point_separator = _yani_theme()->get_option( 'decimal_point_separator', '.' );
            }

            //number_format() — Format a number with grouped thousands
            $final_price = number_format ( $invoice_price , $price_decimals , $decimal_point_separator , $thousands_separator );

            if(  $invoice_currency_pos == 'before' ) {
                return $invoice_currency . $final_price;
            } else {
                return $final_price . $invoice_currency;
            }

        /*} else {
            $invoice_currency = $invoice_price;
        }*/

        return $invoice_currency;
    }

		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

function _yani_invoice() {
	return _Yani_Invoice_Helper::get_instance();
}