<?php
/**
 * Template Name: User Dashboard Saved Search
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

global $wpdb, $yani_local;

$userID = get_current_user_id();

$table_name = $wpdb->prefix . 'yani_search';
$results    = $wpdb->get_results( 'SELECT * FROM ' . $table_name . ' WHERE auther_id = '.$userID.' ORDER BY id DESC', OBJECT );

get_header(); ?>

<header class="header-main-wrap dashboard-header-main-wrap">
    <div class="dashboard-header-wrap">
        <div class="d-flex align-items-center">
            <div class="dashboard-header-left flex-grow-1">
                <h1><?php echo _yani_theme()->get_option('dsh_saved_searches', 'Saved Searches'); ?></h1>         
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
            if ( sizeof( $results ) !== 0 ) : ?>

                <table class="dashboard-table table-lined responsive-table">
                    <thead>
                        <tr>
                            <th><?php echo esc_html__('Search Parameters', _yani_theme()->get_text_domain()); ?></th>
                            <th class="action-col"><?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ( $results as $yani_search_data ) :

                        get_template_part( 'template-parts/dashboard/saved-search-item' );

                    endforeach;
                    ?>

                    </tbody>
                </table>

            <?php
            else :

                echo '<div class="dashboard-content-block">
                        '.esc_html__("You don't have any saved search.", _yani_theme()->get_text_domain()).'
                    </div>';

            endif;

            ?>
            

        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->
<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

    
<?php get_footer(); ?>