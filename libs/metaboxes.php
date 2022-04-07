<?php

function _themename_add_meta_box(){
	add_meta_box(
		'_themename_post_metabox',
		'Page Settings',
		'_themename_post_metabox_render',
		'page',
		'normal',
		'default'
	);

	add_meta_box(
		'_themename_post_metabox',
		'Page Settings',
		'_themename_post_metabox_render',
		'post',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes','_themename_add_meta_box');

function _themename_post_metabox_render($post){ 
	$hide_title = get_post_meta($post->ID,'__themename_hide_title',true);
	$page_layout = get_post_meta($post->ID,'__themename_page_layout',true);
	$sidebar_position = get_post_meta($post->ID,'__themename_sidebar_position',true);
	wp_nonce_field('_themename_update_post_metabox','_themename_update_post_nonce');
	?>

	<p>
		<label for="_themename_hide_title"><?php esc_html_e("Hide Page Title","_themename");?></label>
		<select name="hide_title_field" id="_themename_hide_title" value="<?php echo $hide_title;?>">
			<option value="" <?php echo ($hide_title=="") ? "selected" : "" ;?>>No</option>
			<option value="yes" <?php echo ($hide_title=="yes") ? "selected" : "" ;?>>Yes</option>
		</select>
	</p>

	<p>
		<label for="_themename-page-layout"><?php esc_html_e("Page Layout","_themename");?></label>
		<select name="page_layout" id="_themename-page-layout" value="<?php echo $page_layout;?>">
			<option value="page-full" <?php echo ($page_layout=="page-full") ? "selected" : "" ;?>>Full</option>
			<option value="sidebar-left" <?php echo ($page_layout=="sidebar-left") ? "selected" : "" ;?>>Sidebar Left</option>
			<option value="sidebar-right" <?php echo ($page_layout=="sidebar-right") ? "selected" : "" ;?>>Sidebar Right</option>
		</select>
	</p>

	<p>
		<label for="_themename-sidebar-position"><?php esc_html_e("Sidebar Position","_themename");?></label>
		<select name="sidebar_position" id="_themename-sidebar-position" value="<?php echo $sidebar_position;?>">
			<option value="sidebar-top" <?php echo ($sidebar_position=="sidebar-top") ? "selected" : "" ;?>>Top</option>
			<option value="sidebar-bottom" <?php echo ($sidebar_position=="sidebar-bottom") ? "selected" : "" ;?>>Bottom</option>
		</select>
	</p>

<?php } 

add_action('save_post','_themename_save_post_metabox',10,2);
function _themename_save_post_metabox($post_id,$post){

	$edit_cap = get_post_type_object($post->post_type)->cap->edit_post;
	if(!current_user_can($edit_cap ,$post_id)){
		return;
	}

	if(!isset($_POST['_themename_update_post_nonce']) 
		|| !wp_verify_nonce($_POST['_themename_update_post_nonce'],'_themename_update_post_metabox')){
		return;
	}

	// if(array_key_exists('hide_title_field',$_POST)){		
		$display_title = sanitize_text_field($_POST['hide_title_field']);
		$page_layout = sanitize_text_field($_POST['page_layout']);
		$sidebar_position = sanitize_text_field($_POST['sidebar_position']);
		update_post_meta($post->ID,"__themename_hide_title",$display_title);
		update_post_meta($post->ID,"__themename_page_layout",$page_layout);
		update_post_meta($post->ID,"__themename_sidebar_position",$sidebar_position);
	// }
}
?>