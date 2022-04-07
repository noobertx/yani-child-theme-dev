<?php

function _themename_assets(){
	wp_enqueue_style( 'yani-theme', get_template_directory_uri().'/style.css' );
	

    include (get_template_directory()."/libs/inline-css.php");
    wp_add_inline_style("yani-theme",$inline_style);

	// wp_enqueue_style("yani-stylesheet",get_template_directory_uri()."/dist/assets/css/bundle.css",array('bootstrap'),microtime(),"all");
	
	if(is_singular() && comments_open() && get_option('thread_comments')){		
		wp_enqueue_script("comment-reply");
	}

	$css_minify_prefix = "";


	wp_enqueue_style('bootstrap', YANI_THEME_VENDORS . 'bootstrap.min.css', array(), '5.5.0');
    wp_enqueue_style('bootstrap-select', YANI_THEME_VENDORS . 'bootstrap-select.min.css', array(), '1.13.18');
    wp_enqueue_style('font-awesome-5-all', YANI_THEME_VENDORS . 'font-awesome/css/all.min.css', array(), '5.14.0', 'all');
    // wp_enqueue_style('yani-icons', YANI_THEME_VENDORS . 'icons'.$css_minify_prefix.'.css', array(), YANI_THEME_VERSION);

   wp_enqueue_script('bootstrap', YANI_THEME_VENDORS. 'bootstrap.min.js', array(), microtime(), true);

    if ( is_singular('property') ) {
        // wp_enqueue_style('lightslider', YANI_THEME_VENDORS . 'lightslider.css', array(), '1.1.3');
    }

    // wp_enqueue_style('slick-min', YANI_THEME_VENDORS . 'slick-min.css', array(), YANI_THEME_VERSION);
    // wp_enqueue_style('slick-theme-min', YANI_THEME_VENDORS . 'slick-theme-min.css', array(), YANI_THEME_VERSION);

    // wp_enqueue_style('jquery-ui', YANI_THEME_VENDORS . 'jquery-ui.min.css', array(), '1.12.1');
    // wp_enqueue_style('radio-checkbox', YANI_THEME_VENDORS . 'radio-checkbox-min.css', array(), YANI_THEME_VERSION);

    // wp_enqueue_style('bootstrap-datepicker', YANI_THEME_VENDORS . 'bootstrap-datepicker.min.css', array(), '1.8.0');
    // wp_enqueue_style('theme-main', YANI_THEME_STYLING . 'theme.css', array(), microtime());
    // wp_enqueue_style('houzez-styling-options', YANI_THEME_VENDORS . 'styling-options'.$css_minify_prefix.'.css', array(), microtime());


    //should enqueued on selected page
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_enqueue_script('bootstrap-datepicker', YANI_THEME_VENDORS. 'bootstrap-datepicker.min.js', array('jquery'), '1.9.0', true);
    wp_enqueue_style('OverlayScrollbars', YANI_THEME_VENDORS . 'OverlayScrollbars.min.css', array(), microtime());
    wp_enqueue_script('overlayScrollbars', YANI_THEME_VENDORS. 'jquery.overlayScrollbars.min.js', array('jquery'), microtime(), true);

    

    wp_enqueue_script('bootstrap-select', YANI_THEME_VENDORS. 'bootstrap-select.min.js', array('jquery'), '1.13.18', true);
    wp_enqueue_script('custom-2022', YANI_THEME_VENDORS. 'custom-2022.js', array('jquery'), microtime(), true);
    wp_enqueue_script('modernizr', YANI_THEME_VENDORS. 'modernizr.custom.js', array('jquery'), '3.2.0', true);

    wp_enqueue_script('parallax-background', YANI_THEME_VENDORS. 'parallax-background.min.js', array('jquery'), '1.2', true);
    wp_enqueue_script('slideout', YANI_THEME_VENDORS. 'slideout.min.js', array('jquery'), YANI_THEME_VERSION, true);
    wp_enqueue_script('lightbox', YANI_THEME_VENDORS. 'lightbox.min.js', array('jquery'), YANI_THEME_VERSION, true);
    wp_enqueue_script('theia-sticky-sidebar', YANI_THEME_VENDORS. 'theia-sticky-sidebar.min.js', array('jquery'), YANI_THEME_VERSION, true);

    wp_register_script('chart', YANI_THEME_VENDORS. 'Chart.min.js', array('jquery'), '2.8.0', true);
    wp_enqueue_script('chart');

    wp_enqueue_script('slick', YANI_THEME_VENDORS. 'slick.min.js', array('jquery'), YANI_THEME_VERSION, true);


    if(!wp_script_is('plupload')) {
        wp_enqueue_script('plupload');
    }

	// wp_enqueue_script("yani-script",get_template_directory_uri()."/dist/assets/js/bundle.js",array('jquery', 'plupload','jquery-ui-sortable'),microtime(),true);

	// wp_localize_script('yani-script', 'searchData', array(
 //      'root_url' => get_site_url(),
 //      'nonce' => wp_create_nonce('wp_rest')
 //    ));
    $userID = get_current_user_id();

    $yani_rtl = "no";

    $agent_form_redirect = _yani_theme()->get_option('agent_form_redirect', '');

    if( !empty($agent_form_redirect) ) {
        $agent_form_redirect = get_permalink($agent_form_redirect);
    }


    wp_enqueue_script('bootbox-min', YANI_THEME_VENDORS . 'bootbox.min.js', array('jquery'), '4.4.0', true);

    $search_min_price = _yani_theme()->get_option('advanced_search_widget_min_price', 0);
    $search_min_price_range_for_rent = _yani_theme()->get_option('advanced_search_min_price_range_for_rent', 0);
    $search_max_price = _yani_theme()->get_option('advanced_search_widget_max_price', 2500000);
    $search_max_price_range_for_rent = _yani_theme()->get_option('advanced_search_max_price_range_for_rent', 12000);
    $search_min_price = _yani_price()->get_plain_price($search_min_price);
    $search_max_price = _yani_price()->get_plain_price($search_max_price);
    $search_min_price_range_for_rent = _yani_price()->get_plain_price($search_min_price_range_for_rent);
    $search_max_price_range_for_rent = _yani_price()->get_plain_price($search_max_price_range_for_rent);

    $currency_position   = _yani_theme()->get_option('currency_position', 'before');
    $currency_symbol     = _yani_theme()->get_option('currency_symbol', '$');
    $thousands_separator = _yani_theme()->get_option('thousands_separator', ',');

    $yani_logged_in = 'yes';
    if (!is_user_logged_in()) {
        $yani_logged_in = 'no';
    }

     if ( is_page_template('template/user_dashboard_submit.php') ) {
                wp_enqueue_script('validate', YANI_THEME_VENDORS . 'jquery.validate.min.js', array('jquery'), '1.19.0', true);
            }

   
        $max_prop_images = 50;
   
  //   wp_localize_script('yani-script', 'yani_vars',
  //           array(
  //               'admin_url' => get_admin_url(),
  //               'ajaxurl' => admin_url( 'admin-ajax.php' ),
  //               'yani_rtl' => $yani_rtl,
  //               'userID' => $userID,
  //               // 'redirect_type' => $after_login_redirect,
  //               // 'login_redirect' => $login_redirect,
  //               'wp_is_mobile' => wp_is_mobile(),
  //               'default_lat' => _yani_theme()->get_option('map_default_lat', 25.686540),
  //               'default_long' => _yani_theme()->get_option('map_default_long', -80.431345),
  //               'yani_is_splash' => _yani_template()->is_splash(),
  //               'prop_detail_nav' => _yani_theme()->get_option('prop-detail-nav', 'no'),
  //               'is_singular_property' => is_singular('property'),
  //               'search_position' => _yani_search()->get_header_search_position(),
  //               'login_loading' => esc_html__('Sending user info, please wait...', _yani_theme()->get_text_domain()),
  //               'not_found' => esc_html__("We didn't find any results", _yani_theme()->get_text_domain()),
  //               'yani_map_system' => _yani_map()->get_map_system(),
  //               'for_rent' => _yani_terms()->get_term_slug(_yani_theme()->get_option('search_rent_status'), 'property_status'),
  //               'for_rent_price_slider' => _yani_terms()->get_term_slug(_yani_theme()->get_option('search_rent_status_for_price_range'), 'property_status'),
  //               'search_min_price_range' => $search_min_price,
  //               'search_max_price_range' => $search_max_price,
  //               'search_min_price_range_for_rent' => $search_min_price_range_for_rent,
  //               'search_max_price_range_for_rent' => $search_max_price_range_for_rent,
  //               'get_min_price' => isset($_GET['min-price']) ? $_GET['min-price'] : 0,
  //               'get_max_price' => isset($_GET['max-price']) ? $_GET['max-price'] : 0,
  //               'currency_position' => $currency_position,
  //               'currency_symbol' => $currency_symbol,
  //               'decimals' => _yani_theme()->get_option('decimals', '2'),
  //               'decimal_point_separator' => _yani_theme()->get_option('decimal_point_separator', '.'),
  //               'thousands_separator' => $thousands_separator,
  //               'is_halfmap' => _yani_template()->is_half_map(),
  //               // 'yani_date_language' => $yani_date_language,
  //               // 'yani_default_radius' => $yani_default_radius,
  //               'yani_reCaptcha' => _yani_form()->show_google_reCaptcha(),
  //               // 'geo_country_limit' => $geo_country_limit,
  //               // 'geocomplete_country' => $geocomplete_country,
  //               // 'is_edit_property' => yani_edit_property(),
  //               'yani_upload_nonce' => wp_create_nonce('yani_upload_nonce'),
  //               'processing_text' => esc_html__('Processing, Please wait...', _yani_theme()->get_text_domain()),
  //               'halfmap_layout' => _yani_template()->render_half_map_layout(),
  //               'prev_text' => esc_html__('Prev', _yani_theme()->get_text_domain()),
  //               'next_text' => esc_html__('Next', _yani_theme()->get_text_domain()),
  //               'keyword_search_field' => _yani_theme()->get_option('keyword_field'),
  //               'keyword_autocomplete' => _yani_theme()->get_option('keyword_autocomplete', 1),
  //               'autosearch_text' => esc_html__('Searching...', _yani_theme()->get_text_domain()),
  //               'paypal_connecting' => esc_html__('Connecting to paypal, Please wait... ', _yani_theme()->get_text_domain()),
  //               'transparent_logo' => _yani_template()->is_transparent_logo(),
  //               'is_transparent' => false,
  //               'is_top_header' => _yani_theme()->get_option('top_bar', 0),
  //               'simple_logo' => _yani_theme()->get_option('custom_logo', '', 'url'),
  //               'retina_logo' => _yani_theme()->get_option('retina_logo', '', 'url'),
  //               'mobile_logo' => _yani_theme()->get_option('mobile_logo', '', 'url'),
  //               'retina_logo_mobile' => _yani_theme()->get_option('mobile_retina_logo', '', 'url'),
  //               'retina_logo_mobile_splash' => _yani_theme()->get_option('retina_logo_mobile_splash', '', 'url'),
  //               'custom_logo_splash' => _yani_theme()->get_option('custom_logo_splash', '', 'url'),
  //               'retina_logo_splash' => _yani_theme()->get_option('retina_logo_splash', '', 'url'),
  //               'monthly_payment' => esc_html__('Monthly Payment', _yani_theme()->get_text_domain()),
  //               'weekly_payment' => esc_html__('Weekly Payment', _yani_theme()->get_text_domain()),
  //               'bi_weekly_payment' => esc_html__('Bi-Weekly Payment', _yani_theme()->get_text_domain()),
  //               'compare_url' => _yani_template()->get_template_link('template/template-compare.php'),
  //               'template_thankyou' => _yani_template()->get_template_link('template/template-thankyou.php'),
  //               'compare_page_not_found' => esc_html__('Please create page using compare properties template', _yani_theme()->get_text_domain()),
  //               'compare_limit' => esc_html__('Maximum item compare are 4', _yani_theme()->get_text_domain()),
  //               'compare_add_icon' => '',
  //               'compare_remove_icon' => '',
  //               'add_compare_text' => _yani_theme()->get_option('cl_add_compare', 'Add to Compare'),
  //               'remove_compare_text' => _yani_theme()->get_option('cl_remove_compare', 'Remove from Compare'),
  //               'is_mapbox' => _yani_theme()->get_option('yani_map_system'),
  //               'api_mapbox' => _yani_theme()->get_option('mapbox_api_key'),
  //               'is_marker_cluster' => _yani_theme()->get_option('map_cluster_enable'),
  //               'g_recaptha_version' => _yani_theme()->get_option( 'recaptha_type', 'v2' ),
  //               's_country' => isset($_GET['country']) ? $_GET['country'] : '',
  //               's_state' => isset($_GET['states']) ? $_GET['states'] : '',
  //               's_city' => isset($_GET['location']) ? $_GET['location'] : '',
  //               's_areas' => isset($_GET['areas']) ? $_GET['areas'] : '',
  //               // 'woo_checkout_url' => esc_url($woo_checkout_url),
  //               'agent_redirection' => $agent_form_redirect,
  //               'verify_nonce' => wp_create_nonce('verify_gallery_nonce'),
  //               'verify_file_type' => esc_html__('Valid file formats', _yani_theme()->get_text_domain()),
  //               'yani_logged_in' => $yani_logged_in,
  //               'msg_digits' => esc_html__('Please enter only digits', _yani_theme()->get_text_domain()),
  //               'max_prop_images' => $max_prop_images,
  //               'image_max_file_size' => _yani_theme()->get_option('image_max_file_size'),
  //               'max_prop_attachments' => _yani_theme()->get_option('max_prop_attachments', '3'),
  //               'attachment_max_file_size' => _yani_theme()->get_option('attachment_max_file_size', '12000kb'),
  //               'plan_title_text' => _yani_theme()->get_option('cl_plan_title', 'Plan Title' ),
  //               'plan_size_text' => _yani_theme()->get_option('cl_plan_size', 'Plan Size' ),
  //               'plan_bedrooms_text' => _yani_theme()->get_option('cl_plan_bedrooms', 'Bedrooms' ),
  //               'plan_bathrooms_text' => _yani_theme()->get_option('cl_plan_bathrooms', 'Bathrooms' ),
  //               'plan_price_text' => _yani_theme()->get_option('cl_plan_price', 'Price' ),
  //               'plan_price_postfix_text' => _yani_theme()->get_option('cl_plan_price_postfix', 'Price Postfix' ),
  //               'plan_image_text' => _yani_theme()->get_option('cl_plan_img', 'Plan Image' ),
  //               'plan_description_text' => _yani_theme()->get_option('cl_plan_des', 'Description'),
  //               'plan_upload_text' => _yani_theme()->get_option('cl_plan_img_btn', 'Select Image'),
  //               'plan_upload_size' => _yani_theme()->get_option('cl_plan_img_size', 'Minimum size 800 x 600 px'),

  //               'mu_title_text' => _yani_theme()->get_option('cl_subl_title', 'Title' ),
  //               'mu_type_text' => _yani_theme()->get_option('cl_subl_type', 'Property Type' ),
  //               'mu_beds_text' => _yani_theme()->get_option('cl_subl_bedrooms', 'Bedrooms' ),
  //               'mu_baths_text' => _yani_theme()->get_option('cl_subl_bathrooms', 'Bathrooms' ),
  //               'mu_size_text' => _yani_theme()->get_option('cl_subl_size', 'Property Size' ),
  //               'mu_size_postfix_text' => _yani_theme()->get_option('cl_subl_size_postfix', 'Size Postfix' ),
  //               'mu_price_text' => _yani_theme()->get_option('cl_subl_price', 'Price' ),
  //               'mu_price_postfix_text' => _yani_theme()->get_option('cl_subl_price_postfix', 'Price Postfix' ),
  //               'mu_availability_text' => _yani_theme()->get_option('cl_subl_date', 'Availability Date' ),

  //               'are_you_sure_text' => esc_html__('Are you sure you want to do this?', _yani_theme()->get_text_domain()),
  //               'delete_btn_text' => esc_html__('Delete', _yani_theme()->get_text_domain()),
  //               'cancel_btn_text' => esc_html__('Cancel', _yani_theme()->get_text_domain()),
  //               'confirm_btn_text' => esc_html__('Confirm', _yani_theme()->get_text_domain()),
  //               'processing_text' => esc_html__('Processing, Please wait...', _yani_theme()->get_text_domain()),
  //               'add_listing_msg' => esc_html__('Submitting, Please wait...', _yani_theme()->get_text_domain()),
  //               'confirm_featured' => esc_html__('Are you sure you want to make this a listing featured?', _yani_theme()->get_text_domain()),
  //               'confirm_featured_remove' => esc_html__('Are you sure you want to remove this listing from featured?', _yani_theme()->get_text_domain()),
  //               'confirm_relist' => esc_html__('Are you sure you want to relist this property?', _yani_theme()->get_text_domain()),
  //               'delete_confirmation' => esc_html__('Are you sure you want to delete?', _yani_theme()->get_text_domain()),
  //               'featured_listings_none' => esc_html__('You have used all the "Featured" listings in your package.', _yani_theme()->get_text_domain()),
  //               'prop_sent_for_approval' => esc_html__('Sent for Approval', _yani_theme()->get_text_domain()),
  //               'is_edit_property' => _yani_post()->can_be_editted(),
  //               'is_mapbox' => _yani_theme()->get_option('yani_map_system'),
  //               'api_mapbox' => _yani_theme()->get_option('mapbox_api_key'),
  //               'enable_title_limit' => _yani_theme()->get_option('enable_title_limit', 0),
  //               'property_title_limit' => _yani_theme()->get_option('property_title_limit'),
  //           )
		// );

} 
 
add_action("wp_enqueue_scripts","_themename_assets");
// exclude main and child stylesheets from delivery optimization
function exclude_from_delivery_optimization($handle){
    return in_array($handle, array(
    'bootstrap',
    'bootstrap-select',
    'font-awesome-5-all',
    'yani-icons',
    'lightslider',
    'slick-min',
    'slick-theme-min',
    'jquery-ui',
    'radio-checkbox',
    'bootstrap-datepicker',
    'houzez-main',
    'houzez-styling-options',
    'yani-stylesheet'
    ));
}
// add_filter('speed-up-optimize-css-delivery', 'exclude_from_delivery_optimization');



function mind_defer_scripts( $tag, $handle, $src ) {
  $defer = array( 
    'bootstrap',
    'bootstrap-select',
    'modernizr',
    'slideout',
    'lightbox',
    'theia-sticky-sidebar',
    'slick',
    'yani-script'
  );
  if ( in_array( $handle, $defer ) ) {
     return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
  }
    
    return $tag;
} 
// add_filter( 'script_loader_tag', 'mind_defer_scripts', 10, 3 );





function _themename_admin_assets(){
	wp_enqueue_style("_themename-admin-stylesheet",get_template_directory_uri()."/dist/assets/css/admin.css",array(),microtime(),"all");
    wp_enqueue_style("_themename-admin-stylesheet",get_template_directory_uri()."/dist/assets/css/admin.css",array(),microtime(),"all");
}



add_action("admin_enqueue_scripts","_themename_admin_assets");

function _themename_customize_preview_js(){
    wp_enqueue_script("_themename-customize-preview",YANI_THEME_VENDORS."customize-preview.js",array('customize-preview','jquery'),microtime(),true);    


    // include (get_template_directory()."/libs/inline-css.php");

    // wp_localize_script('_themename-customize-preview','_themename_inline',array(
    //     'footer_link_color' => $footer_link_color
    // ));
}
add_action("customize_preview_init","_themename_customize_preview_js");


function _themename_editor_scripts(){
     // Enqueue block editor JS
    wp_enqueue_script(
        '_themename-editor',
        YANI_THEME_VENDORS."editor-style.js",
        [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
        '1.0',
        true
    );

    // Enqueue block editor styles
    wp_enqueue_style(
        '_themename-editor',
        YANI_THEME_VENDORS."editor-style.css",
        [ 'wp-edit-blocks' ],
        '1.0' 
    );

}
add_action( 'enqueue_block_editor_assets', '_themename_editor_scripts' );


?>