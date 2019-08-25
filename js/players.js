$(document).ready(function(){
	 $("#showmatches").click(function(){
	 	$(".showPlayersStats").hide();

	 	if($(".showPlayersMatches").is(":hidden")){

			$(".showPlayersMatches").slideDown("slow");


		}else{
			$(".showPlayersMatches").slideUp("slow");
		}
	 });

	  $("#showstats").click(function(){
	  	$(".showPlayersMatches").hide();

	 	if($(".showPlayersStats").is(":hidden")){

			$(".showPlayersStats").slideDown("slow");

		}else{
			$(".showPlayersStats").slideUp("slow");
		}
	 });
});