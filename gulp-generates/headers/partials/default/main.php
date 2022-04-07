
<div id="wrapper">    
    <header class="header-main-wrap <?php //_yani_template()->get_transparent(); ?>">
        <?php                                
            get_template_part('template-parts/topbar/top', 'area');      
            $header = _themename_theme()->get_option('header_style'); 
            
            if(empty($header) || _themename_template()->is_splash()) {
                $header = '4';
            }
            
            get_template_part('template-parts/header/header-1'); 
            get_template_part('template-parts/header/header-mobile');               
        ?>
    </header><!-- .header-main-wrap -->
</div>