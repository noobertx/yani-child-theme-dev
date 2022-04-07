<?php global $is_multi_steps; ?>
<div id="attachments" class="dashboard-content-block-wrap <?php echo esc_attr($is_multi_steps);?>">
	<h2><?php echo yani_theme()->get_option('cls_documents', 'Property Documents'); ?></h2>
	<div class="dashboard-content-block">
		<p><?php echo yani_theme()->get_option('cl_decuments_text', 'You can attach PDF files, Map images OR other documents.'); ?></p>
		<p><a href="#" id="select_attachments" class="btn btn-primary"><?php echo yani_theme()->get_option('cl_attachment_btn', 'Select Attachment'); ?></a></p>
		<p id="yani_atach_errors"></p>

		<table class="dashboard-table draggable-table">
			<thead>
				<tr>
					<td colspan="4">
						<label><?php echo yani_theme()->get_option('cl_uploaded_attachments', 'Uploaded Attachments'); ?></label>
					</td>
				</tr>
			</thead>
			<tbody id="yani_attachments_container">
				<?php
				if(yani_edit_property()) { 
					global $property_data;
					$property_attachs = get_post_meta( $property_data->ID, 'yani_attachments', false );
                    $property_attachs = array_unique($property_attachs);

                    if( !empty($property_attachs[0])) {
                        foreach ($property_attachs as $prop_attach_id) {

                            $fullimage_url  = wp_get_attachment_image_src( $prop_attach_id, 'full' );
                            $attachment_title = get_the_title($prop_attach_id);

                            
                            echo '<tr class="attach-thumb">
								<td class="table-full-width table-cell-title">
									<span>'.esc_attr($attachment_title).'</span>
								</td>
								<td>
									<a href="'.$fullimage_url[0].'" target="_blank" class="btn btn-light-grey-outlined"><i class="yani-icon icon-download-bottom"></i></a>
								</td>
								<td>
									<button data-attach-id="' . intval($property_data->ID) . '"  data-attachment-id="' . intval($prop_attach_id) . '" class="attachment-delete btn btn-light-grey-outlined"><i class="yani-icon icon-close"></i></button>
								</td>
								<td class="sort-attachment">
									<a class="btn btn-light-grey-outlined"><i class="yani-icon icon-navigation-menu"></i></a>
								</td>
								<input type="hidden" class="propperty-attach-id" name="propperty_attachment_ids[]" value="' . intval($prop_attach_id) . '"/>
							</tr>';
							

                        }
                    }
				}
				?>
			</tbody>
		</table>
	</div><!-- dashboard-content-block -->
</div><!-- dashboard-content-block-wrap -->