<?php 
global $yani_local;
$agency_tax_no = get_post_meta( get_the_ID(), 'yani_agency_tax_no', true );

if( !empty( $agency_tax_no ) ) { ?>
	<li>
		<strong><?php echo $yani_local['tax_number']; ?>:</strong> 
		<?php echo esc_attr( $agency_tax_no ); ?>
	</li>
<?php } ?>