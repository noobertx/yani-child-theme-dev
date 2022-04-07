<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Login & Register', $theme_text_domain ),
    'id'               => 'header-login-register',
    'subsection'       => false,
    'desc'             => '',
    'icon'   => 'el-icon-lock-alt el-icon-small',
    'fields'           => array(
        array(
            'id'       => 'header_login',
            'type'     => 'switch',
            'title'    => esc_html__( 'Login', $theme_text_domain ),
            'subtitle' => esc_html__( 'Display the login in the header', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'header_register',
            'type'     => 'switch',
            'title'    => esc_html__( 'Register', $theme_text_domain ),
            'subtitle' => esc_html__( 'Display the register in the header', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'login_register_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Login, register type', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'as_icon'   => esc_html__( 'Show as Icon', $theme_text_domain ),
                'as_text'    => esc_html__( 'Show as Text', $theme_text_domain )
            ),
            'default'  => 'as_icon'
        ),

        array(
            'id'       => 'header_loggedIn',
            'type'     => 'switch',
            'title'    => esc_html__( 'Logged In Menu', $theme_text_domain ),
            'subtitle' => esc_html__( 'Disable LoggedIn menu', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'register_first_name',
            'type'     => 'switch',
            'title'    => esc_html__( 'First Name', $theme_text_domain ),
            'subtitle' => esc_html__( 'Show first name field for register form', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'register_last_name',
            'type'     => 'switch',
            'title'    => esc_html__( 'Last Name', $theme_text_domain ),
            'subtitle' => esc_html__( 'Show last name field for register form', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'register_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Phone Number', $theme_text_domain ),
            'subtitle' => esc_html__( 'Show phone number field for register form', $theme_text_domain ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
            'default'  => 0
        ),

        array(
            'id'       => 'enable_password',
            'type'     => 'select',
            'title'    => esc_html__( 'Users can type the password on registration form', $theme_text_domain ),
            'subtitle' => esc_html__('If no, users will get the auto generated password via email', $theme_text_domain),
            'options'   => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'    => esc_html__( 'No', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),

        array(
            'id'       => 'user_as_agent',
            'type'     => 'select',
            'title'    => esc_html__( 'Frontend register user as agent or agency', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'    => esc_html__( 'No', $theme_text_domain )
            ),
            'desc'     => esc_html__( 'If set to "Yes" then every user register from front-end role Agent will be auto create in agent custom post type and role Agency will be auto create in agency custom post type', $theme_text_domain ),
            'default'  => 'yes'
        ),

        array(
            'id'       => 'realtor_visible',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent/Agency Visibility', $theme_text_domain ),
            'subtitle' => esc_html__( 'Front-end registered agent/agency should not show automatically on front-end', $theme_text_domain ),
            'on'       => esc_html__( 'Not Show', $theme_text_domain ),
            'off'      => esc_html__( 'Show', $theme_text_domain ),
            'required' => array('user_as_agent', '=', 'yes'),
            'default'  => 0
        ),

        array(
            'id'       => 'login_redirect',
            'type'     => 'select',
            'title'    => esc_html__( 'After Login Redirect Page', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'same_page'   => esc_html__( 'Current Page', $theme_text_domain ),
                'diff_page'    => esc_html__( 'Different Page', $theme_text_domain )
            ),
            'default'  => 'same_page'
        ),
        array(
            'id'       => 'login_redirect_link',
            'type'     => 'text',
            'required' => array('login_redirect', '=', 'diff_page' ),
            'title'    => esc_html__( 'Enter Redirect Page Link', $theme_text_domain ),
            'subtitle' => esc_html__( 'This must be a URL.', $theme_text_domain ),
            'desc'     => '',
            'validate' => 'url',
            'default'  => '',
        ),

        array(
            'id'       => 'login_terms_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions', $theme_text_domain ),
            'subtitle' => esc_html__( 'Select which page to use for Terms & Conditions', $theme_text_domain ),
            'desc'     => '',
        ),
        array(
            'id'       => 'facebook_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Facebook ?', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'    => esc_html__( 'No', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),
        array(
            'id'       => 'facebook_api_key',
            'type'     => 'text',
            'required' => array( 'facebook_login', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Api key', $theme_text_domain ),
            'subtitle' => esc_html__( 'Facebook Api key for facebook login', $theme_text_domain ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'facebook_secret',
            'type'     => 'text',
            'required' => array( 'facebook_login', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Secret Code', $theme_text_domain ),
            'subtitle' => esc_html__( 'Facebook secret code for facebook login', $theme_text_domain ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'google_login',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Google ?', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'    => esc_html__( 'No', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => 'no'
        ),
        array(
            'id'       => 'google_client_id',
            'type'     => 'text',
            'required' => array( 'google_login', '=', 'yes' ),
            'title'    => esc_html__( 'Google OAuth Client ID', $theme_text_domain ),
            'subtitle' => esc_html__( 'Google oAuth client id for google login', $theme_text_domain ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'google_secret',
            'type'     => 'text',
            'required' => array( 'google_login', '=', 'yes' ),
            'title'    => esc_html__( 'Google Client Secret', $theme_text_domain ),
            'subtitle' => esc_html__( 'Google client secret code for google login', $theme_text_domain ),
            'desc'     => '',
            'default'  => ''
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'User Roles', $theme_text_domain ),
    'id'               => 'header-user-roles',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(

        array(
            'id'       => 'user_show_roles',
            'type'     => 'switch',
            'title'    => esc_html__( 'Registration Form', $theme_text_domain ),
            'subtitle' => esc_html__( 'If enabled, the registration form displays a drop-down menu with the list of user roles', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the user role selection on the register form', $theme_text_domain ),
        ),
        array(
            'id'       => 'user_show_roles_profile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable user roles on profile page', $theme_text_domain ),
            'subtitle' => esc_html__( 'If enabled, it allow users to change role from their profile page', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the user role selection on the profile page', $theme_text_domain ),
        ),
        array(
            'id'       => 'show_hide_roles',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Enable/Disable User Roles', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which user roles you want to disable', $theme_text_domain),
            'options'  => array(
                'agent' => esc_html__('Agent', $theme_text_domain),
                'agency' => esc_html__('Agency', $theme_text_domain),
                'owner' => esc_html__('Owner', $theme_text_domain),
                'buyer' => esc_html__('Buyer', $theme_text_domain),
                'seller' => esc_html__('Seller', $theme_text_domain),
                'manager' => esc_html__('Manager', $theme_text_domain)
            ),
            'default' => array(
                'agent' => '0',
                'agency' => '0',
                'owner' => '0',
                'buyer' => '0',
                'seller' => '0',
                'manager' => '0'
            )
        ),
        array(
            'id'       => 'agent_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Agent Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the agent role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the agent role (Default is Agent)', $theme_text_domain ),
            'default'  => esc_html__( 'Agent', $theme_text_domain ),
        ),
        array(
            'id'       => 'agency_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Agency Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the agency role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the agncy role (Default: Agency)', $theme_text_domain ),
            'default'  => esc_html__( 'Agency', $theme_text_domain ),
        ),
        array(
            'id'       => 'owner_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Owner Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the owner role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the owner role (Default: Owner)', $theme_text_domain ),
            'default'  => esc_html__( 'Owner', $theme_text_domain ),
        ),
        array(
            'id'       => 'buyer_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Buyer Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the buyer role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the buyer role (Default: Buyer)', $theme_text_domain ),
            'default'  => esc_html__( 'Buyer', $theme_text_domain ),
        ),
        array(
            'id'       => 'seller_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Seller Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the seller role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the seller role (Default: Seller)', $theme_text_domain ),
            'default'  => esc_html__( 'Seller', $theme_text_domain ),
        ),
        array(
            'id'       => 'manager_role',
            'type'     => 'text',
            'title'    => esc_html__( 'Manager Role', $theme_text_domain ),
            'subtitle' => esc_html__( 'Change the default name of the manager role', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter a name for the manager role (Default: Manager)', $theme_text_domain ),
            'default'  => esc_html__( 'Manager', $theme_text_domain ),
        ),
    )
) );
