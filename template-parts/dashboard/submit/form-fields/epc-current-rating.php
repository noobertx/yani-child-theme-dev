<div class="form-group">
	<label for="epc_current_rating"><?php echo yani_option('cl_energy_ecp_rating', 'EPC Current Rating'); ?></label>

	<input class="form-control" id="epc_current_rating" name="epc_current_rating" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('epc_current_rating');
    }
    ?>" placeholder="<?php echo yani_option('cl_energy_ecp_rating_plac'); ?>" type="text">
</div>