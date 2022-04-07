<?php
// require_once("sample/barebones-config.php");   
if(!get_option('custom_wprig_opt')){
	// require_once("sample/initialData.php");
    update_option('custom_wprig_opt',$initialSettings);
}
?>