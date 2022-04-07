<?php $sticky_header = _yani_theme()->get_option('main-menu-sticky', 0); ?>
<div class="header-desktop header-v2">
    <div class="header-top">
        <div class="container">
            <div class="header-inner-wrap">
                <div class="navbar d-flex align-items-center">
                    <?php get_template_part('template-parts/header/partials/logo'); ?>

                    <?php get_template_part('template-parts/header/partials/contact-info'); ?>
                </div><!-- navbar -->
            </div>
        </div>
    </div><!-- .header-top -->
    asdasdasd
    <div id="header-section" class="header-bottom" data-sticky="<?php echo intval($sticky_header); ?>">
        <div class="container">
            <div class="header-inner-wrap">
                <div class="navbar d-flex align-items-center">
                    
                    <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1 navbar-dark bg-dark">
                        <?php get_template_part('template-parts/header/partials/nav'); ?>
                    </nav><!-- main-nav -->
                    
                    <?php get_template_part('template-parts/header/user-nav'); ?>

                </div><!-- navbar -->
            </div>
        </div>
    </div><!-- .header-bottom -->
</div><!-- .header-v2 -->

<div class="header-v2 header-v2-mobile">
    <?php get_template_part('template-parts/header/partials/contact-info'); ?>   
</div><!-- header-v2-mobile -->