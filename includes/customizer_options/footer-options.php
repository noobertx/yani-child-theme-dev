<?php
$wp_customize->add_section( 'sec_footer_options', 
        	array(
            'title'       => __( 'Footer Options', '_themename' ), //Visible title of section
            // 'priority'    => 10, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Copyright and Map Settings', '_themename'), //Descriptive tooltip

        	) 
      	);
      	

		
      	$settings = [
			[
				'fields' => [
					'set_copyright_text'=>[
						'type' => 'text',
						'label'	=> 'Copyright Text',
						'description'	=> '',
						'default'=>'Copyright All Rights Reserved',
						'sanitize_callback'=>'_themename_sanitize_site_info'
					],
					'set_footer_bg'=>[
						'type' => 'select',
						'label'	=> 'Footer Background',
						'description'	=> '',
						'default'=>'dark',
						'sanitize_callback'=>'_themename_sanitize_footer_bg',
						'choices' => array(
							'light' => "Light",
							'dark' => "Dark",
						)
					],
					'set_footer_layout'=>[
						'type' => 'select',
						'label'	=> 'Footer Layout',
						'description'	=> '',
						'default'=>'3,3,3,3',
						'sanitize_callback'=>'sanitize_text_field',
						// 'validate_callback'=>'_themename_validate_footer_layout',
						'choices' => array(
							'0' => "3,3,3,3",
							'1' => "4,4,4",
						)
					],
					'set_footer_links_color'=>[
						'type' => 'color',
						'label'	=> 'Footer Link Color',
						'description'	=> '',
						'default'=>'#fff',
						'sanitize_callback'=>'sanitize_hex_color',
						'transport' => "postMessage",
					],
				]
			],
		];



		_themename_Customize::render_setting($wp_customize,$settings,'sec_footer_options','postMessage');

		
?>