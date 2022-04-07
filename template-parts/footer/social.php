<?php if( yani_option('social-footer') != '0' ) { ?>
<div class="footer-social">

	<?php 
	$text_facebook = $text_twitter = $text_instagram = $text_linkedin = $text_googleplus = $text_youtube = $text_pinterest = $text_yelp = $text_behance = '';

	$icons_class = "mr-2";
	if(yani_option('ft-bottom') == 'v2') {
		$text_facebook = esc_html__('Facebook', _yani_theme()->get_text_domain()); 
		$text_twitter = esc_html__('Twitter', _yani_theme()->get_text_domain());
		$text_instagram = esc_html__('Instagram', _yani_theme()->get_text_domain()); 
		$text_linkedin = esc_html__('Linkedin', _yani_theme()->get_text_domain());
		$text_googleplus = esc_html__('Google +', _yani_theme()->get_text_domain());
		$text_youtube = esc_html__('Youtube', _yani_theme()->get_text_domain());
		$text_pinterest = esc_html__('Pinterest', _yani_theme()->get_text_domain());
		$text_yelp = esc_html__('Yelp', _yani_theme()->get_text_domain());
		$text_behance = esc_html__('Behance', _yani_theme()->get_text_domain());
	}

	if(yani_option('ft-bottom') == 'v3') {
		$icons_class = "";
	}
	?>

	<?php if( yani_option('fs-facebook') != '' ){ ?>
	<span>
		<a class="btn-facebook" target="_blank" href="<?php echo esc_url(yani_option('fs-facebook')); ?>">
			<i class="yani-icon icon-social-media-facebook <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_facebook; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-twitter') != '' ){ ?>
	<span>
		<a class="btn-twitter" target="_blank" href="<?php echo esc_url(yani_option('fs-twitter')); ?>">
			<i class="yani-icon icon-social-media-twitter <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_twitter; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-googleplus') != '' ){ ?>
	<span>
		<a class="btn-googleplus" target="_blank" href="<?php echo esc_url(yani_option('fs-googleplus')); ?>">
			<i class="yani-icon icon-social-media-google-plus-1 <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_googleplus; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-linkedin') != '' ){ ?>
	<span>
		<a class="btn-linkedin" target="_blank" href="<?php echo esc_url(yani_option('fs-linkedin')); ?>">
			<i class="yani-icon icon-professional-network-linkedin <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_linkedin; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-instagram') != '' ){ ?>
	<span>
		<a class="btn-instagram" target="_blank" href="<?php echo esc_url(yani_option('fs-instagram')); ?>">
			<i class="yani-icon icon-social-instagram <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_instagram; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-pinterest') != '' ){ ?>
	<span>
		<a class="btn-pinterest" target="_blank" href="<?php echo esc_url(yani_option('fs-pinterest')); ?>">
			<i class="yani-icon icon-social-pinterest <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_pinterest; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-yelp') != '' ){ ?>
	<span>
		<a class="btn-yelp" target="_blank" href="<?php echo esc_url(yani_option('fs-yelp')); ?>">
			<i class="yani-icon icon-social-media-yelp <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_yelp; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-behance') != '' ){ ?>
	<span>
		<a class="btn-behance" target="_blank" href="<?php echo esc_url(yani_option('fs-behance')); ?>">
			<i class="yani-icon icon-designer-community-behance <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_behance; ?>
		</a>
	</span>
	<?php } ?>

	<?php if( yani_option('fs-youtube') != '' ){ ?>
	<span>
		<a class="btn-youtube" target="_blank" href="<?php echo esc_url(yani_option('fs-youtube')); ?>">
			<i class="yani-icon icon-social-video-youtube-clip <?php echo esc_attr($icons_class); ?>"></i> <?php echo $text_youtube; ?>
		</a>
	</span>
	<?php } ?>


</div>
<?php
}
?>