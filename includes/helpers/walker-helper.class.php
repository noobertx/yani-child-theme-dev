<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}


class yani_property_type_id_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

class yani_property_type_slug_array_walker extends Walker {
    var $tree_type = 'property_type';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

class yani_property_status_id_array_walker extends Walker {
    var $tree_type = 'property_status';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

class yani_property_status_slug_array_walker extends Walker {
    var $tree_type = 'property_status';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $yani_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->yani_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->slug;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

if ( ! class_exists( '_yani_Walker_Helper' ) ) {
	class _yani_Walker_Helper{
		private static $instance = null;		

		public function get_property_field_id_array($field,$add_all_type = true,$walker_instance,$status_label="- All -") {

	        if (is_admin() === false) {
	            return;
	        }

	        $types = get_categories(array(
	            'hide_empty' => 0,
	            'taxonomy'   => $field,
	        ));

	        $yani_property_field_id_array_walker = $walker_instance;
	        $yani_property_field_id_array_walker->walk($types, 4);

	        if ($add_all_type === true) {
	            $types_buffer[$status_label] = '';
	            return array_merge(
	                $types_buffer,
	                $yani_property_field_id_array_walker->array_buffer
	            );
	        } else {
	            return $yani_property_field_id_array_walker->array_buffer;
	        }
	    }

	    public function get_property_type_slug_array($add_all_type = true,$walker_instance ,$status_label = '- All Types -') {

	        if (is_admin() === false) {
	            return;
	        }

	        $types = get_categories(array(
	            'hide_empty' => 0,
	            'taxonomy'   => 'property_type',
	        ));

	        $yani_property_field_slug_array_walker = $walker_instance;
	        $yani_property_field_slug_array_walker->walk($types, 4);

	        if ($add_all_type === true) {
	            $types_buffer[$status_label] = '';
	            return array_merge(
	                $types_buffer,
	                $yani_property_field_slug_array_walker->array_buffer
	            );
	        } else {
	            return $yani_property_field_slug_array_walker->array_buffer;
	        }
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

function _yani_walker() {
	return _yani_Walker_Helper::get_instance();
}