<footer class="post__footer">
	<?php
		if(has_category()){
			echo '<div class="post__cats">';
			$cats_list = get_the_category_list(esc_html__(',','_themename'));

			printf(esc_html__('Posted in %s','_themename'),$cats_list);
			echo "</div>";
		}
	?>
	<?php
		if(has_tag()){ ?>
			<?php 
			echo '<div class="post__tags">';					
			$tag_list = get_the_tag_list("<ul></li>","<li></li>","<ul></ul");
			echo $tag_list;
			echo "</div>";
		}
	?>
</footer>