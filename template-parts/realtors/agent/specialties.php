<?php 
global $yani_local;
$agent_specialties = get_post_meta( get_the_ID(), 'yani_agent_specialties', true );

if( !empty( $agent_specialties ) ) { ?>
	<li>
		<strong><?php echo $yani_local['specialties_label']; ?>:</strong> 
		<?php echo esc_attr( $agent_specialties ); ?>
	</li>
<?php } ?>