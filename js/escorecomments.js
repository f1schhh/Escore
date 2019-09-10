$(document).ready(function(){
    $('time.timeago').timeago();
     $('.deleteicon').click(function() {
        return window.confirm("Är du säker att du vill ta bort denna kommentaren?");
    });
 });