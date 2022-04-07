    <div class="item-listing-parallax" style="height: 600px;">
    	<a class="item-listing-parallax-link" href="#"></a>
		<div class="item-parallax-inner parallax" data-parallax-bg-image="http://riseup.local/wp-content/uploads/2021/02/pexels-sam-lion-5709296-scaled.jpg">
			<div class="item-parallax-wrap" data-aos="fade">
				<?php
					echo '<span class="label-featured label">'._yani_theme()->get_option('cl_featured_label', esc_html__( 'Featured', 'houzez' )).'</span>';

					echo '<a href="#" class="label-status label status-color-1">
					Status Label Here
					</a>';
				?>
				<h2 class="item-title">
					<a href="#">A Parallax Demo</a>
				</h2><!-- item-title -->
				<address class="item-address">#11 Brooksport Some City At A Country</address>
				<ul class="item-price-wrap hide-on-list">
					<li class="item-price item-price-text price-single-listing-text">20000</li>
					<span class="price-prefix">$ </span>
				</ul>
			</div><!-- item-parallax-wrap -->
		</div><!-- parallax -->
	</div><!-- item-listing-parallax -->