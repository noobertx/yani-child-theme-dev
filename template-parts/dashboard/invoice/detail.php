<?php
global $yani_local, $dashboard_invoices, $current_user;
wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$user_email     = $current_user->user_email;
$first_name     = $current_user->first_name;
$last_name     = $current_user->last_name;
$user_address = get_user_meta( $userID, 'yani_author_address', true);
if( !empty($first_name) && !empty($last_name) ) {
    $fullname = $first_name.' '.$last_name;
} else {
    $fullname = $current_user->display_name;
}
$invoice_id = $_GET['invoice_id'];
$post = get_post( $invoice_id );
$invoice_data = _yani_invoice()->get_invoice_meta( $invoice_id );

$publish_date = $post->post_date;
$publish_date = date_i18n( get_option('date_format'), strtotime( $publish_date ) );
$invoice_logo = _yani_theme()->get_option( 'invoice_logo', false, 'url' );
$invoice_company_name = _yani_theme()->get_option( 'invoice_company_name' );
$invoice_address = _yani_theme()->get_option( 'invoice_address' );
$invoice_phone = _yani_theme()->get_option( 'invoice_phone' );
$invoice_additional_info = _yani_theme()->get_option( 'invoice_additional_info' );
$invoice_thankyou = _yani_theme()->get_option( 'invoice_thankyou' );

$billing_for_if = get_post_meta( $invoice_id, 'yani_invoice_for', true );
?>
<div class="dashboard-content-block">
    <div class="invoice-wrap">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="invoice-logo mb-3">
                    <div class="logo">
                        <?php if( !empty($invoice_logo) ) { ?>
                        <img src="<?php echo esc_url($invoice_logo); ?>" alt="logo">
                        <?php } ?>
                    </div>
                </div>
            </div><!-- col-md-9 col-sm-12 -->
            <div class="col-md-3 col-sm-12">
                <div class="invoice-date mb-3">
                    <ul class="list-unstyled">
                        <li><strong><?php esc_html_e('Invoice', _yani_theme()->get_text_domain()); ?>:</strong> <?php echo esc_attr($invoice_id); ?></li>
                        <li><strong><?php esc_html_e('Date', _yani_theme()->get_text_domain()); ?>:</strong> <?php echo esc_attr($publish_date); ?></li>
                    </ul>
                </div>
            </div><!-- col-md-3 col-sm-12 -->
        </div><!-- row -->

        <div class="invoice-spacer mb-5"></div>
        
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <ul class="list-unstyled">
                    <li><strong><?php esc_html_e('To', _yani_theme()->get_text_domain()); ?>:</strong></li>
                    <li><?php echo esc_attr($fullname); ?></li>
                    <li><?php esc_html_e('Email', _yani_theme()->get_text_domain()); ?>: <?php echo esc_attr($user_email);?></li>
                </ul>
            </div><!-- col-md-6 col-sm-12 -->
            <div class="col-md-6 col-sm-12">
                <ul class="list-unstyled">
                    <?php if( !empty($invoice_company_name) ) { ?>
                    <li> 
                        <strong> <?php echo esc_attr($invoice_company_name); ?>:</strong>
                    </li>
                    <?php } ?>

                    <?php if( !empty($invoice_address) ) { ?>
                    <li><?php echo ($invoice_address); ?></li>
                    <?php } ?>

                    <?php if( !empty($invoice_phone) ) { ?>
                    <li><?php esc_html_e('Phone', _yani_theme()->get_text_domain()); ?>: <?php echo esc_attr($invoice_phone); ?></li>
                    <?php } ?>
                </ul>
            </div><!-- col-md-6 col-sm-12 -->
        </div><!-- row -->

        <div class="invoice-spacer mb-5"></div>

        <div class="invoce-content">
            <ul class="list-unstyled">
                <li>
                    <strong><?php echo $yani_local['billing_for']; ?></strong> 
                    <span>
                        <?php
                        if( $invoice_data['invoice_billion_for'] != 'package' && $invoice_data['invoice_billion_for'] != 'Package' ) {
                            

                            if( $billing_for_if == 'listing' || $billing_for_if == 'Listing' ) {
                                echo esc_html__('Listing', _yani_theme()->get_text_domain());
                            } elseif ( $billing_for_if == 'UPGRADE TO FEATURED' ) {
                                echo esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain());
                            } else {
                                echo esc_html($invoice_data['invoice_billion_for']);
                            }
        


                        } else {
                            echo esc_html__('Membership Plan', _yani_theme()->get_text_domain()).' '. get_the_title( get_post_meta( $invoice_id, 'yani_invoice_item_id', true) );
                        }
                        ?>
                    </span>
                </li>

                <li>
                    <strong><?php echo $yani_local['billing_type']; ?></strong> 
                    <span>
                        <?php 
                        if( get_post_meta( $invoice_id, 'yani_invoice_type', true ) == 'Recurring' ) {
                            echo esc_html__( 'Recurring', 'houzez' );
                        } else if ( get_post_meta( $invoice_id, 'yani_invoice_type', true ) == 'One Time' ) {
                            echo esc_html__( 'One Time', 'houzez' );
                        } else {
                            echo esc_html( $invoice_data['invoice_billing_type'] ); 
                        }?>
                        
                    </span>
                </li>

                <li>
                    <strong><?php echo $yani_local['payment_method']; ?></strong> 
                    <span>
                        <?php if( $invoice_data['invoice_payment_method'] == 'Direct Bank Transfer' ) {
                            echo $yani_local['bank_transfer'];
                        } else {
                            echo $invoice_data['invoice_payment_method'];
                        } ?>
                    </span>
                </li>

                <li>
                    <strong><?php echo $yani_local['invoice_price']; ?></strong> 
                    <span><?php echo _yani_invoice()->get_invoice_price( $invoice_data['invoice_item_price'] )?></span>
                </li>
            </ul>
        </div><!-- invoce-content -->

        <div class="invoice-spacer mb-5"></div>
        
        <?php if( !empty($invoice_additional_info) || !empty($invoice_thankyou) ) { ?>
        
            <?php if( !empty($invoice_additional_info)) { ?>
            <div class="invoce-information">
                <p><strong><?php echo esc_html__('Additional Information:', _yani_theme()->get_text_domain()); ?></strong></p>
                <p><?php echo $invoice_additional_info; ?> </p>
            </div><!-- invoce-information -->
            <?php } ?>
        
        <div class="invoice-spacer mb-5"></div>

        <p><strong><?php echo $invoice_thankyou; ?></strong></p>
        <?php } ?>

    </div><!-- invoice-wrap -->
</div><!-- dashboard-content-block -->
<a href="#" id="invoice-print-button" data-id="<?php echo intval($invoice_id); ?>" class="btn btn-primary"><?php echo esc_html__('Print Invoice', _yani_theme()->get_text_domain()); ?></a>
<a href="<?php echo esc_url($dashboard_invoices); ?>" class="btn btn-primary-outlined"><?php echo esc_html__('Go back', _yani_theme()->get_text_domain()); ?></a>