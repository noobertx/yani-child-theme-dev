<?php
global $return_array,$terms_page_id;
$agent_email = "noobertx@gmail.com";
$post = get_post(17358);
$schedule_time_slots = _yani_theme()->get_option('schedule_time_slots');
?>

<form method="post" action="#">
    <input type="hidden" name="schedule_contact_form_ajax"
       value="<?php echo wp_create_nonce('schedule-contact-form-nonce'); ?>"/>
    <input type="hidden" name="property_permalink"
           value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
    <input type="hidden" name="property_title"
           value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
    <input type="hidden" name="action" value="yani_schedule_send_message">

    <input type="hidden" name="listing_id" value="<?php echo intval($post->ID)?>">
    <input type="hidden" name="is_listing_form" value="yes">
    <input type="hidden" name="is_schedule_form" value="yes">
    <input type="hidden" name="agent_id" value="<?php echo intval($return_array['agent_id'])?>">
    <input type="hidden" name="agent_type" value="<?php echo esc_attr($return_array['agent_type'])?>">

    <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
    
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label><?php echo _yani_theme()->get_option('spl_con_tour_type', 'Tour Type'); ?></label>
                <select name="schedule_tour_type" class="selectpicker form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('spl_con_select', 'Select'); ?>" data-live-search="false">
                    <option value="<?php echo _yani_theme()->get_option('spl_con_in_person', 'In Person'); ?>"><?php echo _yani_theme()->get_option('spl_con_in_person', 'In Person'); ?></option>
                    <option value="<?php echo _yani_theme()->get_option('spl_con_video_chat', 'Video Chat'); ?>"><?php echo _yani_theme()->get_option('spl_con_video_chat', 'Video Chat'); ?></option>
                </select><!-- selectpicker -->
            </div>
        </div><!-- col-md-4 col-sm-12 -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label><?php echo _yani_theme()->get_option('spl_con_date', 'Date'); ?></label>
                <input name="schedule_date" class="form-control db_input_date" placeholder="<?php echo _yani_theme()->get_option('spl_con_date_plac', 'Select tour date'); ?>" type="text">
            </div>
        </div><!-- col-md-6 col-sm-12 -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label><?php echo _yani_theme()->get_option('spl_con_time', 'Time'); ?></label>
                <select name="schedule_time" class="selectpicker form-control bs-select-hidden">
                    <?php 
                    $time_slots = explode(',', $schedule_time_slots); 
                    foreach ($time_slots as $time) {
                        echo '<option value="'.trim($time).'">'.esc_attr($time).'</option>';
                    }
                    ?>    
                </select>
            </div>
        </div><!-- col-md-6 col-sm-12 -->
    </div><!-- row -->
    <div class="block-title-wrap">
        <h3><?php echo _yani_theme()->get_option('sps_your_info', 'Your information'); ?></h3>
    </div><!-- block-title-wrap -->
    
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label><?php echo _yani_theme()->get_option('spl_con_name', 'Name'); ?></label>
                <input class="form-control" name="name" placeholder="<?php echo _yani_theme()->get_option('spl_con_name_plac', 'Enter your name'); ?>" type="text">
            </div>
        </div><!-- col-md-4 col-sm-12 -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group"> 
                <label><?php echo _yani_theme()->get_option('spl_con_phone', 'Phone'); ?></label>
                <input class="form-control" name="phone" placeholder="<?php echo _yani_theme()->get_option('spl_con_phone_plac', 'Enter your phone'); ?>" type="text">
            </div>
        </div><!-- col-md-4 col-sm-12 -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label><?php echo _yani_theme()->get_option('spl_con_email', 'Email'); ?></label>
                <input class="form-control" name="email" placeholder="<?php echo _yani_theme()->get_option('spl_con_email_plac', 'Enter your email address'); ?>" type="email">
            </div>
        </div><!-- col-md-4 col-sm-12 -->
        <div class="col-sm-12 col-xs-12">
            <div class="form-group form-group-textarea">
                <label><?php echo _yani_theme()->get_option('spl_con_message', 'Message'); ?></label>
                <textarea class="form-control" name="message" rows="5" placeholder="<?php echo _yani_theme()->get_option('spl_con_message_plac', 'Message'); ?>"></textarea>
            </div>
        </div><!-- col-sm-12 col-xs-12 -->

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
            <button class="schedule_contact_form btn btn-secondary btn-sm-full-width">
                <?php get_template_part('template-parts/loader'); ?>
                <?php echo _yani_theme()->get_option('spl_btn_tour_sch', 'Submit a Tour Request'); ?> 
            </button>
        </div><!-- col-sm-12 col-xs-12 -->
        
    </div><!-- row -->
    <div class="form_messages mt-4"></div>
</form>