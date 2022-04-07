<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Yani_Query {
	 public static function loop_agency_agents( $agency_id = null, $count = null ) {
        if ( null == $agency_id ) {
            $agency_id = get_the_ID();
        }

        $args = array(
            'post_type'         => 'yani_agent',
            'posts_per_page'    => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_status' => 'publish',
            'meta_query'        => array(
                array(
                    'key'       =>  'yani_agent_agencies',
                    'value'     => $agency_id,
                    'compare'   => 'LIKE',
                ),
            ),
        );

        if ( ! empty( $count ) ) {
            $args['posts_per_page'] = $count;
        }

        return new WP_Query( $args );
    }

    public static function loop_get_author_properties_ids( $author_id = null ) {            
        $properties_ids_array = array();
        
        if ( null == $author_id ) {
            return $properties_ids_array;
        }

        $args = array(
            'post_type'         => 'property',
            'posts_per_page'    => -1,
            'post_status' => 'publish',
            'author' => $author_id,
        );

        $qry = new WP_Query( $args );

        if( $qry->have_posts() ):
            while( $qry->have_posts() ):
                $qry->the_post();

                    $properties_ids_array[] = get_the_ID();
            endwhile;
        endif;
        Yani_Query::loop_reset();

        return $properties_ids_array;
    }

    public static function author_properties_count( $author_id = null ) {
            if ( null == $author_id ) {
                $author_id = get_the_ID();
            }

            $args = array(
                'post_type' => 'property',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'author' => $author_id
            );

            $qry = new WP_Query( $args );
            return $qry->post_count;
    }

    public static function loop_get_agent_properties_ids( $agent_ids = null ) {
            
            $properties_ids_array = array();
            
            if ( null == $agent_ids ) {
                return $properties_ids_array;
            }

            $args = array(
                'post_type'         => 'property',
                'posts_per_page'    => -1,
                'post_status' => 'publish',
                'meta_query'        => array(
                    array(
                        'key'       =>  'yani_agents',
                        'value'     => $agent_ids,
                        'compare'   => 'IN',
                    ),
                ),
            );

            $qry = new WP_Query( $args );

            if( $qry->have_posts() ):
                while( $qry->have_posts() ):
                    $qry->the_post();

                        $properties_ids_array[] = get_the_ID();
                endwhile;
            endif;
            Yani_Query::loop_reset();

            return $properties_ids_array;
    }

    public static function loop_agency_properties_ids( $agency_id = null ) {
            if ( null == $agency_id ) {
                $agency_id = get_the_ID();
            }

            global $paged;
            if ( is_front_page()  ) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $properties_ids_array = array();

            $agency_listing_args = array(
                'post_type' => 'property',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'yani_property_agency',
                        'value' => $agency_id,
                        'compare' => '='
                    ),
                    array(
                        'key' => 'yani_agent_display_option',
                        'value' => 'agency_info',
                        'compare' => '='
                    ),
                )
            );

            $qry = new WP_Query( $agency_listing_args );
            if( $qry->have_posts() ):
                while( $qry->have_posts() ):
                    $qry->the_post();

                        $properties_ids_array[] = get_the_ID();
                endwhile;
            endif;
            Yani_Query::loop_reset();

            return $properties_ids_array;
    }

    public static function get_agency_agents_ids( $agency_id = null ) {
            if ( null == $agency_id ) {
                $agency_id = get_the_ID();
            }

            $agent_ids_array = array();
            $args = array(
                'post_type'         => 'yani_agent',
                'posts_per_page'    => -1,
                'post_status' => 'publish',
                'meta_query'        => array(
                    array(
                        'key'       => 'yani_agent_agencies',
                        'value'     => $agency_id,
                        'compare'   => '=',
                    ),
                ),
            );

            $agency_agents = new WP_Query( $args );

            if( $agency_agents->have_posts() ):
                while( $agency_agents->have_posts() ):
                    $agency_agents->the_post();

                        $agent_ids_array[] = get_the_ID();
                endwhile;
            endif;
            Yani_Query::loop_reset();

            return $agent_ids_array;
    }

    public static function loop_reset() {
        wp_reset_query();
    }
}
?>