<?php if(_yani_theme()->get_option('disable_date', 1)) { ?>
<div class="item-date">
	<i class="yani-icon icon-attachment mr-1"></i>
	<?php printf( esc_html__( '%s ago', 'houzez' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
</div><!-- item-date -->
<?php } ?>