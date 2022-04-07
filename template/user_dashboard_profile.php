<?php
/**
 * Template Name: User Dashboard Profile
 */

/*-----------------------------------------------------------------------------------*/
// Social Logins
/*-----------------------------------------------------------------------------------*/
if( ( isset($_GET['code']) && isset($_GET['state']) ) ){
    yani_facebook_login($_GET);

} else if( isset( $_GET['openid_mode']) && $_GET['openid_mode'] == 'id_res' ) {
    yani_openid_login($_GET);

} else if (isset($_GET['code'])) {
    yani_google_oauth_login();

} else {
    if ( !is_user_logged_in() ) {
        wp_redirect(  home_url() );
    }
}

get_header(); 

if( isset( $_GET['agents'] ) && $_GET['agents'] == 'list' ) {
    get_template_part('template-parts/dashboard/agents/main');

} elseif( isset( $_GET['agent'] ) && $_GET['agent'] == 'add_new' ) {
    get_template_part('template-parts/dashboard/agents/add-agent');

} else {
    get_template_part('template-parts/dashboard/profile/profile');
}

?>
<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<?php get_footer(); ?>