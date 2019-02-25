$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
});




$(function() {
    $( "#datepicker" ).datepicker();
} );

$(function() {
    $( "#datepicker2" ).datepicker();
} );


$(function() {
    $('#timepicker').timepicker();
} );
