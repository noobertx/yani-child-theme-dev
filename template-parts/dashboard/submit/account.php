<?php 
global $is_multi_steps; 
$show_hide_roles = yani_option('show_hide_roles');
?>
<div id="sumission_login_register_msgs"></div>
<div class="dashboard-content-block-wrap <?php echo esc_attr($is_multi_steps);?>">
	<h2><?php esc_html_e('Do you have an account?', _yani_theme()->get_text_domain());?></h2>
	<div class="dashboard-content-block">
		<p class="step-login-btn">
			<?php esc_html_e( "If you don't have an account you can create one below by entering your email address. Your account details will be confirmed via email. Otherwise you can ", 'houzez' ); ?>
				<a href="#" class="login-here"><strong><?php esc_html_e('Login', _yani_theme()->get_text_domain());?></strong></a>
                <a href="#" class="register-here" style="display: none"><strong><?php esc_html_e('Register', _yani_theme()->get_text_domain());?></strong></a>
		</p>
		
		<div class="step-tab-register">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label for="username"><?php esc_html_e('Username', _yani_theme()->get_text_domain()); ?>* </label>
	                    <input type="text" id="username" name="username" class="form-control" placeholder="<?php esc_html_e( 'Enter your username', 'houzez' ); ?>">
					</div>
				</div><!-- col-md-3 col-sm-12 -->

				<?php if( yani_option('register_mobile', 0) == 1 ) { ?>
			    <div class="col-md-6 col-sm-12">
				    <div class="form-group">
				    	<label for="username"><?php esc_html_e('Phone', _yani_theme()->get_text_domain()); ?>* </label>
				        <input class="form-control" name="phone_number" id="phone_number" type="text" placeholder="<?php esc_html_e('Phone',_yani_theme()->get_text_domain()); ?>" />
				    </div><!-- form-group -->
				</div>
			    <?php } ?>

				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label for="user_email"><?php esc_html_e('Email Address', _yani_theme()->get_text_domain()); ?>* </label>
	                    <input type="email" id="user_email" class="form-control" name="user_email" placeholder="<?php esc_html_e( 'Enter your email address', 'houzez' ); ?>">
					</div>
				</div><!-- col-md-3 col-sm-12 -->

				<?php if( yani_option('user_show_roles', 0) != 0 ) { ?>
				<div class="col-md-6 col-sm-12">
					<label><?php esc_html_e('Select your account type', _yani_theme()->get_text_domain()); ?></label>
					<select name="user_role" id="user_role" class="selectpicker form-control bs-select-hidden" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e('Select your account type', _yani_theme()->get_text_domain()); ?>">
	                    <?php
	                    if( $show_hide_roles['agent'] != 1 ) {
	                        echo '<option value="yani_agent"> '.yani_option('agent_role').' </option>';
	                    }
	                    if( $show_hide_roles['agency'] != 1 ) {
	                        echo '<option value="yani_agency"> ' . yani_option('agency_role') . ' </option>';
	                    }
	                    if( $show_hide_roles['owner'] != 1 ) {
	                        echo '<option value="yani_owner"> ' . yani_option('owner_role') . '  </option>';
	                    }
	                    if( $show_hide_roles['seller'] != 1 ) {
	                        echo '<option value="yani_seller"> ' . yani_option('seller_role') . '  </option>';
	                    }
	                    if( $show_hide_roles['manager'] != 1 ) {
	                        echo '<option value="yani_manager"> ' . yani_option('manager_role') . ' </option>';
	                    }
	                    ?>
	                </select>
				</div><!-- col-md-3 col-sm-12 -->
				<?php } ?>
			</div>
		</div>

        <div class="step-tab-login" style="display: none;">
        	<div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="sp_username"><?php esc_html_e('Username', _yani_theme()->get_text_domain()); ?>* </label>
                        <input type="text" id="sp_username" name="sp_username" class="form-control" placeholder="<?php esc_html_e( 'Enter Your Username', 'houzez' ); ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="sp_password"><?php esc_html_e('Password', _yani_theme()->get_text_domain()); ?>* </label>
                        <input type="password" id="sp_password" class="form-control" name="sp_password" placeholder="<?php esc_html_e( 'Enter Your Password', 'houzez' ); ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php wp_nonce_field( 'yani_register_nonce2', 'yani_register_security2' ); ?>
	</div><!-- dashboard-content-block -->
</div><!-- dashboard-content-block-wrap -->