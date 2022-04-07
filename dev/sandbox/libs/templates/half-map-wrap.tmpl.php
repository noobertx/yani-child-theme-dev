<?php
$wrap_class = 'listing-v1';
?>
<section class="half-map-wrap map-on-left clearfix">
    <div id="map-view-wrap" class="half-map-left-wrap">
        <div class="map-wrap">
            <?php get_template_part('template-parts/map-buttons'); ?>
            
            <div id="houzez-properties-map"></div> 

            <div id="houzez-map-loading" class="houzez-map-loading">
                <div class="mapPlaceholder">
                    <div class="loader-ripple spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="half-map-listing-area" class="half-map-right-wrap <?php echo esc_attr($wrap_class); ?>">
        Map is in here
    </div>
</section>