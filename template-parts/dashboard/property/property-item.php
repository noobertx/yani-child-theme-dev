<?php
global $post;
$post_id    = get_the_ID();
$submit_link = _yani_template()->get_template_link('template/user_dashboard_submit.php');
$listings_page = _yani_template()->get_template_link('template/user_dashboard_properties.php');
$edit_link  	= add_query_arg( 'edit_property', get_the_ID(), $submit_link );
$delete_link  	= add_query_arg( 'property_id', get_the_ID(), $listings_page );
$paid_submission_type  = _yani_theme()->get_option('enable_paid_submission');
$property_status = get_post_status ( $post->ID );
$payment_status = get_post_meta( get_the_ID(), 'yani_payment_status', true );

$payment_page = _yani_template()->get_template_link('template/template-payment.php');
$insights_page = _yani_template()->get_template_link('template/user_dashboard_insight.php');
$payment_page_link = add_query_arg( 'prop-id', $post_id, $payment_page );
$payment_page_link_featured = add_query_arg( 'upgrade_id', $post_id, $payment_page );
$insights_page_link = add_query_arg( 'listing_id', $post_id, $insights_page );

if( $property_status == 'publish' ) {
    $status_badge = '<span class="badge badge-success">'.esc_html__('Approved', _yani_theme()->get_text_domain()).'</span>';
} elseif( $property_status == 'on_hold' ) {
    $status_badge = '<span class="badge badge-info">'.esc_html__('On Hold', _yani_theme()->get_text_domain()).'</span>';
} elseif( $property_status == 'pending' ) {
    $status_badge = '<span class="badge badge-warning">'.esc_html__('Pending', _yani_theme()->get_text_domain()).'</span>';
} elseif( $property_status == 'expired' ) {
    $status_badge = '<span class="badge badge-danger">'.esc_html__('Expired', _yani_theme()->get_text_domain()).'</span>';
} elseif( $property_status == 'draft' ) {
    $status_badge = '<span class="badge badge-dark">'.esc_html__('Draft', _yani_theme()->get_text_domain()).'</span>';
} else {
    $status_badge = '';
}

$payment_status_label = '';
if( $property_status != 'expired' ) {
    if ($paid_submission_type != 'no' && $paid_submission_type != 'membership' && $paid_submission_type != 'free_paid_listing' ) {
        if ($payment_status == 'paid') {
            $payment_status_label = '<span class="label property-payment-status">' . esc_html__('PAID', _yani_theme()->get_text_domain()) . '</span>';
        } elseif ($payment_status == 'not_paid') {
            $payment_status_label = '<span class="label property-payment-status">' . esc_html__('NOT PAID', _yani_theme()->get_text_domain()) . '</span>';
        } else {
            $payment_status_label = '';
        }
    } else {
        $payment_status_label = '';
    }
}
?>
<tr>
	
	<td class="property-table-thumbnail" data-label="<?php echo esc_html__('Thumbnail', _yani_theme()->get_text_domain()); ?>">
		<div class="table-property-thumb">
			
			<?php echo $payment_status_label; ?>

			<a href="<?php echo esc_url(get_permalink()); ?>">
			<?php
			if( has_post_thumbnail() && get_the_post_thumbnail(get_the_ID()) != '') {
                the_post_thumbnail(array('100', '75'));
            } else {
                echo '<img src="http://via.placeholder.com/100x75">';
            }
			?>
			</a>	
		</div>
	</td>
	
	<td class="property-table-address" data-label="<?php echo esc_html__('Title', _yani_theme()->get_text_domain()); ?>">
		<a href="<?php echo esc_url(get_permalink()); ?>"><strong><?php the_title(); ?></strong></a><br>
		<?php echo _yani_property_listing()->get_listing_data('property_map_address'); ?><br>
		<?php if( _yani_role()->user_role_by_post_id($post_id) != 'administrator' && get_post_status ( $post_id ) == 'publish' ) { ?>
                <?php if($paid_submission_type != 'no' && _yani_theme()->get_option('per_listing_expire_unlimited') ) { ?>
                <span class="expiration_date">
                    <?php echo esc_html__('Expiration:', _yani_theme()->get_text_domain()); ?> <?php yani_listing_expire(); ?>
                </span>
                <?php } ?>
        <?php } ?>
	</td>

	<td>
		<?php echo $status_badge; ?>
	</td>

	<td class="property-table-type" data-label="<?php echo esc_html__('Type', _yani_theme()->get_text_domain()); ?>">
		<?php echo _yani_taxonomy()->get_taxonomy_simple('property_type'); ?>&nbsp	
	</td>

	<td class="property-table-status" data-label="<?php echo esc_html__('Status', _yani_theme()->get_text_domain()); ?>">
		<?php echo _yani_taxonomy()->get_taxonomy_simple('property_status'); ?>&nbsp
	</td>

	<td class="property-table-price" data-label="<?php echo esc_html__('Price', _yani_theme()->get_text_domain()); ?>">
		<?php _yani_price()->property_price_admin(); ?>&nbsp
	</td>

	<td class="property-table-featured" data-label="<?php echo esc_html__('Featured', _yani_theme()->get_text_domain()); ?>">
		<?php 
		if(_yani_property_listing()->get_listing_data('featured')) {
			echo esc_html__('Yes', _yani_theme()->get_text_domain()); 
		} else {
			echo esc_html__('No', _yani_theme()->get_text_domain()); 
		}
		?>
	</td>

	<td class="property-table-actions" data-label="<?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?>">
		<div class="dropdown property-action-menu">
			<button class="btn btn-primary-outlined dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?>
			</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                <?php 
                if( class_exists('yani_Insights') && !empty($insights_page) ) { ?>
                <a class="dropdown-item" href="<?php echo esc_url($insights_page_link); ?>"><?php esc_html_e('View Stats', _yani_theme()->get_text_domain()); ?></a>
                <?php } ?>

				<a class="dropdown-item" href="<?php echo esc_url($edit_link); ?>"><?php esc_html_e('Edit', _yani_theme()->get_text_domain()); ?></a>

				<a href="" class="delete-property dropdown-item" data-id="<?php echo intval($post->ID); ?>" data-nonce="<?php echo wp_create_nonce('delete_my_property_nonce') ?>"><?php esc_html_e('Delete', _yani_theme()->get_text_domain()); ?></a>

				<a class="clone-property dropdown-item" data-property="<?php echo $post->ID; ?>" href="#"><?php esc_html_e('Duplicate', _yani_theme()->get_text_domain()); ?></a>

				<?php 
				if(_yani_post()->is_published( $post->ID )) { ?>
                <a href="#" class="put-on-hold dropdown-item" data-property="<?php echo $post->ID; ?>"> 
                	<?php esc_html_e('Put On Hold', _yani_theme()->get_text_domain());?>
                </a>
                <?php 
            	} elseif (_yani_post()->check_post_status( $post->ID ,"on_hold")) { ?>
                    <a href="#" class="put-on-hold dropdown-item" data-property="<?php echo $post->ID; ?>"> 
                    	<?php esc_html_e('Go Live', _yani_theme()->get_text_domain());?>
                    </a>
                <?php } ?>

                <?php
                if( $paid_submission_type == 'per_listing' && $property_status != 'expired' ) {
                    if ($payment_status != 'paid') {

                        if( _yani_theme()->is_woocommerce() ) {
                            echo '<a href="#" class="yani-woocommerce-pay btn pay-btn" data-listid="'.intval($post_id).'">' . esc_html__('Pay Now', _yani_theme()->get_text_domain()) . '</a>';
                        } else {
                            echo '<a href="' . esc_url($payment_page_link) . '" class="btn pay-btn">' . esc_html__('Pay Now', _yani_theme()->get_text_domain()) . '</a>';
                        }
                    } else {
                        if( _yani_property_listing()->get_listing_data('featured') != 1 && $property_status == 'publish' ) {

                            if( yani_is_woocommerce() ) {
                                echo '<a href="' . esc_url($payment_page_link_featured) . '" class="yani-woocommerce-pay btn pay-btn" data-featured="1" data-listid="'.intval($post_id).'">' . esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain()) . '</a>';
                            } else {
                                echo '<a href="' . esc_url($payment_page_link_featured) . '" class="btn pay-btn">' . esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain()) . '</a>';
                            }
                            
                        }
                    }
                }

                if( $property_status == 'expired' && ( $paid_submission_type == 'per_listing') ) {
                    
                    if( yani_is_woocommerce() ) {
                        echo '<a href="#" data-listid="'.intval($post_id).'" class="yani-woocommerce-pay btn pay-btn">'.esc_html__( 'Re-List', _yani_theme()->get_text_domain() ).'</a>';
                    } else {

                        $payment_page_link_expired = add_query_arg( array('prop-id' => $post_id, 'mode' => 'relist'), $payment_page );
                        echo '<a href="' . esc_url($payment_page_link_expired) . '" class="btn pay-btn">'.esc_html__( 'Re-List', _yani_theme()->get_text_domain() ).'</a>';
                    }
                    
                }

                if( $property_status == 'expired' && ( $paid_submission_type == 'free_paid_listing' || $paid_submission_type == 'no' ) ) {
                    
                    echo '<a href="#" data-property="'.$post->ID.'" class="relist-free btn pay-btn">'.esc_html__( 'Re-List', _yani_theme()->get_text_domain() ).'</a>';
                    
                }

                if( _yani_post()->check_post_status( $post->ID ,"draft") ) {

                    // Membership
                    if ( $paid_submission_type == 'membership' && _yani_property_listing()->get_listing_data('featured') != 1 && $property_status == 'publish' ) {
                        
                        echo '<a href="#" data-proptype="membership" data-propid="'.intval( $post->ID ).'" class="make-prop-featured btn pay-btn">' . esc_html__('Set as Featured', _yani_theme()->get_text_domain()) . '</a>';
                        
                    }
                    if ( $paid_submission_type == 'membership' && _yani_property_listing()->get_listing_data('featured') == 1 ) {
                        
                        echo '<a href="#" data-proptype="membership" data-propid="'.intval( $post->ID ).'" class="remove-prop-featured btn pay-btn">' . esc_html__('Remove From Featured', _yani_theme()->get_text_domain()) . '</a>';
                        
                    }
                    if( $property_status == 'expired' && $paid_submission_type == 'membership' ) {
                        
                        echo '<a href="#" data-propid="'.intval( $post->ID ).'" class="resend-for-approval btn pay-btn">' . esc_html__('Reactivate Listing', _yani_theme()->get_text_domain()) . '</a>';
                        
                    }

                    //Paid Featured
                    if( $paid_submission_type == 'free_paid_listing' && $property_status == 'publish' ) {
                        
                        if( _yani_property_listing()->get_listing_data('featured') != 1 ) {

                            if( yani_is_woocommerce() ) {
                                echo '<a href="#" class="yani-woocommerce-pay btn pay-btn" data-featured="1" data-listid="'.intval($post_id).'">' . esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain()) . '</a>';
                            } else {
                                echo '<a href="' . esc_url($payment_page_link_featured) . '" class="btn pay-btn">' . esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain()) . '</a>';
                            }
                        }
                        
                    }

                }
                ?>
			</div>
		</div>
	</td>
</tr>