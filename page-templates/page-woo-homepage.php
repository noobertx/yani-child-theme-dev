<?php
/*
Template Name:Woocommerce Homepage Page
*/

?>

<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?> full-width-page">

<main >
	<section class="main-slider">

		<div class="slick page-slider">
			<?php for($i =1; $i<4 ; ++$i){ 
				$slider_page[$i] 		= get_theme_mod('set_slider_page'.$i);
				$slider_button_text[$i] = get_theme_mod('set_slider_button_text'.$i);
				$slider_button_url[$i] 	= get_theme_mod('set_slider_button_url'.$i);
			?>
			<?php } ?>

			<?php
				$j = 1;
				$args = [
					'post_type' => "page",
					'post_per_page' => 3,
					'post__in' => $slider_page,
					'orderby' => "post__in",
				];

				$slider_loop = new WP_Query($args);

				if($slider_loop->have_posts()){
					while($slider_loop->have_posts()){
						$slider_loop->the_post();
						?>
							<div style="background-image:url('<?php echo get_the_post_thumbnail_url(get_the_ID());?>');background-size:cover;">															
								
								<div class="container">
									<div class="slider-details-container">
										<div class="slide-title">
											<h1><?php the_title();?></h1>
										</div>
										<div class="slide-description">
											<div class="subtitle">
												<?php //the_excerpt();?>
											</div>
											<a href="<?php echo $slider_button_url[$j] ?>" class="btn bg-secondary light"><?php echo $slider_button_text[$j] ?></a>
										</div>
									</div>
								</div>
							</div>
						<?php
						++$j ;
					}
					wp_reset_postdata();
				}
			?>
		</div>
	</section>	

	<div class="page__content">
		<?php
		if(class_exists('woocommerce')): 
			$popular_limit 		= get_theme_mod('max_popular_num',4);
			$popular_cols 		= get_theme_mod('max_popular_cols',4);
			$popular_cols  = (intval($popular_cols) <= 0) ? $popular_cols : 4;
			$new_arrival_limit 		= get_theme_mod('max_new_products_num',4);
			$new_arrival_cols 		= get_theme_mod('max_new_products_cols',4);
			$new_arrival_cols  = (intval($new_arrival_cols) <= 0) ? $new_arrival_cols : 4;
			$deal_of_the_week 		= get_theme_mod('deal_of_the_week',0);

			$currency = get_woocommerce_currency_symbol();
			if($deal_of_the_week != 0) {		
				$deal_product = wc_get_product( $deal_of_the_week );	
			}
		?>

		<?php if($popular_limit!=0): ?>
		<section class="popular-products">
			<div class="container">
				<h2 class="text-center">Popular Products</h2>
				<div class="row">
					<?php echo do_shortcode('[products limit="'.$popular_limit.'" orderby="popularity" columns="'.$popular_cols.'"] ');?>
				</div>
			</div>
		</section>
		<?php endif;?>

		<?php if($new_arrival_limit!=0): ?>
		<section class="new-arrivals">
			<div class="container">
				<h2 class="text-center">New Arrivals</h2>
				<div class="row">
					<?php echo do_shortcode('[products limit="'.$new_arrival_limit.'" orderby="date" columns="'.$new_arrival_cols.'"] ');?>
				</div>
			</div>
		</section>
		<?php endif;?>
		<?php if($deal_of_the_week!=0): ?>
		<section class="deal-of-the-week">
			<div class="container">
				<h2 class="text-center">Deal of the Week</h2>
				<?php
				$sale = $deal_product->get_sale_price();
				$regular = $deal_product->get_regular_price();
				$sale = (!empty($sale)) ? $sale : 0;

				$discount_percentage = absint(($sale / $regular)*100);
				// echo "Sale".$sale. "<br>Regular ".$regular." Discount ".$discount_percentage;

				?>
				<div class="row d-flex align-items-center">
					<div class="deal-img ml-auto col-md-6 col-12 text-center">
						<?php echo get_the_post_thumbnail($deal_of_the_week,"large",["class"=>"img-fluid"]);?>
					</div>
					<div class="deal-desc mr-auto  col-md-6 col-12 text-center">
						<?php if ($discount_percentage >= 0 ):?>
							<span class="discount"><?php echo $discount_percentage;?> % OFF</span>
						<?php endif; ?>
						<h3>
							<a href="<?php echo get_the_permalink($deal_of_the_week); ?>">
								<?php echo get_the_title($deal_of_the_week); ?>									
							</a>
						</h3>
						<p><?php echo get_the_excerpt($deal_of_the_week); ?></p>
						<div class="prices">
							<span class="regular">
								<?php echo $currency.$regular; ?>
							</span>
							<?php if($sale):?>
							<span class="sale">
								<?php echo $currency.$sale; ?>								
							</span>
						<?php endif;?>
						</div>
						<a href="<?php echo esc_url('?add-to-cart='.$deal_of_the_week); ?>" class="add-to-cart btn bg-primary">Add To Cart</a>
					</div>
				</div>
			</div>
		</section>
		<?php endif;?>
		<?php endif;?>
		<section class="_themename-blogs">
			<div class="container">
				<h2 class="text-center"><?php echo get_theme_mod('set_blog_title','News From Our Blog');?></h2>
				<div class="row">
					<?php
						$args = [
							'posts' => 2,
							'posts_per_page'=>'2',
							'orderby' => 'date',
						];

						$blogs = new WP_Query($args);
						if($blogs->have_posts()):
							while($blogs->have_posts()): $blogs->the_post(); ?>
								<div class="col-md-4 col-12 text-center">
									<article>										
										<?php if(has_post_thumbnail()) :
											the_post_thumbnail('medium',['class'=>'img-fluid']);
										endif;?>
										<h3><?php echo get_the_title();?></h3>
										<p><?php echo wp_trim_words( get_the_excerpt(), 15	 ); ?></p>
										<a href="<?php echo esc_url(get_the_permalink())?>" class="btn-sm bg-secondary light">Read More</a>
									</article>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
					?>
				</div>
			</div>
		</section>
		<?php the_content();?>
	</div>
</main>

</div>

<?php get_footer();?>