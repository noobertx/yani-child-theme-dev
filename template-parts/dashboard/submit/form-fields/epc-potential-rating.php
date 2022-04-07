<div class="form-group">
	<label for="epc_potential_rating"><?php echo yani_option('cl_energy_ecp_p', 'EPC Potential Rating'); ?></label>

	<input class="form-control" id="epc_potential_rating" name="epc_potential_rating" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('epc_potential_rating');
    }
    ?>" placeholder="<?php echo yani_option('cl_energy_ecp_p_plac'); ?>" type="text">
</div>