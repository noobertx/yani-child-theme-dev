<?php 
global $yani_local;
$agent_fax = get_post_meta( get_the_ID(), 'yani_agent_fax', true );

if(is_author()) {
	global $current_author_meta;
	$agent_fax = isset($current_author_meta['yani_author_fax'][0]) ? $current_author_meta['yani_author_fax'][0] : '';
}

$agent_fax_call = str_replace(array('(',')',' ','-'),'', $agent_fax);
if( !empty( $agent_fax ) ) { ?>
	<li>
		<strong><?php echo $yani_local['fax_colon']; ?></strong> 
		<a href="fax:<?php echo esc_attr($agent_fax_call); ?>">
			<span><?php echo esc_attr( $agent_fax ); ?></span>
		</a>
	</li>
<?php } ?>