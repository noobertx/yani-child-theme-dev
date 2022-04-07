<?php
$blog_date = _yani_theme()->get_option('blog_date');
$blog_author = _yani_theme()->get_option('blog_author');
?>
<div class="blog-post-item blog-post-item-v1">

	<?php if( _yani_theme()->get_option('blog_featured_image', 1 ) ) { ?>
	<div class="blog-post-thumb">
		<a href="<?php echo esc_url(get_permalink()); ?>" class="hover-effect">
			<?php the_post_thumbnail('houzez-image_masonry', array('class' => 'img-fluid')); ?>
		</a>
	</div><!-- blog-post-thumb -->
	<?php } ?>
	
	<div class="blog-post-content-wrap">
		<div class="blog-post-meta">
			<ul class="list-inline">

				<?php if( $blog_date != 0 ) { ?>
				<li class="list-inline-item">
					<time datetime="<?php esc_attr( the_time( get_option( 'date_format' ) ));?>"><i class="yani-icon icon-attachment mr-1"></i> <?php esc_attr( the_time( get_option( 'date_format' ) ));?></time>
				</li>
				<?php } ?>

				<li class="list-inline-item">
					<i class="yani-icon icon-tags mr-1"></i></span> <?php the_category(', '); ?>
				</li>
			</ul>
		</div><!-- blog-post-meta -->
		<div class="blog-post-title">
			<h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
		</div><!-- blog-post-title -->
		<div class="blog-post-body">
			<?php echo _yani_post()->get_excerpt( 95, 'false' ); ?>
		</div><!-- blog-post-body -->
		<div class="blog-post-link">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html__('Continue Reading', _yani_theme()->get_text_domain()); ?></a>
		</div><!-- blog-post-link -->
	</div><!-- blog-post-content-wrap -->

	<?php if( $blog_author != 0 ) { ?>
	<div class="blog-post-author">
		<i class="yani-icon icon-single-neutral mr-1"></i> <?php echo esc_html__('by', _yani_theme()->get_text_domain()); ?> <?php the_author(); ?>
	</div>
	<?php } ?>

</div><!-- blog-post-item -->