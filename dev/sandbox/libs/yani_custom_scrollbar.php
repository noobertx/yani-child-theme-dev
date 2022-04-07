<?php

function yani_custom_scrollbar_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

$deals = array();

array_push($deals,(object)array(
	"deal_id"=>"1",
	"title"=>"Sample Deal",
	"status"=>"active",
	"agent_id"=>"12",
	"lead_id"=>"123",
	"next_action"=>"next_action",
	"action_due_date"=>"action_due_date",
	"last_contact_date"=>"last_contact_date",
	"value"=>"4000",
));

array_push($deals,(object)array(
	"deal_id"=>"2",
	"title"=>"Sample Deal 2",
	"status"=>"active",
	"agent_id"=>"21",
	"lead_id"=>"32",
	"next_action"=>"next_action",
	"action_due_date"=>"action_due_date",
	"last_contact_date"=>"last_contact_date",
	"value"=>"4000",
));

array_push($deals,(object)array(
	"deal_id"=>"3",
	"title"=>"Sample Deal 3",
	"status"=>"active",
	"agent_id"=>"42",
	"lead_id"=>"67",
	"next_action"=>"next_action",
	"action_due_date"=>"action_due_date",
	"last_contact_date"=>"last_contact_date",
	"value"=>"5000",
));

array_push($deals,(object)array(
	"deal_id"=>"4",
	"title"=>"Sample Deal 4",
	"status"=>"active",
	"agent_id"=>"56",
	"lead_id"=>"89",
	"next_action"=>"next_action",
	"action_due_date"=>"action_due_date",
	"last_contact_date"=>"last_contact_date",
	"value"=>"4800",
));

	
	ob_start();
	echo "This feature is only available on deals table...<br> Feature is underconstruction";
	?>
	<table class="dashboard-table table-lined deals-table responsive-table">
		<tbody>
	<?php 	foreach($deals as $deal_data){	?>

	<tr data-id="<?php echo intval($deal_data->deal_id); ?>">
		<th class="table-nowrap" data-label="<?php esc_html_e('Title', _yani_theme()->get_text_domain()); ?>">
			<strong><?php echo esc_attr($deal_data->title); ?></strong>
		</th>
		<td class="table-nowrap" data-label="<?php esc_html_e('Contact Name', _yani_theme()->get_text_domain()); ?>">
			Robert Talavera
		</td>
		<td class="table-nowrap" data-label="<?php esc_html_e('Agent', _yani_theme()->get_text_domain()); ?>">
			<i class="yani-icon icon-single-neutral-circle mr-2 grey"></i> Alvin McHouse
		</td>
		<td class="table-nowrap" data-label="<?php esc_html_e('Status', _yani_theme()->get_text_domain()); ?>">
			<select class="selectpicker deal_status form-control bs-select-hidden deals-status" title="<?php esc_html_e('Select', _yani_theme()->get_text_domain()); ?>">
				<?php
				$status_settings ='New Lead,Meeting Scheduled,Qualified,Proposal Sent,Called,	Negotiation,Email Sent';
				if(!empty($status_settings)) {
					$status_array = explode(',', $status_settings);
					foreach( $status_array as $status_name ) {
						echo '<option value="'.trim($status_name).'">'.esc_attr($status_name).'</option>';
					}
				}
				?>
			</select><!-- selectpicker -->
		</td>
		<td class="table-nowrap" data-label="<?php esc_html_e('Action Due Date', _yani_theme()->get_text_domain()); ?>">
			<input type="text" class="form-control deal_action_due" value="<?php echo esc_attr($deal_data->action_due_date); ?>" placeholder="<?php esc_html_e('Select a Date', _yani_theme()->get_text_domain()); ?>" readonly>
		</td>
		<td class="table-nowrap" data-label="<?php esc_html_e('Deal Value', _yani_theme()->get_text_domain()); ?>">
		<?php echo esc_attr($deal_data->value); ?>
		</td>

		<td class="table-nowrap" data-label="<?php esc_html_e('Last Contact Date', _yani_theme()->get_text_domain()); ?>">
			<input type="text" class="form-control deal_last_contact" value="<?php echo esc_attr($deal_data->last_contact_date); ?>" placeholder="<?php esc_html_e('Select a Date', _yani_theme()->get_text_domain()); ?>" readonly>
		</td>

		<td class="table-nowrap" data-label="<?php esc_html_e('Phone', _yani_theme()->get_text_domain()); ?>">
			<strong>+63 921 5475 306</strong>
		</td>

		<td class="table-nowrap" data-label="<?php esc_html_e('Email', _yani_theme()->get_text_domain()); ?>">
			<a href="mailto:noobertx@gmail.com"><strong>noobertx@gmail.com</strong></a>
		</td>

		<td class="table-nowrap">
			<div class="dropdown property-action-menu">
				<button class="btn btn-primary-outlined dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php esc_html_e('Actions', _yani_theme()->get_text_domain()); ?>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
					<a class="crm-edit-deal-js dropdown-item open-close-slide-panel" data-id="<?php echo intval($deal_data->deal_id)?>" href="#"><?php esc_html_e('Edit', _yani_theme()->get_text_domain()); ?></a>
					<a class="delete-deal-js dropdown-item" data-id="<?php echo intval($deal_data->deal_id)?>" data-nonce="<?php echo wp_create_nonce('delete_deal_nonce') ?>" href="#"><?php esc_html_e('Delete', _yani_theme()->get_text_domain()); ?></a>
				</div>
			</div>
		</td>

	</tr>
	<?php	} ?>
</tbody>
</table>
<?php
	return ob_get_clean();

}
add_shortcode( "yani_custom_scrollbar", "yani_custom_scrollbar_callback" );

?>
