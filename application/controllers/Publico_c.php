<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico_c extends CI_Controller {

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
			$this->load->model('Publico_m');
			$this->load->helper('url_helper');
			$this->load->library("pagination");
          

	}
	


	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('publico/home');
		$this->load->view('templates/footer');
	}



	public function mostra_salas()
	{
		$data['salas']=$this->Publico_m->selecionarSala();
		
		
		$config = array();
 
        $config["base_url"] = base_url() . "Publico_c/mostra_salas";
       $config["total_rows"] = $this->Publico_m->Contar_salas();
 
       $config["per_page"] = 10;
 
       $config["uri_segment"] = 3;
    	//    $config["num_links"] = 5; 
    	$config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		
		$this->pagination->initialize($config);
 
		   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		   

		   if($this->input->post('submit')){
			$sala=$this->input->post('search_sala');
			
			 
			 
			// $data['results']=$this->Frota_m->searchFrota($fabricante);
			$data["sala"] = $this->Publico_m->busca_salas($config["per_page"], $page,$sala);
	  	$data["links"] = $this->pagination->create_links();
			}else{
				$data["sala"] = $this->Publico_m->busca_salas($config["per_page"], $page);
	  	$data["links"] = $this->pagination->create_links();
				
			}
	   	

		$this->load->view('templates/header');
		$this->load->view('publico/salas',$data);
		
	}

	public function mostra_equipamento()
	{
		$data['equipamento']=$this->Publico_m->selecionarEquipamento();
		
		
		$config = array();
 
        $config["base_url"] = base_url() . "Publico_c/mostra_equipamento";
       $config["total_rows"] = $this->Publico_m->Contar_salas();
 
       $config["per_page"] = 10;
 
       $config["uri_segment"] = 3;
    	//    $config["num_links"] = 5; 
    	$config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		
		$this->pagination->initialize($config);
 
		   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		   

		   if($this->input->post('submit')){
			$equipamento=$this->input->post('search_sala');
			
			 
			 
			// $data['results']=$this->Frota_m->searchFrota($fabricante);
			$data["sala"] = $this->Publico_m->busca_equipamento($config["per_page"], $page,$equipamento);
	  	$data["links"] = $this->pagination->create_links();
			}else{
				$data["sala"] = $this->Publico_m->busca_equipamento($config["per_page"], $page);
	  	$data["links"] = $this->pagination->create_links();
				
			}
	   	

		
		
	
		
		

		$this->load->view('templates/header');
		$this->load->view('publico/equipamento',$data);
		
	}


	  // Validação de login
	  public function validacao_login()
	  { 
		  $this->load->model("Publico_m");
		  $username = $this->input->post("username");
		  $password = $this->input->post("password");

		  $array_user = $this->Publico_m->motrar_Utilizadores($username);
		  
		  $passdatabase = $array_user[0]['password'];
		  $userdatabase = $array_user[0]['username'];

	 
		  // // se o user existe
		  if($userdatabase == $username) {
			  $this->session->set_userdata("usuario_logado",$array_user);
		   
			  $this->session->set_flashdata("sucesso", "Login com sucesso!");
		  }else{
			  $this->session->set_flashdata("erro", "User ou senha inválida!");

		  }
		  redirect('home', 'refresh');  
	  }

	  // Funão de logout, faz uset do user, e manda mensagem, que é mostrada no header
	  public function logout()
	  {
		  $this->session->unset_userdata("usuario_logado");
		  $this->session->set_flashdata("sucesso","Logout com sucesso!");
		  redirect('home', 'refresh');
	  }
}
