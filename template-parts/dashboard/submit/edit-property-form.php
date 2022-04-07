<?php
global $current_user, $hide_add_prop_fields, $required_fields, $is_multi_steps, $prop_meta_data;

wp_get_current_user();
$userID = $current_user->ID;
$enable_paid_submission = _yani_theme()->get_option('enable_paid_submission');
$select_packages_link = _yani_template()->get_template_link('template/template-packages.php');
$remaining_listings = _yani_user()->get_remaining_listings( $userID );
$show_submit_btn = _yani_theme()->get_option('submit_form_type');

if( is_page_template( 'template/user_dashboard_submit.php' ) ) {

    $allowed_html = array(
        'i' => array(
            'class' => array()
        ),
        'strong' => array(),
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array()
        )
    );

    // Check Author
    global $current_user, $property_data, $prop_meta_data;
    $current_user = wp_get_current_user();

    $edit_prop_id = intval( trim( $_GET['edit_property'] ) );
    $property_data    = get_post( $edit_prop_id );

    if ( ! empty( $property_data ) && ( $property_data->post_type == 'property' ) ) {
        $prop_meta_data = get_post_custom( $property_data->ID );

        if ( $property_data->post_author == $current_user->ID ) {
        
        if ( !_yani_user()->is_admin() && $property_data->post_status == 'draft' && $enable_paid_submission == 'membership' && $remaining_listings != -1 && $remaining_listings < 1 && is_user_logged_in() ) {
        if (!_yani_user()->user_has_membership($userID)) {
            print '<div class="user_package_status">
                    <h4>' . esc_html__("You don\'t have any package! You need to buy your package.", _yani_theme()->get_text_domain()) . '</h4>
                    <a class="btn btn-primary" href="' . $select_packages_link . '">' . esc_html__('Get Package', _yani_theme()->get_text_domain()) . '</a>
                    </div>';
        } else {
            print '<div class="user_package_status"><h4>' . esc_html__("Your current package doesn\'t let you publish more properties! You need to upgrade your membership.", _yani_theme()->get_text_domain()) . '</h4>
            <a class="btn btn-primary" href="' . $select_packages_link . '">' . esc_html__('Upgrade Package', _yani_theme()->get_text_domain()) . '</a>
            </div>';
        }
    } else { ?>

        <form id="submit_property_form" name="new_post" method="post" action="" enctype="multipart/form-data" class="update-frontend-property">
            <input type="hidden" name="draft_prop_id" value="<?php echo intval($edit_prop_id); ?>">
            
            <?php if(isset($_GET['updated']) && $_GET['updated'] == 1) { ?>
            <div class="alert alert-success" role="alert">
                <?php esc_html_e('Updated successfully.', _yani_theme()->get_text_domain()); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>

            <?php if(isset($_GET['success']) && $_GET['success'] == 1) { ?>
            <div class="alert alert-success" role="alert">
                <?php esc_html_e('Submitted successfully.', _yani_theme()->get_text_domain()); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>

            <div class="validate-errors alert alert-danger yani-hidden" role="alert">
                <?php echo wp_kses(__( '<strong>Error!</strong> Please fill out the following required fields.', _yani_theme()->get_text_domain() ), $allowed_html); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="validate-errors-gal alert alert-danger yani-hidden" role="alert">
                <?php echo wp_kses(__( '<strong>Error!</strong> Upload at least one image.', _yani_theme()->get_text_domain() ), $allowed_html); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php get_template_part('template-parts/dashboard/submit/partials/menu-edit-property-mobile'); ?>

            <?php
            $layout = _yani_theme()->get_option('property_form_sections');
            $layout = $layout['enabled'];



            if ($layout): foreach ($layout as $key=>$value) {

                switch($key) {

                    case 'description-price':
                        get_template_part('template-parts/dashboard/submit/description-and-price');
                        break;

                    case 'media':
                        get_template_part('template-parts/dashboard/submit/media');
                        break;

                    case 'details':
                        get_template_part('template-parts/dashboard/submit/details');
                        break;

                    case 'energy_class':
                        get_template_part('template-parts/dashboard/submit/energy-class');
                        break;

                    case 'features':
                        get_template_part('template-parts/dashboard/submit/features');
                        break;

                    case 'location':
                        get_template_part('template-parts/dashboard/submit/location');
                        break;
                    
                    case 'virtual_tour':
                        get_template_part('template-parts/dashboard/submit/360-virtual-tour');
                        break;

                    case 'floorplans':
                        get_template_part('template-parts/dashboard/submit/floor', 'plans');
                        break;

                    case 'multi-units':
                        get_template_part('template-parts/dashboard/submit/sub-properties');
                        break;

                    case 'agent_info':
                        if(_yani_agent()->show_agent_box()) {
                            get_template_part('template-parts/dashboard/submit/contact-information');
                        }
                        break;

                    case 'private_note':
                        get_template_part('template-parts/dashboard/submit/private-note');
                        break;

                    case 'attachments':
                        get_template_part('template-parts/dashboard/submit/attachments');
                        break;

                }

            }
            endif;

            if( _yani_user()->is_admin() ) {
                get_template_part('template-parts/dashboard/submit/settings');
            }
            ?>
            
            <?php wp_nonce_field('submit_property', 'property_nonce'); ?>
            <input type="hidden" name="action" value="update_property"/>
            <input type="hidden" name="prop_id" value="<?php echo intval( $property_data->ID ); ?>"/>

            <?php if( ! _yani_user()->is_admin() ) { ?>
            <input type="hidden" name="prop_featured" value="<?php if( isset( $prop_meta_data['yani_featured'] ) ) { echo sanitize_text_field( $prop_meta_data['yani_featured'][0] ); } ?>">
            <?php } ?>

            <input type="hidden" name="prop_payment" value="<?php if( isset( $prop_meta_data['yani_payment_status'] ) ) { echo sanitize_text_field( $prop_meta_data['yani_payment_status'][0] ); } ?>"/>

            <?php if( get_post_status( $edit_prop_id ) == 'draft' ) {
                echo '<input type="hidden" name="yani_draft" value="draft">';
            }?>

            <div class="d-flex add-new-listing-bottom-nav-wrap justify-content-end">
                <button type="submit" class="btn btn-success yani-submit-js">
                    <?php get_template_part('template-parts/loader'); ?>
                    <?php echo _yani_theme()->get_option('fal_save_changes', esc_html__('Save Changes', _yani_theme()->get_text_domain())); ?>
                </button>
            </div>
        </form>

        <?php
    }
        } else {
            esc_html_e('You are not logged in or This property does not belong to logged in user.', _yani_theme()->get_text_domain());
        }
    } else {
        esc_html_e('This is not a valid request', _yani_theme()->get_text_domain());
    }
}


