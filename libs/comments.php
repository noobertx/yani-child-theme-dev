<?php 
function _themename_comment_callback($comment,$args,$depth){
	$tag = ($args['style'] == "div") ? "div" : "li";
	?>
	<<?php echo $tag;?> <?php comment_class('comment-item',$comment->comment_parent ? 'comment--child' : 't');?>>
		<article class="comment__body" id="div-commen-<?php comment_ID();?>">
			<?php echo ($args["avatar_size"] != 0 ) ? get_avatar($comment,$args["avatar_size"],false,false,array("class"=>"comment__avatar")): "" ; ?>

			<?php edit_comment_link(esc_html__('Edit Comment','_themename'),'<span class="comment__edit--link">','</span');?>
			<div class="comment__content">
				<div class="comment__author">
					<?php echo get_comment_author_link($comment);?>
				</div>
			<a href="<?php echo esc_url(get_comment_link($comment,$args));?>" class="comment__time">
				<time datetime="<?php comment_time('c');?>">
					 <?php 
					 	printf(esc_html('%s ago','_themename'),human_time_diff(get_comment_time("U"),current_time("U")));
					 ?>
				</time> 
			</a>
			</div>
			<?php if($comment->comment_approved == "0"){ ?>
				<p class="comment__awaiting-moderation">
					<?php
						esc_html_e("Comment is awaiting moderation","_themename")
					?>
				</p>	
			<?php } ?>
			<?php if($comment->comment_type =="" || ($comment->comment_type == "pingback" || $comment->comment_type == "trackback") && !$args['short_ping']){
			 		comment_text();
			} ?>
			<?php comment_reply_link(array_merge($args,array(
				'depth'=> $depth,
				'max_depth'=> $args['max_depth'],
				'reply_text'=> "Reply",
				'add_bellow'=> 'div-comment',
				'before'=> '<div class="comment__reply-link">',
				'after'=> '</div>',

			)));?>
		</article>
	</<?php echo $tag;?>>
	<?php 

}


	// awesome semantic comment

	function better_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		if ( 'article' == $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		}

		?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">

		<div class="comment-blocks ">	
			<div class="comment-top d-flex">
				
				<figure class="gravatar">
				<?php // echo get_avatar( $comment, 65, 'http://hey.georgie.nu/wp-content/themes/heygeorgie/images/bg.png', 'Author’s gravatar' ); ?>

				<?php echo ($args["avatar_size"] != 0 ) ? get_avatar($comment,$args["avatar_size"],false,false,array("class"=>"comment__avatar")): "" ; ?>
					
				</figure>
					
				<div class="comment-meta post-meta mx-3" role="complementary">
					<div class="comment-meta-wrap d-flex align-items-center">						
						<h2 class="comment-author">
							<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
						</h2>

						<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a> </time>
						<?php edit_comment_link('<p class="comment-meta-item"> Edit this comment</p>','',''); ?>
						<?php if ($comment->comment_approved == '0') : ?>
						<p class="comment-meta-item"> Your comment is awaiting moderation.</p>
						<?php endif; ?>


					</div>
					<div class="comment-content" itemprop="text">
						<?php comment_text() ?>					
					</div>
				</div>
			</div>
			<hr>
			<div class="comment-content-opr ">			
				<div class="comment-reply float-right">
						<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
			</div>



		</div>


		<?php }

	// end of awesome semantic comment

	function better_comment_close() {
		echo '</article>';
	}
?>