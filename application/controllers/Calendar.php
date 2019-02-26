<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller
{

     public function __construct() {
        Parent::__construct();
        $this->load->model("calendar_model");
        $this->load->library("session");
    }

     public function index()
     {
        $id = $this->uri->segment(3);
            
            if (empty($id))
            {
                show_404();
            }
            
            // $data["row"]=$this->Date_m->busca_salas_re($id);


      
        $this->load->view("calendar/index.php", array());
        
         
     }


     public function get_events()
     {
         // Our Start and End Dates
         $start = $this->input->get("data_inicio");
         $data_fim = $this->input->get("data_fim");
    
         $startdt = new DateTime('now'); // setup a local datetime
         $startdt->setTimestamp($start); // Set the date based on timestamp
         $start_format = $startdt->format('Y-m-d');
    
         $enddt = new DateTime('now'); // setup a local datetime
         $enddt->setTimestamp($data_fim); // Set the date based on timestamp
         $end_format = $enddt->format('Y-m-d');
    
         $events = $this->calendar_model->get_events($start_format, $end_format);
    
         $data_events = array();
    
         foreach($events->result() as $r) {
    
             $data_events[] = array(
                 "id" => $r->id,
                 "title" => $r->utilizador_id,
                 "description" => $r->tipologia_id,
                 "end" => $r->data_fim,
                 "start" => $r->data_inicio
             );
         }
    
         echo json_encode(array("events" => $data_events));
         exit();
     }



     public function add_event() 
{
    /* Our calendar data */
    $name = $this->input->post("name", TRUE);
    $desc = $this->input->post("description", TRUE);
    $start_date = $this->input->post("start_date", TRUE);
    $end_date = $this->input->post("end_date", TRUE);

    if(!empty($start_date)) {
       $sd = DateTime::createFromFormat("Y-m-d", $start_date);
       $start_date = $sd->format('Y-m-d');
       $start_date_timestamp = $sd->getTimestamp();
    } else {
       $start_date = date("Y-m-d", time());
       $start_date_timestamp = time();
    }

    if(!empty($end_date)) {
       $ed = DateTime::createFromFormat("Y-m-d", $end_date);
       $end_date = $ed->format('Y-m-d');
       $end_date_timestamp = $ed->getTimestamp();
    } else {
       $end_date = date("Y-m-d", time());
       $end_date_timestamp = time();
    }

    $this->calendar_model->add_event(array(
       "title" => $name,
       "description" => $desc,
       "start" => $start_date,
       "data_fim" => $end_date
       )
    );
    
    redirect(site_url("Requisicao"));
}

public function edit_event()
     {
          $eventid = intval($this->input->post("eventid"));
          $event = $this->calendar_model->get_event($eventid);
          if($event->num_rows() == 0) {
               echo"Invalid Event";
               exit();
          }

          $event->row();

          /* Our calendar data */
          $name = $this->input->post("name");
          $desc = $this->input->post("description");
          $start_date = $this->input->post("start_date");
          $end_date =$this->input->post("end_date");
          $delete = intval($this->input->post("delete"));

          if(!$delete) {

               if(!empty($start_date)) {
                    $sd = DateTime::createFromFormat("Y-m-d", $start_date);
                    $start_date = $sd->format('Y-m-d');
                    $start_date_timestamp = $sd->getTimestamp();
               } else {
                    $start_date = date("Y-m-d", time());
                    $start_date_timestamp = time();
               }

               if(!empty($end_date)) {
                    $ed = DateTime::createFromFormat("Y-m-d", $end_date);
                    $end_date = $ed->format('Y-m-d');
                    $end_date_timestamp = $ed->getTimestamp();
               } else {
                    $end_date = date("Y-m-d", time());
                    $end_date_timestamp = time();
               }

               $this->calendar_model->update_event($eventid, array(
                    "title" => $name,
                    "description" => $desc,
                    "start" => $start_date,
                    "data_fim" => $end_date,
                    )
               );
               echo "<script>alert('This card was not approved, Thanks.');</script>";
          } else {
               $this->calendar_model->delete_event($eventid);
               
          }
          
          
          redirect(site_url("calendar"));
          
     }







}

?>