<?php 
global $yani_local, $dashboard_invoices;
$invoice_data = _yani_invoice()->get_invoice_meta( get_the_ID() );
$user_info = get_userdata($invoice_data['invoice_buyer_id']);
$invoice_detail = add_query_arg( 'invoice_id', get_the_ID(), $dashboard_invoices );

$billing_for_if = get_post_meta( get_the_ID(), 'yani_invoice_for', true );
?>
<tr>
	<td data-label="<?php echo $yani_local['order']; ?>"><?php echo get_the_ID(); ?></td>
	
	<td data-label="<?php echo $yani_local['date']; ?>"><?php echo get_the_date(); ?></td>
	
	<td data-label="<?php echo $yani_local['billing_for']; ?>">
		<?php
            if( $invoice_data['invoice_billion_for'] != 'package' && $invoice_data['invoice_billion_for'] != 'Package' ) {
                
                if( $billing_for_if == 'listing' || $billing_for_if == 'Listing' ) {
                	echo esc_html__('Listing', _yani_theme()->get_text_domain());
                } elseif ( $billing_for_if == 'UPGRADE TO FEATURED' || $billing_for_if == 'Upgrade to Featured' ) {
                	echo esc_html__('Upgrade to Featured', _yani_theme()->get_text_domain());
                } else {
                	echo esc_html($invoice_data['invoice_billion_for']);
                }

            } else {
                echo get_the_title( get_post_meta( get_the_ID(), 'yani_invoice_item_id', true) );
            }
        ?>
	</td>

	<td data-label="<?php echo $yani_local['billing_type']; ?>">
		<?php 
        if( get_post_meta( get_the_ID(), 'yani_invoice_type', true ) == 'Recurring' ) {
            echo esc_html__( 'Recurring', 'houzez' );
        } else if ( get_post_meta( get_the_ID(), 'yani_invoice_type', true ) == 'One Time' ) {
            echo esc_html__( 'One Time', 'houzez' );
        } else {
            echo esc_html( $invoice_data['invoice_billing_type'] ); 
        }?>		
	</td>

	<td data-label="<?php echo $yani_local['invoice_status']; ?>">
		<?php
        $invoice_status = get_post_meta(  get_the_ID(), 'invoice_payment_status', true );
        if( $invoice_status == 0 ) {
            echo '<strong class="label bg-warning">'.esc_html__( 'Not Paid', 'houzez' ).'</strong>';
        } else {
            echo '<strong class="label bg-success">'.esc_html__( 'Paid', 'houzez' ).'</strong>';
        }
        ?>
	</td>

	<td data-label="<?php echo $yani_local['payment_method']; ?>">
		<?php if( $invoice_data['invoice_payment_method'] == 'Direct Bank Transfer' ) {
            echo $yani_local['bank_transfer'];
        } else {
            echo $invoice_data['invoice_payment_method'];
        } ?>
	</td>

	<td data-label="<?php echo $yani_local['total']; ?>">
		<strong><?php echo _yani_invoice()->get_invoice_price( $invoice_data['invoice_item_price'] );?></strong>
	</td>

	<td data-label="<?php echo esc_html__('Actions', _yani_theme()->get_text_domain()); ?>">
		<a class="btn btn-primary" href="<?php echo esc_url($invoice_detail); ?>">
			<?php echo esc_html__('Details', _yani_theme()->get_text_domain()); ?>
		</a>
	</td>
</tr>