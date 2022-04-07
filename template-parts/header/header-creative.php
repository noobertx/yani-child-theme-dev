<div id="header-creative">
	<div class="header-creative-panel">		
		<?php
			 if(!in_array(_yani_theme()->get_header_style(), array( 'header-open' ))){		?>
				<a href="#" class="side-slide-toggle" data-target="side-creative-panel">
					<i class="yani-icon icon-navigation-menu" aria-hidden="true"></i>
				</a>
		<?php } ?>
		<div class="creative-social">
			<?php
				get_template_part('template-parts/header/partials/social-icons'); 
			?>
		</div>
		<div class="header-placeholder"></div>
	</div>


	<div class="header-creative-panel" id="side-creative-panel" data-width="250">
		<div id="top-bar">
			<div class="one clearfix">
				<div class="top-bar-left">
					<?php get_template_part('template-parts/header/partials/logo'); ?>

					<div class="menu-wrapper">
	                    <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1">
	                        <?php get_template_part('template-parts/header/partials/nav'); ?>
	                    </nav><!-- main-nav -->
	                </div>

	                <div class="search-wrapper">
	                	<?php get_template_part('template-parts/search/search-for-banners'); ?>
	                </div>
				</div>
				<div id="top-bar-right">
					
				</div>
				<div class="banner-wrapper">
					
				</div>
			</div>
		</div>
		<div id="action-bar" class="creative">
			<?php get_template_part('template-parts/header/partials/slogan'); ?>
			<?php get_template_part('template-parts/header/partials/social-icons');  ?>
		</div>
	</div>

</div>