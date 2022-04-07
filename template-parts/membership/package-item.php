<?php 
global $yani_local; 
$currency_symbol = _yani_theme()->get_option( 'currency_symbol' );
$where_currency = _yani_theme()->get_option( 'currency_position' );
if(class_exists('yani_Currencies')) {
    $multi_currency = _yani_theme()->get_option('multi_currency');
    $default_currency = _yani_theme()->get_option('default_multi_currency');
    if(empty($default_currency)) {
        $default_currency = 'USD';
    }

    if($multi_currency == 1) {
        $currency = yani_Currencies::get_currency_by_code($default_currency);
        $currency_symbol = $currency['currency_symbol'];
    }
}
$payment_page_link = _yani_template()->get_template_link('template/template-payment.php');

$args = array(
    'post_type'       => 'yani_packages',
    'posts_per_page'  => -1,
    'meta_query'      =>  array(
        array(
            'key' => 'yani_package_visible',
            'value' => 'yes',
            'compare' => '=',
        )
    )
);
$yani_qry = new WP_Query($args);

$total_packages = $first_pkg_column = '';
$total_packages = $yani_qry->found_posts;

if( $total_packages == 3 ) {
    $pkg_classes = 'col-md-4 col-sm-4 col-xs-12';
} else if( $total_packages == 4 ) {
    $pkg_classes = 'col-md-3 col-sm-6';
} else if( $total_packages == 2 ) {
    $pkg_classes = 'col-md-6 col-sm-6';
} else if( $total_packages == 1 ) {
    $pkg_classes = 'col-md-4 col-sm-12';
} else {
    $pkg_classes = 'col-md-3 col-sm-6';
}
$i = 0;
while( $yani_qry->have_posts() ): $yani_qry->the_post(); $i++;

    $pack_price              = get_post_meta( get_the_ID(), 'yani_package_price', true );
    $pack_listings           = get_post_meta( get_the_ID(), 'yani_package_listings', true );
    $pack_featured_listings  = get_post_meta( get_the_ID(), 'yani_package_featured_listings', true );
    $pack_unlimited_listings = get_post_meta( get_the_ID(), 'yani_unlimited_listings', true );
    $pack_billing_period     = get_post_meta( get_the_ID(), 'yani_billing_time_unit', true );
    $pack_billing_frquency   = get_post_meta( get_the_ID(), 'yani_billing_unit', true );
    $yani_package_images        = get_post_meta( get_the_ID(), 'yani_package_images', true );
    $pack_package_tax        = get_post_meta( get_the_ID(), 'yani_package_tax', true );
    $yani_package_popular    = get_post_meta( get_the_ID(), 'yani_package_popular', true );
    $package_custom_link     = get_post_meta( get_the_ID(), 'yani_package_custom_link', true );

    if( $pack_billing_frquency > 1 ) {
        $pack_billing_period .='s';
    }
    if ( $where_currency == 'before' ) {
        $package_price = '<span class="price-table-currency">'.$currency_symbol.'</span><span class="price-table-price">'.$pack_price.'</span>';
    } else {
        $package_price = '<span class="price-table-price">'.$pack_price.'</span><span class="price-table-currency">'.$currency_symbol.'</span>';
    }

    if( $yani_package_popular == "yes" ) {
        $is_popular = 'featured';
    } else {
        $is_popular = '';
    }

    $payment_process_link = add_query_arg( 'selected_package', get_the_ID(), $payment_page_link );

    if( $i == 1 && $total_packages == 2 ) {
        $first_pkg_column = 'col-md-offset-2 col-sm-offset-0';
    } else if (  $i == 1 && $total_packages == 1  ) {
        $first_pkg_column = 'col-md-offset-4 col-sm-offset-0';
    } else {
        $first_pkg_column = '';
    }

    if(!empty($package_custom_link)) {
        $payment_process_link = $package_custom_link;
    }

    ?>
    <div class="<?php echo esc_attr( $pkg_classes ); ?>">
        <div class="price-table-module <?php echo esc_attr( $is_popular ); ?>">
            <div class="price-table-title">
                <?php the_title(); ?>
            </div><!-- price-table-title -->
            <div class="price-table-price-wrap">
                <div class="d-flex align-items-start justify-content-center">
                    <?php echo $package_price; ?>
                </div><!-- d-flex -->
            </div><!-- price-table-price-wrap -->
            <div class="price-table-description">
                <ul class="list-unstyled">
                    <li>
                        <i class="yani-icon icon-check-circle-1 primary-text mr-1"></i> 
                        <<?php echo $yani_local['time_period']; ?>: 
                        <strong><?php echo esc_attr( $pack_billing_frquency ).' '._yani_theme()->get_billing_period( $pack_billing_period ); ?></strong>
                    </li>
                    <li>
                        <i class="yani-icon icon-check-circle-1 primary-text mr-1"></i> 
                        <?php echo _yani_theme()->get_option('cl_properties', 'Properties'); ?>: 
                        <?php if( $pack_unlimited_listings == 1 ) { ?>
                            <strong><?php echo $yani_local['unlimited_listings']; ?></strong>
                        <?php } else { ?>
                            <strong><?php echo esc_attr( $pack_listings ); ?></strong>
                        <?php } ?>
                    </li>
                    <li>
                        <i class="yani-icon icon-check-circle-1 primary-text mr-1"></i> 
                        <?php echo $yani_local['featured_listings']; ?>: 
                        <strong><?php echo esc_attr( $pack_featured_listings ); ?></strong>
                    </li>

                    <?php if($yani_package_images != "") { ?>
                    <li>
                        <i class="yani-icon icon-check-circle-1 primary-text mr-1"></i> 
                        <?php echo esc_html_e('Images', _yani_theme()->get_text_domain()); ?>: 
                        <strong><?php echo esc_attr( $yani_package_images ); ?></strong>
                    </li>
                    <?php } ?>

                    <?php if($pack_package_tax != "") { ?>
                    <li>
                        <i class="yani-icon icon-check-circle-1 primary-text mr-1"></i> 
                        <?php esc_html_e('Taxes', _yani_theme()->get_text_domain()); ?>: 
                        <strong><?php echo esc_attr( $pack_package_tax ).'%'; ?></strong>
                    </li>
                    <?php } ?>
                </ul>
            </div><!-- price-table-description -->
            <div class="price-table-button">
                <?php if( _yani_theme()->is_woocommerce() ) { ?>
                    <a class="houzez-woocommerce-package btn btn-primary" data-packid="<?php echo get_the_ID(); ?>" href="#">
                        <i class="yani-icon icon-check-circle-1 mr-1"></i> <?php echo $yani_local['get_started']; ?>
                    </a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="<?php echo esc_url($payment_process_link); ?>">
                        <i class="yani-icon icon-check-circle-1 mr-1"></i> <?php echo $yani_local['get_started']; ?>
                    </a>
                <?php } ?>
            </div><!-- price-table-button -->
        </div><!-- taxonomy-grids-module -->
    </div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>