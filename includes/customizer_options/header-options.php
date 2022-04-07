<?php
$wp_customize->add_section( 'sec_header_options', 
        	array(
            'title'       => __( 'Header', '_themename' ), //Visible title of section
            // 'priority'    => 10, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Header Layout and Nav', '_themename'), //Descriptive tooltip

        	) 
      	);
      	

		
      	$settings = [
			[
				'fields' => [
					'set_header_bg'=>[
						'type' => 'select',
						'label'	=> 'Header Background',
						'description'	=> '',
						'default'=>'dark',
						'sanitize_callback'=>'_themename_sanitize_footer_bg',
						'choices' => array(
							'light' => "Light",
							'dark' => "Dark",
						)
					],
					'set_header_links_color'=>[
						'type' => 'color',
						'label'	=> 'Header Link Color',
						'description'	=> '',
						'default'=>'#fff',
						'sanitize_callback'=>'sanitize_hex_color',
						'transport' => "postMessage",
					],
				]
			],
		];



		_themename_Customize::render_setting($wp_customize,$settings,'sec_header_options','postMessage');

		
?>