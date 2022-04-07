<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Post_Helper' ) ) {
	class _Yani_Post_Helper{
		private static $instance = null;		

		public function init(){
			add_filter('wp_link_pages_args', array($this,'add_link_pages_args_prevnext'));
		}

		public function can_be_editted() {
	        if ( isset( $_GET[ 'edit_property' ] ) && ! empty( $_GET[ 'edit_property' ] ) ) {
	            return true;
	        }

	        return false;
	    }

	    
	    public function is_published( $post_id ) {
	        if( get_post_status( $post_id ) == 'publish' ) {
	            return true;
	        }
	        return false;
	    }

	    public function check_post_status( $post_id ,$status) {
	        if( get_post_status( $post_id ) == 'draft' ) {
	            return true;
	        }
	        return false;
	    }

		
	    
	    public function check_post_types_plugin($post_type) {

	        if(class_exists('yani_Post_Type')) {
	            if(yani_Post_Type::get_setting($post_type) != 'disabled') {
	                return true;
	            } else {
	                return false;
	            }
	        }

	        return true;
	    }
		public function render_pagination( $pages = '' ) {        
	        $paged = 1;
	        if ( get_query_var( 'paged' ) ) {
	            $paged = get_query_var( 'paged' );
	        } elseif ( get_query_var( 'page' ) ) { // if is static front page
	            $paged = get_query_var( 'page' );
	        }

	        $prev = $paged - 1;
	        $next = $paged + 1;
	        $range = 2; // change it to show more links
	        $showitems = ( $range * 2 )+1;

	        if( $pages == '' ){
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if( !$pages ){
	                $pages = 1;
	            }
	        }


	        if( 1 != $pages ){

	            $output = "";
	            $inner = "";
	            $output .= '<div class="pagination-wrap">';
	                $output .= '<nav>';
	                    $output .= '<ul class="pagination justify-content-center">';
	                        
	                        if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { 
	                            $output .= '<li class="page-item">';
	                                $output .= '<a class="page-link" href="'.get_pagenum_link(1).'" aria-label="Previous">';
	                                    $output .= '<i class="yani-icon arrow-button-left-1"></i>';
	                                $output .= '</a>';
	                            $output .= '</li>';
	                        }

	                        if( $paged > 1 ) { 
	                            $output .= '<li class="page-item">';
	                                $output .= '<a class="page-link" href="'.get_pagenum_link($prev).'" aria-label="Previous">';
	                                    $output .= '<i class="yani-icon icon-arrow-left-1"></i>';
	                                $output .= '</a>';
	                            $output .= '</li>';
	                        } else {
	                            $output .= '<li class="page-item disabled">';
	                                $output .= '<a class="page-link" aria-label="Previous">';
	                                    $output .= '<i class="yani-icon icon-arrow-left-1"></i>';
	                                $output .= '</a>';
	                            $output .= '</li>';
	                        }

	                        for ( $i = 1; $i <= $pages; $i++ ) {
	                            if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
	                            {
	                                if ( $paged == $i ){
	                                    $inner .= '<li class="page-item active"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
	                                } else {
	                                    $inner .= '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
	                                }
	                            }
	                        }
	                        $output .= $inner;
	                        

	                        if($paged < $pages) {
	                            $output .= '<li class="page-item">';
	                                $output .= '<a class="page-link" href="'.get_pagenum_link($next).'" aria-label="Next">';
	                                    $output .= '<i class="yani-icon icon-arrow-right-1"></i>';
	                                $output .= '</a>';
	                            $output .= '</li>';
	                        }

	                        if( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) {
	                            $output .= '<li class="page-item">';
	                                $output .= '<a class="page-link" href="'.get_pagenum_link( $pages ).'" aria-label="Next">';
	                                    $output .= '<i class="yani-icon arrow-button-right-1"></i>';
	                                $output .= '</a>';
	                            $output .= '</li>';
	                        }


	                    $output .= '</ul>';
	                $output .= '</nav>';
	            $output .= '</div>';

	            echo $output;

	        }
   		}

   		public function count_property_views( $prop_id ) {

	        $total_views = intval( get_post_meta($prop_id, 'yani_total_property_views', true) );

	        if( $total_views != '' ) {
	            $total_views++;
	        } else {
	            $total_views = 1;
	        }
	        update_post_meta( $prop_id, 'yani_total_property_views', $total_views );

	        $today = date('m-d-Y', time());
	        $today_time = date('m-d-Y h:i:s', time());

	        //$today = date('m-d-Y', strtotime("-1 days"));
	        $views_by_date = get_post_meta($prop_id, 'yani_views_by_date', true);

	        if( $views_by_date != '' || is_array($views_by_date) ) {
	            if (!isset($views_by_date[$today])) {

	                if (count($views_by_date) > 60) {
	                    array_shift($views_by_date);
	                }
	                $views_by_date[$today] = 1;

	            } else {
	                $views_by_date[$today] = intval($views_by_date[$today]) + 1;
	            }
	        } else {
	            $views_by_date = array();
	            $views_by_date[$today] = 1;
	        }

	        update_post_meta($prop_id, 'yani_views_by_date', $views_by_date);
	        update_post_meta($prop_id, 'yani_recently_viewed', current_time('mysql'));

    	}

    	public function add_link_pages_args_prevnext($args)    {
	        global $page, $numpages, $more, $pagenow;

	        if (!$args['next_or_number'] == 'next_and_number')
	            return $args;

	        $args['next_or_number'] = 'number';
	        if (!$more)
	            return $args;

	        if ($page - 1)
	            $args['before'] .= _wp_link_page($page - 1)
	                . $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';

	        if ($page < $numpages)
	            $args['after'] = _wp_link_page($page + 1)
	                . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
	                . $args['after'];

	        return $args;
    	}

    	public function get_post_term_slug( $post_id, $tax_name ) {
        	$terms = get_the_terms( $post_id, $tax_name );
	        if ( !empty( $terms ) ){
	            // get the first term
	            $term = array_shift( $terms );
	            return $term->slug;
	        }
	    }

	    public function ajax_pagination( $pages = '' ) {

	        $paged = 1;

	        if ( get_query_var( 'paged' ) ) {
	            $paged = get_query_var( 'paged' );
	        } elseif ( get_query_var( 'page' ) ) { // if is static front page
	            $paged = get_query_var( 'page' );
	        }

	        if( isset($_GET['paged']) ) {
	            $paged = $_GET['paged'];
	        }

	        if(empty($paged))$paged = 1;

	        $prev = $paged - 1;
	        $next = $paged + 1;
	        $range = 2; // change it to show more links
	        $showitems = ( $range * 2 )+1;
	        
	        if( $pages == '' ){
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if( !$pages ){
	                $pages = 1;
	            }
	        }

	        if( 1 != $pages ){

	            echo '<div class="pagination-wrap yani_ajax_pagination">';
	            echo '<nav>';
	            echo '<ul class="pagination justify-content-center">';
	            echo ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) ? '<li class="page-item"><a class="page-link" data-houzepagi="1" rel="First" href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span></a></li>' : '';
	            echo ( $paged > 1 ) ? '<li class="page-item"><a class="page-link" data-houzepagi="'.$prev.'" rel="Prev" href="'.get_pagenum_link($prev).'"><i class="yani-icon icon-arrow-left-1"></i></a></li>' : '<li class="page-item disabled"><a class="page-link" aria-label="Previous"><i class="yani-icon icon-arrow-left-1"></i></a></li>';
	            for ( $i = 1; $i <= $pages; $i++ ) {
	                if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
	                {
	                    if ( $paged == $i ){
	                        echo '<li class="page-item active"><a class="page-link" data-houzepagi="'.$i.'" href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
	                    } else {
	                        echo '<li class="page-item"><a class="page-link" data-houzepagi="'.$i.'" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
	                    }
	                }
	            }
	            echo ( $paged < $pages ) ? '<li class="page-item"><a class="page-link" data-houzepagi="'.$next.'" rel="Next" href="'.get_pagenum_link($next).'"><i class="yani-icon icon-arrow-right-1"></i></a></li>' : '';
	            echo ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) ? '<li class="page-item"><a class="page-link" data-houzepagi="'.$pages.'" rel="Last" href="'.get_pagenum_link( $pages ).'"><span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span></a></li>' : '';
	            echo '</ul>';
	            echo '</nav>';
	            echo '</div>';

	        }
	    }

	    public  function loadmore($max_num_pages) {
	        $more_link = get_next_posts_link( __('Load More', _yani_theme()->get_text_domain()), $max_num_pages );
	        $allowed_html_array = array(
	            'a' => array(
	                'href' => array(),
	                'title' => array()
	            )
	        );

	        if(!empty($more_link)) : ?>
	            <div id="yani-pagination-loadmore" class="pagination-wrap yani-load-more">
	                <div class="pagination">
	                    <?php echo wp_kses( $more_link, $allowed_html_array); ?>
	                </div>
	            </div>
	        <?php endif;
	    }

	    public function yani_admin_post_type () {
	        global $post, $parent_file, $typenow, $current_screen, $pagenow;

	        $post_type = NULL;

	        if($post && (property_exists($post, 'post_type') || method_exists($post, 'post_type')))
	            $post_type = $post->post_type;

	        if(empty($post_type) && !empty($current_screen) && (property_exists($current_screen, 'post_type') || method_exists($current_screen, 'post_type')) && !empty($current_screen->post_type))
	            $post_type = $current_screen->post_type;

	        if(empty($post_type) && !empty($typenow))
	            $post_type = $typenow;

	        if(empty($post_type) && function_exists('get_current_screen'))
	            $post_type = get_current_screen();

	        if(empty($post_type) && isset($_REQUEST['post']) && !empty($_REQUEST['post']) && function_exists('get_post_type') && $get_post_type = get_post_type((int)$_REQUEST['post']))
	            $post_type = $get_post_type;

	        if(empty($post_type) && isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type']))
	            $post_type = sanitize_key($_REQUEST['post_type']);

	        if(empty($post_type) && 'edit.php' == $pagenow)
	            $post_type = 'post';

	        return $post_type;
	    }

	    public function get_invoice_meta( $post_id, $field = false ) {

        $defaults = array(
            'invoice_billion_for' => '',
            'invoice_billing_type' => '',
            'invoice_item_id' => '',
            'invoice_item_price' => '',
            'invoice_tax' => '',
            'invoice_payment_method' => '',
            'invoice_purchase_date' => '',
            'invoice_buyer_id' => ''
        );

        $meta = get_post_meta( $post_id, '_yani_invoice_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }
        return $meta;
    }

    public function get_excerpt($limit, $id = '')    {
        $excerpt = explode(' ', get_the_excerpt($id), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
        return $excerpt;
    }

    public function get_content($limit)    {
        $content = explode(' ', get_the_content(), $limit);
        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }
        $content = preg_replace('/\[.+\]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
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

function _yani_post() {
	return _Yani_Post_Helper::get_instance();
}