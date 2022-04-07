<?php
global $current_user, $yani_local, $ele_settings, $ele_edit_mode_settings;
wp_get_current_user();
$userID  =  $current_user->ID;

$ele_show_dropdown = isset($ele_edit_mode_settings['show_dropdown']) ? $ele_edit_mode_settings['show_dropdown'] : '';

$dash_profile_link = yani_get_template_link_2('template/user_dashboard_profile.php');
$dashboard_insight = yani_get_template_link_2('template/user_dashboard_insight.php');
$dashboard_crm = yani_get_template_link_2('template/user_dashboard_crm.php');
$dashboard_listings = yani_get_template_link_2('template/user_dashboard_properties.php');
$dashboard_add_listing = yani_get_template_link_2('template/user_dashboard_submit.php');
$dashboard_favorites = yani_get_template_link_2('template/user_dashboard_favorites.php');
$dashboard_search = yani_get_template_link_2('template/user_dashboard_saved_search.php');
$dashboard_invoices = yani_get_template_link_2('template/user_dashboard_invoices.php');
$dashboard_msgs = yani_get_template_link_2('template/user_dashboard_messages.php');
$dashboard_membership = yani_get_template_link_2('template/user_dashboard_membership.php');
$dashboard_gdpr = yani_get_template_link_2('template/user_dashboard_gdpr.php');
$dashboard_seen_msgs = add_query_arg( 'view', 'inbox', $dashboard_msgs );
$dashboard_unseen_msgs = add_query_arg( 'view', 'sent', $dashboard_msgs );
$home_link = home_url('/');
$enable_paid_submission = yani_option('enable_paid_submission');
$create_lisiting_enable = yani_option('create_lisiting_enable');
$header_style = yani_option('header_style');

$ac_crm = $ac_insight = $ac_profile = $ac_props = $ac_add_prop = $ac_fav = $ac_search = $ac_invoices = $ac_msgs = $ac_mem = $ac_gdpr = '';
if( is_page_template( 'template/user_dashboard_profile.php' ) ) {
    $ac_profile = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_properties.php' ) ) {
    $ac_props = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_submit.php' ) ) {
    $ac_add_prop = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_saved_search.php' ) ) {
    $ac_search = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_favorites.php' ) ) {
    $ac_fav = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_invoices.php' ) ) {
    $ac_invoices = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_messages.php' ) ) {
    $ac_msgs = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_membership.php' ) ) {
    $ac_mem = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_gdpr.php' ) ) {
    $ac_gdpr = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_insight.php' ) ) {
    $ac_insight = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_crm.php' ) ) {
    $ac_crm = 'class=active';
}


$user_custom_picture = yani_get_profile_pic($userID);

?>
<nav class="logged-in-nav-wrap" id="navi-user">
    <div class="navbar-logged-in-wrap navbar <?php echo esc_attr($ele_show_dropdown); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img width="42" height="42" alt="author" src="<?php echo esc_url($user_custom_picture ); ?>" class="rounded">
        </a>
        <ul class="logged-in-nav dropdown-menu <?php echo esc_attr($ele_show_dropdown); ?>">
            <?php
            if( !empty( $dashboard_crm ) && yani_check_role() ) {
                echo '<li class="side-menu-item">';
                        echo '<a '.$ac_crm.' href="'.esc_url($dashboard_crm).'">';
                            echo '<i class="yani-icon icon-layout-dashboard mr-2"></i></span> '.yani_option('dsh_board', 'Board').'
                        </a>';

                    echo '</li>';
            }

            if( !empty( $dashboard_insight ) && yani_check_role() ) {
                echo '<li class="side-menu-item">
                        <a '.$ac_insight.' href="'.esc_url($dashboard_insight).'">
                            <i class="yani-icon icon-analytics-bars mr-2"></i> '.yani_option('dsh_insight', 'Insight').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_listings ) && yani_check_role() ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr( $ac_props ).' href="'.esc_url($dashboard_listings).'">
                            <i class="yani-icon icon-building-cloudy mr-2"></i> '.yani_option('dsh_props', 'Properties').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_add_listing ) && yani_check_role() ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr( $ac_add_prop ).' href="'.esc_url($dashboard_add_listing).'">
                            <i class="yani-icon icon-add-circle mr-2"></i> '.yani_option('dsh_create_listing', 'Create a Listing').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_favorites ) ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr( $ac_fav ).' href="'.esc_url($dashboard_favorites).'">
                            <i class="yani-icon icon-love-it mr-2"></i> '.yani_option('dsh_favorite', 'Favorites').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_search ) ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr( $ac_search ).' href="'.esc_url($dashboard_search).'">
                            <i class="yani-icon icon-search mr-2"></i> '.yani_option('dsh_saved_searches', 'Saved Searches').'
                        </a>
                    </li>';
            }



            if( !empty($dashboard_membership) && $enable_paid_submission == 'membership' && yani_check_role() ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr($ac_mem).' href="'.esc_attr($dashboard_membership).'">
                            <i class="yani-icon icon-task-list-text-1 mr-2"></i> '.yani_option('dsh_membership', 'Membership').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_invoices ) && yani_check_role() ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr(  $ac_invoices ).' href="'.esc_url($dashboard_invoices).'">
                            <i class="yani-icon icon-accounting-document mr-2"></i> '.yani_option('dsh_invoices', 'Invoices').'
                        </a>
                    </li>';
            }

            if( !empty( $dashboard_msgs ) ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr(  $ac_msgs ).' href="'.esc_url($dashboard_msgs).'">
                            <i class="yani-icon icon-messages-bubble mr-2"></i> '.yani_option('dsh_messages', 'Messages').'
                        </a>
                    </li>';
            }

            if( !empty( $dash_profile_link ) ) {
                echo '<li class="side-menu-item">
                        <a '.esc_attr( $ac_profile ).' href="'.esc_url($dash_profile_link).'">
                            <i class="yani-icon icon-single-neutral-circle mr-2"></i> '.yani_option('dsh_profile', 'My profile').'
                        </a>
                    </li>'; 
            }

            echo '<li class="side-menu-item">
                    <a href="' . wp_logout_url( home_url() ) . '">
                        <i class="yani-icon icon-lock-5 mr-2"></i> '.yani_option('dsh_logout', 'Log out').'
                    </a>
                </li>';
            ?>
        </ul><!-- logged-in-nav -->
    </div><!-- .navbar-logged-in-wrap -->
</nav>
<!-- .logged-in-nav-wrap -->
