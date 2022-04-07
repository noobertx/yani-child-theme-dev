<?php
/**
 * Template Name: User Dashboard Invoices
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

global $paged, $yani_local, $current_user, $dashboard_invoices;
$dashboard_invoices = _yani_template()->get_template_link('template/user_dashboard_invoices.php');

global $yani_local;
get_header();

if ( is_front_page()  ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
?>
<header class="header-main-wrap dashboard-header-main-wrap">
    <div class="dashboard-header-wrap">
        <div class="d-flex align-items-center">
            <div class="dashboard-header-left flex-grow-1">
                <h1><?php echo _yani_theme()->get_option('dsh_invoices', 'Invoices'); ?></h1>         
            </div><!-- dashboard-header-left -->
            <div class="dashboard-header-right">
            </div><!-- dashboard-header-right -->
        </div><!-- d-flex -->
    </div><!-- dashboard-header-wrap -->
</header><!-- .header-main-wrap -->

<section class="dashboard-content-wrap">
    <div class="dashboard-content-inner-wrap">
        <div class="dashboard-content-block-wrap">
            <?php 
            if( isset( $_GET['invoice_id']) && !empty($_GET['invoice_id']) ) {
                get_template_part('template-parts/dashboard/invoice/detail');

            } else { ?>

            <h2><?php echo esc_html__('Search Invoices', _yani_theme()->get_text_domain()); ?></h2>
            <div class="dashboard-content-block">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label><?php echo $yani_local['start_date']; ?></label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="yani-icon icon-calendar-3"></i></div>
                                </div>
                                <input id="startDate" type="text" class="form-control db_input_date" placeholder="<?php echo esc_html__('Select a date', _yani_theme()->get_text_domain()); ?>" readonly>
                            </div><!-- input-group -->
                        </div><!-- form-group -->
                    </div><!-- col-md-3 col-sm-12 -->
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label><?php echo $yani_local['end_date']; ?></label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="yani-icon icon-calendar-3"></i></div>
                                </div>
                                <input id="endDate" type="text" class="form-control db_input_date" placeholder="<?php echo esc_html__('Select a date', _yani_theme()->get_text_domain()); ?>" readonly>
                            </div><!-- input-group -->
                        </div><!-- form-group -->
                    </div><!-- col-md-3 col-sm-12 -->
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="invoice_type"><?php echo $yani_local['invoice_type']; ?></label>
                            <select class="selectpicker form-control bs-select-hidden" id="invoice_type" data-live-search="false">
                                <option value=""><?php echo $yani_local['any']; ?></option>
                                <option value="Listing"><?php echo $yani_local['invoice_listing']; ?></option>
                                <option value="package"><?php echo $yani_local['invoice_package']; ?></option>
                                <option value="Listing with Featured"><?php echo $yani_local['invoice_feat_list']; ?></option>
                                <option value="Upgrade to Featured"><?php echo $yani_local['invoice_upgrade_list']; ?></option>
                            </select>
                        </div><!-- form-group -->
                    </div><!-- col-md-3 col-sm-12 -->
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="invoice_status"><?php echo $yani_local['invoice_status']; ?></label>
                            <select class="selectpicker form-control bs-select-hidden" id="invoice_status" data-live-search="false">
                                <option value=""><?php echo $yani_local['any']; ?></option>
                                <option value="1"><?php echo $yani_local['paid']; ?></option>
                                <option value="0"><?php echo $yani_local['not_paid']; ?></option>
                            </select>
                        </div><!-- form-group -->
                    </div><!-- col-md-3 col-sm-12 -->
                </div><!-- row -->
            </div><!-- dashboard-content-block -->

            <table class="dashboard-table table-lined responsive-table">
                <thead>
                    <tr>
                        <th><?php echo $yani_local['order']; ?></th>
                        <th><?php echo $yani_local['date']; ?></th>
                        <th><?php echo $yani_local['billing_for']; ?></th>
                        <th><?php echo $yani_local['billing_type']; ?></th>
                        <th><?php echo $yani_local['invoice_status']; ?></th>
                        <th><?php echo $yani_local['payment_method']; ?></th>
                        <th><?php echo $yani_local['total']; ?></th>
                        <th class="action-col"><?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?></th>
                    </tr>
                </thead>
                <tbody id="invoices_content">
                    <?php 
                    $invoices_args = array(
                        'post_type' => 'yani_invoice',
                        'posts_per_page' => '-1',
                        'meta_query' => array(
                            array(
                                'key' => 'yani_invoice_buyer',
                                'value' => get_current_user_id(),
                                'compare' => '='
                            )
                        ),
                        'paged' => $paged
                    );

                    $invoice_query = new WP_Query($invoices_args);
                    $total = 0;
                    if ($invoice_query->have_posts()) :
                        while ($invoice_query->have_posts()) : $invoice_query->the_post();

                            get_template_part('template-parts/dashboard/invoice/invoice-item'); 

                        endwhile; 
                    endif;
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table><!-- dashboard-table -->

            <?php _yani_post()->render_pagination( $invoice_query->max_num_pages ); ?>
            <?php } ?>

        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->
<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<?php get_footer(); ?>