<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Template_Helper' ) ) {
	class _Yani_Template_Helper{
		private static $instance = null;

		public function get_template_link($template) {
			$args = array(
	            'meta_key' => '_wp_page_template',
	            'meta_value' => $template
	        );
	        $pages = get_pages($args);
	        if( $pages ) {
	            $add_link = get_permalink( $pages[0]->ID );
	        } else {
	            $add_link = '';
	        }
	        return $add_link;
		}
		public function get_template_link_2($template) {
	        $args = array(
	            'meta_key' => '_wp_page_template',
	            'meta_value' => $template
	        );
	        $pages = get_pages($args);
	        if( $pages ) {
	            $add_link = get_permalink( $pages[0]->ID );
	        } else {
	            $add_link = '';
	        }
	        return $add_link;
	    }

	    public function is_login_page(){
	        if ( is_page_template( array(
	            'template/template-login.php',
	        ) )
	        ) {
	            return true;
	        }
	        return false;
    	}

    	public function is_dashboard() {

	        $files = apply_filters( 'yani_is_dashboard_filter', array(
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_insight.php',
	            'template/user_dashboard_crm.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/user_dashboard_messages.php'
	            
	        ) );

	        if ( is_page_template($files) ) {
	            return true;
	        }
	        return false;
	    }

	    public function is_transparent_logo() {
	        $css_class = '';
	        $header_type = _yani_theme()->get_option('header_style');
	        $transparent = get_post_meta(get_the_ID(), 'yani_main_menu_trans', true);

	        if( $transparent != 'no' && !empty($transparent) && ($header_type == '4') ) {
	            return true;
	        }

	        if($this->is_splash()) {
	            return true;
	        }
	        return false;
	    }
	   

    	public function is_listings_template() {

	        $files = apply_filters( 'yani_is_listings_template_filter', array(
	            'template/property-listings-map.php',
	            'template/template-listing-list-v1.php',
	            'template/template-listing-list-v2.php',
	            'template/template-listing-list-v5.php',
	            'template/template-listing-list-v1-fullwidth.php',
	            'template/template-listing-list-v2-fullwidth.php',
	            'template/template-listing-list-v5-fullwidth.php',
	            'template/template-listing-grid-v1.php',
	            'template/template-listing-grid-v1-fullwidth-2cols.php',
	            'template/template-listing-grid-v1-fullwidth-3cols.php',
	            'template/template-listing-grid-v1-fullwidth-4cols.php',
	            'template/template-listing-grid-v2.php',
	            'template/template-listing-grid-v2-fullwidth-2cols.php',
	            'template/template-listing-grid-v2-fullwidth-3cols.php',
	            'template/template-listing-grid-v2-fullwidth-4cols.php',
	            'template/template-listing-grid-v4.php',
	            'template/template-listing-grid-v5.php',
	            'template/template-listing-grid-v5-fullwidth-2cols.php',
	            'template/template-listing-grid-v5-fullwidth-3cols.php',
	            'template/template-listing-grid-v6.php',
	            'template/template-listing-grid-v6-fullwidth-2cols.php',
	            'template/template-listing-grid-v6-fullwidth-3cols.php',
	            'template/template-listing-grid-v3.php',
	            'template/template-listing-grid-v3-fullwidth-2cols.php',
	            'template/template-listing-grid-v3-fullwidth-3cols.php',
	        ) );

	        if ( is_page_template( $files ) ) {
	            return true;
	        }
	        return false;
    	}

    	public  function get_transparent() {
	        $css_class = '';
	        $transparent = get_post_meta(get_the_ID(), 'yani_main_menu_trans', true);
	        $header_type = get_post_meta(get_the_ID(), 'yani_header_type', true);
	        $header_style = _yani_theme()->get_option('header_style');

	        if( $transparent != 'no' && $header_type != 'none' && !empty($transparent) && !empty($header_type) && $header_style == '4' && !wp_is_mobile() ) {
	            $css_class = 'header-transparent-wrap';
	        }

	        if($this->is_splash()) {
	            $css_class = 'header-transparent-wrap';
	        }
	        return $css_class;
	    }

    	public function is_search_needed() {

	        $files = apply_filters( 'yani_search_needed_filter', array(
	            'template/property-listings-map.php',
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/template-packages.php',
	            'template/template-payment.php',
	            'template/template-thankyou.php',
	            'template/user_dashboard_messages.php'
	        ) );

	        if( is_singular( 'property' ) ) {
	            return true;
	        } elseif( is_search() ) {
	            return false;
	        }  elseif( is_author() ) {
	            return false;
	        } elseif( is_404() ) {
	            return false;
	        } elseif ( is_page_template( $files ) ) {
	            return false;

	        } elseif($this->is_half_map()) {
	            return false;

	        } elseif($this->is_splash()) {
	            return false;
	        }
	        return true;
	    }

	    public function get_search_template_link() {


	        if( $this->is_half_map() ) {
	            $add_link = get_permalink( get_the_ID() );
	            return $add_link;
	        } else {
	            $template = 'template/template-search.php';
	        }

	        $args = array(
	            'meta_key' => '_wp_page_template',
	            'sort_order' => 'desc',
	            'sort_column' => 'ID',
	            'meta_value' => $template
	        );
	        $pages = get_pages($args);
	        if( $pages ) {
	            $add_link = get_permalink( $pages[0]->ID );
	        } else {
	            $add_link = home_url('/');
	        }
	        return $add_link;
	    }

	    public function is_half_map() {
	        if( (is_page_template(array('template/template-search.php')) && _yani_theme()->get_option('search_result_page') == 'half_map') || is_page_template(array('template/property-listings-map.php')) ) {
	            return true;

	        }
	        return false;
	    }

	    public function is_splash() {
	        if ( is_page_template( array(
	            'template/template-splash.php',
	        ) )
	        ) {
	            return true;
	        }
	        return false;
	    }

	    public function is_postid_needed() {
		        if( is_search() ) {
		            return false;
		        } elseif( is_author() ) {
		            return false;
		        } elseif( is_404() ) {
		            return false;
		        }
		        return true;
	    }

		public function render_breadcrumbs($options = array()){

	        global $post;
	        $allowed_html_array = array(
	            'i' => array(
	                'class' => array()
	            )
	        );

	        $text['home']     = esc_html__('Home', _yani_theme()->get_text_domain()); // text for the 'Home' link
	        $text['category'] = esc_html__('%s', _yani_theme()->get_text_domain()); // text for a category page
	        $text['tax']      = esc_html__('%s', _yani_theme()->get_text_domain()); // text for a taxonomy page
	        $text['search']   = esc_html__('Search Results for "%s" Query', _yani_theme()->get_text_domain()); // text for a search results page
	        $text['tag']      = esc_html__('%s', _yani_theme()->get_text_domain()); // text for a tag page
	        $text['author']   = esc_html__('%s', _yani_theme()->get_text_domain()); // text for an author page
	        $text['404']      = esc_html__('Error 404', _yani_theme()->get_text_domain()); // text for the 404 page

	        $defaults = array(
	            'show_current' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
	            'show_on_home' => 0, // 1 - show breadcrumbs on the homepage, 0 - don't show
	            'delimiter' => '',
	            'before' => '<li class="breadcrumb-item active">',
	            'after' => '</li>',

	            'home_before' => '',
	            'home_after' => '',
	            'home_link' => home_url() . '/',

	            'link_before' => '<li class="breadcrumb-item">',
	            'link_after'  => '</li>',
	            'link_attr'   => '',
	            'link_in_before' => '',
	            'link_in_after'  => ''
	        );

	        extract($defaults);

	        $link = '<a href="%1$s"><span>' . $link_in_before . '%2$s' . $link_in_after . '</span></a>';

	        // form whole link option
	        $link = $link_before . $link . $link_after;

	        if (isset($options['text'])) {
	            $options['text'] = array_merge($text, (array) $options['text']);
	        }

	        // override defaults
	        extract($options);

	        // regex replacement
	        $replace = $link_before . '<a' . esc_attr( $link_attr ) . '\\1>' . $link_in_before . '\\2' . $link_in_after . '</a>' . $link_after;

	        /*
	         * Use bbPress's breadcrumbs when available
	         */
	        if (function_exists('bbp_breadcrumb') && is_bbpress()) {

	            $bbp_crumbs =
	                bbp_get_breadcrumb(array(
	                    'home_text' => $text['home'],
	                    'sep' => '',
	                    'sep_before' => '',
	                    'sep_after'  => '',
	                    'pad_sep' => 0,
	                    'before' => $home_before,
	                    'after' => $home_after,
	                    'current_before' => $before,
	                    'current_after'  => $after,
	                ));

	            if ($bbp_crumbs) {
	                echo '<ul class="breadcrumb favethemes_bbpress_breadcrumb">' .$bbp_crumbs. '</ul>';
	                return;
	            }
	        }

	        // normal breadcrumbs
	        if ((is_home() || is_front_page())) {

	            if ($show_on_home == 1) {
	                echo '<li class="breadcrumb-item">'. esc_attr( $home_before ) . '<a href="' . esc_url( $home_link ) . '">' . esc_attr( $text['home'] ) . '</a>'. esc_attr( $home_after ) .'</li>';
	            }

	        } else {

	            echo '<ol class="breadcrumb">' .$home_before . sprintf($link, $home_link, $text['home']) . $home_after . $delimiter;

	            if (is_category() || is_tax())
	            {
	                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	                if( $term ) {

	                    $taxonomy_object = get_taxonomy( get_query_var( 'taxonomy' ) );
	                    //echo '<li><a>'.$taxonomy_object->rewrite['slug'].'</a></li>';

	                    $parent = $term->parent;

	                    while ($parent):
	                        $parents[] = $parent;
	                        $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
	                        $parent = $new_parent->parent;
	                    endwhile;
	                    if(!empty($parents)):
	                        $parents = array_reverse($parents);

	                        // For each parent, create a breadcrumb item
	                        foreach ($parents as $parent):
	                            $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));

	                            $term_link = get_term_link( $item );
	                            if ( is_wp_error( $term_link ) ) {
	                                continue;
	                            }
	                            echo '<li class="breadcrumb-item"><a href="'.$term_link.'">'.$item->name.'</a></li>';
	                        endforeach;
	                    endif;

	                    // Display the current term in the breadcrumb
	                    echo '<li class="breadcrumb-item">'.$term->name.'</li>';

	                } else {

	                    $the_cat = get_category(get_query_var('cat'), false);

	                    // have parents?
	                    if ($the_cat->parent != 0) {

	                        $cats = get_category_parents($the_cat->parent, true, $delimiter);
	                        $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

	                        echo $cats;
	                    }

	                    // print category
	                    echo $before . sprintf((is_category() ? $text['category'] : $text['tax']), single_cat_title('', false)) . $after;
	                } // end terms else

	            }
	            else if (is_search()) {

	                echo $before . sprintf($text['search'], get_search_query()) . $after;

	            }
	            else if (is_day()) {

	                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
	                    . sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter
	                    . $before . get_the_time('d') . $after;

	            }
	            else if (is_month()) {

	                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
	                    . $before . get_the_time('F') . $after;

	            }
	            else if (is_year()) {

	                echo $before . get_the_time('Y') . $after;

	            }
	            // single post or page
	            else if (is_single() && !is_attachment()) {

	                // custom post type
	                if (get_post_type() != 'post' && get_post_type() != 'property' ) {

	                    $post_type = get_post_type_object(get_post_type());
	                    
	                    if ($show_current == 1) {
	                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
	                    }
	                }
	                elseif( get_post_type() == 'property' ){

	                    $single_prop_breadcrumb = _yani_theme()->get_option('single_prop_breadcrumb', 'property_type');

	                    if( $single_prop_breadcrumb == 'property_city_area') {
	                         $terms = get_the_terms( get_the_ID(), 'property_city' );
	                         $terms_2 = get_the_terms( get_the_ID(), 'property_area' );

	                    } else if( $single_prop_breadcrumb == 'property_status_type') {
	                         $terms = get_the_terms( get_the_ID(), 'property_status' );
	                         $terms_2 = get_the_terms( get_the_ID(), 'property_type' );

	                    } else {
	                        $terms = get_the_terms( get_the_ID(), $single_prop_breadcrumb );
	                    }
	                    
	                    if( !empty($terms) ) {
	                        foreach ($terms as $term) {
	                            $term_link = get_term_link($term);
	                            // If there was an error, continue to the next term.
	                            if (is_wp_error($term_link)) {
	                                continue;
	                            }
	                            echo '<li class="breadcrumb-item"><a href="' . esc_url($term_link) . '"> <span>' . esc_attr( $term->name ). '</span></a></li>';
	                        }
	                    }

	                    if( !empty($terms_2) ) {
	                        foreach ($terms_2 as $term) {
	                            $term_link = get_term_link($term);
	                            // If there was an error, continue to the next term.
	                            if (is_wp_error($term_link)) {
	                                continue;
	                            }
	                            echo '<li class="breadcrumb-item"><a href="' . esc_url($term_link) . '"> <span>' . esc_attr( $term->name ). '</span></a></li>';
	                        }
	                    }


	                    if ($show_current == 1) {
	                        echo esc_attr($delimiter) . $before . get_the_title() . $after;
	                    }
	                }
	                else {

	                    $cat = get_the_category();

	                    if( !empty($cat) ) {
	                        $cats = get_category_parents($cat[0], true, esc_attr($delimiter));

	                        if ($show_current == 0) {
	                            $cats = preg_replace("#^(.+)esc_attr($delimiter)$#", "$1", $cats);
	                        }

	                        $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);

	                        echo $cats;
	                    }

	                    if ($show_current == 1) {
	                        echo $before . get_the_title() . $after;
	                    }
	                } // end else

	            }
	            elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() ) {

	                $post_type = get_post_type_object(get_post_type());

	                echo $before . $post_type->labels->name . $after;

	            }
	            elseif (is_attachment()) {

	                $parent = get_post($post->post_parent);
	                $cat = current(get_the_category($parent->ID));
	                $cats = get_category_parents($cat, true, esc_attr($delimiter));

	                if (!is_wp_error($cats)) {
	                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
	                    echo $cats;
	                }

	                printf($link, get_permalink($parent), $parent->post_title);

	                if ($show_current == 1) {
	                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
	                }

	            }
	            elseif (is_page() && !$post->post_parent && $show_current == 1) {

	                echo $before . get_the_title() . $after;

	            }
	            elseif (is_page() && $post->post_parent) {

	                $parent_id  = $post->post_parent;
	                $breadcrumbs = array();

	                while ($parent_id) {
	                    $page = get_post($parent_id);
	                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
	                    $parent_id  = $page->post_parent;
	                }

	                $breadcrumbs = array_reverse($breadcrumbs);

	                for ($i = 0; $i < count($breadcrumbs); $i++) {

	                    echo ( $breadcrumbs[$i] );

	                    if ($i != count($breadcrumbs)-1) {
	                        echo esc_attr($delimiter);
	                    }
	                }

	                if ($show_current == 1) {
	                    echo esc_attr($delimiter) . $before . get_the_title() . $after;
	                }

	            }
	            elseif (is_tag()) {
	                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

	            }
	            elseif (is_author()) {

	                global $author;

	                $userdata = get_userdata($author);
	                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

	            }
	            elseif (is_404()) {
	                echo $before . esc_attr( $text['404'] ). $after;
	            }

	            // have pages?
	            if (get_query_var('paged')) {

	                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
	                    echo ' (' . esc_html__('Page', _yani_theme()->get_text_domain()) . ' ' . get_query_var('paged') . ')';
	                }
	            }

	            echo '</ol>';
	        }

	    } 

	    public function is_transparent() {
	        $transparent = get_post_meta(get_the_ID(), 'yani_main_menu_trans', true);

	        if( $transparent != 'no' && !empty($transparent) ) {
	            return true;
	        }
	        return false;
	    }

	    public function get_percent_up_down($old_number, $new_number) {

	        if( $old_number != 0 ) {
	            $percent = (($new_number - $old_number) / $old_number * 100);
	        } else {
	            $percent = $new_number * 100;
	        }
	        

	        $class = 'text-success';
	        $arrow = 'icon-arrow-button-up-2';
	        if( $old_number > $new_number ) {
	            $class = 'text-danger';
	            $arrow = 'icon-arrow-button-down-2';
	        } 
	        
	        $output = '<div class="views-percentage '.$class.'">
	            <i class="yani-icon '.$arrow.'"></i> '.round($percent, 1).'%
	        </div>';

	        return $output;
	    }

	    public function banner_fullscreen() {
	        $banner_height = get_post_meta(get_the_ID(), 'yani_header_full_screen', true);
	        if( $banner_height != 0 ) {
	            echo 'top-banner-wrap-fullscreen';
	        }
	        return '';
	    }

	    public function current_screen() {
	        global $pagenow;
	        $post_type = yani_admin_post_type();

	        $get_action = isset($_GET['action']) ? $_GET['action'] : '';

	        if( $post_type == 'page' && ( $pagenow == 'post-new.php' || $get_action == 'edit' ) ) {
	            return 'admin_page';
	        } 
	        return 'others';
	    }

	    public function get_sidebar_meta( $post_id, $field = false ) {

	        $defaults = array(
	            'specific_sidebar' => 'no',
	            'selected_sidebar' => 'default-sidebar',
	        );

	        $meta = get_post_meta( $post_id, '_yani_sidebar_meta', true );
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

	    public function render_half_map_layout() {
	        $listing_view = '';
	        if( (is_page_template(array('template/template-search.php')) && _yani_theme()->get_option('search_result_page') == 'half_map')) {
	            $listing_view = _yani_theme()->get_option('search_result_posts_layout', 'list-view-v1');

	        } elseif(is_page_template(array('template/property-listings-map.php'))) {
	            $listing_view = _yani_theme()->get_option('halfmap_posts_layout', 'list-view-v1');

	        }
	        if($listing_view == 'list-view-v1' || $listing_view == 'list-view-v2' || $listing_view == 'list-view-v5') {

	            $listing_view = 'list-view';

	        } 

	        return $listing_view;
	    }

	    public function get_header_transparent_class() {
	        $css_class = '';
	        $transparent = get_post_meta(get_the_ID(), 'yani_main_menu_trans', true);
	        $header_type = get_post_meta(get_the_ID(), 'yani_header_type', true);
	        $header_style = _yani_theme()->get_option('header_style');

	        if( $transparent != 'no' && $header_type != 'none' && !empty($transparent) && !empty($header_type) && $header_style == '4' && !wp_is_mobile() ) {
	            $css_class = 'header-transparent-wrap';
	        }

	        if($this->is_splash()) {
	            $css_class = 'header-transparent-wrap';
	        }
	        return $css_class;
	    }



	    public function is_container_needed() {
	        $files = apply_filters( 'yani_container_needed_filter', array(
	            'template/property-listings-map.php',
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/template-thankyou.php',
	            'template/user_dashboard_messages.php',
	            'template/properties-parallax.php'
	        ) );

	        if( is_singular( 'property' ) ) {
	            return false;
	        } elseif ( is_page_template( $files ) ) {
	            return false;
	        }
	        return true;
	    }

	    public function is_landing_page() {

	        $files = apply_filters( 'yani_is_landing_page_filter', array(
	            'template/property-listings-map.php',
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/user_dashboard_messages.php'
	        ) );

	        if ( is_page_template( $files ) ) {
	            return true;
	        }
	        return false;
	    }

	    public  function is_map_needed() {
	        global $post;
	        
	        $post_id = isset($post->ID) ? $post->ID : 0;
	        $header_type = get_post_meta($post_id, 'yani_header_type', true);
	        
	        if(is_page_template('template/user_dashboard_submit.php')) {
	            return true;

	        } elseif($header_type == 'property_map') {
	            return true;

	        } elseif(is_page_template('template/property-listings-map.php')) {
	            return true;

	        } elseif(is_page_template('template/template-search.php') && yani_option('search_result_page') == 'half_map') {
	            return true;

	        } elseif ( is_singular( 'property' ) ) {
	            return true;
	        }

	        return false;
	    }

	    public function is_footer() {

	        $files = apply_filters( 'yani_is_footer_filter', array(
	            'template/user_dashboard_profile.php',
	            'template/user_dashboard_properties.php',
	            'template/user_dashboard_favorites.php',
	            'template/user_dashboard_invoices.php',
	            'template/user_dashboard_saved_search.php',
	            'template/user_dashboard_floor_plans.php',
	            'template/user_dashboard_multi_units.php',
	            'template/user_dashboard_membership.php',
	            'template/user_dashboard_gdpr.php',
	            'template/user_dashboard_submit.php',
	            'template/user_dashboard_messages.php'
	        ) );

	        if ( is_page_template( 'template/template-splash.php' ) ) {
	            return false;
	        } elseif ( is_page_template( $files ) ) {
	            return false;
	        }
	        return true;
	    }
	    
	    public function get_allowed_html() {
	        $allowed_html_array = array(
	            'a' => array(
	                'href' => array(),
	                'title' => array(),
	                'target' => array()
	            ),
	            'strong' => array(),
	            'th' => array(),
	            'td' => array(),
	            'span' => array(),
	        ); 
	        return $allowed_html_array;
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

function _yani_template(){
	return _Yani_Template_Helper::get_instance();
}
?>