<?php 
global $yani_local; 
$is_multi_currency = yani_option('multi_currency');
$default_multi_currency = get_the_author_meta( 'yani_author_currency' , get_current_user_id() );
if(empty($default_multi_currency)) {
    $default_multi_currency = yani_option('default_multi_currency');
}

if( $is_multi_currency == 1 && class_exists('yani_Currencies')) { ?>

<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label for="currency">
			<?php echo esc_html__('Currency', _yani_theme()->get_text_domain()); ?>	
		</label>

		<select name="currency" class="selectpicker form-control bs-select-hidden" data-live-search="false" data-live-search-style="begins">
	        <option value=""><?php echo $yani_local['choose_currency']; ?></option>
	        <?php
	        $currencies = yani_Currencies::get_form_fields();
	        if(!empty($currencies)) {
		        foreach ($currencies as $currency) {

		        	if (yani_edit_property()) {
		        		echo '<option '.selected($currency->currency_code, yani_get_field_meta('currency'), false).' value="'.esc_attr($currency->currency_code).'">'.esc_attr($currency->currency_code).'</option>';

		        	} else {
		        		echo '<option '.selected($currency->currency_code, $default_multi_currency, false).' value="'.esc_attr($currency->currency_code).'">'.esc_attr($currency->currency_code).'</option>';
		        	}
		        }
		    }
	        ?>
	    </select>
	</div>
</div>

<?php } ?>