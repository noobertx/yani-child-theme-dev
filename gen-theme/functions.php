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
define( 'YANI_THEME_VERSION', '0.0.7' );
?>

<?php require_once("libs/enqueue-assets.php");?>
<?php //require_once("libs/theme-support.php");?>
<?php //require_once("libs/sidebars.php");?>
<?php //require_once("libs/rest-api.php");?>
<?php require_once("libs/navigation.php");?>
<?php //require_once("libs/fonts.php");?>
<?php //require_once("libs/customizer.php"); ?>
<?php //require_once("libs/metaboxes.php");?>
<?php //require_once("libs/plugin-activation.php");?>
<?php //require_once("libs/comments.php");?>
<?php //require_once("libs/shortcodes.php"); ?>
<?php //require_once("libs/custom-post-types.php");
// require_once("libs/theme-customizer.php");

require_once("libs/class-wp-bootstrap-navwalker.php");
require_once("libs/widgets.php");


if(class_exists('woocommerce')){
	require_once("libs/woocommerce.php"); 
}

function _theme_readmore_link(){ ?> 
<a href="<?php echo get_the_permalink()?>" title="<?php the_title_attribute()?>">
		<?php _e('Read More','yani'); ?>
		<span class="u-screen-reader-text"><?php _e('About'.the_title(),'yani');?></span>
</a>
<?php }

function yani_post_meta(){
	
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
