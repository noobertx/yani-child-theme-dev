<?php
global $current_user, $yani_local;
wp_get_current_user();
$userID  =  $current_user->ID;
$create_lisiting_enable = _yani_theme()->get_option('create_lisiting_enable');

$header_style = 2;

$page_templates = array(
	"profile"=> 'template/user_dashboard_profile.php',
	"properties"=> 'template/user_dashboard_properties.php',
	"create_listing"=> 'template/user_dashboard_submit.php'
);

$dashboard_add_listing = _yani_template()->get_template_link("template/user_dashboard_submit.php");

$links = array();

foreach($page_templates  as $t=>$template){
	$links[$t] = _yani_template()->get_template_link_2($template);
}
$user_custom_picture = _yani_user()->get_profile_pic($userID);
// print_r($links);
?>

<nav class="logged-in-nav-wrap navi-login-register slideout-menu slideout-menu-right" id="navi-user">
	<div class="d-flex justify-content-end">
		<?php if( $create_lisiting_enable != 0 || !empty(_yani_theme()->get_option('hd1_4_phone'))){ ?>
			<div class="login-register-nav">
				<?php if( !empty(_yani_theme()->get_option('hd1_4_phone')) && _yani_theme()->get_option('hd1_4_phone_enable', 0) && ( $header_style == 1 || $header_style == 4 ) ) { ?>
					<span class="btn-phone-number">
			            <a href="tel:<?php echo _yani_theme()->get_option('hd1_4_phone'); ?>"><i class="yani-icon icon-phone-actions-ring mr-1"></i> <?php echo _yani_theme()->get_option('hd1_4_phone'); ?></a>
			        </span>
				<?php } ?>

				<?php if( $create_lisiting_enable != 0 && _yani_role()->check_role() ){ ?>
			        <a class="btn btn-create-listing hidden-xs hidden-sm" href="<?php echo esc_url($dashboard_add_listing); ?>">
			            <?php echo _yani_theme()->get_option('dsh_create_listing', 'Create a Listing'); ?>
			        </a>
			     <?php } ?>

			</div>
		<?php } ?>
		<div class="navbar-logged-in-wrap navbar">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    	        <img width="42" height="42" alt="author" src="<?php echo esc_url($user_custom_picture ); ?>" class="rounded">
	        </a>
	        <ul class="logged-in-nav dropdown-menu">
	        	<?php foreach($links as $page=>$link){
	        		if(!empty($page) && _yani_role()->check_role() ){ ?>
	        			<li class="side-menu-item">
	        				<a href="<?php echo esc_url($link); ?>">
	        					<?php echo _yani_theme()->get_option('dsh_'.$page);  ?>	        					
	        				</a>
	        			</li>
	        		<?php }
	        	} ?>
	        </ul>
		</div>
	</div>
</nav>