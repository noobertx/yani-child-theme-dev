<?php
class yani_Price{
	private static $instance = null;	

	public function property_price_admin () {
        global $post;
        $sale_price     = get_post_meta( get_the_ID(), 'yani_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'yani_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'yani_property_price_postfix', true );
        $price_separator = _yani_theme()->get_option('currency_separator');

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<b>'.$sale_price. '</b>';
            echo $output;
            return;
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = $price_separator . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {
                echo '<b>' . $this->get_property_price($sale_price) . '</b><br/>';

                if (!empty( $second_price )) {
                    echo $this->get_property_price($second_price) . $price_postfix;
                }
            } else {
                if (!empty( $sale_price )) {
                    echo '<b>';
                    echo $this->get_property_price($sale_price) . $price_postfix;
                    echo '</b>';
                }
            }

        }
    }

    public function get_property_price ( $listing_price ) {

    
        if( $listing_price ) {
            $listing_price = $this->get_clean_price_20($listing_price);
            
            $currency_maker = $this->currency_maker();

            $listings_currency = $currency_maker['currency'];
            $price_decimals = $currency_maker['decimals'];
            $listing_currency_pos = $currency_maker['currency_position'];
            $price_thousands_separator = $currency_maker['thousands_separator'];
            $price_decimal_point_separator = $currency_maker['decimal_point_separator'];
        
            $short_prices = _yani_theme()->get_option('short_prices');

            if($short_prices != 1 ) {

                $listing_price = doubleval( $listing_price );
                if ( class_exists( 'FCC_Rates' ) && _yani_theme()->check_theme_option("currency_switcher_enable",0,true) && isset( $_COOKIE[ "yani_set_current_currency" ] ) ) {

                    $listing_price = apply_filters( 'yani_currency_switcher_filter', $listing_price );
                    return $listing_price;
                }
                
                $indian_format = _yani_theme()->get_option('indian_format');
                if($indian_format == 1) {
                    $final_price = yani_moneyFormatIndia ($listing_price);
                } else {
                    //number_format() — Format a number with grouped thousands
                    $final_price = number_format ( $listing_price , $price_decimals , $price_decimal_point_separator , $price_thousands_separator );
                }


            } else {
                $final_price = yani_number_shorten($listing_price, $price_decimals);
            }
            if(  $listing_currency_pos == 'before' ) {
                return $listings_currency . $final_price;
            } else {
                return $final_price . $listings_currency;
            }

        } else {
            $listings_currency = '';
        }

        return $listings_currency;
    }

    public function currency_maker() {

        $price_maker_array = array();
        $multi_currency = _yani_theme()->get_option('multi_currency');
        $default_currency = _yani_theme()->get_option('default_multi_currency');
        if(empty($default_currency)) {
            $default_currency = 'USD';
        }

        
        $price_maker_array['currency'] = $this->get_currency();
        $price_maker_array['decimals']  = intval(_yani_theme()->get_option( 'decimals' ));
        $price_maker_array['currency_position']  = _yani_theme()->get_option( 'currency_position' );
        $price_maker_array['thousands_separator']  = _yani_theme()->get_option( 'thousands_separator' );
        $price_maker_array['decimal_point_separator']  = _yani_theme()->get_option( 'decimal_point_separator' );

        return $price_maker_array;
    }

    public function get_currency(){
        //get default currency from theme options
        $yani_default_currency = _yani_theme()->get_option( 'currency_symbol' );
        if(empty($yani_default_currency)){
            return esc_html__( '$' , 'houzez' );
        }
        return $yani_default_currency;
    }
    public function get_clean_price_20($string) {
       $string = preg_replace('/&#36;/', '', $string);
       $string = str_replace(' ', '', $string); 
       $string = preg_replace('/[,]/', '', $string);

       return  $string;
    }

    public function get_plain_price($amount) {

        if ( empty( $amount ) || is_nan( $amount ) ) {
            return '';
        }

        if ( isset( $_COOKIE['yani_set_current_currency'] ) ) {
            $formatted_converted_price = $this->get_switch_currency_plain( $amount );
            return apply_filters( 'yani_currency_converted_price', $formatted_converted_price, $amount );
        } else {
            return $amount;
        }

    }

    public function get_switch_currency_plain($amount) {

        $base_currency = $this->get_base_currency();
        $current_currency = $this->get_current_currency();
        $converted_price = $this->Fcc_convert_currency( $amount, $base_currency, $current_currency );

        return apply_filters( 'yani_switch_currency', $converted_price );

    }


    public function get_base_currency() {

        $default_currency = _yani_theme()->get_option('yani_base_currency');
        if ( !empty( $default_currency ) ) {
            return $default_currency;
        } else {
            $default_currency = 'USD';
        }

        return $default_currency;
    }

    public function get_current_currency() {

        if ( isset( $_COOKIE['yani_set_current_currency'] ) && Fcc_currency_exists( $_COOKIE['yani_set_current_currency'] ) ) { 
            $current_currency = $_COOKIE['yani_set_current_currency']; // phpcs:ignore
        } else {
            $current_currency = $this->get_base_currency();
        }

        return strtoupper( $current_currency );
    }

    public function Fcc_convert_currency( $amount = 1, $from = 'USD', $in = 'EUR' ) {

    $rates = FCC_Rates::get_rates();

    $error = $result = '';
    if ( $rates && is_array( $rates ) && count( $rates ) > 100 ) {

        if ( ! Fcc_currency_exists( $from ) OR ! Fcc_currency_exists( $in ) ) {
            trigger_error(
                esc_html__( 'Currency was not exist or found in database.', 'favethemes-currency-converter' ),
                E_USER_WARNING
            );
            $error = true;
        }

        if ( ! is_numeric( $amount ) ) {
            trigger_error(
                esc_html__( 'Amount to covert is not number, it must be number.', 'favethemes-currency-converter' ),
                E_USER_WARNING
            );
            $error = true;
        }

        if ( ! $error === true ) {
            $from   = strtoupper( $from );
            $in     = strtoupper( $in );
            $result = $rates[ $from ] && $rates[ $in ] ? (float) $amount * (float) $rates[ $in ] / (float) $rates[ $from ] : floatval( $amount );
        }

    } else {

        trigger_error(
            __( 'Look like your API is not valid, There was a problem to get currency data from database.', 'favethemes-currency-converter' ),
            E_USER_WARNING
        );

    }

    return $result;
}
     public function get_list_of_supports() {

            $currencies_array = array();
            $get_currencies_list = _yani_theme()->get_option('yani_supported_currencies');
            if ( ! empty( $get_currencies_list ) ) {
                $currencies_array = explode( ',', $get_currencies_list );
            } else {
                $currencies_array = array(
                    'AUD','CAD','CHF','EUR','GBP','HKD','JPY','NOK','SEK','USD','NGN'
                );
            }

            return $currencies_array;
        }

        public function get_wpc_current_currency() {
            if ( isset( $_COOKIE[ "yani_set_current_currency" ] ) ) {
                $get_current_currency = $_COOKIE[ "yani_set_current_currency" ];
                if ( Fcc_currency_exists( $get_current_currency ) ) {
                    $current_currency = $get_current_currency;
                } else {
                    $current_currency = $this->default_currency_for_switcher();
                }
            } else {
                $current_currency = $this->default_currency_for_switcher();
            }

            return $current_currency;
        }

        public function default_currency_for_switcher() {
            $default_currency = _yani_theme()->get_option('yani_base_currency');
            if ( !empty( $default_currency ) ) {
                return $default_currency;
            } else {
                $default_currency = 'USD';
            }

            return $default_currency;
        }


	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}

function _yani_price() {
	return yani_Price::get_instance();
}