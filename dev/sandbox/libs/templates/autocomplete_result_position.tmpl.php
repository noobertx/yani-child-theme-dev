<?php $background_type=""; ?>
<section class="top-banner-wrap top-banner-wrap-fullscreen horizontal-search-wrap" style="max-height:700px;">
    <div id="houzez-auto-complete-banner" class="auto-complete"></div>
    <?php 
    if ( $background_type == 'slider' ) {

        echo '<div class="splash-slider-wrap">';

        if(!empty($image_ids)) {
            foreach ( $image_ids as $id ) {
                $url = wp_get_attachment_image_src($id, array(2000, 1000));
                echo '<div class="splash-slider-item" style="background-image: url('.esc_url($url[0]).');"></div>';
                
            } 
        }

        echo '</div>';
    } else if($background_type == 'video') {

        echo '<div id="video-background" class="video-background splash-video-background" data-vide-bg="mp4: '.$mp4.', webm: '.$webm.', ogv: '.$ogv.', poster: '.$video_image.'" data-vide-options="position: 0% 50%">
            </div>';

    } ?>

    <?php if( $background_type == 'image' ) { ?>
    <div class="banner-inner parallax d-flex" data-parallax-bg-image="<?php echo esc_url($bg_img); ?>">
    <?php } else { ?>
    <div class="banner-inner d-flex">
    <?php } ?>
        <div class="align-self-center flex-fill">
            <div class="banner-caption">
                <h2 class="banner-title">SPLASH WELCOME TEXT HERE</h2>
                <p class="banner-subtitle">SPLASH SUBTITLE HERE</p>
                <?php get_template_part('template-parts/search/search-for-banners'); ?>
            </div><!-- banner-caption -->
        </div><!-- align-self-center -->
    </div><!-- banner-inner parallax -->
</section><!-- top-banner-wrap -->