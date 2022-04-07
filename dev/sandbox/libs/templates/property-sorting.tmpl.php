<?php
global $post;

$sortby = '';
if( isset( $_GET['sortby'] ) ) {
    $sortby = $_GET['sortby'];
}
$sort_id = 'sort_properties';

?>
<div class="sort-by">
	<div class="d-flex align-items-center">
		<div class="sort-by-title">
			<?php esc_html_e( 'Sort by:', _yani_theme()->get_text_domain() ); ?>
		</div><!-- sort-by-title -->  
		<select id="<?php echo esc_attr($sort_id); ?>" class="selectpicker form-control bs-select-hidden" title="<?php esc_html_e( 'Default Order', _yani_theme()->get_text_domain() ); ?>" data-live-search="false" data-dropdown-align-right="auto">
			<option value=""><?php esc_html_e( 'Default Order', _yani_theme()->get_text_domain() ); ?></option>
			<option <?php selected($sortby, 'a_price'); ?> value="a_price"><?php esc_html_e('Price - Low to High', _yani_theme()->get_text_domain()); ?></option>
            <option <?php selected($sortby, 'd_price'); ?> value="d_price"><?php esc_html_e('Price - High to Low', _yani_theme()->get_text_domain()); ?></option>
            
            <option <?php selected($sortby, 'featured_first'); ?> value="featured_first"><?php esc_html_e('Featured Listings First', _yani_theme()->get_text_domain()); ?></option>
            
            <option <?php selected($sortby, 'a_date'); ?> value="a_date"><?php esc_html_e('Date - Old to New', _yani_theme()->get_text_domain() ); ?></option>
            <option <?php selected($sortby, 'd_date'); ?> value="d_date"><?php esc_html_e('Date - New to Old', _yani_theme()->get_text_domain() ); ?></option>
		</select><!-- selectpicker -->
	</div><!-- d-flex -->
</div><!-- sort-by -->