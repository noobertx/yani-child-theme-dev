<?php
class yani_Admin{

    public static $instance;

    public function __construct() {
    	add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );
    	add_action('admin_init', array($this,'add_theme_caps'));
    }

    public function register_admin_pages() {
    	$sub_menus = array();

        add_menu_page(
            esc_html__( 'Houzez', 'houzez' ),
            esc_html__( 'Houzez', 'houzez' ),
            'manage_options',
            'yani_dashboard',
            '',
            '',
            '5'
        );

        $sub_menus['plugins'] = array(
            'yani_dashboard',
            esc_html__( 'Plugins', 'houzez' ),
            esc_html__( 'Plugins', 'houzez' ),
            'manage_options',
            'yani_plugins',
            array( $this, 'plugins' ),
        );

        if( class_exists(_yani_theme()->get_text_domain()) ) {
	        $sub_menus['yani_fbuilder'] = array( 
	            'yani_dashboard', 
	            esc_html__( 'Fields builder', 'houzez' ),
	            esc_html__( 'Fields builder', 'houzez' ),
	            'manage_options', 
	            'yani_fbuilder', 
	            array( 'yani_Fields_Builder', 'render' )
	        );

	        $sub_menus['yani_currencies'] = array(
	            'yani_dashboard',
	            esc_html__( 'Currencies', 'houzez' ),
	            esc_html__( 'Currencies', 'houzez' ),
	            'manage_options',
	            'yani_currencies',
	            array( 'yani_Currencies', 'render' )
	        );

	        $sub_menus['fcc_api_settings'] = array(
	            'yani_dashboard',
	            esc_html__( 'Currency Switcher', 'houzez' ),
	            esc_html__( 'Currency Switcher', 'houzez' ),
	            'manage_options',
	            'fcc_api_settings',
	            array( 'FCC_API_Settings', 'render' )
	        );

	        $sub_menus['yani_post_types'] = array(
	            'yani_dashboard',
	            esc_html__( 'Post Types', 'houzez' ),
	            esc_html__( 'Post Types', 'houzez' ),
	            'manage_options',
	            'yani_post_types',
	            array( 'yani_Post_Type', 'render' )
	        );

	        $sub_menus['yani_taxonomies'] = array(
	            'yani_dashboard',
	            esc_html__( 'Taxonomies', 'houzez' ),
	            esc_html__( 'Taxonomies', 'houzez' ),
	            'manage_options',
	            'yani_taxonomies',
	            array( 'yani_Taxonomies', 'render' )
	        );

	        $sub_menus['yani_permalinks'] = array(
	            'yani_dashboard',
	            esc_html__( 'Permalinks', 'houzez' ),
	            esc_html__( 'Permalinks', 'houzez' ),
	            'manage_options',
	            'yani_permalinks',
	            array( 'yani_Permalinks', 'render' )
	        );
	    }

	    // Add filter for third party uses
        $sub_menus = apply_filters( 'yani_admin_sub_menus', $sub_menus, 20 );


        $sub_menus['documentation'] = array(
            'yani_dashboard',
            esc_html__( 'Documentation', 'houzez' ),
            esc_html__( 'Documentation', 'houzez' ),
            'manage_options',
            'yani_help',
            array( $this, 'documentation' ),
        );

        $sub_menus['feedback'] = array(
            'yani_dashboard',
            esc_html__( 'Feedback', 'houzez' ),
            esc_html__( 'Feedback', 'houzez' ),
            'manage_options',
            'yani_feedback',
            array( $this, 'feedback' ),
        );

		if ( class_exists( 'OCDI_Plugin' ) && class_exists(_yani_theme()->get_text_domain()) && yani_theme_verified() ) {
			$sub_menus['demo_import'] = array(
				'yani_dashboard',
				esc_html__( 'Demo Import', 'houzez' ),
				esc_html__( 'Demo Import', 'houzez' ),
				'manage_options',
				'admin.php?page=houzez-one-click-demo-import',
			);
		}

        if ( $sub_menus ) {
            foreach ( $sub_menus as $sub_menu ) {
                call_user_func_array( 'add_submenu_page', $sub_menu );
            }
        }
	}
	public function add_theme_caps() {
        
        // gets the author role
        $role = get_role('administrator');

        $role->add_cap('create_properties');

        $role->add_cap('publish_properties');
        $role->add_cap('read_property');
        $role->add_cap('delete_property');
        $role->add_cap('edit_property');
        $role->add_cap('edit_properties');
        $role->add_cap('delete_properties');
        $role->add_cap('edit_published_properties');
        $role->add_cap('delete_published_properties');
        $role->add_cap('read_private_properties');
        $role->add_cap('delete_private_properties');
        $role->add_cap('edit_others_properties');
        $role->add_cap('delete_others_properties');
        $role->add_cap('edit_private_properties');
        $role->add_cap('delete_private_properties');
        $role->add_cap('edit_published_properties');

        $role->add_cap('delete_user_package');
        $role->add_cap('delete_user_packages');
        $role->add_cap('edit_user_packages');
        $role->add_cap('delete_others_user_packages');

        $role->add_cap('read_testimonial');
        $role->add_cap('edit_testimonial');
        $role->add_cap('delete_testimonial');
        $role->add_cap('create_testimonials');
        $role->add_cap('publish_testimonials');
        $role->add_cap('edit_testimonials');
        $role->add_cap('edit_published_testimonials');
        $role->add_cap('delete_published_testimonials');
        $role->add_cap('delete_testimonials');
        $role->add_cap('delete_private_testimonials');
        $role->add_cap('delete_others_testimonials');
        $role->add_cap('edit_others_testimonials');
        $role->add_cap('edit_private_testimonials');
        $role->add_cap('edit_published_testimonials');

        $role->add_cap('read_agent');
        $role->add_cap('delete_agent');
        $role->add_cap('edit_agent');
        $role->add_cap('create_agents');
        $role->add_cap('edit_agents');
        $role->add_cap('edit_others_agents');
        $role->add_cap('publish_agents');
        $role->add_cap('read_private_agents');
        $role->add_cap('delete_agents');
        $role->add_cap('delete_private_agents');
        $role->add_cap('delete_published_agents');
        $role->add_cap('delete_others_agents');
        $role->add_cap('edit_private_agents');
        $role->add_cap('edit_published_agents');

        // gets the author role
        $role = get_role('editor');

        $role->add_cap('create_properties');

        $role->add_cap('read_property');
        $role->add_cap('delete_property');
        $role->add_cap('edit_property');
        $role->add_cap('publish_properties');
        $role->add_cap('edit_properties');
        $role->add_cap('edit_published_properties');
        $role->add_cap('delete_published_properties');
        $role->add_cap('read_private_properties');
        $role->add_cap('delete_private_properties');
        $role->add_cap('edit_others_properties');
        $role->add_cap('delete_others_properties');
        $role->add_cap('edit_private_properties');
        $role->add_cap('edit_published_properties');

        $role->add_cap('read_testimonial');
        $role->add_cap('delete_testimonial');
        $role->add_cap('edit_testimonial');
        $role->add_cap('create_testimonials');
        $role->add_cap('delete_testimonial');
        $role->add_cap('publish_testimonials');
        $role->add_cap('edit_testimonials');
        $role->add_cap('edit_published_testimonials');
        $role->add_cap('delete_published_testimonials');
        $role->add_cap('delete_testimonials');
        $role->add_cap('delete_private_testimonials');
        $role->add_cap('delete_others_testimonials');
        $role->add_cap('edit_others_testimonials');
        $role->add_cap('edit_private_testimonials');
        $role->add_cap('edit_published_testimonials');

        $role->add_cap('read_agent');
        $role->add_cap('delete_agent');
        $role->add_cap('edit_agent');
        $role->add_cap('create_agents');
        $role->add_cap('edit_agents');
        $role->add_cap('edit_others_agents');
        $role->add_cap('publish_agents');
        $role->add_cap('read_private_agents');
        $role->add_cap('delete_agents');
        $role->add_cap('delete_private_agents');
        $role->add_cap('delete_published_agents');
        $role->add_cap('delete_others_agents');
        $role->add_cap('edit_private_agents');
        $role->add_cap('edit_published_agents');

        // $role = get_role('yani_agent');
        // $role->add_cap('level_2');

        // $agency_role = get_role('yani_agency');
        // $agency_role->add_cap('level_2');

        // $owner_role = get_role('yani_owner');
        // $owner_role->add_cap('level_2');

        // $seller_role = get_role('yani_seller');
        // $seller_role->add_cap('level_2');

        // $manager_role = get_role('yani_manager');
        // $manager_role->add_cap('level_5');


    }
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

return yani_Admin::instance();
?>
