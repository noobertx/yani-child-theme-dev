<?php 
global $yani_local;
$agency_email = get_post_meta( get_the_ID(), 'yani_agency_email', true );

if( !empty( $agency_email ) ) { ?>
    <li class="email">
    	<strong><?php echo $yani_local['email_colon']; ?></strong> 
    	<a href="mailto:<?php echo esc_attr( $agency_email ); ?>"><?php echo esc_attr( $agency_email ); ?></a>
    </li>
<?php } ?>