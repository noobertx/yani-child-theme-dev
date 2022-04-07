<?php 
global $yani_local;
$agency_mobile = get_post_meta( get_the_ID(), 'yani_agency_mobile', true );
$agency_mobile_call = str_replace(array('(',')',' ','-'),'', $agency_mobile);
if( !empty( $agency_mobile ) ) { ?>
	<li>
		<strong><?php echo $yani_local['mobile_colon']; ?></strong> 
		<a href="tel:<?php echo esc_attr($agency_mobile_call); ?>">
			<span class="agent-phone <?php yani_show_phone(); ?>"><?php echo esc_attr( $agency_mobile ); ?></span>
		</a>
	</li>
<?php } ?>