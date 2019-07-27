$(document).ready(function(){
    $("#submatchinfo").closest("form").submit(function(e) {

        e.preventDefault();

        $.ajax({
            url: 'addmatch.php',
            type: 'POST',
            data: {team1: $(".team1").serialize(),team2: $(".team2").serialize(), status: $(".status").serialize(), map: $(".map").serialize(), starttime: $(".starttime").serialize(), startdate: $(".startdate").serialize(), league: $(".league").serialize()},
            dataType: 'html'
        })
        .done(function(data){
            $('.modal-content').fadeIn("slow").html(data);
        })
        .fail(function(){
            alert("lol");
        });
    });
});