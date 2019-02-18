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
          

	}
	


	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('publico/home');
		$this->load->view('templates/footer');
	}



	public function mostra_salas()
	{
		
		$data['sala'] = $this->Publico_m->busca_salas();
		// Drop list dis fabricantes,modelos,cores
		

		$this->load->view('templates/header');
		$this->load->view('publico/salas',$data);
		// $this->load->view('templates/footer');
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
