<?php

function yani_switch_view_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);
	$listing_view = 'list-view-v1';
	if($listing_view == 'list-view-v1') {
	    $wrap_class = 'listing-v1';
	    $item_layout = 'v1';
	    $view_class = 'list-view';

	} elseif($listing_view == 'grid-view-v1') {
	    $wrap_class = 'listing-v1';
	    $item_layout = 'v1';
	    $view_class = 'grid-view';

	} elseif($listing_view == 'list-view-v2') {
	    $wrap_class = 'listing-v2';
	    $item_layout = 'v2';
	    $view_class = 'list-view';

	} elseif($listing_view == 'grid-view-v2') {
	    $wrap_class = 'listing-v2';
	    $item_layout = 'v2';
	    $view_class = 'grid-view';

	} elseif($listing_view == 'grid-view-v3') {
	    $wrap_class = 'listing-v3';
	    $item_layout = 'v3';
	    $view_class = 'grid-view';
	    $have_switcher = false;

	} elseif($listing_view == 'grid-view-v4') {
	    $wrap_class = 'listing-v4';
	    $item_layout = 'v4';
	    $view_class = 'grid-view';
	    $have_switcher = false;

	} elseif($listing_view == 'list-view-v5') {
	    $wrap_class = 'listing-v5';
	    $item_layout = 'v5';
	    $view_class = 'list-view';

	} elseif($listing_view == 'grid-view-v5') {
	    $wrap_class = 'listing-v5';
	    $item_layout = 'v5';
	    $view_class = 'grid-view';

	} elseif($listing_view == 'grid-view-v6') {
	    $wrap_class = 'listing-v6';
	    $item_layout = 'v6';
	    $view_class = 'grid-view';
	    $have_switcher = false;

	} 

	ob_start();
	?>
	<div class="page-title-wrap">
            <div class="d-flex align-items-center">
	<div class="listing-switch-view">
	<ul class="list-inline">
		<li class="list-inline-item">
			<a class="switch-btn btn-list">
				<i class="yani-icon icon-layout-bullets"></i>
			</a>
		</li>
		<li class="list-inline-item">
			<a class="switch-btn btn-grid">
				<i class="yani-icon icon-layout-module-1"></i>
			</a>
		</li>
	</ul>
	</div>
	</div>
	</div>
	<div class="listing-view <?php echo esc_attr($view_class); ?>" data-layout="<?php echo esc_attr($item_layout); ?>">
		<div id="yani_ajax_container">
        	<div class="card-deck">
        		<?php
        			$listings = [
        				['id'=>2725,'title'=>"Property 1"],
        				['id'=>4396,'title'=>"Property 2"],
        				['id'=>2687,'title'=>"Property 3"],
        				['id'=>2677,'title'=>"Property 4"],
        				['id'=>2669,'title'=>"Property 5"],
        				['id'=>4392,'title'=>"Property 6"]
        			];
        		?>
        		<?php foreach($listings as $listing_item){ ?>
        		<div class="item-listing-wrap hz-item-gallery-js card">
        			<div class="item-wrap item-wrap-v1 item-wrap-no-frame h-100">
						<div class="d-flex align-items-center h-100">
							<div class="item-header">
								<span class="label-featured label"></span>
								<a href="#" class="label-status label status-color-1">
					                Status
            					</a>
            					<a href="'.get_term_link($label_id).'" class="hz-label label label-color-1">
               						Label
            					</a>
            					<ul class="item-price-wrap hide-on-list">
            						$50
								</ul>
								<ul class="item-tools">
						            <li class="item-tool item-preview">
						                <span class="hz-show-lightbox-js" data-listid="<?php echo $listing_item['id'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo _yani_theme()->get_option('cl_preview', 'Preview'); ?>">
						                        <i class="yani-icon icon-expand-3"></i>   
						                </span><!-- item-tool-favorite -->
						            </li><!-- item-tool -->
						            
						            <li class="item-tool item-favorite">
						                <span class="add-favorite-js item-tool-favorite" data-toggle="tooltip" data-placement="top" title="<?php echo _yani_theme()->get_option('cl_favorite', 'Favourite'); ?>" data-listid="<?php echo $listing_item['id'];?>">
						                    <i class="yani-icon icon-love-it some-icon"></i> 
						                </span><!-- item-tool-favorite -->
						            </li><!-- item-tool -->
						            <li class="item-tool item-compare">
						                <span class="yani_compare compare-<?php echo $listing_item['id'];?> item-tool-compare show-compare-panel" data-toggle="tooltip" data-placement="top" title="<?php echo _yani_theme()->get_option('cl_add_compare', 'Add to Compare'); ?>" data-listing_id="<?php echo $listing_item['id'];?>" >
						                    <i class="yani-icon icon-add-circle"></i>
						                </span><!-- item-tool-compare -->
						            </li><!-- item-tool -->
						        </ul><!-- item-tools -->   

						        <div class="listing-image-wrap">
									<div class="listing-thumb">
										<a href="#" class="listing-featured-thumb hover-effect">
											<?php echo get_the_post_thumbnail($listing_item['id']);?>
										</a><!-- hover-effect -->
									</div>
								</div>
							</div>
							<div class="item-body flex-grow-1">
								<h2 class="item-title">
									<a href="#"><?php echo $listing_item['title']; ?></a>									
								</h2><!-- item-title -->
								<address class="item-address">
									#11 Brooksport Some City At A Country
								</address>
								<!--Amenities-->
								<a class="btn btn-primary btn-item" href="#">Details</a><!-- btn-item -->
								<!--Author-->
								<!--Date-->
							</div>
							<div class="item-footer clearfix">
							</div>
						</div>
					</div>
        		</div>
        		<?php } ?>

            </div>
        </div>
	</div>
	<?php
	return ob_get_clean();

}
add_shortcode( "yani_switch_view", "yani_switch_view_callback" );

?>
