<?php 
global $yani_local;
$agent_email = get_post_meta( get_the_ID(), 'yani_agent_email', true );

if(is_author()) {
	global $author_email;
	$agent_email = $author_email;
}

if( !empty( $agent_email ) ) { ?>
    <li class="email">
    	<strong><?php echo $yani_local['email_colon']; ?></strong> 
    	<a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a>
    </li>
<?php } ?>