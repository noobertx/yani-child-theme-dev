<?php
    do_action("_themename_header_creative");
    $transparent = apply_filters("_themename_header_transparent");
?>
<div id="wrapper">    
    <header class="header-main-wrap <?php echo $transparent; ?>">
        <?php
            do_action("_themename_header_style");
        ?>
    </header><!-- .header-main-wrap -->
</div>