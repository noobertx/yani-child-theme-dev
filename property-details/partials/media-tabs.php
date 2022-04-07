<?php
global $post, $top_area, $map_street_view;
$featured_image = _yani_image()->get_image_url('full');
$featured_image_url = $featured_image[0];

if( ! has_post_thumbnail( $post->ID ) || get_the_post_thumbnail($post->ID) == "" ) {
	$featured_image_url = _yani_image()->get_image_placeholder_url('full');
}



$gallery_active = $map_active = $street_active = "";
$active_tab = _yani_theme()->get_option('prop_default_active_tab', 'image_gallery');
if( $active_tab == 'map_view' ) {
	$map_active = 'show active';

} elseif( $active_tab == 'street_view' ) {
	$street_active = 'show active'; 
} else {
	$gallery_active = 'show active';
}


if($top_area == 'v2') { ?>
	<div class="tab-pane <?php echo esc_attr($gallery_active); ?>" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" style="background-image: url(<?php echo esc_url($featured_image_url); ?>);">
		<?php get_template_part('property-details/partials/image-count'); ?>	
		<div class="d-flex page-title-wrap page-label-wrap">
			<div class="container">
			<?php get_template_part('property-details/partials/item-labels'); ?>
			</div>
		</div>
		<?php get_template_part('property-details/property-title'); ?> 
		<a class="property-banner-trigger" data-toggle="modal" data-target="#property-lightbox" href="#"></a>
	</div>

<?php } elseif($top_area == 'v3' || $top_area == 'v4') { ?>

	<div class="tab-pane <?php echo esc_attr($gallery_active); ?>" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
		<?php get_template_part('property-details/partials/gallery'); ?>
	</div>

<?php } elseif($top_area == 'v5') { ?>

	<div class="tab-pane <?php echo esc_attr($gallery_active); ?>" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
		<?php get_template_part('property-details/partials/image-count'); ?>
		<?php get_template_part('property-details/partials/gallery-variable-width'); ?>
	</div>

<?php } else { ?>

	<div class="tab-pane <?php echo esc_attr($gallery_active); ?>" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" style="background-image: url(<?php echo esc_url($featured_image_url); ?>);">
		<?php get_template_part('property-details/partials/image-count'); ?>
		<?php 
		if(_yani_theme()->get_option('agent_form_above_image')) {
			get_template_part('property-details/agent-form'); 
		}?>

		<a class="property-banner-trigger" data-toggle="modal" data-target="#property-lightbox" href="#"></a>
	</div>

<?php } ?>

<?php if( !_yani_map()->is_map_in_section() ) { ?>
<div class="tab-pane <?php echo esc_attr($map_active); ?>" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
	<?php get_template_part('property-details/partials/map'); ?>
</div>

<?php if(_yani_map()->get_map_system() == 'google' && $map_street_view != 'hide' ) { ?>
	<div class="tab-pane <?php echo esc_attr($street_active); ?>" id="pills-street-view" role="tabpanel" aria-labelledby="pills-street-view-tab">
	</div>
	<?php } ?>
<?php } ?>





