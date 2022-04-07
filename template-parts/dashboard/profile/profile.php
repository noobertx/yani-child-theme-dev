<?php
$userID = get_current_user_id();
$user_agent_id = get_user_meta( $userID, 'yani_author_agent_id', true );
$user_agency_id = get_user_meta( $userID, 'yani_author_agency_id', true );

if(_yani_user()->role_is("yani_agency")){
    $id_for_permalink = $user_agency_id;
} elseif(_yani_user()->role_is("yani_agent")) {
    $id_for_permalink = $user_agent_id;
}

if( !empty( $id_for_permalink ) ) {
    if( 'publish' == get_post_status ( $id_for_permalink ) ) {
        $agent_permalink = get_permalink($id_for_permalink);
    } else {
        $agent_permalink = get_author_posts_url( $userID );
    }

} else {
    $agent_permalink = get_author_posts_url( $userID );
}
?>
<header class="header-main-wrap dashboard-header-main-wrap">
	<div class="dashboard-header-wrap">
		<div class="d-flex align-items-center">
			<div class="dashboard-header-left flex-grow-1">
				<h1><?php echo _yani_theme()->get_option('dsh_profile', 'My profile'); ?></h1> 
			</div>			
		</div>		
	</div>
</header>
<section class="dashboard-content-wrap">
	<div class="dashboard-content-inner-wrap">
		<div class="dashboard-content-block-wrap">
			<form method="post">
				<?php get_template_part('template-parts/dashboard/profile/information'); ?>
				<?php wp_nonce_field( 'yani_profile_ajax_nonce', 'yani-security-profile' ); ?>
                <input type="hidden" name="action" value="yani_update_profile">

			</form>
		</div> 
	</div>
</section>