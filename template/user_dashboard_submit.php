<?php
/**
 * Template Name: User Dashboard Create Listing
 */

global $yani_local, $current_user, $properties_page, $hide_prop_fields, $is_multi_steps;

wp_get_current_user();
$userID = $current_user->ID;


if( is_user_logged_in() && !_yani_role()->check_role() ) {
    wp_redirect(  home_url() );
}
$user_email = $current_user->user_email;
$admin_email =  get_bloginfo('admin_email');
$panel_class = '';
$invalid_nonce = false;
$submitted_successfully = false;
$updated_successfully = false;

$hide_prop_fields = _yani_theme()->get_option('hide_add_prop_fields');

$dashboard_listings = _yani_template()->get_template_link('template/user_dashboard_properties.php');
$enable_paid_submission = _yani_theme()->get_option('enable_paid_submission');
$payment_page_link = _yani_template()->get_template_link('template/template-payment.php');
$thankyou_page_link = _yani_template()->get_template_link('template/template-thankyou.php');
$select_packages_link = _yani_template()->get_template_link('template/template-packages.php');
$submit_property_link = _yani_template()->get_template_link('template/user_dashboard_submit.php');

$create_listing_login_required = _yani_template()->get_template_link('create_listing_button');
$sticky_sidebar = _yani_theme()->get_option('sticky_sidebar');
$allowed_html = array();
$submit_form_type = _yani_theme()->get_option('submit_form_type');

if( $submit_form_type == 'one_step' ) {
    $submit_form_main_class = 'yani-one-step-form';
    $is_multi_steps = 'active';
} else {
    $submit_form_main_class = 'yani-m-step-form';
    $is_multi_steps = 'form-step';
}


if( isset( $_POST['action'] ) ) {

    $submission_action = $_POST['action'];

    $new_property = array(
        'post_type'	=> 'property'
    );

    if( $enable_paid_submission == 'per_listing' ) {

        if ( !is_user_logged_in() ) { 
            $email = wp_kses( $_POST['user_email'], $allowed_html );
            if( email_exists( $email ) ) {
                $errors[] = $yani_local['email_already_registerd'];
            }

            if( !is_email( $email ) ) {
                $errors[] = $yani_local['invalid_email'];
            }

            if( empty($errors) ) {
                $username = explode("@", $email);

                if( username_exists( $username[0] ) ) {
                    $username = $username[0].rand(5, 999);
                } else {
                    $username = $username[0];
                }

                $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                $user_id = wp_create_user( $username, $random_password, $email );

                if( !is_wp_error( $user_id ) ) {
                    $user = get_user_by( 'id', $user_id );

                    _yani_user()->update_profile( $user_id );
                    _yani_user()->new_user_notification( $user_id, $random_password );
                    $user_as_agent = yani_option('user_as_agent');
                    if( $user_as_agent == 'yes' ) {
                        _yani_login_register()->register_as_agent ( $username, $email, $user_id );
                    }

                    if( !is_wp_error($user) ) {
                        wp_clear_auth_cookie();
                        wp_set_current_user( $user->ID, $user->user_login );
                        wp_set_auth_cookie( $user->ID );
                        do_action( 'wp_login', $user->user_login );

                        $property_id = apply_filters( 'yani_submit_listing', $new_property );


                        if( _yani_theme()->is_woocommerce() ) {
                            if( ( $submission_action != 'update_property' ) || ( isset($_POST['yani_draft']) && $_POST['yani_draft'] == 'draft') ) {

                                do_action('yani_per_listing_woo_payment', $property_id);

                            } else {
                                if (!empty($submit_property_link)) {
                                    $submit_property_link = add_query_arg( 'edit_property', $property_id, $submit_property_link );
                                    $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                    $parameter = 'updated=1';
                                    wp_redirect($submit_property_link . $separator . $parameter);
                                }
                            }

                        } else {
                            if (!empty($payment_page_link)) {
                                $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                $parameter = 'prop-id=' . $property_id;
                                wp_redirect($payment_page_link . $separator . $parameter);

                            } elseif( !empty($payment_page_link) && isset($_POST['yani_draft']) ) {
                                $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                $parameter = 'prop-id=' . $property_id;
                                wp_redirect($payment_page_link . $separator . $parameter);

                            } else {
                                if (!empty($dashboard_listings)) {
                                    $separator = (parse_url($dashboard_listings, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                    $parameter = ($updated_successfully) ? '' : '';
                                    wp_redirect($dashboard_listings . $separator . $parameter);
                                }
                            }
                        }
                        exit();
                    }

                }

            }

        } else {
            $property_id = apply_filters('yani_submit_listing', $new_property);

            if( _yani_theme()->is_woocommerce() ) {
                if( ( $submission_action != 'update_property' ) || ( isset($_POST['yani_draft']) && $_POST['yani_draft'] == 'draft') ) {

                    do_action('yani_per_listing_woo_payment', $property_id);

                } else {
                    if (!empty($submit_property_link)) {
                        $submit_property_link = add_query_arg( 'edit_property', $property_id, $submit_property_link );
                        $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                        $parameter = 'updated=1';
                        wp_redirect($submit_property_link . $separator . $parameter);
                    }
                }

            } else {

                if (!empty($payment_page_link) && $submission_action != 'update_property' ) {
                    $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                    $parameter = 'prop-id=' . $property_id;
                    wp_redirect($payment_page_link . $separator . $parameter);

                } elseif( !empty($payment_page_link) && isset($_POST['yani_draft']) ) {
                    $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                    $parameter = 'prop-id=' . $property_id;
                    wp_redirect($payment_page_link . $separator . $parameter);
                } else {
                    if (!empty($submit_property_link)) {
                        $submit_property_link = add_query_arg( 'edit_property', $property_id, $submit_property_link );
                        $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                        $parameter = 'updated=1';
                        wp_redirect($submit_property_link . $separator . $parameter);
                    }
                }
            }
        }
    // End per listing if
    } else if( $enable_paid_submission == 'membership' ) {

        if ( !is_user_logged_in() ) {
            $email = wp_kses( $_POST['user_email'], $allowed_html );
            if( email_exists( $email ) ) {
                $errors[] = $yani_local['email_already_registerd'];
            }

            if( !is_email( $email ) ) {
                $errors[] = $yani_local['invalid_email'];
            }

            if( empty($errors) ) {
                $username = explode("@", $email);

                if( username_exists( $username[0] ) ) {
                    $username = $username[0].rand(5, 999);
                } else {
                    $username = $username[0];
                }

                $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                $user_id = wp_create_user( $username, $random_password, $email );

                if( !is_wp_error( $user_id ) ) {

                    $user = get_user_by( 'id', $user_id );

                    _yani_user()->update_profile( $user_id );
                    _yani_user()->new_user_notification( $user_id, $random_password );
                    $user_as_agent = yani_option('user_as_agent');
                    if( $user_as_agent == 'yes' ) {
                        _yani_login_register()->register_as_agent ( $username, $email, $user_id );
                    }

                    if( !is_wp_error($user) ) {
                        wp_clear_auth_cookie();
                        wp_set_current_user( $user->ID, $user->user_login );
                        wp_set_auth_cookie( $user->ID );
                        do_action( 'wp_login', $user->user_login );

                        $property_id = apply_filters( 'yani_submit_listing', $new_property );

                        $args = array(
                            'listing_title'  =>  get_the_title($property_id),
                            'listing_id'     =>  $property_id,
                            'listing_url'    =>  get_permalink($property_id),
                        );

                        /*
                         * Send email
                         * */
                        if( $submission_action != 'update_property' ) {
                            _yani_email()->send_email_type( $user_email, 'free_submission_listing', $args);
                            _yani_email()->send_email_type( $admin_email, 'admin_free_submission_listing', $args);
                        }

                        $separator = (parse_url($select_packages_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                        $parameter = '';//'prop-id=' . $property_id;
                        wp_redirect($select_packages_link . $separator . $parameter);
                        exit();
                    }

                }

            }

        // end is_user_logged_in if
        } else {
            
            $property_id = apply_filters('yani_submit_listing', $new_property);
            $args = array(
                'listing_title'  =>  get_the_title($property_id),
                'listing_id'     =>  $property_id,
                'listing_url'    =>  get_permalink($property_id)
            );

            /*
             * Send email
             * */
            if( $submission_action != 'update_property' ) {
                _yani_email()->send_email_type( $user_email, 'free_submission_listing', $args);
                _yani_email()->send_email_type( $admin_email, 'admin_free_submission_listing', $args);
            }

            if (_yani_user()->user_has_membership($userID)) {
                
                if (!empty($submit_property_link)) {
                    $submit_property_link = add_query_arg( 'edit_property', $property_id, $submit_property_link );
                    $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';

                    $parameter = 'success=1';
                    if($submission_action == 'update_property') {
                        $parameter = 'updated=1';
                    }
                    
                    wp_redirect($submit_property_link . $separator . $parameter);
                }

            } // end membership check
            else {
                $separator = (parse_url($select_packages_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                $parameter = '';//'prop-id=' . $property_id;
                wp_redirect($select_packages_link . $separator . $parameter);
                exit();
            }
        }

    // End membership else if
    } else {

        if ( !is_user_logged_in() ) {
            $email = wp_kses( $_POST['user_email'], $allowed_html );
            if( email_exists( $email ) ) {
                $errors[] = $yani_local['email_already_registerd'];
            }

            if( !is_email( $email ) ) {
                $errors[] = $yani_local['invalid_email'];
            }

            if( empty($errors) ) {
                $username = explode("@", $email);

                if( username_exists( $username[0] ) ) {
                    $username = $username[0].rand(5, 999);
                } else {
                    $username = $username[0];
                }

                $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                $user_id = wp_create_user( $username, $random_password, $email );

                if( !is_wp_error( $user_id ) ) {

                    $user = get_user_by( 'id', $user_id );

                    _yani_user()->update_profile( $user_id );
                    _yani_user()->new_user_notification( $user_id, $random_password );
                    $user_as_agent = yani_option('user_as_agent');
                    if( $user_as_agent == 'yes' ) {
                        _yani_login_register()->register_as_agent ( $username, $email, $user_id );
                    }

                    if( !is_wp_error($user) ) {
                        wp_clear_auth_cookie();
                        wp_set_current_user( $user->ID, $user->user_login );
                        wp_set_auth_cookie( $user->ID );
                        do_action( 'wp_login', $user->user_login );

                        $property_id = apply_filters( 'yani_submit_listing', $new_property );

                        $args = array(
                            'listing_title'  =>  get_the_title($property_id),
                            'listing_id'     =>  $property_id,
                            'listing_url'    =>  get_permalink($property_id)
                        );

                        /*
                         * Send email
                         * */
                        if( $submission_action != 'update_property' ) {
                            _yani_email()->send_email_type( $user_email, 'free_submission_listing', $args);
                            _yani_email()->send_email_type( $admin_email, 'admin_free_submission_listing', $args);
                        }

                        if (!empty($thankyou_page_link)) {
                            wp_redirect($thankyou_page_link);

                        } else {
                            if (!empty($dashboard_listings)) {
                                $separator = (parse_url($dashboard_listings, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                $parameter = ($updated_successfully) ? '' : '';
                                wp_redirect($dashboard_listings . $separator . $parameter);
                            }
                        }
                        exit();
                    }

                }

            }

        } else {

            $property_id = apply_filters('yani_submit_listing', $new_property);

            $args = array(
                'listing_title'  =>  get_the_title($property_id),
                'listing_id'     =>  $property_id,
                'listing_url'    =>  get_permalink($property_id)
            );

            /*
             * Send email
             * */
            if( $submission_action != 'update_property' ) {
                // _yani_email()->send_email_type( $user_email, 'free_submission_listing', $args);
                // _yani_email()->send_email_type( $admin_email, 'admin_free_submission_listing', $args);
            }

            if (!empty($submit_property_link)) {
                $submit_property_link = add_query_arg( 'edit_property', $property_id, $submit_property_link );
                $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';

                $parameter = 'success=1';
                if($submission_action == 'update_property') {
                    $parameter = 'updated=1';
                }
                
                wp_redirect($submit_property_link . $separator . $parameter);
            }

        }
    }

}

get_header();

$yani_loggedin = false;
if ( is_user_logged_in() ) {
    $yani_loggedin = true;
}

$dash_main_class = "dashboard-add-new-listing";
if (_yani_post()->can_be_editted()) { 
    $dash_main_class = "dashboard-edit-listing";
}
if( is_user_logged_in() ) { ?>
	<header class="header-main-wrap dashboard-header-main-wrap">
		<div class="dashboard-header-wrap">
			<div class="d-flex align-items-center">
				<div class="dashboard-header-left flex-grow-1">
					<?php get_template_part('template-parts/dashboard/submit/partials/snake-nav'); ?>
					<h1><?php echo _yani_theme()->get_option('dsh_create_listing', 'Create a Listing'); ?></h1>
				</div>
				<div class="dashboard-header-right">
					<?php if(_yani_post()->can_be_editted()){
						 $view_link = isset($_GET['edit_property']) ? get_permalink($_GET['edit_property']) : '';
						?>
					<a class="btn btn-primary-outlined" target="_blank" href="<?php echo esc_url($view_link); ?>"><?php echo _yani_theme()->get_option('fal_view_property', esc_html__('View Property', _yani_theme()->get_text_domain())); ?></a>

					<?php if( get_post_status( $_GET['edit_property'] ) == 'draft' ) { ?>
                    <button id="save_as_draft" class="btn btn-primary-outlined fave-load-more">
                        <?php get_template_part('template-parts/loader'); ?>
                        <?php echo _yani_theme()->get_option('fal_save_draft', esc_html__('Save as Draft', _yani_theme()->get_text_domain())); ?> 
                    </button>
                    <?php } ?>          
                    <?php } else { ?>
                    <button id="save_as_draft" class="btn btn-primary-outlined fave-load-more">
                        <?php get_template_part('template-parts/loader'); ?>
                        <?php echo _yani_theme()->get_option('fal_save_draft', esc_html__('Save as Draft', _yani_theme()->get_text_domain())); ?>        
                    </button>
                    <?php } ?>         
				</div>
			</div>
		</div>
	</header>
    <section class="dashboard-content-wrap <?php echo esc_attr($dash_main_class); ?>">
		<?php if (_yani_post()->can_be_editted()) { ?>
			<div class="d-flex">
				<div class="order-2">
					<?php get_template_part('template-parts/dashboard/submit/partials/menu-edit-property');?>
				</div>
				<div class="order-1 flex-grow-1">
		<?php } ?>
		<div class="dashboard-content-inner-wrap">
			<?php if(_yani_post()->can_be_editted()){

        
				get_template_part('template-parts/dashboard/submit/edit-property-form');
			}else{ 
				get_template_part('template-parts/dashboard/submit/submit-property-form');
			} ?>
		</div>
		<?php if (_yani_post()->can_be_editted()) { ?>
		</div>
		</div>
		<?php } ?>
	</section>

<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>
<?php }else{ ?>
<header class="header-main-wrap <?php _yani_property()->get_header_transparent_class(); ?>">
	<?php
        if( _yani_theme()->get_option('top_bar') ) {
            get_template_part('template-parts/topbar/top', 'bar');
        }

        // $header = _yani_theme()->get_option('header_style'); 
        $header = 3; 
        
        get_template_part('template-parts/header/header', $header);
    ?>
</header>
<section class="frontend-submission-page dashboard-content-inner-wrap">
	<div class="container">
        <div class="row">
            <div class="col-12">
            	<?php 
                if( $create_listing_login_required == 'yes' ) {

                    get_template_part('template-parts/dashboard/submit/partials/login-required');

                } else {

                    get_template_part('template-parts/dashboard/submit/submit-property-form');
                     
                } ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/footer/main');  ?>
<?php }


/*
if(yani_get_map_system() == 'google') {
    if(yani_option('googlemap_api_key') != "") {
        wp_enqueue_script('yani-submit-google-map',  get_theme_file_uri('/js/submit-property-google-map.js'), array('jquery'), yani_THEME_VERSION, true);
    }
    
} else {
    wp_enqueue_script('yani-submit-osm', get_theme_file_uri('/js/submit-property-osm.js'), array('jquery'), yani_THEME_VERSION, true);
}
*/
 ?>

<?php get_footer(); ?>