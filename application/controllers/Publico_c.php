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

	public function Contacto_form()
	{
		$this->load->view('templates/header');
		$this->load->view('publico/Contacto');
		$this->load->view('templates/footer');
	}


	public function registar_user()
	{


		// Valido os campos com o from validation


		// Valida o Nome
		$this->form_validation->set_rules('name', 'Nome', 'required',
		array(
					'required'      => 'Não preencheu %s.',
			)
		);

		// Valida o Ultimo nome
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[utilizador.username]',
		array(
				   'required'      => 'Não preencheu %s.',
				   'is_unique'     => 'Este %s já existe.'
		   )
	    );

	   // Valida o Email
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[utilizador.email]',
	    array(
				  'required'      => 'Não preencheu %s.',
				  'is_unique'     => 'Este %s já existe.'
		  )
	  	);

		// Valida a Password
		$this->form_validation->set_rules('password', 'Password','required',
			array('required' => 'Você tem de preencher campo %s.')
			);

		// Confirma a Password
		$this->form_validation->set_rules('confirm', 'Password de Confirmação','required|matches[password]',
			array(
				'required'      => 'Não preencheu %s.',
				'matches'     => 'A %s não coincide.'
				)
		);

		

		// Guarda os valores inseridos no registo
		$nome = $this->input->post("name");
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$confirm = $this->input->post("confirm");


			// Se o form validation nao tiver erros.
			if ($this->form_validation->run() == TRUE) {
				
				
				$password = password_hash($password,PASSWORD_DEFAULT);


				$data = array (
						'nome' => $nome,
						'username' => $username,
						'email' => $email,
						'password' => $password
				);
				

				var_dump($data);
				$this->Publico_m->inserir_Registo($data);
				$this->session->set_flashdata("Registo_sucess", "Registado/a com sucesso!");
				$this->load->view('templates/Header');
				$this->load->view('publico/Registo', $data);
				$this->load->view('templates/Footer');

				redirect('home', 'refresh');

				
				

			} else {
				$data['erros'] = array('mensagens' => validation_errors());
				
				$this->load->view('templates/Header');
				$this->load->view('publico/Registo', $data);
				$this->load->view('templates/Footer');
				
				

					}
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
