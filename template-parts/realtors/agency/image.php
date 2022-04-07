<?php 
if( has_post_thumbnail() ) {
	the_post_thumbnail('medium_large', array('class' => 'img-fluid'));
} else {
	yani_image_placeholder( 'large' );
}
?>