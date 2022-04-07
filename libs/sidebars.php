<?php 
function _themename_sidebar_widgets(){
	register_sidebar(array(
		'id' => 'primary-sidebar',
		'name' => esc_html(__('Primary Sidebar','_themename')),
		'description' => esc_html(__('Sidebar Appears','_themename')),
		'before_widget' => '<section id="%1$s" class="">',
		'after_widget' => '</section>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
}

add_action('widgets_init','_themename_sidebar_widgets');
function _themename_footer_widgets(){
	$columns = [3,3,3,3];

	foreach($columns as $i => $column){
		register_sidebar(array(
			'id' => 'footer-sidebar-'.$i,
			'name' => esc_html(__('Footer Sidebar ('.($i+1).')' ,'_themename')),
			'description' => esc_html(__('Footer Widgets','_themename')),
			'before_widget' => '<section id="%1$s" class="">',
			'after_widget' => '</section>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
	}
}
add_action('widgets_init','_themename_footer_widgets');
?>