<?php 
global $yani_local;
$languages = get_post_meta( get_the_ID(), 'yani_agency_language', true );

if( !empty( $languages ) ) { ?>
	<p>
		<i class="yani-icon icon-messages-bubble mr-1"></i>
		<strong><?php echo $yani_local['languages']; ?>:</strong> 
		<?php echo esc_attr( $languages ); ?>
	</p>
<?php } ?>