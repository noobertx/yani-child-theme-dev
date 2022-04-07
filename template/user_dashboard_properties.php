<?php
/**
 * Template Name: User Dashboard Properties
 */

if ( !is_user_logged_in() || !_yani_role()->check_role() ) {
    wp_redirect(  home_url() );
}

global  $current_user;
wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$paid_submission_type = esc_html ( _yani_theme()->get_option('enable_paid_submission','') );
$packages_page_link = _yani_template()->get_template_link('template/template-packages.php');
$dashboard_add_listing = _yani_template()->get_template_link('template/user_dashboard_submit.php');

get_header();

if( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'approved' ) {
    $qry_status = 'publish';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'pending' ) {
    $qry_status = 'pending';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'expired' ) {
    $qry_status = 'expired';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'draft' ) {
    $qry_status = 'draft';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'on_hold' ) {
    $qry_status = 'on_hold';
} else {
    $qry_status = 'any';
}
$sortby = '';
if( isset( $_GET['sortby'] ) ) {
    $sortby = $_GET['sortby'];
}
$no_of_prop   =  '9';
$paged        = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'        =>  'property',
    'author'           =>  $userID,
    'paged'             => $paged,
    'posts_per_page'    => $no_of_prop,
    'post_status'      =>  array( $qry_status ),
    'suppress_filters' => false
);
if( isset ( $_GET['keyword'] ) ) {
    $keyword = trim( $_GET['keyword'] );
    if ( ! empty( $keyword ) ) {
        $args['s'] = $keyword;
    }
}
$args = _yani_property_listing()->prop_sort ( $args );
?>
<header class="header-main-wrap dashboard-header-main-wrap">
    <div class="dashboard-header-wrap">
        <div class="d-flex align-items-center">
            <div class="dashboard-header-left flex-grow-1">
                <h1><?php echo _yani_theme()->get_option('dsh_props', 'Properties'); ?></h1>         
            </div><!-- dashboard-header-left -->

            <?php if(!empty($dashboard_add_listing)) { ?>
            <div class="dashboard-header-right">
                <a class="btn btn-primary" href="<?php echo esc_url($dashboard_add_listing); ?>"><?php echo _yani_theme()->get_option('dsh_create_listing', 'Create a Listing'); ?></a>
            </div><!-- dashboard-header-right -->
            <?php } ?>
        </div><!-- d-flex -->
    </div><!-- dashboard-header-wrap -->
</header><!-- .header-main-wrap -->
<section class="dashboard-content-wrap">
    <div class="dashboard-content-inner-wrap">
        <div class="dashboard-content-block-wrap">

            <div class="dashboard-property-search-wrap">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="dashboard-property-search">
                            <?php get_template_part('template-parts/dashboard/property/search'); ?>
                        </div>
                    </div>
                    <div class="dashboard-property-sort-by">
                        <?php get_template_part('template-parts/listing/listing-sort-by'); ?>  
                    </div>
                </div>
            </div><!-- dashboard-property-search -->

            <?php
            $prop_qry = new WP_Query($args); 
            if( $prop_qry->have_posts() ): ?>
                <div id="dash-prop-msg"></div>
                <table class="dashboard-table dashboard-table-properties table-lined responsive-table">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Thumbnail', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Title', _yani_theme()->get_text_domain()); ?></th>
                        <th></th>
                        <th><?php echo esc_html__('Type', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Status', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Price', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Featured', _yani_theme()->get_text_domain()); ?></th>
                        <th class="action-col"><?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($prop_qry->have_posts()): $prop_qry->the_post();

                        get_template_part('template-parts/dashboard/property/property-item');

                    endwhile; 
                    ?>

                </tbody>
                </table><!-- dashboard-table -->

                <?php _yani_post()->render_pagination( $prop_qry->max_num_pages ); ?>

            <?php    
            else: 

                if(isset($_GET['keyword'])) {

                    echo '<div class="dashboard-content-block">
                        '.esc_html__("No results found", _yani_theme()->get_text_domain()).'
                    </div>';

                } else {
                    echo '<div class="dashboard-content-block">
                        '.esc_html__("You don't have any property listed.", _yani_theme()->get_text_domain()).' <a href="'.esc_url($dashboard_add_listing).'"><strong>'.esc_html__('Create a listing', _yani_theme()->get_text_domain()).'</strong></a>
                    </div>';
                }
                

            endif;
            ?>
        
        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->
<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<?php get_footer(); ?>