	<header id="header">
			<div class="row">
				<div class="header-main brand col-md-3 col-12 col-lg-3 text-center text-md-left">
					<div class="branding">	
						<?php
							if( function_exists( 'the_custom_logo' ) ) {
							    if(has_custom_logo()) {
							        the_custom_logo();
							    } else { ?>		        
							    	
						<div class="square bg-primary"></div>
						<div class="square bg-secondary"></div>
						<div class="square bg-accent"></div>
						<div class="square bg-light"></div>
						<div class="square bg-dark"></div>
							    <?php }
							}
						?>
					</div>
				</div>
				<div class="header-bottom col-10 col-lg-10">	
					<div class="row">	
						<div class="navigation-wrap">			
							<div class="navigation">
								<div class="">
									<nav class="navbar navbar-expand-lg">
									  <div class="">
									    <button 
									    class="navbar-toggler" 
									    type="button" 
									    data-bs-toggle="collapse" 
									    data-bs-target="#bs-example-navbar-collapse-1" 
									    aria-controls="bs-example-navbar-collapse-1" 
									    aria-expanded="false" 
									    aria-label="<?php __('Toggle navigation','_themename'); ?>">
									      <span class="navbar-toggler-icon"></span>
									    </button>
									    <?php
												wp_nav_menu(
													array(
														'theme_location'	=> 'main-menu',
														'depth'				=> 2,
														'container'			=> 'div',
														'container_class'	=> 'collapse navbar-collapse',
														'container_id'		=> 'bs-example-navbar-collapse-1',
														'menu_class'		=> 'nav navbar-nav',
														'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
														'walker' 			=> new WP_Bootstrap_Navwalker()
													)
												);
											?>
									  </div>
									</nav>
								<!-- <nav class="header-nav navbar navbar-expand-md" role="navigation">
										<button 
										class="navbar-toggler" 
										type="button" 
										data-toggle="collapse" 
										data-target="#bs-example-navbar-collapse-1"
										aria-controls="bs-example-navbar-collapse-1"
										aria-expanded="false"
										aria-label="Toggle navigation"
										>									
											<span class="navbar-toggler-icon"></span>
										</button>							
										<?php
											// wp_nav_menu(
											// 	array(
											// 		'theme_location'	=> 'main-menu',
											// 		'depth'				=> 4,
											// 		'container'			=> 'div',
											// 		'container_class'	=> 'collapse navbar-collapse',
											// 		'container_id'		=> 'bs-example-navbar-collapse-1',
											// 		'menu_class'		=> 'nav navbar-nav',
											// 		'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
											// 		'walker' 			=> new WP_Bootstrap_Navwalker()
											// 	)
											// );
										?>
								</nav> -->
							</div>
								<!-- <nav class="header-nav" role="navigation" aria-label="<?php esc_html__('Main Navigation','_themename')?>">
									<?php 
									//	wp_nav_menu(array('theme_location'=>'main-menu'));
									?>
								</nav> -->
						</div>
					</div>
				</div>
				<div class="header-widget-wrap">
					<a href="#" class="nav-search-field-toggler js-search-trigger" data-toggle="nav-search-feild">
						<i class="far fa-search"></i>
					</a>

					<?php if(class_exists('woocommerce')) { ?>
					<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ,'_themename'); ?>">
						<i class="far fa-shopping-cart"></i>
						<span class="items"></span>
					</a>
					
					<div class="dropdown _themename-account">
						<a href = "#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton">
							<i class="far fa-user"></i>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php if(is_user_logged_in()) { ?>
							<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" ><?php _e('My Account','_themename'); ?></a>
							<a href="<?php echo esc_url(wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id')))); ?>" ><?php _e('Logout','_themename');?></a>
							<?php }else{ ?>
							<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" ><?php _e('Sign In','_themename'); ?></a>
							<?php } ?>
						</div>
					</div>
					<?php } ?>


				</div>
			</div>	
		</div>
	</header>