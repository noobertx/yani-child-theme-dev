<div class="form-group">
    <label for="prop_video_url"><?php echo _yani_theme()->get_option('cl_video_url', 'Video URL'); ?></label>
    <input class="form-control" name="prop_video_url" value="<?php
    if (_yani_post()->can_be_editted()) {
            echo _yani_field()->get_field_meta('video_url');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_video_url_plac', 'YouTube, Vimeo, SWF File and MOV File are supported'); ?>" type="text">
    <small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_example', 'For example'); ?>: https://www.youtube.com/watch?v=49d3Gn41IaA</small>
</div>