<?php if( is_active_sidebar( 'primary-sidebar') ) { ?>
	<aside role="complementary" class="sidebar w-25 ">	
		<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</aside>	
<?php } ?>