<?php 
$website = get_post_meta( get_the_ID(), 'yani_agency_web', true );

if( !empty( $website ) ) { ?>
	<li>
		<strong><?php esc_html_e('Website', _yani_theme()->get_text_domain()); ?></strong> 
		<a target="_blank" href="<?php echo esc_url($website); ?>"><?php echo esc_attr( $website ); ?></a>
	</li>
<?php } ?>