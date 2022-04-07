<?php 
global $yani_local;
$agent_licenses = get_post_meta( get_the_ID(), 'yani_agent_license', true );

if( !empty( $agent_licenses ) ) { ?>
	<li>
		<strong><?php echo $yani_local['agent_license']; ?>:</strong> 
		<?php echo esc_attr( $agent_licenses ); ?>
	</li>
<?php } ?>