<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:26 PM
 */
global $post, $top_area, $map_street_view;
$layout = yani_option('property_blocks_tabs');
$schedule = yani_option('yani_tabs_schedule');
$energy_class = yani_option('yani_energy_class');
$availability_calendar = yani_option('yani_availability_calendar');
$show_similer = yani_option( 'yani_similer_properties' );
$property_reviews = yani_option( 'property_reviews' );
$yani_mortgage = yani_option( 'yani_mortgage' );
$yani_sublisting = yani_option( 'yani_sublisting' );
$layout = $layout['enabled'];
$floor_plans = get_post_meta( $post->ID, 'floor_plans', true );
$video_url = get_post_meta( $post->ID, 'yani_video_url', true );
$virtual_tour = get_post_meta( $post->ID, 'yani_virtual_tour', true );

$tab_end = '</div>';
$li_start = '<li class="nav-item">';
$li_end = '</li>';
?>

<!--start detail content tabber-->
<div class="listing-tabs horizontal-listing-tabs">
    <ul class="nav nav-tabs nav-justified">
        <?php
        $i = 0;
        if ($layout): foreach ($layout as $key => $value) {

            if( $i == 0 ) { $a_active = 'active'; } else { $a_active = ''; }

            switch($key) {

                case 'description':
                    echo $li_start;
                    echo '<a class="nav-link '.$a_active.'" href="#property-description" data-toggle="tab">'.yani_option('sps_description', 'Description').'</a>';
                    echo $li_end;
                    $i++;
                    break;

                case 'address':
                    echo $li_start;
                    echo '<a class="nav-link '.$a_active.'" href="#property-address" data-toggle="tab">'.yani_option('sps_address', 'Address').'</a>';
                    echo $li_end;
                    $i++;
                    break;

                case 'details':
                    echo $li_start;
                    echo '<a class="nav-link '.$a_active.'" href="#property-details" data-toggle="tab">'.yani_option('sps_details', 'Details').'</a>';
                    echo $li_end;
                    $i++;
                    break;

                case 'features':
                    echo $li_start;
                    echo '<a class="nav-link '.$a_active.'" href="#property-features" data-toggle="tab">'.yani_option('sps_features', 'Features').'</a>';
                    echo $li_end;
                    $i++;
                    break;

                case 'floor_plans':
                    if( isset($floor_plans[0]['yani_plan_title']) && !empty( $floor_plans[0]['yani_plan_title'] ) ) {
                        echo $li_start;
                        echo '<a class="nav-link '.$a_active.'" href="#property-floor-plans" data-toggle="tab">'.yani_option('sps_floor_plans', 'Floor Plans').'</a>';
                        echo $li_end;
                        $i++;
                    }
                    break;

                case 'video':

                    if( !empty($video_url ) ) {
                        echo $li_start;
                        echo '<a class="nav-link '.$a_active.'" href="#property-video" data-toggle="tab">'.yani_option('sps_video', 'Video').'</a>';
                        echo $li_end;
                        $i++;
                    }
                    break;

                case 'virtual_tour':

                    if( !empty($virtual_tour) ) {
                        echo $li_start;
                        echo '<a class="nav-link '.$a_active.'" href="#property-virtual-tour" data-toggle="tab">'.yani_option('sps_virtual_tour', '360?? Virtual Tour').'</a>';
                        echo $li_end;
                        $i++;
                    }
                    break;

            }
        }

        endif;
        ?>

    </ul>
</div>

    <!--start tab-content-->
    <div class="tab-content horizontal-tab-content" id="property-tab-content">
        <?php
        $j = 0;
        if ($layout): foreach ($layout as $key=>$value) {

            if( $j == 0 ) { $tab_active = 'show active'; } else { $tab_active = ''; }

            switch($key) {

                case 'description':
                    echo '<div class="tab-pane fade '.$tab_active.'" id="property-description" role="tabpanel">';
                        get_template_part('property-details/description'); 
                    echo '</div>';
                    $j++;
                    break;

                case 'address':
                    echo '<div class="tab-pane fade '.$tab_active.'" id="property-address" role="tabpanel">';
                        get_template_part('property-details/address');
                    echo '</div>';
                    $j++;
                    break;

                case 'details':
                    echo '<div class="tab-pane fade '.$tab_active.'" id="property-details" role="tabpanel">';
                        get_template_part('property-details/detail');
                    echo '</div>';
                    $j++;
                    break;

                case 'features':
                    echo '<div class="tab-pane fade '.$tab_active.'" id="property-features" role="tabpanel">';
                        get_template_part('property-details/features');
                    echo '</div>';
                    $j++;
                    break;

                case 'floor_plans':
                    echo '<div class="tab-pane fade '.$tab_active.'" id="property-floor-plans" role="tabpanel">';
                        get_template_part('property-details/floor-plans');
                    echo '</div>';
                    $j++;
                    break;

                case 'video':

                    if( !empty($video_url ) ) {
                        echo '<div class="tab-pane fade '.$tab_active.'" id="property-video" role="tabpanel">';
                            get_template_part('property-details/video');
                        echo '</div>';
                        $j++;
                    }
                    break;

                case 'virtual_tour':
                    if( !empty($virtual_tour) ) {
                        echo '<div class="tab-pane fade '.$tab_active.'" id="property-virtual-tour" role="tabpanel">';
                            get_template_part('property-details/virtual-tour');
                        echo '</div>';
                        $j++;
                    }
                    break;
            }
        }

        endif;
        ?>

    </div>
    <!--end tab-content-->
    
    <?php
    if($top_area != 'v6') {
        get_template_part('property-details/overview'); 
    }

    if( $yani_mortgage != 0 && yani_hide_calculator() ) {
        get_template_part('property-details/mortgage-calculator');
    }

    if($yani_sublisting != 0) {
        get_template_part('property-details/sub-listing-main');
    }

    if($energy_class != 0) {
        get_template_part('property-details/energy');
    }

    get_template_part('property-details/walkscore');

    get_template_part('property-details/yelp-nearby');

    if($schedule != 0) { 
        get_template_part('property-details/schedule-a-tour');
    }

    if($availability_calendar != 0) {
        get_template_part('property-details/availability-calendar');
    }

    if( yani_option('tabs_agent_bottom', 1) ) {
        get_template_part('property-details/agent-form-bottom');
    }

    if($property_reviews != 0) {
        get_template_part('property-details/reviews');
    }

    get_template_part('property-details/similar-properties');
    ?>
