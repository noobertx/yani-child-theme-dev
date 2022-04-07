(function($){
	$("#frm-check-service-area").on("click","#btnGo",function(e){
		e.preventDefault();
		$fromControl = $(".form-control").val();
		$parent = $(this).closest(".yani-delivery-areas");
		$("#frm-check-service-area").hide();
		$parent.find(".delivery-area-status").html("Checking...").removeClass("danger").removeClass("success").addClass("info");
		$(".form-control").removeClass("bg-danger").removeClass("white")
		$.getJSON(searchData.root_url+'/wp-json/search/v1/zip?term='+ $fromControl,function(results){
			if(results){
				$parent.find(".delivery-area-status").removeClass("info").addClass("success").html("Great news, we deliver to your area!");
				$("#frm-check-service-area").show();
				$(".yani-delivery-areas-banner").show();
				$(".yani-delivery-areas").hide();
			}else{
				$("#frm-check-service-area").show();
				$parent.find(".delivery-area-status").removeClass("info").addClass("danger").html("Sorry, we're not yet in your neighborhood. Join us online for info on new delivery areas, recipes and farm events");				
				$(".form-control").addClass("bg-danger").addClass("white")
			}
		})
	})

	$(".yani-delivery-areas-banner").on("click","#btn-change-location",function(e){
		$(".yani-delivery-areas-banner").hide();
		$(".yani-delivery-areas").show();
		$(".form-control").removeClass("bg-danger").removeClass("white")
		$parent.find(".delivery-area-status").html("").removeClass("danger").removeClass("success").removeClass("info");
	})

})(jQuery)