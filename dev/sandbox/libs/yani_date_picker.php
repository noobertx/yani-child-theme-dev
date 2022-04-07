<?php

function yani_date_picker_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	?>
	<div class="row">
		

	<div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Start Date</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="yani-icon icon-calendar-3"></i></div>
                                </div>
                                <input id="startDate" type="text" class="form-control db_input_date" placeholder="<?php echo esc_html__('Select a date', _yani_theme()->get_text_domain()); ?>" >
                            </div><!-- input-group -->
                        </div><!-- form-group -->
                    </div>
	</div>
	<?php
	return ob_get_clean();

}
add_shortcode( "yani_date_picker", "yani_date_picker_callback" );

?>
