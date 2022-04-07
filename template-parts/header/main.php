<?php
 if(_yani_theme()->get_header_style(true) == 'header-creative'){
    get_template_part('template-parts/header/header', 'creative');
}
?>
<div id="wrapper">    
    <header class="header-main-wrap <?php _yani_template()->get_transparent(); ?>">

        <?php
            if(_yani_theme()->get_header_style(true) != 'header-creative'){
                if(_yani_theme()->get_header_style(true) == 'header-shop'){

                    get_template_part('template-parts/header/header-style', 'shop');
                }else{                    
                    // get_template_part('template-parts/topbar/top', 'area');
                   
                    $header = _yani_theme()->get_option('header_style'); 
                    if(empty($header) || _yani_template()->is_splash()) {
                        $header = '4';
                    }
                    get_template_part('template-parts/header/header', $header ); 
                    get_template_part('template-parts/header/header-mobile'); 
                }
            }           
        ?>
    </header><!-- .header-main-wrap -->
</div>