<?php global $wpdb, $current_user;

wp_get_current_user();
$current_user_id =  $current_user->ID;
$thread_id = 5;
$table = $wpdb->prefix . 'yani_thread_messages';

$yani_thread = $wpdb->get_row(
	"
	SELECT * 
	FROM $table
	WHERE id = $thread_id
	"
);


$yani_messages = $wpdb->get_results(
	"
	SELECT * 
	FROM $table
	WHERE thread_id = $thread_id
	ORDER BY id DESC
	"
);
$thread_author = 1;
if ( $thread_author == $current_user_id ) {
	$thread_author = 2;
} 

$thread_author_first_name  =  get_the_author_meta( 'first_name', $thread_author );
$thread_author_last_name  =  get_the_author_meta( 'last_name', $thread_author );
$thread_author_display_name = get_the_author_meta( 'display_name', $thread_author );

?>
<div class="message-list-wrap">
    <ul class="list-unstyled message-list">
   		<?php foreach ( $yani_messages as $message ) {

			$message_class = 'msg-me';
			$message_author = $message->created_by;
			$message_author_name = ucfirst( $thread_author_display_name );
			$message_author_picture =  get_the_author_meta( 'yani_author_custom_picture' , $message_author );

			if ( $message_author == $current_user_id ) {
				$message_author_name = esc_html__( 'Me', 'houzez' );
				$message_class = '';
			}

			if ( empty( $message_author_picture )) {
				$message_author_picture = YANI_THEME_IMAGES_2.'profile-avatar.png';
			}
   		?>
   		    <li class="message-list-item <?php echo esc_attr($message_class); ?>">
                <div class="d-flex">
                    <div class="message-reply-user mr-3">
                        <img class="rounded-circle mt-1" src="<?php echo esc_url($message_author_picture); ?>" width="40" height="40" alt="<?php echo esc_attr($message_author_name); ?>">
                    </div><!-- message-reply-user -->
                    <div class="message-reply-message flex-grow-1">
                        <p><strong><?php echo esc_attr($message_author_name); ?></strong><br>
                            <time><span class="mr-3"><i class="yani-icon icon-time-clock-circle mr-1"></i>  <?php echo date_i18n( get_option('time_format'), strtotime( $message->time ) ); ?> <i class="yani-icon icon-attachment ml-3 mr-1"></i> <?php echo date_i18n( get_option('date_format'), strtotime( $message->time ) ); ?> </span></time>
                        </p>
                        
                        <?php echo $message->message; ?>
                    </div><!-- message-reply-message -->
                </div>
            </li>


    	<?php } ?>

  	</ul>
</div>
<div class="message-reply-message flex-grow-1">
    <form class="form-msg" method="post">
    	<input type="hidden" name="start_thread_message_form_ajax"
		   value="<?php echo wp_create_nonce('start-thread-message-form-nonce'); ?>"/>
		<input type="hidden" name="thread_id" value="<?php echo intval($thread_id); ?>"/>
		<input type="hidden" name="action" value="yani_thread_message">

        <div class="form-group">
            <label><?php esc_html_e( 'Reply Message', 'houzez' ); ?></label>
            <textarea class="form-control" name="message" rows="5" placeholder="<?php esc_html_e( 'Type your message here...', 'houzez' ); ?>"></textarea>
        </div>

        <button class="start_thread_message_form btn btn-primary">
        	<?php get_template_part('template-parts/loader'); ?>
        	<?php esc_html_e('Send Message', _yani_theme()->get_text_domain()); ?>		
        </button>
        
        <!-- <button class="btn btn-light-grey-outlined pull-right"><i class="yani-icon icon-attachment mr-2"></i> <?php esc_html_e('Attachment', _yani_theme()->get_text_domain()); ?></button> -->

    </form>
</div><!-- message-reply-message -->
