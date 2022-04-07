<?php
/*
We Need Actionbar Option
*/
?>

<div id="action-bar">
    <div class="container">
        <div class="column one">            
            <?php 
                get_template_part('template-parts/header/partials/slogan'); 
                if (has_nav_menu('social-menu')) {
                    // mfn_wp_social_menu();
                } else {
                    get_template_part('template-parts/header/partials/social-icons'); 
                }
            ?>
        </div>
    </div>
</div>


<?php if(_yani_theme()->get_header_style(true) == 'header-overlay'){ ?>
    <div id="header-overlay-wrap">
        <div class="close-wrapper">
            <a href="#" class="close">
                <i class="yani-icon icon-close"></i>
            </a>
        </div>
        <div class="menu-wrapper">
            <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1">
                <?php get_template_part('template-parts/header/partials/nav'); ?>
            </nav><!-- main-nav -->
        </div>
    </div>

    <a class="side-slide-toggle" data-target="header-overlay-wrap" href="#" aria-label="Mobile menu">
        <i class="yani-icon icon-navigation-menu" aria-hidden="true"></i>
    </a>

<?php } ?>
<div class="header_placeholder"></div>
<?php if(_yani_theme()->get_header_style(true) != 'header-overlay'){ ?>
<div id="top-bar" class="loading navbar-dark bg-dark">
    <div class="container">
        <div class="column one">

            <div class="header-inner-wrap">

                <div class="navbar d-flex align-items-center">
                    <?php get_template_part('template-parts/header/partials/logo'); ?>

                    <?php if(_yani_theme()->get_header_style(true) != 'header-simple'){ ?>
                        <div class="menu-wrapper">
                            <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1 ">
                                <?php get_template_part('template-parts/header/partials/nav'); ?>
                            </nav><!-- main-nav -->
                        </div>
                    <?php } ?>

                    <div class="secondary-menu-wrapper">
                        <?php get_template_part('template-parts/header/user-nav'); ?>
                        <?php if(_yani_theme()->get_header_style(true) == 'header-simple'){ ?>
                        <a class="responsive-menu-toggle side-slide-toggle" data-target="side-slide-simple" href="#" aria-label="Mobile menu"><i class="yani-icon icon-navigation-menu" aria-hidden="true"></i></a>
                        <?php } ?>

                    </div>

                    <div class="banner-wrapper">
                        <?php //echo wp_kses_post(mfn_opts_get('header-banner')); ?>
                    </div>

                </div><!-- navbar -->

                <?php
                    // if (! mfn_opts_get('top-bar-right-hide')) {
                        
                    // }
                ?>
                <!-- <div class="top_bar_right">RIGHT</div> -->
                <!-- <div class="search_wrapper "> -->
                    <?php
                        // get_search_form(true);
                        // if ( mfn_opts_get('header-search-live') ) {
                           //get_template_part('template-parts/search/main'); 
                        // }
                    ?>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<?php } ?>