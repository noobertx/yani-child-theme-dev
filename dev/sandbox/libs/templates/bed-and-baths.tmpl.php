<?php
$sticky_hidden = '';
$sticky_data = '';
$hidden_data = '0';
$search_builder = _yani_search()->search_builder();
$layout = $search_builder['enabled'];



?>

<section id="desktop-header-search" class="advanced-search advanced-search-nav <?php echo esc_attr($sticky_hidden); ?>" data-hidden="<?php echo esc_attr($hidden_data); ?>" data-sticky='<?php echo esc_attr( $sticky_data ); ?>'>

	<div class="<?php echo _yani_search()->get_header_search_width(); ?>">
		<form class="houzez-search-form-js <?php _yani_search()->get_search_filters_class(); ?>" method="get" autocomplete="off" action="<?php echo esc_url( _yani_template()->get_search_template_link() ); ?>">

			<?php do_action('yani_search_hidden_fields'); ?>
			
		<div class="advanced-search-v3">
			<div class="d-flex">
				
				<?php
				$i = 0;
				
				if ($layout) {
					foreach ($layout as $key=>$value) { $i ++;
						$class_flex_grow = '';
						$directory = 'fields';
						$common_class = "flex-search";
						if($key == 'keyword' || $key == 'geolocation') {
							$class_flex_grow = 'flex-grow-1';
						} elseif($i == 1) {
							$class_flex_grow = 'flex-grow-1';
						}

						if($key == 'type' || $key == 'status' || $key == 'price' || $key == 'label' || $key == 'bedrooms' || $key == 'bathrooms') {
						}
							$directory = "fields-v3";
						if(in_array($key, _yani_search()->get_search_builtIn_fields())) {
							echo '<div class="'.$common_class.' '.$class_flex_grow.'">';
								get_template_part('template-parts/search/'.$directory.'/'.$key);
							echo '</div>';

							if($key == 'geolocation') {
								echo '<div class="flex-search">';
									get_template_part('template-parts/search/'.$directory.'/distance');
								echo '</div>';
							}
							
						} else {

							echo '<div class="'.$common_class.' '.$class_flex_grow.'">';
								_yani_search()->get_custom_search_fields($key);
							echo '</div>';
							
						}
						if($i == _yani_search()->get_search_builder_first_row())
							break;
					}
				}
				?>

				<?php if( ! _yani_search()->get_adv_search_visible() ) { ?>
				<div class="flex-search">
					<?php get_template_part('template-parts/search/fields-v3/more-options'); ?>
				</div>
				<?php } ?>
				
				<div class="flex-search btn-no-right-padding">
					<?php get_template_part('template-parts/search/fields/submit-button'); ?>
				</div>
			</div>
		</div>

		<div id="advanced-search-filters" class="collapse">
			<?php get_template_part('template-parts/search/filters'); ?>
		</div>
		
	</form>
	</div>
</section>