<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Review_Helper' ) ) {
	class _Yani_Review_Helper{
		private static $instance = null;

		public function get_stars($stars, $is_label = true ) {

		
			$output = '';

			if($stars >= 1 && $stars < 1.5) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Poor', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars >= 1.5 && $stars < 2) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating half-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Fair', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars >= 2 & $stars < 2.5) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Fair', _yani_theme()->get_text_domain()).'</span>';
			        }

			}  elseif($stars >= 2.5 & $stars < 3) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating half-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Average', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars >= 3 && $stars < 3.5 ) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Average', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars >= 3.5 && $stars < 4 ) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating half-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Good', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars >= 4 && $stars < 4.5) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating empty-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Good', _yani_theme()->get_text_domain()).'</span>';
			        }

			}  elseif($stars >= 4.5 && $stars < 5) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating half-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Exceptional', _yani_theme()->get_text_domain()).'</span>';
			        }

			} elseif($stars == 5) {
				$output = '
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					<span class="star"><i class="icon-rating full-star"></i></span>
					';

		            if($is_label) {
			            $output .= '<span class="label bg-success">'.esc_html__('Exceptional', _yani_theme()->get_text_domain()).'</span>';
			        }
			}

			return $output;

		}

	public function check_user_review($user_id, $listing_id, $review_post_type){
		$returnVal = false;
		
		if(!empty($user_id) && !empty($listing_id)){
			
			$args = array(
				'post_type'  => 'yani_reviews',
				'post_status'	=> 'publish',
				'author' => $user_id,
				'posts_per_page' => -1,
				
		 	);
		 	$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					if($review_post_type == 'property') {
						$current_review = get_post_meta(get_the_ID(), 'review_property_id', true);

					} elseif($review_post_type == 'yani_agent') {
						$current_review = get_post_meta(get_the_ID(), 'review_agent_id', true);

					} elseif($review_post_type == 'yani_agency') {
						$current_review = get_post_meta(get_the_ID(), 'review_agency_id', true);

					} elseif($review_post_type == 'yani_author') {
						$current_review = get_post_meta(get_the_ID(), 'review_author_id', true);

					}

					if($current_review==$listing_id){
						$returnVal = true;
					}
				}
				wp_reset_postdata();
			}
			
		}
		else{
			$returnVal = false;
		}
		return $returnVal;
	}

	public function add_listing_rating($listing_id, $meta_key, $new_stars = null) {
		$args = array(
		    'post_type'   => 'yani_reviews',
		    'meta_key' => $meta_key,
		    'meta_value' => $listing_id,
		    'posts_per_page' => -1,
		    'post_status' => 'publish',
		);

		$listing_rating = '';
		$total_stars = $total_review = 0;

		$review_query = new WP_Query($args);
		if($review_query->have_posts()) {
			$total_review = $review_query->found_posts;

			while($review_query->have_posts()): $review_query->the_post();
				$review_stars = get_post_meta(get_the_ID(), 'review_stars', true);
				$total_stars = $total_stars + $review_stars;

			endwhile; 
			wp_reset_postdata();

			$total_review = $total_review+1;
			$total_stars = $total_stars+$new_stars;

			$rating = $total_stars/$total_review;

			update_post_meta($listing_id, 'yani_total_rating', $rating);
			return true;

		} else {
			
			update_post_meta($listing_id, 'yani_total_rating', $new_stars);
		}

		return true;
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

function _yani_review() {
	return _Yani_Review_Helper::get_instance();
}