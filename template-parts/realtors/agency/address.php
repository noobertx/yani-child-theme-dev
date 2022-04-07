<address>
<?php 
$agency_address = get_post_meta( get_the_ID(), 'yani_agency_address', true );
if(!empty($agency_address)) {
	echo '<i class="yani-icon icon-pin"></i> '.$agency_address;
}
?>
</address>