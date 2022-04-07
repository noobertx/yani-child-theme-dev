<?php 
global $yani_local;
$service_area = get_post_meta( get_the_ID(), 'yani_agent_service_area', true );

if( !empty( $service_area ) ) { ?>
	<li>
		<strong><?php echo $yani_local['service_area']; ?>:</strong> 
		<?php echo esc_attr( $service_area ); ?>
	</li>
<?php } ?>