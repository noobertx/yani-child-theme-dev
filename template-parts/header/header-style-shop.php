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
<div class="header-placeholder"></div>
<div id="top-bar" class="loading">
	<div class="container">
		<div class="column one">
			<div class="top-bar-row top-bar-row-first clearfix">
				<?php get_template_part('template-parts/header/partials/logo'); ?>
				<?php get_template_part('template-parts/topbar/partials/top-bar','right'); ?>
			</div>
			<div class="top-bar-row top-bar-row-second clearfix">
				<div class="menu-wrapper">
                    <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1 navbar-dark bg-dark">
                        <?php get_template_part('template-parts/header/partials/nav'); ?>
                    </nav><!-- main-nav -->
                </div>
			</div>
 			<div class="search-wrapper">
                <?php get_template_part('template-parts/search/main'); ?> 				
 			</div>
		</div>
	</div>
</div>