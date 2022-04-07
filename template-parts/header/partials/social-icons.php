<?php if( _yani_theme()->get_option('social-header') != '0' ): ?>
<div class="header-social-icons">
	<ul class="list-inline">
		
		<?php if( _yani_theme()->get_option('hs-facebook') != '' ) { ?>
		<li class="list-inline-item">
			<a target="_blank" class="btn-square btn-facebook" href="<?php echo esc_url(_yani_theme()->get_option('hs-facebook')); ?>">
				<i class="yani-icon icon-social-media-facebook"></i>
			</a>
		</li><!-- .facebook -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-twitter') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-twitter" href="<?php echo esc_url(_yani_theme()->get_option('hs-twitter')); ?>">
				<i class="yani-icon icon-social-media-twitter"></i>
			</a>
		</li><!-- .twitter -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-googleplus') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-google-plus" href="<?php echo esc_url(_yani_theme()->get_option('hs-googleplus')); ?>">
				<i class="yani-icon icon-social-media-google-plus-1"></i>
			</a>
		</li><!-- .google-plus -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-linkedin') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-linkedin" href="<?php echo esc_url(_yani_theme()->get_option('hs-linkedin')); ?>">
				<i class="yani-icon icon-professional-network-linkedin"></i>
			</a>
		</li><!-- .linkedin -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-instagram') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-instagram" href="<?php echo esc_url(_yani_theme()->get_option('hs-instagram')); ?>">
				<i class="yani-icon icon-social-instagram"></i>
			</a>
		</li><!-- .instagram -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-pinterest') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-pinterest" href="<?php echo esc_url(_yani_theme()->get_option('hs-pinterest')); ?>">
				<i class="yani-icon icon-social-pinterest"></i>
			</a>
		</li><!-- .pinterest -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-youtube') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-youtube" href="<?php echo esc_url(_yani_theme()->get_option('hs-youtube')); ?>">
				<i class="yani-icon icon-social-video-youtube-clip"></i>
			</a>
		</li><!-- .youtube -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-yelp') != '' ){ ?>
		 <li class="list-inline-item">
			<a target="_blank" class="btn-square btn-yelp" href="<?php echo esc_url(_yani_theme()->get_option('hs-yelp')); ?>">
				<i class="yani-icon icon-social-media-yelp"></i>
			</a>
		</li><!-- .yelp -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hs-behance') != '' ){ ?>
		<li class="list-inline-item">
			<a target="_blank" class="btn-square btn-behance" href="<?php echo esc_url(_yani_theme()->get_option('hs-behance')); ?>">
				<i class="yani-icon icon-designer-community-behance"></i>
			</a>
		</li><!-- .behance -->
		<?php } ?>
	</ul>
</div><!-- .header-social-icons -->
<?php endif; ?>