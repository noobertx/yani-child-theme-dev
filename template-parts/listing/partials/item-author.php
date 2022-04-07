<?php 
global $post;
$listing_agent = _yani_property()->get_property_agent( $post->ID ); 

if(_yani_theme()->get_option('disable_agent', 1) && !empty($listing_agent)) { ?>
<div class="item-author">
	<i class="yani-icon icon-single-neutral mr-1"></i>
	<?php echo implode( ', ', $listing_agent ); ?>
</div><!-- item-author -->
<?php } ?>