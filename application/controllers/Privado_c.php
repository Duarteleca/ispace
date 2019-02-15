<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
			// $this->load->model('news_model');
			$this->load->helper('url_helper');
			
	}
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}

	  // Validação de login
	  public function validacao_login()
	  { 
		  $this->load->model("Privado_m");
		  $username = $this->input->post("username");
		  $password = $this->input->post("password");

		  $array_user = $this->Carro_m->motrar_Utilizadores($username);
		  
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




}
