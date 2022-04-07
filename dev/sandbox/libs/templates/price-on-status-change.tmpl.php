<?php
$search_builder = _yani_search()->search_builder();
        $layout = $search_builder['enabled']
?>

<div class="advanced-search-widget">
            <form class="houzez-search-form-js" method="get" autocomplete="off" action="<?php echo esc_url( _yani_template()->get_search_template_link() ); ?>">
                <?php
                $i = 0;
                if ($layout) {
                    foreach ($layout as $key=>$value) { $i ++;
                        
                        if(in_array($key, _yani_search()->get_search_builtIn_fields())) {
                            
                            get_template_part('template-parts/search/fields/'.$key);
                            
                        } else {
                            _yani_search()->get_custom_search_fields($key);
                        }
                    }
                }
                
                if(_yani_search()->is_price_range_search()) {
                    get_template_part('template-parts/search/fields/price-range'); 
                }

                if(_yani_search()->is_other_featuers_search()) {
                    get_template_part('template-parts/search/other-features');
                }

                get_template_part('template-parts/search/fields/submit-button'); ?>
            </form>
        </div>