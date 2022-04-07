<?php
/**
 * Template Name: Template all agencies
 *
 */
get_header();
global $paged, $yani_local;
$sticky_sidebar = _yani_theme()->get_option('sticky_sidebar');
$page_id = get_the_ID();
if ( is_front_page() ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$page_content_position = _yani_property_listing()->get_listing_data('listing_page_content_area');

$number_of_agencies = _yani_theme()->get_option('num_of_agencies');
if(!$number_of_agencies){
    $number_of_agencies = 9;
}

$qry_args = array(
    'post_type' => 'yani_agency',
    'posts_per_page' => $number_of_agencies,
    'paged' => $paged,
    'post_status' => 'publish',
    'meta_query' => array(
        'relation' => 'OR',
            array(
             'key' => 'yani_agency_visible',
             'compare' => 'NOT EXISTS', // works!
             'value' => '' // This is ignored, but is necessary...
            ),
            array(
             'key' => 'yani_agency_visible',
             'value' => 1,
             'type' => 'NUMERIC',
             'compare' => '!=',
            )
    )
);

$order = get_post_meta( $page_id, 'yani_agency_order', true );
$orderby = get_post_meta( $page_id, 'yani_agency_orderby', true );


if( !empty( $orderby ) && $orderby != 'none' ) {
    $qry_args['orderby'] = $orderby;
}
if( !empty( $order ) ) {
    $qry_args['order'] = $order;
}

$agencies_query = new WP_Query( $qry_args );
?>

<section class="listing-wrap">
    <div class="container">
        
        <div class="page-title-wrap">
            <?php get_template_part('template-parts/page/breadcrumb'); ?> 
            <div class="d-flex align-items-center">
                <?php get_template_part('template-parts/page/page-title'); ?> 
            </div><!-- d-flex -->  
        </div><!-- page-title-wrap -->

        <div class="row">
            <div class="col-lg-8 col-md-12 bt-content-wrap right-bt-content-wrap">
                
                <?php
                if ( $page_content_position !== '1' ) {
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            ?>
                            <article <?php post_class(); ?>>
                                <?php the_content(); ?>
                            </article>
                            <?php
                        }
                    } 
                }?>

                <div class="agents-list-view">
                    <?php
                    if ( $agencies_query->have_posts() ) :
                    while ( $agencies_query->have_posts() ) : $agencies_query->the_post();

                            get_template_part('template-parts/realtors/agency/list');

                    endwhile;
                    
                    else:
                        get_template_part('template-parts/realtors/agency/none');
                    endif;
                    ?>
                </div><!-- listing-view -->
                
                <?php _yani_post()->render_pagination( $agencies_query->max_num_pages ); wp_reset_query(); ?>

            </div><!-- bt-content-wrap -->
            <div class="col-lg-4 col-md-12 bt-sidebar-wrap left-bt-sidebar-wrap <?php if( $sticky_sidebar['agency_sidebar'] != 0 ){ echo 'yani_sticky'; }?>">
                <?php get_sidebar('agencies'); ?>
            </div><!-- bt-sidebar-wrap -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- listing-wrap -->

<?php
if ('1' === $page_content_position ) {
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            ?>
            <section class="content-wrap">
                <?php the_content(); ?>
            </section>
            <?php
        }
    }
}
?>

<?php get_footer(); ?>