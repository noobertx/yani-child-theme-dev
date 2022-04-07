<?php 
global $yani_local, $is_multi_steps;
?>
<div id="floorplan" class="dashboard-content-block-wrap <?php echo esc_attr($is_multi_steps);?>">
	<h2><?php echo _yani_theme()->get_option('cls_floor_plans', 'Floor Plans'); ?></h2>
	<div class="dashboard-content-block">
		<div id="yani_floor_plans_main">
			<?php 
			$data_increment = 0;
			if(_yani_post()->can_be_editted()) { 
			global $property_data;
			$floor_plans = get_post_meta( $property_data->ID, 'floor_plans', true );

			$count = 0;
            if( !empty($floor_plans) ) {
	            foreach ($floor_plans as $floorplan):
	            	$plan_title = isset($floorplan['yani_plan_title']) ? $floorplan['yani_plan_title'] : '';
	                $plan_rooms = isset($floorplan['yani_plan_rooms']) ? $floorplan['yani_plan_rooms'] : '';
	                $plan_bathrooms = isset($floorplan['yani_plan_bathrooms']) ? $floorplan['yani_plan_bathrooms'] : '';
	                $price = isset($floorplan['yani_plan_price']) ? $floorplan['yani_plan_price'] : '';
	                $price_postfix = isset($floorplan['yani_plan_price_postfix']) ? $floorplan['yani_plan_price_postfix'] : '';
	                $plan_size = isset($floorplan['yani_plan_size']) ? $floorplan['yani_plan_size'] : '';
	                $plan_image = isset($floorplan['yani_plan_image']) ? $floorplan['yani_plan_image'] : '';
	                $yani_plan_description = isset($floorplan['yani_plan_description']) ? $floorplan['yani_plan_description'] : '';
				?>

				<div class="houzez-floorplan-clone">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="remove-floorplan-row" data-remove="<?php echo esc_attr( $count-1 ); ?>">
								<i class="yani-icon icon-remove-circle mr-2"></i>
							</div>

							<div class="form-group">
								<label><?php echo _yani_theme()->get_option('cl_plan_title', 'Plan Title' ); ?></label>
								<input class="form-control" name="floor_plans[<?php echo intval($count); ?>][yani_plan_title]" value="<?php echo sanitize_text_field( $plan_title ); ?>" type="text" placeholder="<?php echo _yani_theme()->get_option('cl_plan_title_plac', 'Enter the title'); ?>">
							</div>

						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo _yani_theme()->get_option('cl_plan_bedrooms', 'Bedrooms' ); ?></label>
								<input class="form-control" name="floor_plans[<?php echo intval($count); ?>][yani_plan_rooms]" value="<?php echo sanitize_text_field( $plan_rooms ); ?>" type="text" placeholder="<?php echo _yani_theme()->get_option('cl_plan_bedrooms_plac', 'Enter the number of bedrooms');?>">
							</div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="floor_plans[<?php echo intval($count); ?>][yani_plan_bathrooms]"><?php echo _yani_theme()->get_option('cl_plan_bathrooms', 'Bathrooms' ); ?></label>
			                    <input value="<?php echo sanitize_text_field( $plan_bathrooms ); ?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_bathrooms]" type="text" id="yani_plan_bathrooms_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_bathrooms_plac', 'Enter the number of bathrooms');?>">
							</div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="floor_plans[<?php echo intval($count); ?>][yani_plan_price]"><?php echo _yani_theme()->get_option('cl_plan_price', 'Price' ); ?></label>
			                    <input value="<?php echo sanitize_text_field( $price ); ?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_price]" type="text" id="yani_plan_price_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_price_plac', 'Enter the price');?>">
							</div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="floor_plans[<?php echo intval($count); ?>][yani_plan_price_postfix]"><?php echo _yani_theme()->get_option('cl_plan_price_postfix', 'Price Postfix' ); ?></label>
			                    <input value="<?php echo sanitize_text_field( $price_postfix ); ?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_price_postfix]" type="text" id="yani_plan_price_postfix_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_price_postfix_plac', 'Enter the price postfix');?>">
							</div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="floor_plans[<?php echo intval($count); ?>][yani_plan_size]"><?php echo _yani_theme()->get_option('cl_plan_size', 'Plan Size' ); ?></label>
			                    <input value="<?php echo sanitize_text_field( $plan_size ); ?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_size]" type="text" id="yani_plan_size_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_size_plac', 'Enter the plan size' );?>">
							</div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo _yani_theme()->get_option('cl_plan_img', 'Plan Image'); ?></label>
							
								<div class="d-flex align-items-start">
									<img class="floor-thumb img-fluid" src="<?php echo esc_url( $plan_image ); ?>" width="100" height="75" alt="thumb">	
									<div class="ml-2">
										<a href="#" id="floorplan-file-select-<?php echo intval($count); ?>" class="floorplan-file-select btn btn-primary btn-full-width"><?php echo _yani_theme()->get_option('cl_plan_img_btn', 'Select Image'); ?></a>

										<input value="<?php echo esc_url( $plan_image ); ?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_image]" type="hidden" id="yani_plan_image_<?php echo intval($count); ?>" class="yani_plan_image form-control">

										<small class="form-text text-muted">
											<?php echo _yani_theme()->get_option('cl_plan_img_size', 'Minimum size 800 x 600 px'); ?>
										</small>
									</div>
								</div>

							</div>
							<div class="errors-log"></div>
			                <div class="progress houzez-hidden">
			                </div>
						</div><!-- col-md-6 col-sm-12 -->
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label for="floor_plans[<?php echo intval($count); ?>][yani_plan_description]"><?php echo _yani_theme()->get_option('cl_plan_des', 'Description'); ?></label>
			                    <textarea placeholder="<?php echo _yani_theme()->get_option('cl_plan_des_plac', 'Enter the plan description');?>" name="floor_plans[<?php echo intval($count); ?>][yani_plan_description]" rows="4" id="yani_plan_description_0" class="form-control"><?php echo sanitize_textarea_field($yani_plan_description); ?></textarea>
							</div>
						</div><!-- col-md-12 col-sm-12 -->
					</div>
					<hr>
				</div>

				
				<?php 
				$count++;
	            endforeach;
	        }
            $data_increment = $count - 1;

			} else { ?>
			<div class="houzez-floorplan-clone">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="remove-floorplan-row" data-remove="0">
							<i class="yani-icon icon-remove-circle mr-2"></i>
						</div>
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('cl_plan_title', 'Plan Title' ); ?></label>
							<input class="form-control" name="floor_plans[0][yani_plan_title]" placeholder="<?php echo _yani_theme()->get_option('cl_plan_title_plac', 'Enter the title'); ?>" type="text">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('cl_plan_bedrooms', 'Bedrooms' ); ?></label>
							<input class="form-control" name="floor_plans[0][yani_plan_rooms]" placeholder="<?php echo _yani_theme()->get_option('cl_plan_bedrooms_plac', 'Enter the number of bedrooms');?>" type="text">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="floor_plans[0][yani_plan_bathrooms]"><?php echo _yani_theme()->get_option('cl_plan_bathrooms', 'Bathrooms' ); ?></label>
		                    <input name="floor_plans[0][yani_plan_bathrooms]" type="text" id="yani_plan_bathrooms_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_bathrooms_plac', 'Enter the number of bathrooms');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="floor_plans[0][yani_plan_price]"><?php echo _yani_theme()->get_option('cl_plan_price', 'Price' ); ?></label>
		                    <input name="floor_plans[0][yani_plan_price]" type="text" id="yani_plan_price_0" class="form-control"placeholder="<?php echo _yani_theme()->get_option('cl_plan_price_plac', 'Enter the price');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="floor_plans[0][yani_plan_price_postfix]"><?php echo _yani_theme()->get_option('cl_plan_price_postfix', 'Price Postfix' ); ?></label>
		                    <input name="floor_plans[0][yani_plan_price_postfix]" type="text" id="yani_plan_price_postfix_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_price_postfix_plac', 'Enter the price postfix');?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label for="floor_plans[0][yani_plan_size]"><?php echo _yani_theme()->get_option('cl_plan_size', 'Plan Size' ); ?></label>
		                    <input name="floor_plans[0][yani_plan_size]" type="text" id="yani_plan_size_0" class="form-control" placeholder="<?php echo _yani_theme()->get_option('cl_plan_size_plac', 'Enter the plan size' );?>">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('cl_plan_img', 'Plan Image'); ?></label>

							<div class="d-flex align-items-start">
								<img class="floor-thumb img-fluid" src="https://placehold.it/100x75" width="100" height="75" alt="thumb">	
								<div class="ml-2">
									<a href="#" id="floorplan-file-select-0" class="floorplan-file-select btn btn-primary btn-full-width"><?php echo _yani_theme()->get_option('cl_plan_img_btn', 'Select Image'); ?></a>

									<input name="floor_plans[0][yani_plan_image]" type="hidden" id="yani_plan_image_0" class="yani_plan_image form-control" value="">

									<small class="form-text text-muted">
										<?php echo _yani_theme()->get_option('cl_plan_img_size', 'Minimum size 800 x 600 px'); ?>
									</small>
								</div>
							</div>
						</div>
						<div class="errors-log"></div>
		                <div class="progress houzez-hidden"></div>
					</div><!-- col-md-6 col-sm-12 -->
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label for="floor_plans[0][yani_plan_description]"><?php echo _yani_theme()->get_option('cl_plan_des', 'Description'); ?></label>
		                    <textarea placeholder="<?php echo _yani_theme()->get_option('cl_plan_des_plac', 'Enter the plan description');?>" name="floor_plans[0][yani_plan_description]" rows="4" id="yani_plan_description_0" class="form-control"></textarea>
						</div>
					</div><!-- col-md-12 col-sm-12 -->
				</div>
				<hr>
			</div>
			<?php } ?>
		</div><!-- row -->

		<button id="add-floorplan-row" data-increment="<?php echo esc_attr($data_increment); ?>" class="btn btn-primary btn-left-icon"><i class="yani-icon icon-add-circle"></i> <?php esc_html_e('Add New', _yani_theme()->get_text_domain()); ?></button>
	</div><!-- dashboard-content-block -->
</div><!-- dashboard-content-block-wrap -->

