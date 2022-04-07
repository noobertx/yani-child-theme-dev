<div class="form-group">
	<label for="energy_performance"><?php echo yani_option('cl_energy_build_performance', 'Energy performance of the building'); ?></label>

	<input class="form-control" id="energy_performance" name="energy_performance" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('energy_performance');
    }
    ?>" placeholder="<?php echo yani_option('cl_energy_build_performance_plac'); ?>" type="text">
</div>