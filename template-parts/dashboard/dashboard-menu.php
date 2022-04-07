<?php
global $yani_local;

$dash_profile_link = _yani_template()->get_template_link('template/user_dashboard_profile.php');
$dashboard_insight = _yani_template()->get_template_link('template/user_dashboard_insight.php');
$dashboard_listings = _yani_template()->get_template_link('template/user_dashboard_properties.php');
$dashboard_add_listing = _yani_template()->get_template_link('template/user_dashboard_submit.php');
$dashboard_favorites = _yani_template()->get_template_link('template/user_dashboard_favorites.php');
$dashboard_search = _yani_template()->get_template_link('template/user_dashboard_saved_search.php');
$dashboard_invoices = _yani_template()->get_template_link('template/user_dashboard_invoices.php');
$dashboard_msgs = _yani_template()->get_template_link('template/user_dashboard_messages.php');
$dashboard_membership = _yani_template()->get_template_link('template/user_dashboard_membership.php');
$dashboard_gdpr = _yani_template()->get_template_link('template/user_dashboard_gdpr.php');
$dashboard_seen_msgs = add_query_arg( 'view', 'inbox', $dashboard_msgs );
$dashboard_unseen_msgs = add_query_arg( 'view', 'sent', $dashboard_msgs );

$dashboard_crm = _yani_template()->get_template_link('template/user_dashboard_crm.php');
$crm_leads = add_query_arg( 'hpage', 'leads', $dashboard_crm );
$crm_deals = add_query_arg( 'hpage', 'deals', $dashboard_crm );
$crm_enquiries = add_query_arg( 'hpage', 'enquiries', $dashboard_crm );
$crm_activities = add_query_arg( 'hpage', 'activities', $dashboard_crm );

$home_link = home_url('/');
$enable_paid_submission = _yani_theme()->get_option('enable_paid_submission');

$parent_crm = $parent_props = $parent_agents = $ac_crm = $ac_insight = $ac_profile = $ac_props = $ac_add_prop = $ac_fav = $ac_search = $ac_invoices = $ac_msgs = $ac_mem = $ac_gdpr = '';
if( is_page_template( 'template/user_dashboard_profile.php' ) ) {
    $ac_profile = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_properties.php' ) ) {
    $ac_props = 'class=active';
    $parent_props = "side-menu-parent-selected";
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
    $parent_crm = "side-menu-parent-selected";
}

$agency_agents = add_query_arg( 'agents', 'list', $dash_profile_link );
$agency_agent_add = add_query_arg( 'agent', 'add_new', $dash_profile_link );

$all = add_query_arg( 'prop_status', 'all', $dashboard_listings );
$approved = add_query_arg( 'prop_status', 'approved', $dashboard_listings );
$pending = add_query_arg( 'prop_status', 'pending', $dashboard_listings );
$expired = add_query_arg( 'prop_status', 'expired', $dashboard_listings );
$draft = add_query_arg( 'prop_status', 'draft', $dashboard_listings );
$on_hold = add_query_arg( 'prop_status', 'on_hold', $dashboard_listings );

$ac_approved = $ac_pending = $ac_expired = $ac_all = $ac_draft = $ac_on_hold = $ac_agents = $ac_agent_new = '';

if( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'approved' ) {
    $ac_approved = $ac_props = 'class=active';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'pending' ) {
    $ac_pending = $ac_props = 'class=active';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'expired' ) {
    $ac_expired = $ac_props = 'class=active';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'approved' ) {
    $ac_approved = $ac_props = 'class=active';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'draft' ) {
    $ac_draft = $ac_props = 'class=active';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'on_hold' ) {
    $ac_on_hold = $ac_props = 'class=active';
} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'all' ) {
    $ac_all = $ac_props = 'class=active';
}

if( isset( $_GET['agents'] ) && $_GET['agents'] == 'list' ) {
    $ac_agents = 'class=active';
    $parent_agents = "side-menu-parent-selected";
    $ac_profile = '';
} elseif( isset( $_GET['agent'] ) && $_GET['agent'] == 'add_new' ) {
    $ac_agents = 'class=active';
    $ac_agent_new = 'class=active';
    $ac_profile = '';
    $parent_agents = "side-menu-parent-selected";
}
?>
<ul class="side-menu list-unstyled">
	<?php
	if( !empty( $dashboard_crm ) && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item '.esc_attr($parent_crm).'">';
				echo '<a '.$ac_crm.' href="'.esc_url($dashboard_crm).'">
					<i class="yani-icon icon-layout-dashboard mr-2"></i> '._yani_theme()->get_option('dsh_board', 'Board').'
				</a>';

				echo '<ul class="side-menu-dropdown list-unstyled">';
					
					echo '<li class="side-menu-item">
						<a href="'.esc_url($crm_activities).'"><i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_activities', 'Activities').'</a>
					</li>';
					echo '<li class="side-menu-item">
						<a href="'.esc_url($crm_deals).'"><i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_deals', 'Deals').'</a>
					</li>';
					echo '<li class="side-menu-item">
						<a href="'.esc_url($crm_leads).'"><i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_leads', 'Leads').'</a>
					</li>';

					echo '<li class="side-menu-item">
						<a href="'.esc_url($crm_enquiries).'"><i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_inquiries', 'Inquiries').'</a>
					</li>';

				echo '</ul>';
		echo '</li>';
	}

	if( !empty( $dashboard_insight ) && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item">
				<a '.$ac_insight.' href="'.esc_url($dashboard_insight).'">
					<i class="yani-icon icon-analytics-bars mr-2"></i> '._yani_theme()->get_option('dsh_insight', 'Insight').'
				</a>
			</li>';
	}

	if( !empty( $dashboard_listings ) && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item '.esc_attr($parent_props).'">
				<a '.esc_attr( $ac_props ).' href="'.esc_url($dashboard_listings).'">
					<i class="yani-icon icon-building-cloudy mr-2"></i> '._yani_theme()->get_option('dsh_props', 'Properties').'
				</a>
				<ul class="side-menu-dropdown list-unstyled">
					<li class="side-menu-item">
						<a '.esc_attr( $ac_all ).' href="'.esc_url($all).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_all', 'all').'
						</a>
					</li>
					<li class="side-menu-item">
						<a '.esc_attr( $ac_approved ).' href="'.esc_url($approved).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_published', 'published').'
						</a>
					</li>
					<li class="side-menu-item">
						<a '.esc_attr( $ac_pending ).' href="'.esc_url($pending).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_pending', 'pending').'
						</a>
					</li>
					<li class="side-menu-item">
						<a '.esc_attr( $ac_expired ).' href="'.esc_url($expired).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_expired', 'expired').'
						</a>
					</li>
					<li class="side-menu-item">
						<a '.esc_attr( $ac_draft ).' href="'.esc_url($draft).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_draft', 'draft').'
						</a>
					</li>
					<li class="side-menu-item">
						<a '.esc_attr( $ac_on_hold ).' href="'.esc_url($on_hold).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_hold', 'on_hold').'
						</a>
					</li>
				</ul>
			</li>';
    }

	if( !empty( $dashboard_add_listing ) && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr( $ac_add_prop ).' href="'.esc_url($dashboard_add_listing).'">
					<i class="yani-icon icon-add-circle mr-2"></i> '._yani_theme()->get_option('dsh_create_listing', 'Create a Listing').'
				</a>
			</li>';
    }

	if( !empty( $dashboard_favorites ) ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr( $ac_fav ).' href="'.esc_url($dashboard_favorites).'">
					<i class="yani-icon icon-love-it mr-2"></i> '._yani_theme()->get_option('dsh_favorite', 'Favorites').'
				</a>
			</li>';
    }

	if( !empty( $dashboard_search ) ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr( $ac_search ).' href="'.esc_url($dashboard_search).'">
					<i class="yani-icon icon-search mr-2"></i> '._yani_theme()->get_option('dsh_saved_searches', 'Saved Searches').'
				</a>
			</li>';
    }


	if( !empty($dashboard_membership) && $enable_paid_submission == 'membership' && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr($ac_mem).' href="'.esc_attr($dashboard_membership).'">
					<i class="yani-icon icon-task-list-text-1 mr-2"></i> '._yani_theme()->get_option('dsh_membership', 'Membership').'
				</a>
			</li>';
    }

	if( !empty( $dashboard_invoices ) && _yani_role()->check_role() ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr(  $ac_invoices ).' href="'.esc_url($dashboard_invoices).'">
					<i class="yani-icon icon-accounting-document mr-2"></i> '._yani_theme()->get_option('dsh_invoices', 'Invoices').'
				</a>
			</li>';
    }

    if( !empty( $dashboard_msgs ) ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr(  $ac_msgs ).' href="'.esc_url($dashboard_msgs).'">
					<i class="yani-icon icon-messages-bubble mr-2"></i> '._yani_theme()->get_option('dsh_messages', 'Messages').'
				</a>
			</li>';
    }

    if( !empty( $dash_profile_link ) && _yani_user()->role_is("yani_agency") ) {
		echo '<li class="side-menu-item '.esc_attr($parent_agents).'">
				<a '.esc_attr( $ac_agents ).' href="'.esc_url($agency_agents).'">
					<i class="yani-icon icon-single-neutral mr-2"></i> '._yani_theme()->get_option('dsh_agents', 'Agents').'
				</a>
				<ul class="side-menu-dropdown list-unstyled">
					<li class="side-menu-item">
						<a '.esc_attr( $ac_agent_new ).' href="'.esc_url($agency_agent_add).'">
							<i class="yani-icon icon-arrow-right-1"></i> '._yani_theme()->get_option('dsh_addnew', 'Add New').'
						</a>
					</li>
				</ul>
			</li>';
    }

	if( !empty( $dash_profile_link ) ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr( $ac_profile ).' href="'.esc_url($dash_profile_link).'">
					<i class="yani-icon icon-single-neutral-circle mr-2"></i> '._yani_theme()->get_option('dsh_profile', 'My profile').'
				</a>
			</li>';	
	}

	if( !empty( $dashboard_gdpr ) ) {
		echo '<li class="side-menu-item">
				<a '.esc_attr( $ac_gdpr ).' href="'.esc_url($dashboard_gdpr).'">
					<i class="yani-icon icon-single-neutral-circle mr-2"></i> '._yani_theme()->get_option('dsh_gdpr', 'GDPR Request').'
				</a>
			</li>';	
	}

    echo '<li class="side-menu-item">
			<a href="' . wp_logout_url( home_url() ) . '">
				<i class="yani-icon icon-lock-5 mr-2"></i> '._yani_theme()->get_option('dsh_logout', 'Log out').'
			</a>
		</li>';
	?>
</ul>