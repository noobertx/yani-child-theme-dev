<?php
	if(post_password_required()){
		return ;
	}

?>
<section>	
<div id="comments container mx-auto" class="comments">
	<?php if(have_comments()){ ?>
		<h2 class="comments_title">
			<?php 
				printf(
					esc_html(_n('%1$s Reply to "%2$s"','%1$s Replies to "%2$s"',get_comments_number().'_themename'
				)),
				number_format_i18n(get_comments_number()),
				get_the_title());
			?>
		</h2>

		<ul class="comments__list">
			
		<?php if(! comments_open() && get_comments_number()){?>
			<p class="comments__closed">
				<?php
					esc_html_e('Comments are closed for this post','_themename');
				?>
			</p>	
			<?php }else{

			 ?>
		<?php 
		wp_list_comments(array(
			'style' => 'li',
			'avatar_size'=>50,
			'reply_text' => __('Reply','_themename'),
			 'callback' => 'better_comment'

		));
		}
		?>
		</ul>
	<?php the_comments_pagination(); ?>
	<?php comment_form(); ?>
	<?php } ?>
</div>
</section>

