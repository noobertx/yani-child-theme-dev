<div class="form-group">
	<textarea class="form-control" name="virtual_tour" rows="7" placeholder="<?php echo _yani_theme()->get_option('cl_virtual_plac', 'Enter virtual tour iframe/embeded code');?>"><?php
    if (_yani_post()->can_be_editted()) {
         _yani_field()->get_field_meta('virtual_tour', false);
    }
    ?></textarea>
</div>