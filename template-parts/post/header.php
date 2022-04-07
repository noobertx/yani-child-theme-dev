	<div class="post__header">
		
	<h2>
		<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"> <?php the_title(); ?></a>
	</h2>
	<div class="post-thumbnail">
		<?php
			if(has_post_thumbnail()): 
				the_post_thumbnail('medium',['class'=>'img-fluid']);
			endif;
		?>
	</div>	
	<div>
		Posted on 
		<a href="<?php echo get_permalink()?>">
			<time date-time="<?echo get_the_date("c");?>">
				<?php echo get_the_date();?>
			</time>
		</a>
		By 
		<a href="<?echo get_author_posts_url(get_the_author_meta('ID'));?>">
			<?php echo get_the_author();?>
		</a>

		<?php if(has_category()): ?>
		Categories <span><?php the_category('');?></span>
		<?php endif;?>
		<?php if(has_tag()): ?>
		Tags <span><?php the_tags('',',');?></span>
		<?php endif;?>
	</div>
	</div>