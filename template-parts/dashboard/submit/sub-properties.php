<?php global $is_multi_steps; ?>
<div id="sub-properties" class="dashboard-content-block-wrap <?php echo esc_attr($is_multi_steps);?>">
	<h2><?php echo _yani_theme()->get_option('cls_sub_listings', 'Sub Listings'); ?></h2>
	<div class="dashboard-content-block">
		<div id="multi_units_main">
			<?php 
			$data_increment = 0;
			if(_yani_post()->can_be_editted()) { 
			global $property_data;
			$multi_units = get_post_meta( $property_data->ID, 'yani_multi_units', true );
			$count = 0;
	            if( !empty($multi_units) ) {
	            foreach ($multi_units as $multi_unit):
			?>
			<div class="houzez-units-clone">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="remove-subproperty-row" data-remove="<?php echo esc_attr( $count-1 ); ?>">
							<i class="yani-icon icon-remove-circle mr-2"></i>
						</div>
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_title]"><?php echo _yani_theme()->get_option('cl_subl_title', 'Title' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_title'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_title]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_title_plac', 'Enter the title');?>">
						</div>
					</div><!-- col-md-12 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_beds]"><?php echo _yani_theme()->get_option('cl_subl_bedrooms', 'Bedrooms' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_beds'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_beds]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_bedrooms', 'Enter the number of bedrooms');?>">
							<small class="form-text text-muted"><?php esc_html_e('Only digits', _yani_theme()->get_text_domain()); ?></small>
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_baths]"><?php echo _yani_theme()->get_option('cl_subl_bathrooms', 'Bathrooms' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_baths'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_baths]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_bathrooms_plac', 'Enter the number of bathrooms');?>">
							<small class="form-text text-muted"><?php esc_html_e('Only digits', _yani_theme()->get_text_domain()); ?></small>
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_size]"><?php echo _yani_theme()->get_option('cl_subl_size', 'Property Size' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_size'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_size]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_size', 'Enter the property size');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_size_postfix]"><?php echo _yani_theme()->get_option('cl_subl_size_postfix', 'Size Postfix' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_size_postfix'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_size_postfix]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_size_postfix_plac', 'Enter the property size postfix');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_price]"><?php echo _yani_theme()->get_option('cl_subl_price', 'Price' ); ?></label>
                           	<input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_price'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_price]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_price_plac', 'Enter the price');?>">
							
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_price_postfix]"><?php echo _yani_theme()->get_option('cl_subl_price_postfix', 'Price Postfix' ); ?></label>
                           	<input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_price_postfix'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_price_postfix]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_price_postfix_plac', 'Enter the price postfix');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->

					<div class="col-md-6 col-sm-12">
		                <div class="form-group">
		                    <label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_type]"><?php echo _yani_theme()->get_option('cl_subl_type', 'Property Type' ); ?></label>
                            <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_type'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_type]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_type_plac', 'Enter the property type');?>">
		                </div>
		            </div>
		            <div class="col-md-6 col-sm-12">
		                <label for="yani_multi_units[<?php echo intval($count); ?>][yani_mu_availability_date]"><?php echo _yani_theme()->get_option('cl_subl_date', 'Availability Date' ); ?></label>
                        <input value="<?php echo sanitize_text_field( $multi_unit['yani_mu_availability_date'] ); ?>" name="yani_multi_units[<?php echo intval($count); ?>][yani_mu_availability_date]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_date_plac', 'Enter the availability date');?>">
		            </div>
				</div><!-- row -->
				<hr>
			</div>
			<?php 
				$count++;
				endforeach;
				$data_increment = $count - 1;
				}
			} else { ?>
			<div class="houzez-units-clone">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="remove-subproperty-row" data-remove="0">
							<i class="yani-icon icon-remove-circle mr-2"></i>
						</div>
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_title]"><?php echo _yani_theme()->get_option('cl_subl_title', 'Title' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_title]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_title_plac', 'Enter the title');?>">
						</div>
					</div><!-- col-md-12 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_beds]"><?php echo _yani_theme()->get_option('cl_subl_bedrooms', 'Bedrooms' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_beds]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_bedrooms', 'Enter the number of bedrooms');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_baths]"><?php echo _yani_theme()->get_option('cl_subl_bathrooms', 'Bathrooms' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_baths]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_bathrooms_plac', 'Enter the number of bathrooms');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_size]"><?php echo _yani_theme()->get_option('cl_subl_size', 'Property Size' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_size]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_size', 'Enter the property size');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_size_postfix]"><?php echo _yani_theme()->get_option('cl_subl_size_postfix', 'Size Postfix' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_size_postfix]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_size_postfix_plac', 'Enter the property size postfix');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_price]"><?php echo _yani_theme()->get_option('cl_subl_price', 'Price' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_price]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_price_plac', 'Enter the price');?>">
							<small class="form-text text-muted"><?php esc_html_e('Only digits', _yani_theme()->get_text_domain()); ?></small>
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="yani_multi_units[0][yani_mu_price_postfix]"><?php echo _yani_theme()->get_option('cl_subl_price_postfix', 'Price Postfix' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_price_postfix]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_price_postfix_plac', 'Enter the price postfix');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->

					<div class="col-md-6 col-sm-12">
		                <div class="form-group">
		                    <label for="yani_multi_units[0][yani_mu_type]"><?php echo _yani_theme()->get_option('cl_subl_type', 'Property Type' ); ?></label>
		                    <input name="yani_multi_units[0][yani_mu_type]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_type_plac', 'Enter the property type');?>">
		                </div>
		            </div>
		            <div class="col-md-6 col-sm-12">
		            	<div class="form-group">
			                <label for="yani_multi_units[0][yani_mu_availability_date]"><?php echo _yani_theme()->get_option('cl_subl_date', 'Availability Date' ); ?></label>
			                <input name="yani_multi_units[0][yani_mu_availability_date]" type="text" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_subl_date_plac', 'Enter the availability date');?>">
			            </div>
		            </div>
				</div><!-- row -->
				<hr>
			</div>
			<?php } ?>
		</div>

		<button id="add-subproperty-row" data-increment="<?php echo esc_attr($data_increment); ?>" class="btn btn-primary btn-left-icon"><i class="yani-icon icon-add-circle"></i> <?php esc_html_e('Add New', _yani_theme()->get_text_domain()); ?></button>
	</div><!-- dashboard-content-block -->
</div><!-- dashboard-content-block-wrap -->

