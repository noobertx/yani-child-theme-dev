<?php
	add_filter('woocommerce_show_page_title','yani_remove_shop_title');

	function yani_remove_shop_title(){
		return false;
	}


	if(!is_product_tag()){

	remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
	}

	if(is_cart()){
		echo "This is the cart page";
	}

	if(is_product_tag()){
		add_action('woocommerce_before_main_content','_themename_add_sidebar_tags',6);

		function _themename_add_sidebar_tags(){
			echo '<div class="sidebar-shop">';
		}
		add_action('woocommerce_before_main_content','woocommerce_get_sidebar',7);

		add_action('woocommerce_before_main_content','_themename_close_sidebar_tags',8);

		function _themename_close_sidebar_tags(){
			echo '</div>';
		}

	}

add_filter( 'woocommerce_add_to_cart_fragments', '_themename_woocommerce_header_add_to_cart_fragment' );

function _themename_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
		<span class="items">
			<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> </span> 
	<?php
	$fragments['a.cart-customlocation span.items'] = ob_get_clean();
	return $fragments;
}
?>