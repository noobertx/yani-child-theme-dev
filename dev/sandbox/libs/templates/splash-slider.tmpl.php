<?php
    $listings = [
                        ['id'=>2725,'title'=>"Property 1"],
                        ['id'=>4396,'title'=>"Property 2"],
                        ['id'=>2687,'title'=>"Property 3"],
                        ['id'=>2677,'title'=>"Property 4"],
                        ['id'=>2669,'title'=>"Property 5"],
                        ['id'=>4392,'title'=>"Property 6"]
                    ];

     $background_type  = 'slider';
?>
<section class="top-banner-wrap top-banner-wrap-fullscreen horizontal-search-wrap">
    <div id="houzez-auto-complete-banner" class="auto-complete"></div>
    <?php 
    if ( $background_type == 'slider' ) {

        echo '<div class="splash-slider-wrap">';

        if(!empty($listings)) {
            foreach ( $listings as $id ) {
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
                <h2 class="banner-title"><?php echo $splash_welcome_text; ?></h2>
                <p class="banner-subtitle"><?php echo $page_head_subtitle; ?></p>
                <?php get_template_part('template-parts/search/search-for-banners'); ?>
            </div><!-- banner-caption -->
        </div><!-- align-self-center -->
    </div><!-- banner-inner parallax -->
</section><!-- top-banner-wrap -->