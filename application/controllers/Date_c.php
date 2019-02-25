<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Date_c extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
			parent::__construct();
			$this->load->model('Date_m');
			$this->load->helper('url_helper');
			$this->load->library("pagination");
	}
	

    
    public function salar()
	{

        $salas=$this->input->post('search_sala');
		$data['salas']=$this->Date_m->selecionarSala();
        $data["sala"] = $this->Date_m->busca_salas($salas);
        
        $this->load->view('templates/header');
        $this->load->view('date/salar',$data);
		$this->load->view('templates/footer');
    }
    
    public function editar()
        {
           
            
           
                
        $this->load->view('date/editar',array());
       
        
                
          
        }



        public function get_events()
     {
         // Our Start and End Dates
         $start = $this->input->get("start");
         $end = $this->input->get("end");
    
         $startdt = new DateTime('now'); // setup a local datetime
         $startdt->setTimestamp($start); // Set the date based on timestamp
         $start_format = $startdt->format('Y-m-d');
    
         $enddt = new DateTime('now'); // setup a local datetime
         $enddt->setTimestamp($end); // Set the date based on timestamp
         $end_format = $enddt->format('Y-m-d');
        $id=3;
         $events = $this->Date_m->get_events($start_format, $end_format,$id);
    
         $data_events = array();
    
         foreach($events->result() as $r) {
    
             $data_events[] = array(
                 "id" => $r->id,
                 "title" => $r->title,
                 "description" => $r->description,
                 "end" => $r->end,
                 "start" => $r->start
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
       "end" => $end_date
       )
    );
    
    redirect(site_url("calendar"));
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
                    "end" => $end_date,
                    )
               );
               echo "<script>alert('This card was not approved, Thanks.');</script>";
          } else {
               $this->calendar_model->delete_event($eventid);
               
          }
          
          
          redirect(site_url("calendar"));
          
     }


     

     public function dragedit_event()
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
                    $sd = DateTime::createFromFormat("Y/m/d", $start_date);
                    $start_date = $sd->format('Y-m-d');
                    $start_date_timestamp = $sd->getTimestamp();
               } else {
                    $start_date = date("Y-m-d", time());
                    $start_date_timestamp = time();
               }

               if(!empty($end_date)) {
                    $ed = DateTime::createFromFormat("Y/m/d", $end_date);
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
                    "end" => $end_date,
                    )
               );

          } else {
               $this->calendar_model->delete_event($eventid);
          }

          redirect(site_url("calendar"));
     }








}
