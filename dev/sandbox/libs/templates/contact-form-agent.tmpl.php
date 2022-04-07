<?php
    $return_array = _yani_agent()->render_property_contact_form(false);
    $hide_form_fields = array(
        "name" => 0,
        "phone" => 0,
        "usertype" => 0,
        "message" => 0,
        "terms_page_id" => 0,
    );
    ?>
    <?php
    $terms_page_id = 25;
    $agent_email = is_email( "noobertx@gmail.com" );
    $agent_id = 1;
    $agent_type  = 'agent_info';
    $post = get_post(17381);
    $property_id = 17381;
     $source_link = get_author_posts_url(1);
    $dataModel = '';
    $action_class = '';
    $login_class = '';
    $dataModel = '';
    $action_class = "houzez-send-message";
    $name = get_the_title();
if( !is_user_logged_in() ) {
    $login_class = 'msg-login-required';
    $dataModel = 'data-toggle="modal" data-target="#login-register-form"';
}

?>
                    <div class="property-form clearfix">
                        <div class="form_messages"></div>

                        <form method="post">
                            <input type="hidden" id="target_email" name="target_email" value="<?php echo antispambot($agent_email); ?>">
                            <input type="hidden" name="contact_realtor_ajax" id="contact_realtor_ajax" value="<?php echo wp_create_nonce('contact_realtor_nonce'); ?>"/>
                            <input type="hidden" name="action" value="yani_contact_realtor" />
                            <input type="hidden" name="source_link" value="<?php echo esc_url($source_link)?>">
                            <input type="hidden" name="agent_id" value="<?php echo intval($agent_id)?>">
                            <input type="hidden" name="agent_type" value="<?php echo esc_attr($agent_type)?>">
                            <input type="hidden" name="realtor_page" value="yes">

                            <?php if( $hide_form_fields['name'] != 1 ) { ?>
                            <div class="form-group">
                                <input class="form-control" name="name" value="" type="text" placeholder="<?php esc_html_e('Your Name', _yani_theme()->get_text_domain()); ?>">
                            </div><!-- form-group --> 
                            <?php } ?>

                            <?php if( $hide_form_fields['phone'] != 1 ) { ?>  
                            <div class="form-group">
                                <input class="form-control" name="mobile" value="" type="text" placeholder="<?php esc_html_e('Phone', _yani_theme()->get_text_domain()); ?>">
                            </div><!-- form-group -->   
                            <?php } ?>

                            <div class="form-group">
                                <input class="form-control" name="email" value="" type="email" placeholder="<?php esc_html_e('Email', _yani_theme()->get_text_domain()); ?>">
                            </div><!-- form-group --> 

                            <?php if( $hide_form_fields['message'] != 1 ) { ?>  
                            <div class="form-group form-group-textarea">
                                <textarea class="form-control" name="message" rows="4" placeholder="<?php esc_html_e('Message', _yani_theme()->get_text_domain()); ?>"><?php echo sprintf(esc_html__('Hi %s, I saw your profile on %s and wanted to see if i can get some help', _yani_theme()->get_text_domain()), $name, get_option('blogname')); ?></textarea>
                            </div><!-- form-group -->
                            <?php } ?>

                            <?php if( $hide_form_fields['usertype'] != 1 ) { ?>    
                            <div class="form-group">
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
                            </div><!-- form-group -->   
                            <?php } ?>

                            <div class="form-group">
                                <label class="control control--checkbox m-0 hz-terms-of-use">
                                    <input type="checkbox" name="privacy_policy"><?php echo _yani_theme()->get_option('spl_sub_agree', 'By submitting this form I agree to'); ?> <a target="_blank" href="<?php echo esc_url(get_permalink($terms_page_id)); ?>"><?php echo _yani_theme()->get_option('spl_term', 'Terms of Use'); ?></a>
                                    <span class="control__indicator"></span>
                                </label>
                            </div><!-- form-group -->

                            <?php get_template_part('template-parts/google', 'reCaptcha'); ?>        

                            <button id="contact_realtor_btn" type="button" class="btn btn-secondary btn-full-width">
                                <?php esc_html_e('Submit', _yani_theme()->get_text_domain()); ?>
                                <?php get_template_part('template-parts/loader'); ?>
                            </button>
                        </form>
                    </div><!-- property-form -->
                    