
<!DOCTYPE html>
<html>
 <head>
  <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  <script type="text/javascript">
   
  $(document).ready(function() {
 $('#calendar').fullCalendar({
    editable:true,
    eventOverlap:false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
   
    selectable:true,
    selectHelper:true,
    eventSources: [
    {
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: '<?php echo base_url() ?>calendar/get_events',
                dataType: 'json',
                data: {                
                    start: start.unix(),
                    end: end.unix()
                },
                success: function(msg) {
                    var events = msg.events;
                    callback(events);
                    
                }
            });
       }
    },
    ],
    dayClick: function(date, jsEvent, view) {
        date_last_clicked = $(this);
        // $(this).css('background-color', '#bed7f3');
        $('#addModal input[name=start_date]').val(moment(date).format('YYYY-MM-DD'));
        $('#addModal').modal();
    },
    eventClick: function(event, jsEvent, view) {
        if(event.id==2) {

        }else{

          $('#name').val(event.title);
          $('#description').val(event.description);
          $('#start_date').val(moment(event.start).format('YYYY-MM-DD'));
          if(event.end) {
            $('#end_date').val(moment(event.end).format('YYYY-MM-DD'));
          } else {
            $('#end_date').val(moment(event.start).format('YYYY-MM-DD'));
          }
          $('#event_id').val(event.id);
          $('#editModal').modal();
}},
 
        eventDrop:function(event)
    {
        
        if(event.id==2) {

}else{
        $('#name').val(event.title);
          $('#description').val(event.description);
          $('#start_date').val(moment(event.start).format('YYYY-MM-DD'));
          if(event.end) {
            $('#end_date').val(moment(event.end).format('YYYY-MM-DD'));
          } else {
            $('#end_date').val(moment(event.start).format('YYYY-MM-DD'));
          }
          $('#event_id').val(event.id);
          $('#editModal').modal();
    }},

     eventResize:function(event)
    {
        $('#name').val(event.title);
          $('#description').val(event.description);
          $('#start_date').val(moment(event.start).format('YYYY-MM-DD'));
          if(event.end) {
            $('#end_date').val(moment(event.end).format('YYYY-MM-DD'));
          } else {
            $('#end_date').val(moment(event.start).format('YYYY-MM-DD'));
          }
          $('#event_id').val(event.id);
          $('#editModal').modal();
    },



        eventMouseover: function(calEvent, jsEvent, view){
            if(event.id==2) {

                }else{
        var tooltip = '<div class="event-tooltip">' + calEvent.description +'<br>'+ 'data de inicio: '+ calEvent.start.format('YYYY-MM-DD') + '</div>';
        $("body").append(tooltip);

        $(this).mouseover(function(e) {
            $(this).css('z-index', 10000);
            $('.event-tooltip').fadeIn('500');
            $('.event-tooltip').fadeTo('10', 1.9);
        }).mousemove(function(e) {
            $('.event-tooltip').css('top', e.pageY + 10);
            $('.event-tooltip').css('left', e.pageX + 20);
        });
    }},

 eventMouseout: function(calEvent, jsEvent) {
    if(event.id==2) {

}else{
        $(this).css('z-index', 8);
        $('.event-tooltip').remove();
    }},

  });
   
  </script>
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>
