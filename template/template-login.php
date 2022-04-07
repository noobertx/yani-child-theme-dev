<?php
/**
 * Template Name: Login & Register
 */
get_header(); ?>
	
<section class="blog-wrap">
    <div class="container">
    	<div class="page-title-wrap login-page-title">
            <div class="d-flex align-items-center text-center">
                <div class="page-title flex-grow-1">
					<h1><?php the_title(); ?></h1>
				</div><!-- page-title --> 
            </div><!-- d-flex -->  
        </div>
        <div class="row">
            <div class="col-lg-12">                      
                
                <?php if( !is_user_logged_in() ) { ?>
                <div class="login-form-page-wrap">
	                <div class="login-register-tabs">
	                    <ul class="nav nav-tabs">
	                        <li class="nav-item">
	                            <a class="modal-toggle-1 nav-link active" data-toggle="tab" href="#login-form-tab" role="tab"><?php esc_html_e('Login', _yani_theme()->get_text_domain()); ?></a>
	                        </li>
	                        <?php if( _yani_theme()->get_option('header_register') ) { ?>
	                        <li class="nav-item">
	                            <a class="modal-toggle-2 nav-link" data-toggle="tab" href="#register-form-tab" role="tab"><?php esc_html_e('Register', _yani_theme()->get_text_domain()); ?></a>
	                        </li>
	                    	<?php } ?>
	                    </ul>    
	                </div><!-- login-register-tabs -->
	                <div class="tab-content">
	                    <div class="tab-pane fade login-form-tab active show" id="login-form-tab" role="tabpanel">
	                        <?php get_template_part('template-parts/login-register/login-form'); ?>
	                    </div><!-- login-form-tab -->

	                    <?php if( _yani_theme()->get_option('header_register') ) { ?>
	                    <div class="tab-pane fade register-form-tab" id="register-form-tab" role="tabpanel">
	                       <?php get_template_part('template-parts/login-register/register-form'); ?>
	                   </div><!-- register-form-tab -->
	               		<?php } ?>
	               </div><!-- tab-content -->
               </div>
               <?php 
           		} else { 
           			echo '<div class="login-form-page-text">'; 
           			echo '<strong>'.esc_html__('You are already logged in!', _yani_theme()->get_text_domain()).'</strong>';
           			echo '</div>';
               }?>
               
           </div><!-- col-lg-12 -->
       </div><!-- row -->
   </div><!-- container -->
</section>

<?php get_footer(); ?>