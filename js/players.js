$(document).ready(function(){
	 $("#showmatches").click(function(){

	 	if($(".showPlayersMatches").is(":hidden")){

			$(".showPlayersMatches").slideDown("slow");

		}else{
			$(".showPlayersMatches").slideUp("slow");
		}
	 });
});