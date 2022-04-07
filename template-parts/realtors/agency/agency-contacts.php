<div class="agent-contacts-wrap">
	<h3 class="widget-title"><?php esc_html_e('Contact', _yani_theme()->get_text_domain()); ?></h3>
	<div class="agent-map">
		<?php get_template_part('template-parts/realtors/agency/image'); ?>
		<?php 
		if( yani_option('agency_address', 1) ) {
			get_template_part('template-parts/realtors/agency/address'); 
		}?>
	</div>
	<ul class="list-unstyled">

		<?php 
		if( yani_option('agency_phone', 1) ) {
			get_template_part('template-parts/realtors/agency/office-phone');
		} 

		if( yani_option('agency_mobile', 1) ) {
			get_template_part('template-parts/realtors/agency/mobile'); 
		}

		if( yani_option('agency_fax', 1) ) {
			get_template_part('template-parts/realtors/agency/fax');
		} 

		if( yani_option('agency_email', 1) ) {
			get_template_part('template-parts/realtors/agency/email'); 
		}
		if( yani_option('agent_website', 1) ) {
			get_template_part('template-parts/realtors/agency/website'); 
		}?>
	</ul>

	<?php 
	if( yani_option('agency_social', 1) ) { 
		get_template_part('template-parts/realtors/agency/social', 'v2'); 
	} ?>

</div><!-- agent-bio-wrap -->