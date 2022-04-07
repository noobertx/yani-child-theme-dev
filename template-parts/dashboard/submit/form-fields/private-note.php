<div class="form-group">
	<label for="private_note">
		<?php echo _yani_theme()->get_option('cl_private_note', 'Write private note for this property, it will not display for public.'); ?>		
	</label>
	<textarea class="form-control" id="private_note" name="private_note" rows="7" placeholder="<?php echo _yani_theme()->get_option('cl_private_note_plac', 'Enter the note here'); ?>"><?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('private_note');
    }
    ?></textarea>
</div>