<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Statistics_Helper' ) ) {
	class _Yani_Statistics_Helper{
		private static $instance = null;
	
    	public function get_return_traffic_labels( $prop_id ) {

	        $record_days = $this->get_option('yani_stats_days');
	        if( empty($record_days) ) {
	            $record_days = 14;
	        }

	        $views_by_date = get_post_meta($prop_id, 'yani_views_by_date', true);

	        if (!is_array($views_by_date)) {
	            $views_by_date = array();
	        }
	        $array_labels = array_keys($views_by_date);
	        $array_labels = array_slice( $array_labels, -1 * $record_days, $record_days, false );

	        return $array_labels;
	    }

	    public function get_return_traffic_data($prop_id) {

	        $record_days = yani_option('yani_stats_days');
	        if( empty($record_days) ) {
	            $record_days = 14;
	        }

	        $views_by_date = get_post_meta( $prop_id, 'yani_views_by_date', true );
	        if ( !is_array( $views_by_date ) ) {
	            $views_by_date = array();
	        }
	        $array_values = array_values( $views_by_date );
	        $array_values = array_slice( $array_values, -1 * $record_days, $record_days, false );

	        return $array_values;
	    }


		public function get_realtor_stats($taxonomy, $meta_key, $meta_value, $term_slug) {
			global $author_id;

			$args = array(
				'post_type' => 'property',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'fields' => 'ids',
				'tax_query' => array(
			        array(
			            'taxonomy' => $taxonomy,
			            'field'    => 'slug',
			            'terms'    => $term_slug,
			            'include_children' => false
			        )
			    )
			);

			$meta_query = array();

	        if(is_singular('yani_agency')) {

	        	$agents_array = array();
	        	$agenyc_agents_ids = yani_Query::loop_agency_agents_ids(get_the_ID());

	        	if( !empty($agenyc_agents_ids) ) {
		        	$agents_array = array(
			            'key' => 'yani_agents',
			            'value' => $agenyc_agents_ids,
			            'compare' => 'IN',
			        );
		        }

	        	$args['meta_query'] = array(
	                'relation' => 'OR',
	                $agents_array,
	                array(
	                    'relation' => 'AND',
	                    array(
				            'key'     => $meta_key,
				            'value'   => $meta_value,
				            'compare' => '='
				        ),
				        array(
				            'key'     => 'yani_agent_display_option',
				            'value'   => 'agency_info',
				            'compare' => '='
				        )
	                ),
	            );


	        } elseif(is_singular('yani_agent')) {

	        	$meta_query[] = array(
		            'key' => $meta_key,
		            'value' => $meta_value,
		            'type' => 'CHAR',
		            'compare' => '=',
		        );
	        	$args['meta_query'] = $meta_query;

	        } elseif(is_author()) {
	        	$args['author'] = $author_id;
	        }

			$posts = get_posts($args); 
			//echo count($posts).'<br/>';

			return count($posts);
		}



		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

function _yani_statistics() {
	return _Yani_Statistics_Helper::get_instance();
}
	
