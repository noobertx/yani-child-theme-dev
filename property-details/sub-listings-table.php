<?php
$multi_units  = yani_get_listing_data('multi_units');
if( isset($multi_units[0]['yani_mu_title']) && !empty( $multi_units[0]['yani_mu_title'] ) ) {
?>
<div class="property-sub-listings-table-wrap property-section-wrap" id="property-sub-listings-wrap">
	<div class="block-wrap">
		<div class="block-title-wrap">
			<h2><?php echo yani_option('sps_sub_listings', 'Sub Listings'); ?></h2>
		</div><!-- block-title-wrap -->
		<div class="block-content-wrap">
			<table class="sub-listings-table table-lined responsive-table">
				<thead>
					<tr>
						<th><?php esc_html_e('Title', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Property Type', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Price', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Beds', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Baths', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Property Size', _yani_theme()->get_text_domain()); ?></th>
                        <th><?php esc_html_e('Availability Date', _yani_theme()->get_text_domain()); ?></th>
					</tr>
				</thead>
				<tbody>

					<?php 
					$mu_price_postfix = '';
					foreach( $multi_units as $mu ):

						$postfix = '';
						$yani_mu_size = '';
						$yani_mu_availability_date = '';
						$yani_mu_beds = '';
						$yani_mu_baths = '';
                        if( !empty( $mu['yani_mu_price_postfix'] ) ) {
                            $mu_price_postfix = ' / '.$mu['yani_mu_price_postfix'];
                        }

                        if( !empty($mu['yani_mu_size_postfix']) ) {
                        	$postfix = yani_get_size_unit( $mu['yani_mu_size_postfix'] );
                        }

                        if( !empty($mu['yani_mu_size']) ) {
                        	$yani_mu_size = yani_get_area_size($mu['yani_mu_size']);
                        }

                        if( !empty($mu['yani_mu_availability_date']) ) {
                        	$yani_mu_availability_date = $mu['yani_mu_availability_date'];
                        }

                        if( !empty($mu['yani_mu_beds']) ) {
                        	$yani_mu_beds = $mu['yani_mu_beds'];
                        }
                        if( !empty($mu['yani_mu_baths']) ) {
                        	$yani_mu_baths = $mu['yani_mu_baths'];
                        }
                        ?>
						<tr>
							<td data-label="<?php esc_html_e('Title', _yani_theme()->get_text_domain()); ?>">
								<strong><?php echo esc_attr( $mu['yani_mu_title'] ); ?></strong>
							</td>
							<td data-label="<?php esc_html_e('Property Type', _yani_theme()->get_text_domain()); ?>"><?php echo esc_attr( $mu['yani_mu_type'] ); ?></td>
							<td data-label="<?php esc_html_e('Price', _yani_theme()->get_text_domain()); ?>">
								<strong><?php echo yani_get_property_price( $mu['yani_mu_price'] ).$mu_price_postfix; ?></strong>
							</td>
							<td data-label="<?php esc_html_e('Beds', _yani_theme()->get_text_domain()); ?>">
								<i class="yani-icon icon-hotel-double-bed-1 mr-1"></i>
								<?php echo esc_attr( $yani_mu_beds ); ?> 
							</td>
							<td data-label="<?php esc_html_e('Baths', _yani_theme()->get_text_domain()); ?>">
								<i class="yani-icon icon-bathroom-shower-1 mr-1"></i>
								<?php echo esc_attr( $yani_mu_baths ); ?> 
							</td>
							<td data-label="<?php esc_html_e('Property Size', _yani_theme()->get_text_domain()); ?>"><?php echo $yani_mu_size.' '.$postfix; ?></td>
							<td data-label="<?php esc_html_e('Availability Date', _yani_theme()->get_text_domain()); ?>"><?php echo esc_attr($yani_mu_availability_date); ?></td>
						</tr>
					<?php endforeach; ?>
					
				</tbody>
			</table>
		</div><!-- block-content-wrap -->
	</div><!-- block-wrap -->
</div><!-- property-address-wrap -->
<?php } ?>