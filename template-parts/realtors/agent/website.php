<?php 
$agent_website = get_post_meta( get_the_ID(), 'yani_agent_website', true );

if(is_author()) {
	global $author_website;
	$agent_website = $author_website;
}

if( !empty( $agent_website ) ) { ?>
	<li>
		<strong><?php esc_html_e('Website', _yani_theme()->get_text_domain()); ?></strong> 
		<a target="_blank" href="<?php echo esc_url($agent_website); ?>"><?php echo esc_attr( $agent_website ); ?></a>
	</li>
<?php } ?>