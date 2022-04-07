<?php

 //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'sec_slider', 
         array(
            'title'       => __( 'Slider Options', '_themename' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for MyTheme.', '_themename'), //Descriptive tooltip
         ) 
      );

      
$settings = [
			[
				'fields' => [
					'set_slider_page1'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 1',
						'description'	=> 'Set Slider Page 1',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text1'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 1',
						'description'	=> 'Button Text for Page 1',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url1'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 1',
						'description'	=> 'Button URL for Page 1',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
			[
				'fields' => [
					'set_slider_page2'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 2',
						'description'	=> 'Set Slider Page 2',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text2'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 2',
						'description'	=> 'Button Text for Page 2',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url2'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 2',
						'description'	=> 'Button URL for Page 2',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
			[
				'fields' => [
					'set_slider_page3'=>[
						'type' => 'dropdown-pages',
						'label'	=> 'Set Slider Page 3',
						'description'	=> 'Set Slider Page 3',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
					'set_slider_button_text3'=>[
						'type' => 'text',
						'label'	=> 'Button Text for Page 3',
						'description'	=> 'Button Text for Page 3',
						'default'=>'',
						'sanitize_callback'=>'sanitize_text_field',
					],
					'set_slider_button_url1'=>[
						'type' => 'url',
						'label'	=> 'Button URL for Page 3',
						'description'	=> 'Button URL for Page 3',
						'default'=>'',
						'sanitize_callback'=>'esc_url_raw',
					],
				]
			],
		];

		_themename_Customize::render_setting($wp_customize,$settings,'sec_slider');


?>