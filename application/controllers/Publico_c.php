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



	public function Recuperar_pass(){
		$email=$this->input->post("email");
		if($this->input->post('submit')){

		$this->load->model("Publico_m");
		
		$password=$this->Publico_m->randomPassword();
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$this->Publico_m->recupera_pass($email,$password_hash);



		$data['error'] = 'Enviado com Sucesso';
		//Load email library
		$this->load->library('email');

		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'rentacar.bravavalley@gmail.com',
			'smtp_pass' => '1a2s3d4f5g',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<p> De: '.$password_hash.'<p>';



		$this->email->to('duarteleca@hotmail.com');
		$this->email->from('rentacar.bravavalley@gmail.com','iSpace');
		$this->email->subject($email);
		$this->email->message($htmlContent);

		//Send email
		$this->email->send();

		$this->load->view('templates/header');
		$this->load->view('publico/Recuperar',$data);
		$this->load->view('templates/footer');


		}else{
			$this->load->view('templates/header');
		$this->load->view('publico/Recuperar');
		$this->load->view('templates/footer');
		}

		
	}


	public function Contacto()
	{

	
			 $name=$this->input->post("name");
			$email=$this->input->post("email");
			$mensagem=$this->input->post("message");
			$assunto=$this->input->post("assunto");
			
		

	if($this->input->post('submit')){
		$data['error'] = 'Enviado com Sucesso'; 
		// $this->load->model("Publico_m");
		// $this->Publico_m->GuardarContato($contato);
		


			//Load email library
	$this->load->library('email');

	//SMTP & mail configuration
	$config = array(
		'protocol'  => 'smtp',
		'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => 'rentacar.bravavalley@gmail.com',
		'smtp_pass' => '1a2s3d4f5g',
		'mailtype'  => 'html',
		'charset'   => 'utf-8'
	);
	$this->email->initialize($config);
	$this->email->set_mailtype("html");
	$this->email->set_newline("\r\n");

	//Email content
	$htmlContent = '<p> De: '.$email.'<p>';
	$htmlContent .= '<p> Nome: '.$name.'</p>';
	$htmlContent .= '<p> Mensagem: '.$mensagem.'</p>';


	$this->email->to('duarteleca@hotmail.com');
	$this->email->from('rentacar.bravavalley@gmail.com','iSpace');
	$this->email->subject($assunto);
	$this->email->message($htmlContent);

	//Send email
	$this->email->send();



			$this->load->view('templates/header');
			$this->load->view('publico/Contacto',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header');
			$this->load->view('publico/Contacto');
			$this->load->view('templates/footer');
		}
	}

	// Regita um usuário
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
		 
				

	
	// Mostra salas
	public function mostra_salas()
	{
		$salas=$this->input->post('search_sala');
		$data['salas']=$this->Publico_m->selecionarSala();
		$data["sala"] = $this->Publico_m->busca_salas($salas);
		
		$this->load->view('templates/header');
		$this->load->view('publico/salas',$data);
		
	}


	// Mostrar equipamentos
	public function mostra_equipamento()
	{


		$equipamento=$this->input->post('search_sala');
		$data['equipamento']=$this->Publico_m->selecionarEquipamento();
		$data["sala"] = $this->Publico_m->busca_equipamento($equipamento);
	
		$this->load->view('templates/header');
		$this->load->view('publico/equipamento',$data);
		
	}


	  // Validação de login
	  public function validacao_login()
	  { 
		  $this->load->model("Publico_m");
		  $username = $this->input->post("username");
		  $password = $this->input->post("password");

		  $array_user = $this->Publico_m->mostrar_Utilizadores($username);
		  
		  
		//  Se o array chegar vario, ou sej anão encontrou nada, dá erro
		  if(empty($array_user)){
			$this->session->set_flashdata("erro", "User ou senha inválida!");
			redirect(base_url("/home"));
		  }
		  else{
			$passdatabase = $array_user[0]['password'];
			$userdatabase = $array_user[0]['username'];
		  }
	 
		  //  se o user existe
		  if($userdatabase == $username && password_verify($password,$passdatabase)) {
			  $this->session->set_userdata("usuario_logado",$array_user);
		   
			  $this->session->set_flashdata("sucesso", "Login com sucesso!");
			  redirect(base_url("/home"));
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
