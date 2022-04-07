<?php

add_theme_support( 'post-thumbnails');
define( 'YANI_THEME_JS_DIR_URI', get_template_directory_uri() . '/assets/js/' );
define( 'YANI_THEME_CUSTOM_JS', get_template_directory_uri() . '/assets/theme-js/' );
define( 'YANI_THEME_IMAGES', get_template_directory_uri() . '/assets/images/' );
define( 'YANI_THEME_IMAGES_2', get_template_directory_uri() . '/img/' );
define( 'YANI_THEME_VENDORS', get_template_directory_uri() . '/vendors/' );
define( 'YANI_THEME_STYLING', get_template_directory_uri() . '/dist/assets/css/' );
define( 'YANI_THEME_FRAMEWORK_DIR', get_template_directory() . '/framework/' );
define( 'YANI_THEME_FRAMEWORK_URI', get_template_directory_uri() . '/framework/' );
define( 'YANI_THEME_CUSTOMIZER_OPTIONS', get_template_directory() . '/includes/customizer_options/' );
define( 'YANI_THEME_VERSION', '0.0.7' );
?>

<?php require_once("libs/enqueue-assets.php");?>
<?php require_once("libs/theme-support.php");?>
<?php require_once("libs/theme-customizer.php"); ?>
<?php require_once("libs/sidebars.php");?>
<?php //require_once("libs/rest-api.php");?>
<?php require_once("libs/navigation.php");?>
<?php //require_once("libs/fonts.php");?>
<?php //require_once("libs/customizer.php"); ?>
<?php require_once("libs/metaboxes.php");?>
<?php //require_once("libs/plugin-activation.php");?>
<?php require_once("libs/comments.php");?>
<?php //require_once("libs/shortcodes.php"); ?>
<?php //require_once("libs/custom-post-types.php");

require_once("libs/class-wp-bootstrap-navwalker.php");
require_once("libs/widgets.php");


if(class_exists('woocommerce')){
	require_once("libs/woocommerce.php"); 
}

function _theme_readmore_link(){ ?> 
<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		<?php _e('Read More','_themename'); ?>
		<span class="u-screen-reader-text"><?php _e(the_title(),'_themename');?></span>
</a>
<?php }

function _themename_post_meta(){
	
}
/*Classes*/
// require_once("framework/classes/class-property-post-type.php");



require_once( 'framework/crm/yani-crm.php');
require_once( 'framework/functions/message-functions.php');
require_once( 'framework/classes/admin.class.php');
// require_once( 'framework/classes/settings.class.php');
require_once("framework/classes/yani-query.class.php");
require_once("framework/classes/data-source.class.php");
// require_once("framework/classes/membership.class.php");
require_once("framework/classes/property-listing.class.php");
require_once("framework/classes/rates.class.php");
require_once("framework/classes/price.class.php");
require_once( 'framework/mobile-menu-walker.php');
require_once( 'framework/menu-walker.php');





require_once("includes/helpers/ajax-helper.class.php");
// require_once("includes/helpers/message-helper.class.php");
require_once("includes/helpers/template-helper.class.php");
require_once("includes/helpers/attachment-helper.class.php");
require_once("includes/helpers/theme-helper.class.php");
require_once("includes/helpers/role-helper.class.php");
require_once("includes/helpers/payment-helper.class.php");
require_once("includes/helpers/invoice-helper.class.php");
require_once("includes/helpers/post-helper.class.php");
require_once("includes/helpers/property-helper.class.php");
require_once("includes/helpers/listing-helper.class.php");
require_once("includes/helpers/agent-helper.class.php");
require_once("includes/helpers/user-helper.class.php");
require_once("includes/helpers/author-helper.class.php");
require_once("includes/helpers/image-helper.class.php");
require_once("includes/helpers/form-helper.class.php");
require_once("includes/helpers/statistics-helper.class.php");
require_once("includes/helpers/review-helper.class.php");
require_once("includes/helpers/membership-package-helper.class.php");
require_once("includes/helpers/map-helper.class.php");
require_once("includes/helpers/fields-helper.class.php");
require_once("includes/helpers/taxonomy-helper.class.php");
require_once("includes/helpers/term-helper.class.php");
require_once("includes/helpers/search-helper.class.php");
require_once("includes/helpers/email-helper.class.php");


require_once("dev/sandbox/shortcodes.php");
require_once("includes/redux/yani-config.php");


add_filter('manage_plugin_post_posts_columns', 'posts_columns', 5);
add_action('manage_plugin_post_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($columns){
    $columns['riv_post_thumbs'] = __('Thumbs');

    $n_columns = array();
  $move = 'riv_post_thumbs'; // what to move
  $before = 'title'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
  
}
 
function posts_custom_columns($column_name, $id){
    if($column_name === 'riv_post_thumbs'){
        echo '<img src = "'.get_the_post_thumbnail_url().'" style="width:46px;height:46px;">';
    }
    
}


function filter_single_post_pagination($output, $format, $link, $post){
    $title = get_the_title($post);
    if($post){

    $url   = get_permalink($post->ID);
    $class = 'btn btn-secondary my-2 mx-2 text-limit ';
    $rel   = 'prev';
    $arrow = '&laquo;';
 
    if('next_post_link' === current_filter()){
        $class = 'btn btn-secondary my-2 text-limit ';
        $rel   = 'next';
        $arrow = '&raquo;';
    return "<a href='$url' rel='$rel' class='$class '>$title $arrow  </a>";
    }
    return "<a href='$url' rel='$rel' class='$class '>$arrow  $title  </a>";
    }
}
add_filter( 'previous_post_link', 'filter_single_post_pagination', 10, 4);
add_filter( 'next_post_link', 'filter_single_post_pagination', 10, 4);


add_action('pre_get_posts', 'university_adjust_queries');
function university_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('employer') AND $query->is_main_query()) {
    $query->set('posts_per_page', '5');
  }

  if (!is_admin() AND is_post_type_archive('plugin_post') AND $query->is_main_query()) {
    $query->set('posts_per_page', '3');
  }
  // if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
  //   $query->set('orderby', 'title');
  //   $query->set('order', 'ASC');
  //   $query->set('posts_per_page', -1);
  // }
  // if (!is_admin() AND is_post_type_archive('packages_post') AND is_main_query()) {
  //   $query->set('orderby', 'post_ID');
  //   $query->set('order', 'ASC');
  //   $query->set('posts_per_page', -1);
  // }
  // if (!is_admin() AND is_post_type_archive('employer') AND is_main_query()) {
  //   $query->set('posts_per_page', -1);
  // }
  // if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
  //   $today = date('Ymd');
  //   $query->set('meta_key', 'event_date');
  //   $query->set('orderby', 'meta_value_num');
  //   $query->set('order', 'ASC');
  //   $query->set('meta_query', array(
  //             array(
  //               'key' => 'event_date',
  //               'compare' => '>=',
  //               'value' => $today,
  //               'type' => 'numeric'
  //             )
  //           ));
  // }
}

function _themename_delete_post(){
  $url = add_query_arg([
    "action" => "_themename_delete_post",
    "post" => get_the_ID(),
    "nonce" => wp_create_nonce("_themename_delete_post_".get_the_ID())
  ],home_url());

  if(current_user_can("delete_post",get_the_ID())){
    return "<a href = '".esc_url($url)."' class='btn btn-warning btn-sm'>".esc_html__("Delete Post","_themename")." &times;</a>";
  }
  return;
}

function _themename_handle_delete_post(){
  if(isset($_GET["action"]) && $_GET["action"]==="_themename_delete_post"){

    if(!isset($_GET["nonce"]) || !wp_verify_nonce($_GET["nonce"],"_themename_delete_post_".$_GET["post"])){
      return ;
    }

    $post_id = isset($_GET["post"]) ? $_GET["post"] : null;

    $post = get_post((int )$post_id);

    if(empty($post)){
      return;
    }


    if(!current_user_can("delete_posts",$post_id)){
      return;
    }

    wp_trash_post($post_id);  
    wp_safe_redirect(home_url());

    die;

  }
}

add_action('init','_themename_handle_delete_post');