<?php
global $opt_name,$theme_text_domain, $allowed_html_array, $Option_Countries;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Map Settings', $theme_text_domain ),
    'id'     => 'houzez-googlemap-settings',
    'desc'   => '',
    'icon'   => 'el-icon-globe el-icon-small',
    'fields' => array(
        array(
            'id'       => 'yani_map_system',
            'type'     => 'button_set',
            'title'    => esc_html__('Map System', $theme_text_domain),
            'subtitle' => esc_html__('Select the map system that you want to use', $theme_text_domain),
            'desc'     => '',
            'options' => array(
                'osm' => 'Open Street Map',
                'mapbox' => 'Map Box',
                'google' => 'Google',
             ), 
            'default' => 'osm'
        ),
        array(
            'id'       => 'googlemap_api_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Google Maps API KEY', $theme_text_domain ),
            'desc'     => wp_kses(__( 'We strongly encourage you to get an APIs Console key and post the code in Theme Options. You can get it from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">here</a>.', $theme_text_domain ), $allowed_html_array),
            'subtitle' => esc_html__( 'Enter your google maps api key', $theme_text_domain ),
            'required'  => array('yani_map_system', '=', 'google')
        ),
        array(
            'id'       => 'mapbox_api_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Mapbox API KEY', $theme_text_domain ),
            'desc'     => wp_kses(__( 'Please enter the Mapbox API key, you can get from <a target="_blank" href="https://account.mapbox.com/">here</a>.', $theme_text_domain ), $allowed_html_array),
            'required'  => array('yani_map_system', '=', 'mapbox')
        ),
        array(
            'id'       => 'yani_map_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Map Type', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__( 'Select the map type', $theme_text_domain ),
            'required'  => array('yani_map_system', '=', 'google'),
            'options' => array(
                'roadmap' => 'Road Map',
                'satellite' => 'Satellite',
                'hybrid' => 'Hybrid',
                'terrain' => 'Terrain',
             ), 
            'default' => 'roadmap'
        ),
        

        array(
            'id'       => 'markerPricePins',
            'type'     => 'select',
            'title'    => esc_html__( 'Marker Type', $theme_text_domain ),
            'desc' => esc_html__( 'Select marker type for Google Maps', $theme_text_domain ),
            //'desc'     => '',
            'options'  => array(
                'no'   => esc_html__( 'Marker Icon', $theme_text_domain ),
                'yes'   => esc_html__( 'Price Pins', $theme_text_domain )
            ),
            'default'  => 'no'
        ),
        array(
            'id'       => 'short_prices_pins',
            'type'     => 'switch',
            'title'    => esc_html__( 'Short Price', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Please note that the currency switcher will not work if the short price functionality is enabled.', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the short price numbers like 12K, 10M, 10B.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
            'required'  => array('markerPricePins', '=', 'yes'),
        ),
        array(
            'id'       => 'marker_spiderfier',
            'type'     => 'switch',
            'title'    => esc_html__( 'Overlapping Marker Spiderfier', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the Overlapping Marker Spiderfier?', $theme_text_domain ),
            //'desc'     => '',
            'on'       => 'Yes',
            'off'      => 'No',
            'default'  => 0,
            'required'  => array('yani_map_system', '=', 'google')
        ),

        array(
            'id'       => 'map_default_lat',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Latitude', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enter default latitude for maps', $theme_text_domain ),
            'default'  => '25.686540',
            'validate' => 'numeric'
        ),

        array(
            'id'       => 'map_default_long',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Longitude', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enter default longitude for maps', $theme_text_domain ),
            'default'  => '-80.431345',
            'validate' => 'numeric'
        ),

        array(
            'id'       => 'geo_country_limit',
            'type'     => 'switch',
            'title'    => esc_html__( 'Limit to Country', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Geo autocomplete limit to specific country', $theme_text_domain ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'		=> 'geocomplete_country',
            'type'		=> 'select',
            'required'  => array('geo_country_limit', '=', '1'),
            'title'		=> esc_html__( 'Geo Auto Complete Country', $theme_text_domain ),
            'subtitle'	=> esc_html__( 'Limit Geo auto complete to specific country', $theme_text_domain ),
            'options'	=> $Option_Countries,
            'default' => ''
        ),

        /*array(
            'id'       => 'map_fullscreen',
            'type'     => 'switch',
            'title'    => esc_html__( 'Map Fullscreen', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable map fullscreen button on half map.', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'geo_location',
            'type'     => 'switch',
            'title'    => esc_html__( 'Geo Location', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable geo location.', $theme_text_domain ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
            'required'  => array('yani_map_system', '=', 'google')
        ),

        array(
            'id' => 'geo_location_info',
            'type' => 'info',
            'required' => array('geo_location', '=', '1'),
            'title' => '',
            'style' => 'info',
            'desc' => __('Note: Google Geo location not work in chrome without SSL (https://), you can enable IPINFO location below for Google chrome if you don not have SSL. ', $theme_text_domain)
        ),

        array(
            'id'       => 'ipinfo_location',
            'type'     => 'switch',
            'title'    => esc_html__( 'IPINFO Location', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable Ip info location, only work with chrome withour SSL.', $theme_text_domain ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
            'required'  => array('yani_map_system', '=', 'google')
        ),
        array(
            'id'       => 'googlemap_zoom_level',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Map Zoom', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( '1 to 20', $theme_text_domain ),
            'default'  => '12',
            'required'  => array('yani_map_system', '=', 'google')
        ),*/
    ),
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Cluster', $theme_text_domain ),
    'id'     => 'map-cluster',
    'desc'   => '',
    'icon'   => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'       => 'map_cluster_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Markers cluster', $theme_text_domain ),
            'subtitle' => '',
            'desc'     => esc_html__( 'enable or disable the marker cluster', $theme_text_domain ),
            'on'       => esc_html__('Enabled', $theme_text_domain),
            'off'      => esc_html__('Disabled', $theme_text_domain),
            'default'  => 1
        ),
        array(
            'id'        => 'map_cluster',
            'type'      => 'media',
            'title'     => esc_html__( 'Map Cluster', $theme_text_domain ),
            'read-only' => false,
            'default'   => array( 'url' => YANI_THEME_IMAGES . 'map/cluster-icon.png' ),
            'desc'  => esc_html__( 'Upload the map cluster icon.', $theme_text_domain ),
        ),
        array(
            'id'       => 'googlemap_zoom_cluster',
            'type'     => 'text',
            'title'    => esc_html__( 'Cluster Zoom Level', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the maximum zoom level for the cluster to appear. From 1 to 20 the fefault is 12', $theme_text_domain ),
            'default'  => '12',
            'required'  => array('yani_map_system', '=', 'google')
        ),
    )
        
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Single Listing Map', $theme_text_domain ),
    'id'     => 'map-single-listing',
    'desc'   => '',
    'icon'   => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'       => 'detail_map_pin_type',
            'type'     => 'select',
            'title'    => esc_html__('Pin or Circle', $theme_text_domain),
            'desc' => esc_html__('Select what to show on map, Marker or Circle', $theme_text_domain),
            'options'  => array(
                'marker'   => esc_html__( 'Marker Pin', $theme_text_domain ),
                'circle'   => esc_html__( 'Circle', $theme_text_domain ),
            ),
            'default'  => 'marker',
        ),
        array(
            'id'       => 'single_mapzoom',
            'type'     => 'text',
            'title'    => esc_html__( 'Single Listing Map Zoom', $theme_text_domain ),
            'desc'     => '',
            'desc' => esc_html__( 'Enter a number from 1 to 20 the fefault is 12', $theme_text_domain ),
            'default'  => '14',
            'validate' => 'numeric'
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Map Style', $theme_text_domain ),
    'id'     => 'map-style',
    'desc'   => '',
    'icon'   => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'       => 'googlemap_stype',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Style for Google Map', $theme_text_domain ),
            'subtitle' => esc_html__( 'Use https://snazzymaps.com/ to create styles', $theme_text_domain ),
            'desc'     => '',
            'default'  => '',
            'mode'     => 'plain',
        )
    )
));