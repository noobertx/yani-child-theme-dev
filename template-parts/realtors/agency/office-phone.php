<?php 
global $yani_local;
$agency_phone = get_post_meta( get_the_ID(), 'yani_agency_phone', true );
$agency_office_call = str_replace(array('(',')',' ','-'),'', $agency_phone);

if( !empty($agency_phone) ) { ?>
    <li>
    	<strong><?php echo $yani_local['office_colon']; ?></strong> 
    	<a href="tel:<?php echo esc_attr($agency_office_call); ?>">
	    	<span class="agent-phone <?php yani_show_phone(); ?>"><?php echo esc_attr( $agency_phone ); ?></span>
	    </a>
    </li>
<?php } ?>