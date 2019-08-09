$(document).ready(function(){
	var searchin = $("#searchinput");
	searchin.keyup(function(){

		thistext = $(this).val();

		if(thistext == ''){

		}else{
			$("#searchinput").css("border-bottom-right-radius", "0px");
		    $("#searchinput").css("border-bottom-left-radius", "0px");

		    $.ajax({
		    	url: 'searchresults.php',
		    	method: 'POST',
		    	data:{searchtxt:thistext},
		    	dataType: 'text',
		    	success:function(data){
		    		$(".search-content").fadeIn().html(data);
		    	}
		    })
		}
	});

	$('body').click(function(){
		$(".search-content").fadeOut();
	});

});