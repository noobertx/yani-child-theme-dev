<?php global $return_array,$hide_form_fields,$terms_page_id,$post,$property_id; ?>
<div class="block-content-wrap">
			
			<?php 
			if(_yani_form()->get_form_type()) {

				echo $return_array['agent_data']; ?>

				<div class="block-title-wrap">
					<h3><?php echo _yani_theme()->get_option('sps_propperty_enqry', 'Inquire About This Property'); ?></h3>
				</div>

				<?php
				if(!empty(_yani_theme()->get_option('contact_form_agent_bottom'))) {
					echo do_shortcode(_yani_theme()->get_option('contact_form_agent_bottom'));
				}
			} else { ?>

			<form method="post" action="#">

				<?php echo $return_array['agent_data']; ?>

				<div class="block-title-wrap">
					<h3><?php echo _yani_theme()->get_option('sps_propperty_enqry', 'Inquire About This Property'); ?></h3>
				</div>
			
				<div class="form_messages"></div>

				<div class="row">

					<?php if( $hide_form_fields['name'] != 1 ) { ?>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('spl_con_name', 'Name'); ?></label>
							<input class="form-control" name="name" placeholder="<?php echo _yani_theme()->get_option('spl_con_name_plac', 'Enter your name'); ?>" type="text">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<?php } ?>

					<?php if( $hide_form_fields['phone'] != 1 ) { ?>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('spl_con_phone', 'Phone'); ?></label>
							<input class="form-control" name="mobile" placeholder="<?php echo _yani_theme()->get_option('spl_con_phone_plac', 'Enter your phone number'); ?>" type="text">
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<?php } ?>

					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('spl_con_email', 'Email'); ?></label>
							<input class="form-control" name="email" placeholder="<?php echo _yani_theme()->get_option('spl_con_email_plac', 'Enter your email address'); ?>" type="email">
						</div>
					</div><!-- col-md-6 col-sm-12 -->

					<?php if( $hide_form_fields['usertype'] != 1 ) { ?>	
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label><?php echo _yani_theme()->get_option('spl_con_usertype', "I'm a"); ?></label>
							<select name="user_type" class="selectpicker form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('spl_con_select', 'Select'); ?>">
								<?php if( _yani_theme()->get_option('spl_con_buyer') != "" ) { ?>
								<option value="buyer"><?php echo _yani_theme()->get_option('spl_con_buyer', "I'm a buyer"); ?></option>
								<?php } ?>

								<?php if( _yani_theme()->get_option('spl_con_tennant') != "" ) { ?>
								<option value="tennant"><?php echo _yani_theme()->get_option('spl_con_tennant', "I'm a tennant"); ?></option>
								<?php } ?>

								<?php if( _yani_theme()->get_option('spl_con_agent') != "" ) { ?>
								<option value="agent"><?php echo _yani_theme()->get_option('spl_con_agent', "I'm an agent"); ?></option>
								<?php } ?>

								<?php if( _yani_theme()->get_option('spl_con_other') != "" ) { ?>
								<option value="other"><?php echo _yani_theme()->get_option('spl_con_other', 'Other'); ?></option>
								<?php } ?>
							</select><!-- selectpicker -->
						</div>
					</div><!-- col-md-6 col-sm-12 -->
					<?php } ?>

					<?php if( $hide_form_fields['message'] != 1 ) { ?>	
					<div class="col-sm-12 col-xs-12">
						<div class="form-group form-group-textarea">
							<label><?php echo _yani_theme()->get_option('spl_con_message', 'Message'); ?></label>
							<textarea class="form-control hz-form-message" name="message" rows="5" placeholder="<?php echo _yani_theme()->get_option('spl_con_message_plac', 'Message'); ?>"><?php echo _yani_theme()->get_option('spl_con_interested', "Hello, I am interested in"); ?> [<?php echo get_the_title(); ?>]</textarea>
						</div>
					</div><!-- col-sm-12 col-xs-12 -->
					<?php } ?>

					<?php if( _yani_theme()->get_option('gdpr_and_terms_checkbox', 1) ) { ?>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control control--checkbox m-0 hz-terms-of-use">
								<input type="checkbox" name="privacy_policy"><?php echo _yani_theme()->get_option('spl_sub_agree', 'By submitting this form I agree to'); ?> <a target="_blank" href="<?php echo esc_url(get_permalink($terms_page_id)); ?>"><?php echo _yani_theme()->get_option('spl_term', 'Terms of Use'); ?></a>
								<span class="control__indicator"></span>
							</label>
						</div><!-- form-group -->
					</div>
					<?php } ?>

					<div class="col-sm-12 col-xs-12">
						<?php if ( $return_array['is_single_agent'] == true ) : ?>
				            <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
				        <?php endif; ?>
				        <input type="hidden" name="property_agent_contact_security" value="<?php echo wp_create_nonce('property_agent_contact_nonce'); ?>"/>
				        <input type="hidden" name="property_permalink" value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
				        <input type="hidden" name="property_title" value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
				        <input type="hidden" name="property_id" value="<?php echo esc_attr($property_id); ?>"/>
				        <input type="hidden" name="action" value="yani_property_agent_contact">
				        <input type="hidden" class="is_bottom" value="bottom">
				        <input type="hidden" name="listing_id" value="<?php echo intval($post->ID)?>">
				        <input type="hidden" name="is_listing_form" value="yes">
				        <input type="hidden" name="agent_id" value="<?php echo intval($return_array['agent_id'])?>">
				        <input type="hidden" name="agent_type" value="<?php echo esc_attr($return_array['agent_type'])?>">

				        <?php get_template_part('template-parts/google', 'reCaptcha'); ?>

						<button class="yani_agent_property_form btn btn-secondary btn-sm-full-width">
							<?php get_template_part('template-parts/loader'); ?>
							<?php echo _yani_theme()->get_option('spl_btn_request_info', 'Request Information'); ?>		
						</button>

						<?php if( $return_array['is_single_agent'] == true && _yani_theme()->get_option('agent_direct_messages', 0) ) { ?>
						<button type="button" <?php echo $dataModel; ?> class="<?php echo esc_attr($action_class).' '.esc_attr($login_class); ?> btn btn-secondary-outlined btn-sm-full-width">
							<?php get_template_part('template-parts/loader'); ?>
							<?php echo _yani_theme()->get_option('spl_btn_message', 'Send Message'); ?>		
						</button>
						<?php } ?>
						
					</div><!-- col-sm-12 col-xs-12 -->
				</div><!-- row -->
			</form>
			<?php } ?>
			
		</div><!-- block-co