<?php
$wp_customize->add_section( 'sec_featured_products', 
        	array(
            'title'       => __( 'Products and Blog', '_themename' ), //Visible title of section
            'priority'    => 10, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Featured Products and Blog Settings.', '_themename'), //Descriptive tooltip
        	) 
      	);
      	

		
      	$settings = [
			[
				'fields' => [
					'max_popular_num'=>[
						'type' => 'number',
						'label'	=> 'Popular Products Max Number',
						'description'	=> 'Popular Products Max Number',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_popular_cols'=>[
						'type' => 'number',
						'label'	=> 'Popular Products Max Columns',
						'description'	=> 'Popular Products Max Columns',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_new_products_num'=>[
						'type' => 'number',
						'label'	=> 'New Arrival Products Max Number',
						'description'	=> 'New Arrival Products Max Number',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'max_new_products_cols'=>[
						'type' => 'number',
						'label'	=> 'New Arrival Products Max Columns',
						'description'	=> 'New Arrival Products Max Columns',
						'default'=>'4',
						'sanitize_callback'=>'absint',
					],
					'deal_of_the_week'=>[
						'type' => 'number',
						'label'	=> 'Deal of the Week Product ID',
						'description'	=> 'Product ID',
						'default'=>'',
						'sanitize_callback'=>'absint',
					],
				]
			],
		];

		_themename_Customize::render_setting($wp_customize,$settings,'sec_featured_products');
?>