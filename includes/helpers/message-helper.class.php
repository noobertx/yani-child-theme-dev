<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Message_Helper' ) ) {
	class _Yani_Message_Helper{
		private static $instance = null;

		function __construct() {
			add_filter( 'yani_start_thread', array($this,'start_thread_filter', 1, 1 ));
			add_filter( 'yani_thread_message', array($this,'thread_message_filter', 3, 9 ));
			add_filter( 'yani_message_email_notification', array($this,'message_email_notification_filter', 4, 9 ));
		}

		public function start_thread_filter( $property_id ) {

			global $wpdb, $current_user;	
			wp_send_json_success($thread_id);

			wp_get_current_user();
			$sender_id =  $current_user->ID;
			$receiver_id = get_post_field( 'post_author', $property_id );
			$table_name = $wpdb->prefix . 'yani_threads';
			$agent_display_option = get_post_meta( $property_id, 'yani_agent_display_option', true );
			$prop_agent_display = get_post_meta( $property_id, 'yani_agents', true );
			if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
				$prop_agent_id = get_post_meta( $property_id, 'yani_agents', true );
				$agent_user_id = get_post_meta( $prop_agent_id, 'yani_user_meta_id', true );
				if ( !empty( $agent_user_id ) && $agent_user_id != 0 ) {
					$receiver_id = $agent_user_id;
				}
			} elseif( $agent_display_option == 'agency_info' ) {
				$prop_agent_id = get_post_meta( $property_id, 'yani_property_agency', true );
				$agent_user_id = get_post_meta( $prop_agent_id, 'yani_user_meta_id', true );
				if ( !empty( $agent_user_id ) && $agent_user_id != 0 ) {
					$receiver_id = $agent_user_id;
				}
			}

			$id = $wpdb->insert(
				$table_name,
				array(
					'sender_id' => $sender_id,
					'receiver_id' => $receiver_id,
					'property_id' => $property_id,
					'time'	=> current_time( 'mysql' )
				),
				array(
					'%d',
					'%d',
					'%d',
					'%s'
				)
			);

			return $wpdb->insert_id;

		}

		public function thread_message_filter( $thread_id, $message, $attachments ) {

			global $wpdb, $current_user;

			if ( is_array( $attachments ) ) {
				$attachments = serialize( $attachments );
			}

			wp_get_current_user();
			$created_by =  $current_user->ID;
			$table_name = $wpdb->prefix . 'yani_thread_messages';

			$message = stripslashes($message);
			$message = htmlentities($message);

			$message_id = $wpdb->insert(
				$table_name,
				array(
					'created_by' => $created_by,
					'thread_id' => $thread_id,
					'message' => $message,
					'attachments' => $attachments,
					'time' => current_time( 'mysql' )
				),
				array(
					'%d',
					'%d',
					'%s',
					'%s',
					'%s'
				)
			);

			$tabel = $wpdb->prefix . 'yani_threads';
			$wpdb->update(
				$tabel,
				array(  'seen' => 0 ),
				array( 'id' => $thread_id ),
				array( '%d' ),
				array( '%d' )
			);

			$message_query = "SELECT * FROM $tabel WHERE id = $thread_id";
			$yani_thread = $wpdb->get_row( $message_query );
			$receiver_id = $yani_thread->sender_id;

			if ( $receiver_id == $created_by ) {
				$receiver_id = $yani_thread->receiver_id;
			}

			$receiver_data = get_user_by( 'id', $receiver_id );

			apply_filters( 'yani_message_email_notification', $thread_id, $message, $receiver_data->user_email, $created_by );

			return $message_id;

		}

	public function message_email_notification_filter( $thread_id, $message, $email, $created_by ) {

		ob_start();

		$url_query = array( 'thread_id' => $thread_id, 'seen' => true );
		$thread_link = yani_get_template_link('template/user_dashboard_messages.php');
		$thread_link = add_query_arg( $url_query, $thread_link );
		$sender_name = get_the_author_meta( 'display_name', $created_by );

		?>
		<table style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;width:100%;margin:0;padding:0">
			<tbody>
			<tr style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0">
				<td style="font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0">
					<p style="margin:0 0 15px;padding:0"><?php esc_html_e( 'You have a new message on', 'yani' ); ?> <b><?php echo esc_attr( get_option('blogname') );?></b> <?php echo esc_html_e('from', 'yani');?> <i><?php echo esc_attr($sender_name); ?></i></p>
					<div style="padding-left:20px;margin:0;border-left:2px solid #ccc;color:#888">
						<p><?php echo $message; ?></p>
					</div>
					<p style="padding:20px 0 0 0;margin:0">
						<a style="color:#15bcaf" href="<?php echo esc_url( $thread_link ); ?>">
							<?php echo esc_html__('Click here to see message on website dashboard.', 'yani');?>
						</a>
					</p>
				</td>
			</tr>
			</tbody>
		</table>

		<?php
		$data = ob_get_contents();

		ob_clean();

		$subject = esc_html__( 'You have new message!', 'yani' );

		_yani_email()->send_messages_emails( $email, $subject, $data );

	}


		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

function _yani_message() {
	return _Yani_Message_Helper::get_instance();
}

_yani_message();