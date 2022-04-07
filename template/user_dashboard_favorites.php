<?php
/**
 * Template Name: User Dashboard Favorite Properties
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

global $yani_local, $current_user;

wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$fav_ids = 'yani_favorites-'.$userID;
$fav_ids = get_option( $fav_ids );
get_header();
?>

<header class="header-main-wrap dashboard-header-main-wrap">
    <div class="dashboard-header-wrap">
        <div class="d-flex align-items-center">
            <div class="dashboard-header-left flex-grow-1">
                <h1><?php echo _yani_theme()->get_option('dsh_favorite', 'Favorites'); ?></h1>         
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
            if( empty( $fav_ids ) ) { ?>
            <div class="dashboard-content-block">
                <?php echo esc_html__("You don't have any favorite listings yet!", _yani_theme()->get_text_domain()); ?>
            </div>

            <?php 
            } else {
            ?>
            <table class="dashboard-table dashboard-table-properties table-lined responsive-table">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Thumbnail', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Title', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Type', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Status', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php echo esc_html__('Price', _yani_theme()->get_text_domain()); ?></th>
                        <th class="action-col"><?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $args = array('post_type' => 'property', 'post__in' => $fav_ids, 'numberposts' => -1 );
                    $myposts = get_posts($args);
                    foreach ($myposts as $post) : setup_postdata($post);
                        
                        get_template_part('template-parts/dashboard/property/favorite-item');

                    endforeach;
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table><!-- dashboard-table -->
            <?php } ?>
        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->

<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<?php get_footer(); ?>