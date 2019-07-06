$(document).ready(function(){

	$(".fixmobilepos").hide();

	$(".mobilebtn").click(function(){

		if($(".fixmobilepos").is(":hidden")){

			$(".fixmobilepos").slideDown("slow");

		}else{
			$(".fixmobilepos").slideUp("slow");
		}

		

	});


});
