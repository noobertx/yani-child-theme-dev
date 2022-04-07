<?php
require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/custom-sanitizers.php");
require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/custom-validators.php");
class _themename_Customize {
   public static function register ( $wp_customize ) {

   	$wp_customize->get_setting('blogname')->transport = 'postMessage';
     
   	$wp_customize->selective_refresh->add_partial('blogname',array(
   		// 'settings' =>('blogname'),
   		'selector' => "#header-section .logo span.h1",
   		'container_inclusive' => false,
   		'render_callback' => function(){
   			get_bloginfo('name');
   		}
   	));

   	$wp_customize->selective_refresh->add_partial('_themename_footer_partial',array(
   		'settings' => array('set_copyright_text','set_footer_bg','set_footer_layout'),
   		'selector' => "#site-footer",
   		'container_inclusive' => false,
   		'render_callback' => function(){
   			get_template_part('template-parts/footer/widgets'); 
   			get_template_part('template-parts/footer/info');
   		}
   	));

   	$wp_customize->selective_refresh->add_partial('_themename_header_partial',array(
   		'settings' => array('set_header_bg'),
   		'selector' => ".header-main-wrap",
   		'container_inclusive' => false,
   		'render_callback' => function(){
   			 get_template_part('template-parts/header/header', '4' ); 
             get_template_part('template-parts/header/header-mobile'); 
   		}
   	));
      
      
	
	require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/sec_slider.php");
	require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/featured-products.php");
	require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/header-options.php");     
	require_once(YANI_THEME_CUSTOMIZER_OPTIONS."/footer-options.php");     




   }

   public static function render_setting($wp_customize,$collection,$section,$transport = "refresh"){
   	foreach($collection as $item){
			foreach($item['fields'] as $name=>$field){
				if(empty($field['validate_callback'])){
					$field['validate_callback'] = "";
				}

				if(empty($field['sanitize_callback'])){
					$field['sanitize_callback'] = "";
				}

				if(!empty($field['transport'])){
					$transport  = $field['transport'] ;
				}

				$wp_customize->add_setting(
					$name,array(
						'type'	=> 'theme_mod',
						'default'	=> $field['default'],
						'sanitize_callback'	=> $field['sanitize_callback'],
						'validate_callback'	=> $field['validate_callback'],
						'transport' => $transport
					)
				);

				if($field['type']=="select"){					
					$wp_customize->add_control(
						$name,array(
							'label'	=> $field['label'],
							'description'	=> $field['description'],
							'section'	=> $section,
							'type'	=> $field['type'],
							'choices'	=> $field['choices'],
						)
					);
				}
				else if($field['type']=="color"){					
					$wp_customize->add_control( 
						new WP_Customize_Color_Control( $wp_customize, $name, array(
        				'label' => $field['label'],
        				'section' => $section,
        				'settings' => $name
 					    ))
					);
				}
				else{
					$wp_customize->add_control(
						$name,array(
							'label'	=> $field['label'],
							'description'	=> $field['description'],
							'section'	=> $section,
							'type'	=> $field['type'],
						)
					);
				}


			}
		}
   }
   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
           <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
           <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
           <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( '_themename_Customize' , 'register' ) );

// Output custom CSS to live site
// add_action( 'wp_head' , array( '_themename_Customize' , 'header_output' ) );

// // Enqueue live preview javascript in Theme Customizer admin screen
// add_action( 'customize_preview_init' , array( '_themename_Customize' , 'live_preview' ) );