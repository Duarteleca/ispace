<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Calendar Display</title>
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'; ?>">
        <script type="text/javascript" src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script> 
        <link rel="stylesheet" href="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.min.css" />
               <script src="<?php echo base_url() ?>scripts/fullcalendar/lib/moment.min.js"></script>
               <script src="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.min.js"></script>
               <script src="<?php echo base_url() ?>scripts/fullcalendar/gcal.js"></script>
               <link rel="stylesheet" type="text/css" media="screen" href="/ispace/assets/css/style.css" />
               
    </head>
    <body>

    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <?php echo isset($error) ?  "<div class='alert alert-success' role='alert'>". $error ."</div>" : ''; ?>
    <h1>Caelndar</h1>
    <div id="calendar">
</div>





<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("calendar/add_event"), array("class" => "form-horizontal")) ?>
      <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="name" value="">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Description</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="description">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                
                <div class="col-md-8">
               
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="start_date">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                <div class="col-md-8">
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="end_date">
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add Event">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open(site_url("calendar/edit_event"), array("class" => "form-horizontal")) ?>
      <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="name" value="" id="name">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Description</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="description" id="description">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="start_date" id="start_date">
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="end_date" id="end_date">
                </div>
        </div>
        <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading">Delete Event</label>
                    <div class="col-md-8">
                        <input type="checkbox" name="delete" value="1">
                    </div>
            </div>
            <input type="text" name="eventid" id="event_id" value="0" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Update Event">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>



    </div>
    </div>
    </div>


<script type="text/javascript">
$('.date-picker').datepicker();

 var date_last_clicked = null;

//  var id_user= this->session->userdata("usuario_logado")[0]['id'];

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
        events: function(data_inicio, data_fim, timezone, callback) {
            $.ajax({
                url: '<?php echo base_url() ?>calendar/get_events',
                dataType: 'json',
                data: {                
                    data_inicio: data_inicio.unix(),
                    data_fim: data_fim.unix()
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
       
        
        if(event.title== 12) {

        }else{

          $('#name').val(event.title);
        //   $('#description').val(event.description);
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
        //   $('#description').val(event.description);
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
        //   $('#description').val(event.description);
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
        var tooltip = '<div class="event-tooltip">' + calEvent.title +'<br>'+ 'data de inicio: '+ calEvent.start.format('YYYY-MM-DD') + '</div>';
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
    </body>
</html>