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
            $id = $this->uri->segment(3);
            
            if (empty($id))
            {
                show_404();
            }
            
            $data["row"]=$this->Date_m->busca_salas_re($id);


            // $datas = array(
            
            //     'id' => $id,
            //     'modelo_id' => $this->input->post('id_modelo'),
            //     'cor_id' => $this->input->post('id_cor'),
            //     'disponibilidade' => $this->input->post('id_disponibilidade'),
            //     'matricula' => $this->input->post('id_matricula')
            // );
            
            // $this->form_validation->set_rules('id_modelo', 'id_modelo', 'required');
            // $this->form_validation->set_rules('text', 'Text', 'required');
     
            // if($this->input->post('submit'))
            // {
            //     $this->Frota_m->saveCar($id);
                
            //     // $this->load->view('news/success');
            //     redirect( base_url() . 'frota/controle_frota');
               
     
            // }
            // else
            // {

                $this->load->view('templates/header');
        $this->load->view('date/editar',$data);
        $this->load->view('templates/footer');
        
                
            // }
        }
}
