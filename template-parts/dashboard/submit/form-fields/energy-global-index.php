<div class="form-group">
	<label for="energy_global_index"><?php echo yani_option('cl_energy_index', 'Global Energy Performance Index'); ?></label>

	<input class="form-control" id="energy_global_index" name="energy_global_index" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('energy_global_index');
    }
    ?>" placeholder="<?php echo yani_option('cl_energy_index_plac', 'For example: 92.42 kWh / m²a'); ?>" type="text">
</div>