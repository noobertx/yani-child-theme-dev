<?php
global $post;
$size = 'full';
$properties_images = rwmb_meta( 'yani_property_images', 'type=plupload_image&size='.$size, $post->ID );
$userID      =   get_current_user_id();
$fav_option = 'yani_favorites-'.$userID;
$fav_option = get_option( $fav_option );
$lightbox_logo = yani_option( 'lightbox_logo', false, 'url' );
$lightbox_agent_cotnact = yani_option('agent_form_gallery');
$lightbox_caption = yani_option('lightbox_caption', 0); 

$lightbox_class = "";
if(!$lightbox_agent_cotnact) {
	$lightbox_class = "lightbox-gallery-full-wrap";
}

$icon = $key = '';
if( !empty($fav_option) ) {
    $key = array_search($post->ID, $fav_option);
}
if( $key != false || $key != '' ) {
    $icon = 'text-danger';
}
?>
<div class="property-lightbox">
	<div class="modal fade" id="property-lightbox" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="d-flex align-items-center">

						<?php if( !empty( $lightbox_logo ) ) { ?>
						<div class="lightbox-logo">
							<img class="img-fluid" src="<?php echo esc_url( $lightbox_logo ); ?>" alt="<?php the_title(); ?>">
						</div><!-- lightbox-logo -->
						<?php } ?>

						<div class="lightbox-title flex-grow-1">
							
						</div><!-- lightbox-title  -->
						<div class="lightbox-tools">
							<ul class="list-inline">
								<?php if( yani_option('prop_detail_favorite') != 0 ) { ?>
								<li class="list-inline-item btn-favorite">
									<a class="add-favorite-js" data-listid="<?php echo intval($post->ID)?>" href="#"><i class="yani-icon icon-love-it mr-2 <?php echo esc_attr($icon); ?>"></i> <span class="display-none"><?php esc_html_e('Favorite', _yani_theme()->get_text_domain()); ?></span></a>
								</li>
								<?php } ?>

								<?php if( yani_option('prop_detail_share') != 0 ) { ?>
								<li class="list-inline-item btn-share">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="yani-icon icon-share mr-2"></i> <span><?php esc_html_e('Share', _yani_theme()->get_text_domain()); ?></span></a>
									<div class="dropdown-menu dropdown-menu-right item-tool-dropdown-menu">
										<?php get_template_part('property-details/partials/share'); ?>
									</div>
								</li>
								<?php } ?>
								<li class="list-inline-item btn-email">
									<a href="#"><i class="yani-icon icon-envelope"></i></a>
								</li>
							</ul>
						</div><!-- lightbox-tools -->
					</div><!-- d-flex -->
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div><!-- modal-header -->

				<div class="modal-body clearfix">
					<div class="lightbox-gallery-wrap <?php echo esc_attr($lightbox_class); ?>">
						
						<?php 
						if($lightbox_agent_cotnact) { ?>
						<a class="btn-expand">
							<i class="yani-icon icon-expand-3"></i>
						</a>
						<?php } ?>
						
						<?php  if( !empty($properties_images) && count($properties_images)) { ?>
						<div class="lightbox-gallery">
						    <div id="lightbox-slider-js" class="lightbox-slider">
						        
						        <?php
						        foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
						       		$output = '';
						            $output .= '<div>';
								        $output .= '<img class="img-fluid" src="'.esc_url( $prop_image_meta['full_url'] ).'" alt="'.esc_attr($prop_image_meta['alt']).'" title="'.esc_attr($prop_image_meta['title']).'">';

								        if( !empty($prop_image_meta['caption']) && $lightbox_caption != 0 ) {
									        $output .= '<span class="hz-image-caption">'.esc_attr($prop_image_meta['caption']).'</span>';
									    }

								    $output .= '</div>';

								    echo $output;
						        }
						        ?>
						        
						    </div>
						</div><!-- lightbox-gallery -->
						<?php } else { 
			                $featured_image_url = yani_get_image_url('full');
			                echo '<div>
			                    <img class="img-fluid" src="'.esc_url($featured_image_url[0]).'">
			                </div>';
			            } ?>

					</div><!-- lightbox-gallery-wrap -->

					<?php 
					if($lightbox_agent_cotnact) { ?>
					<div class="lightbox-form-wrap">
						<?php get_template_part('property-details/agent-form'); ?>
					</div><!-- lightbox-form-wrap -->
					<?php } ?>
				</div><!-- modal-body -->
				<div class="modal-footer">
					
				</div><!-- modal-footer -->
			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
</div><!-- property-lightbox -->

