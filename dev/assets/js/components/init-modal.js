window.yani_processing_modal = function ( msg ) {
    var process_modal ='<div class="modal fade" id="yani_modal" tabindex="-1" role="dialog" aria-labelledby="yaniModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body yani_messages_modal">'+msg+'</div></div></div></div></div>';
    jQuery('body').append(process_modal);
    jQuery('#yani_modal').modal();
}

window.yani_processing_modal_close = function( ) {
    jQuery('#yani_modal').modal('hide');
}