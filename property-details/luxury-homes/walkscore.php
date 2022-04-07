<?php
$yani_walkscore = yani_option('yani_walkscore');
$yani_walkscore_api = yani_option('yani_walkscore_api');

if( $yani_walkscore != 0 && $yani_walkscore_api != '' ) {
?>
<div class="fw-property-walkscore-wrap fw-property-section-wrap" id="property-walkscore-wrap">
	<div class="block-wrap">
		<div class="block-content-wrap">

			<?php yani_walkscore($post->ID); ?>

		</div><!-- block-content-wrap -->
	</div><!-- block-wrap -->
</div><!-- fw-property-walkscore-wrap -->
<?php } ?>