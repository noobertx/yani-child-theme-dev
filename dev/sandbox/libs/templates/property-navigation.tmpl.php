<?php 
$property_layout = "simple";
$layout = [
    "unit"=>"unit",
    "description"=>"description",
    "address"=>"address",
    "details"=>"details",
    "energy_class"=>"energy_class",
    "features"=>"features",
    "floor_plans"=>"floor_plans",
    "video"=>"video",
    // "walkscore"=>"walkscore",
    // "yelp_nearby"=>"yelp_nearby",
    "virtual_tour"=>"virtual_tour",
    "schedule_tour"=>"schedule_tour",
    // "mortgage_calculator-beta"=>"mortgage_calculator-beta",
    "review"=>"review",   
    // "similar_properties"=>"similar_properties"
]
?>
<div class="property-navigation-wrap">
	<div class="container-fluid">
		<ul class="property-navigation list-unstyled d-flex justify-content-between">
			<li class="property-navigation-item">
				<a class="back-top" href="#main-wrap">
					<i class="yani-icon icon-arrow-button-circle-up"></i>
				</a>
			</li>
			<?php
            if ($layout): foreach ($layout as $key=>$value) {

                switch($key) {

                    case 'unit':

                        $multi_units  = _yani_property_listing()->get_listing_data('multi_units');
                        if( isset($multi_units[0]['yani_mu_title']) && !empty( $multi_units[0]['yani_mu_title'] ) ) {
                        echo '<li class="property-navigation-item">
							<a class="target" href="#property-sub-listings-wrap">' . _yani_theme()->get_option('sps_sub_listings', 'Sub Listings') . '</a>
						</li>';
                        }
                        break;

                    case 'description':
                        
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-description-wrap">' . _yani_theme()->get_option('sps_description', 'Description') . '</a>
							</li>';
                        break;


                    case 'address':
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-address-wrap">'._yani_theme()->get_option('sps_address', 'Address').'</a>
							</li>';
                        break;

                    case 'details':
                        
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-detail-wrap">' . _yani_theme()->get_option('sps_details', 'Details') . '</a>
							</li>';
                        break;

                    case 'energy_class':
                        
                        $energy_class = _yani_property_listing()->get_listing_data('energy_class');
                        if(!empty($energy_class)) {
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-energy-class-wrap">' . _yani_theme()->get_option('sps_energy_class', 'Energy Class') . '</a>
							</li>';
                        }
                        break;

                    case 'features':
                        
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-features-wrap">' . _yani_theme()->get_option('sps_features', 'Features') . '</a>
							</li>';
                        break;

                    case 'floor_plans':
                        
                        if( isset($floor_plans[0]['yani_plan_title']) && !empty( $floor_plans[0]['yani_plan_title'] ) ) {
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-floor-plans-wrap">'._yani_theme()->get_option('sps_floor_plans', 'Floor Plans').'</a>
							</li>';
                        }
                        break;

                    case 'video':
                        if( !empty( $prop_video_url )) {
                        	echo '<li class="property-navigation-item">
								<a class="target" href="#property-video-wrap">' . _yani_theme()->get_option('sps_video', 'Video') . '</a>
							</li>';
                        }
                        
                        break;

                    case 'virtual_tour':
                        if(!empty($virtual_tour)) {
                            echo '<li class="property-navigation-item">
								<a class="target" href="#property-virtual-tour-wrap">' . _yani_theme()->get_option('sps_virtual_tour', '360° Virtual Tour') . '</a>
							</li>';
                        }
                        
                        break;

                    case 'walkscore':
                        if( $yani_walkscore != 0 && $yani_walkscore_api != '' ) {
                            echo '<li class="property-navigation-item">
								<a class="target" href="#property-walkscore-wrap">' . _yani_theme()->get_option('sps_walkscore', 'WalkScore') . '</a>
							</li>';
                        }
                        break;

                    case 'yelp_nearby':
                        if( $hide_yelp ) {
                            echo "<li class='property-navigation-item'>
								<a class='target' href='#property-nearby-wrap'>"._yani_theme()->get_option('sps_nearby', "What's Nearby?")."</a>
							</li>";
                        }
                        break;

                    case 'schedule_tour':
                        
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-schedule-tour-wrap">' . _yani_theme()->get_option('sps_schedule_tour', 'Schedule a Tour') . '</a>
							</li>';
                        break;

                    case 'mortgage_calculator-beta':
                        
                        if( yani_hide_calculator() ) {
                        echo '<li class="property-navigation-item">
                                <a class="target" href="#property-mortgage-calculator-wrap">' . _yani_theme()->get_option('sps_calculator', 'Mortgage Calculator') . '</a>
                            </li>';
                        }
                        break;

                    case 'agent_bottom':
                        if( $enableDisable_agent_forms != 0 && $agent_display_option != 'none') {
                            echo '<li class="property-navigation-item">
								<a class="target" href="#property-contact-agent-wrap">' . _yani_theme()->get_option('sps_contact', 'Contact') . '</a>
							</li>';
                        }
                        
                        break;

                    case 'review':
                        
                        echo '<li class="property-navigation-item">
								<a class="target" href="#property-review-wrap">' . _yani_theme()->get_option('sps_reviews', 'Reviews') . '</a>
							</li>';
                        break;

                    case 'similar_properties':
                        
                        if( $similer_properties ) {
                        echo '<li class="property-navigation-item">
                                <a class="target" href="#similar-listings-wrap">' . _yani_theme()->get_option('sps_similar_listings', 'Similar Listings') . '</a>
                            </li>';
                        }
                        break;

                }

            }

            endif;
            ?>
			
		</ul>
	</div><!-- container -->
</div><!-- property-navigation-wrap -->