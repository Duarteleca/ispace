<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privado_c extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model("Privado_m");
			
			
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}

	//  --------------------------------------Salas----------------------------------------------


	// Mostra todas as salas
	  public function mostra_salas()
	{
		
		$data['salas']=$this->Privado_m->busca_salas();
		$this->load->view('templates/header');
		$this->load->view('publico/Sala_admin',$data);
		$this->load->view('templates/footer');
		
	}


	// Insere salas
	public function inserir_sala()
	{

		// Validações de todos os campos
		$this->form_validation->set_rules('tiposala', 'Tipo de Sala','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('capaciadade', 'Capaciadade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);

		$this->form_validation->set_rules('nomesala', 'Nome da Sala','required',
			array(
				'required'      => 'Não preencheu %s.',
				)
		);

		// Guarda os valores inseridos no registo
		$tiposala = $this->input->post("tiposala");
		$capaciadade = $this->input->post("capaciadade");
		$disponibilidade = $this->input->post("disponibilidade");
		$nomesala = $this->input->post("nomesala");

		
		// Se o form validation nao tiver erros.
		if ($this->form_validation->run() == TRUE) {

		// Configurações da imagem que foi upload
		$config['upload_path']          = './assets/img/salas';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		
		$this->load->library('upload', $config);
		$this->upload->do_upload('postimage');		
	
		$post_image = $_FILES['postimage']['name'];
		
		$endereco ='assets/img/salas/';
		
		$imagem = $endereco.$post_image;
			
			// Busca o id do tipo de sala que foi inserido
			$array_sala = $this->Privado_m->mostrar_Sala($tiposala);
			$id_sala = $array_sala[0]['id'];


			$data = array (
					'capacidade' => $capaciadade,
					'disponibilidade' => $disponibilidade,
					'nome' => $nomesala,
					'sala_id' => $id_sala,
					'imagem' => $imagem
					
			);
			

			$this->Privado_m->inserir_Sala($data);
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_sala', $data);
			$this->load->view('templates/Footer');

			// Mostra os erros
		} 
		else 
		{
			$data['erros'] = array('mensagens' => validation_errors());
			
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_sala', $data);
			$this->load->view('templates/Footer');
		}
			
	}
		
	// Editar Sala
	public function editar_Sala()
		{

			// Validações
			$this->form_validation->set_rules('capacidade', 'Capacidade','required',
			array(
				'required'      => 'Não preencheu %s.')
				
			);
			$this->form_validation->set_rules('nome_sala', 'Nome Sala','required|is_unique[tipologia.nome]',
			array(
				'required'      => 'Não preencheu %s.',
				'is_unique'     => 'Este %s já existe.'
				)
			);

			$this->form_validation->set_rules('disponibilidade', 'Tipo de Sala','required',
			array(
				'required'      => 'Não preencheu %s.',
				'is_unique'     => 'Este %s já existe.'
				)
			);



			// Se o form validation nao tiver erros.
			if ($this->form_validation->run() == TRUE) {
		
				// Configurações da imagem que foi upload
			$config['upload_path']          = './assets/img/salas';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			
			$this->load->library('upload', $config);
			$this->upload->do_upload('postimage');		
		
			$post_image = $_FILES['postimage']['name'];

			// Se ao editar, não inserir uma nova imagem, faz o editar, sem fazer upload, caso contrario faz com imagem

			if($post_image == null)
			{
					// Guarda os valores inseridos no registo
				$id_tiposala= $this->input->post("id_tiposala");
				$capacidade = $this->input->post("capacidade");
				$nome_sala = $this->input->post("nome_sala");
				$disponibilidade = $this->input->post("disponibilidade");
				


				

					$inputs = array(
									'capacidade' => $capacidade,
									'disponibilidade' => $disponibilidade ,
									'nome' => $nome_sala,
								
									);

				$this->Privado_m->atualiza_Sala($inputs,$id_tiposala);
				$this->session->set_flashdata("Sala_sucesso", "Sala editada com sucesso!");
				


				redirect('Sala_admin', 'refresh');
			}
			else
			{


			$endereco ='assets/img/salas/';
			$imagem = $endereco.$post_image;
				

			// Guarda os valores inseridos no registo
			$id_tiposala= $this->input->post("id_tiposala");
			$capacidade = $this->input->post("capacidade");
			$nome_sala = $this->input->post("nome_sala");
			$disponibilidade = $this->input->post("disponibilidade");
			

				$inputs = array(
								'capacidade' => $capacidade,
								'disponibilidade' => $disponibilidade ,
								'nome' => $nome_sala,
								'imagem' => $imagem
								);
								
								

			$this->Privado_m->atualiza_Sala($inputs,$id_tiposala);
			$this->session->set_flashdata("Sala_sucesso", "Sala editada com sucesso!");
			


			redirect('Sala_admin', 'refresh');
							
			}
			
			}
			else
			{

				// Como é uma tabela, tenho de chamar esta funão, para mostrar a tabela
				$data['salas']=$this->Privado_m->busca_salas();
				


				
				$data['erros'] = array('mensagens' => validation_errors());
		
				$this->load->view('templates/Header');
				$this->load->view('publico/Sala_admin', $data);
				$this->load->view('templates/Footer');
				
		
			}
			
		}


	// Eliminar Sala

	public function Apaga_Sala()
	{

		$id_sala = $this->input->post('id_tiposala');
		$this->Privado_m->eliminar_Sala($id_sala);

			// Carrego as views
		$this->load->view('templates/Header');
		// $this->load->view('publico/Home');
		$this->load->view('templates/Footer');
		redirect('Sala_admin', 'refresh');
	}

	

	// ------------------------------------------------Equipamentos------------------------------------

	// Mostrar equipamentos

		public function mostra_equipamento()
		{
			
			$data['equipamentos']=$this->Privado_m->selecionarEquipamento();
			$this->load->view('templates/header');
			$this->load->view('publico/Equipamento_admin',$data);
			$this->load->view('templates/footer');
			
		}

	// Inserir Equipamentos
	public function inserir_equipamento()
	{

		// Validações de todos os campos
		$this->form_validation->set_rules('nome_Equipamento', 'Tipo de Sala','required|is_unique[equipamento.nome]',
		array(
			'required'      => 'Não preencheu %s.',
			'is_unique'     => 'Este %s já existe.'
			)
		);

		$this->form_validation->set_rules('quantidade', 'Quantidade','required',
		array(
			'required' => 'Você tem de preencher campo %s.')
		);

		$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
		array(
			'required' => 'Você tem de preencher campo %s.')
		);


		// Guarda os valores inseridos dos inputs
		$nome_Equipamento = $this->input->post("nome_Equipamento");
		$quantidade = $this->input->post("quantidade");
		$disponibilidade = $this->input->post("disponibilidade");


		
		// Se o form validation nao tiver erros.
		if ($this->form_validation->run() == TRUE) {

		// Configurações da imagem que foi upload
		$config['upload_path']          = './assets/img/equipamento';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 1024;
		$config['max_height']           = 1500;

		
		$this->load->library('upload', $config);
		$this->upload->do_upload('postimage2');		
			
		$post_image = $_FILES['postimage2']['name'];
		
		$endereco ='assets/img/equipamento/';
		
		$imagem = $endereco.$post_image;
			
			


			$data = array (
					'nome' => $nome_Equipamento,
					'quantidade' => $quantidade,
					'disponibilidade' => $disponibilidade,
					'imagem' => $imagem
					
			);
			

			$this->Privado_m->inserir_equipamento($data);
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_equipamento', $data);
			$this->load->view('templates/Footer');

			// Mostra os erros
		} 
		else 
		{
			$data['erros'] = array('mensagens' => validation_errors());
			
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_equipamento', $data);
			$this->load->view('templates/Footer');
		}
			
	}

	// Eliminar Equipamento

	public function Apaga_Equipamento()
	{

		$id_sala = $this->input->post('id_tiposala');
		$this->Privado_m->eliminar_Sala($id_sala);

			// Carrego as views
		$this->load->view('templates/Header');
		// $this->load->view('publico/Home');
		$this->load->view('templates/Footer');
		redirect('Sala_admin', 'refresh');
	}


	// Atualiza perfil do utilizador
	// Irá verificar se fez alterações na pass e foto, faz alteração atraves do e-mail
	public function atualizar_perfil()
	{

		// Valido os campos com o from validation

		// Valida o Nome
		$this->form_validation->set_rules('nome', 'Nome', 'required',
		array(
					'required'      => 'Não preencheu %s.',
			)
		);

		// Valida o Ultimo nome
		// $this->form_validation->set_rules('username', 'Username', 'required|is_unique[utilizador.username]',
		// array(
		// 		   'required'      => 'Não preencheu %s.',
		// 		   'is_unique'     => 'Este %s já existe.'
		//    )
	    // );

		//    // Valida o Email
		//     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[utilizador.email]',
		//     array(
		// 			  'required'      => 'Não preencheu %s.',
		// 			  'is_unique'     => 'Este %s já existe.'
		// 	  )
		//   	);

		// Valida a Password
		// $this->form_validation->set_rules('password', 'Password');

		// // Confirma a Password
		// $this->form_validation->set_rules('confirm', 'Password de Confirmação','matches[password]');

		
		// Guarda os valores inseridos na pagina
		$nome = $this->input->post("nome");
		// $username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		// $confirm = $this->input->post("confirm");


			// Se o form validation nao tiver erros.
			if ($this->form_validation->run() == TRUE) {

				$config['upload_path']          = './assets/img/utilizadores';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 100;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;
		
				
				$this->load->library('upload', $config);
				$this->upload->do_upload('postimage');		
			
				$post_image = $_FILES['postimage']['name'];


			// Verifica  se a pass esta vazia, se estiver, verifica a imagem se está vazia.

			if(empty($password)){
				if($post_image == null)
				{
					
	
					$data = array (
							'nome' => $nome,
							// 'username' => $username,
							// 'email' => $email,
							// 'password' => $password,
							// 'imagem' => $imagem
							
					);
		
					$this->Privado_m->atualiza_utilizador($data,$email);
					$data['error'] = 'Alteração do nome'; 
					$this->load->view('templates/header');
					$this->load->view('privado/perfil',$data);
					$this->load->view('templates/footer');
	
	
 
				}else{
					$endereco ='assets/img/utilizadores/';
					$imagem = $endereco.$post_image;
		
	
					$data = array (
						'nome' => $nome,
						// 'username' => $username,
						// 'email' => $email,
						// 'password' => $password,
						'imagem' => $imagem
						
				);
				$this->Privado_m->atualiza_utilizador($data,$email);
				$data['error'] = 'Alteração do nome e foto'; 
				$this->load->view('templates/header');
				$this->load->view('privado/perfil',$data);
					$this->load->view('templates/footer');
	
	
				}


			}else{

				if($post_image == null)
				{
				$passwords = password_hash($password,PASSWORD_DEFAULT);

				$data = array (
						'nome' => $nome,
						// 'username' => $username,
						// 'email' => $email,
						'password' => $passwords,
						// 'imagem' => $imagem
						
				);
				$this->Privado_m->atualiza_utilizador($data,$email);
				$data['error'] = 'Alteração de nome com pass'; 
				$this->load->view('templates/header');
				$this->load->view('privado/perfil',$data);
					$this->load->view('templates/footer');



			}else{
				$endereco ='assets/img/utilizadores/';
				$imagem = $endereco.$post_image;
				$passwords = password_hash($password,PASSWORD_DEFAULT);

				$data = array (
					'nome' => $nome,
					// 'username' => $username,
					// 'email' => $email,
					'password' => $passwords,
					'imagem' => $imagem
					
			);




			$this->Privado_m->atualiza_utilizador($data,$email);
			$data['error'] = 'Alteração do nome e foto com pass'; 
			$this->load->view('templates/header');
			$this->load->view('privado/perfil',$data);
			$this->load->view('templates/footer');


			}

			}
				
			} else {
				
				$data['erros'] = array('mensagens' => validation_errors());
				
				$this->load->view('templates/Header');
				$this->load->view('privado/perfil',$data);
				$this->load->view('templates/Footer');
				
				

					}
				}
	

	public function users()
	{

		$this->form_validation->set_rules('username', 'Username','required',
			array(
				'required'      => 'Não preencheu %s.')
				
			);

			if ($this->form_validation->run() == TRUE) {

				$tipo = $this->input->post("tipo_user");
				$id_user = $this->input->post('id_user');
				$data = array (
					'tipo' => $tipo
				);
				
				$this->Privado_m->atualiza_tipo($id_user,$data);
				$data['utilizadores']=$this->Privado_m->Selecionar_Utilizadores();
				$data['error']="editado como sucesso";
				$this->load->view('templates/header');
				$this->load->view('privado/users',$data);
				$this->load->view('templates/footer');
			}else{

				$data['utilizadores']=$this->Privado_m->Selecionar_Utilizadores();
				$this->load->view('templates/header');
				$this->load->view('privado/users',$data);
				$this->load->view('templates/footer');
			}		
	}

	public function apaga_utilizador()
	{

		$id_user= $this->input->post('id_user');
		$this->Privado_m->Eliminar_User($id_user);

			// Carrego as views
			$data['error']="eliminado como sucesso";
			$data['utilizadores']=$this->Privado_m->Selecionar_Utilizadores();
			$this->load->view('templates/header');
			$this->load->view('privado/users',$data);
			$this->load->view('templates/footer');
	}


	// Editar Equipamento
	public function editar_Equipamento()
		{

			// Validações
			$this->form_validation->set_rules('nome', 'Nome','required',
			array(
				'required'      => 'Não preencheu %s.')
				
			);
			$this->form_validation->set_rules('quantidade', 'Quantidade','required',
			array(
				'required'      => 'Não preencheu %s.')
				
			);

			$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
			array(
				'required'      => 'Não preencheu %s.')
				
			);



			// Se o form validation nao tiver erros.
			if ($this->form_validation->run() == TRUE) {
		
			// Configurações da imagem que foi upload
			$config['upload_path']          = './assets/img/equipamento';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1024;
			$config['max_height']           = 1500;

			
			$this->load->library('upload', $config);
			$this->upload->do_upload('postimage');		
		
			$post_image = $_FILES['postimage']['name'];

			
			// Se ao editar, não inserir uma nova imagem, faz o editar, sem fazer upload, caso contrario faz com imagem

			if($post_image == null)

			
			{

				// Guarda os valores inseridos no registo
				$nome= $this->input->post("nome");
				$quantidade = $this->input->post("quantidade");
				$disponibilidade = $this->input->post("disponibilidade");
				$id_equipamento = $this->input->post("id_equipamento");
								

				$inputs = array(
								'nome' => $nome,
								'quantidade' => $quantidade ,
								'disponibilidade' => $disponibilidade
								);

				$this->Privado_m->atualiza_Equipamento($inputs,$id_equipamento);
				$this->session->set_flashdata("Sala_sucesso", "Sala editada com sucesso!");
				


				redirect('Equipamento_admin', 'refresh');
			}
			else
			{


			$endereco ='assets/img/equipamento/';
			$imagem = $endereco.$post_image;
			

			// Guarda os valores inseridos no registo
			$nome= $this->input->post("nome");
			$quantidade = $this->input->post("quantidade");
			$disponibilidade = $this->input->post("disponibilidade");
			$id_equipamento = $this->input->post("id_equipamento");
						

					$inputs = array(
						'nome' => $nome,
						'quantidade' => $quantidade ,
						'disponibilidade' => $disponibilidade,
						'imagem' => $imagem
						);
								
								

			$this->Privado_m->atualiza_Equipamento($inputs,$id_equipamento);
			$this->session->set_flashdata("Equipamento_sucesso", "Equipamento editado com sucesso!");
			

			redirect('Equipamento_admin', 'refresh');
							
			}
			
			}
			else
			{

				// Como é uma tabela, tenho de chamar esta função, para mostrar a tabela
				$data['equipamentos']=$this->Privado_m->selecionarEquipamento();
				


				
				$data['erros'] = array('mensagens' => validation_errors());
		
				$this->load->view('templates/Header');
				$this->load->view('publico/Equipamento_admin', $data);
				$this->load->view('templates/Footer');
				
		
			}
			
		}
// -----------------------------Requisição---------------------------------

		// Mostra requisição
		public function fazer_requisicao()
		{
			$data['equipamentos']=$this->Privado_m->selecionarEquipamento();
			// $data['salas']=$this->Privado_m->busca_salas();
			$this->load->view('templates/header');
			$this->load->view('publico/Fazer_requisicao');
			$this->load->view('templates/footer');
			
		}

		// Fazer requisição

		public function requisitar_Sala()
		{
			
			// Guarda os valores inseridos 
			$id_user = $this->input->post("id_user");
			$id_sala= $this->input->post("id_sala");
			$data_inicio = $this->input->post("data_inicio");
			$data_fim = $this->input->post("data_fim");
			$hora_inicio = $this->input->post("hora_inicio");
			$hora_fim = $this->input->post("hora_fim");
		

			$data = array(
				'data_inicio' => $data_inicio,
				'data_fim' => $data_fim ,
				'hora_inicio' => $hora_inicio,
				'hora_fim' => $hora_fim,
				'utilizador_id' => $id_user,
				'tipologia_id' => $id_sala
				);
						
						

			$this->Privado_m->faz_Requisicao($data);
			$this->session->set_flashdata("Equipamento_sucesso", "Equipamento editado com sucesso!");
	

			redirect('Salas', 'refresh');
			

			$this->load->view('templates/header');
			$this->load->view('publico/Salas');
			$this->load->view('templates/footer');
			
		}


		// Mostrar Salas requisitadas pelo utilizador
		public function mostra_salas_requisicao()
		{
			$user_id_salas = $this->session->userdata("usuario_logado")[0]['id'];
			$data['salas_requisitas']=$this->Privado_m->selecionar_salas_requisitadas($user_id_salas);
			
			// // Tenho de colocar a consulta de equipamentos para mostra na list drop dentro do modal
			 $data['equipamentos']=$this->Privado_m->selecionarEquipamento();
			
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicao',$data);
			$this->load->view('templates/Footer');
			
		}


		// Mostrar equipamentos
	public function mostra_equipamento_requisitar()
	
	{

		$id = $this->uri->segment(2);
            
		if (empty($id))
		{
			show_404();
		}
		


		$data['equipamento']=$this->Privado_m->selecionarEquipamento();
		// $data["sala"] = $this->Privado_m->busca_equipamento($equipamento);
	
		$this->load->view('templates/header');
		$this->load->view('publico/Equipamento_requisito',$data);
		$this->load->view('templates/Footer');
		
	}



	// Adiciona equipamentos à requesição
	public function adicionar_Equipamento_Requisito()

	{
		$nome_Equipamento = $this->input->post("procuraEquipamento");
		$quantidade_Equipamento = $this->input->post("quantidade");
		
		// Ir à base de dados busca a quantidade do equipamento inserido
		

		$array_Equipamento = $this->Privado_m->busca_Equipamento($nome_Equipamento);
		var_dump($array_Equipamento );
		$quantidade_Atual = $array_Equipamento[0]['quantidade'];
		$id_Equipamento = $array_Equipamento[0]['id'];

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade



		if($quantidade_Equipamento<= $quantidade_Atual){
				$quantidade_Final = $quantidade_Atual - $quantidade_Equipamento;

				$data = array(
				'id' => $id_Equipamento,
				'quantidade' => $quantidade_Final
				);
			
				// faz update na quantidade do equipamento requisitado.
				$this->Privado_m->update_Equipamento($data,$id_Equipamento);


				// Faz update na tabela requisicao_has_requipamento
				$id_requisicao = $this->input->post("id_requisicao");

				$informacao = array(
					'equipamento_id' => $id_Equipamento,
					'requisicao_id' => $id_requisicao,
					'quantidade' => $quantidade_Equipamento
					);

		

				

				$this->Privado_m->requisicao_has_equipamento($informacao);

				
			

		}else{
			$this->session->set_flashdata("erro_quantidade", "Não existe tanta quantidade");

		}

		// redirect('Requisicao', 'refresh');

	}

	// Elimina requisição

	public function apaga_Requisicao()
	{

		$id_requisição = $this->input->post('id_requisicao');
		$this->Privado_m->elimina_requisicao($id_requisição);

		// Carrego as views
		$this->load->view('templates/Header');
		// $this->load->view('publico/Home');
		$this->load->view('templates/Footer');
		redirect('Sala_admin', 'refresh');
	}

	// Editar requisição

	public function edita_Requisicoa()
	{
		// Post dos valores
		$id_requisicao = $this->input->post('id_requisicao');
		$data_inicio = $this->input->post('data_inicio');
		$data_fim = $this->input->post('data_fim');
		$hora_inicio = $this->input->post('hora_inicio');
		$hora_fim = $this->input->post('hora_fim');

		// Fazer validações
		$data = array(
			'data_inicio' => $data_inicio,
			'data_fim' => $data_fim,
			'hora_inicio' => $hora_inicio,
			'hora_fim' => $hora_fim
		);



		$this->Privado_m->edita_Requisicao($id_requisicao,$data);


	}

	// Mostrar todas as requisições para o admin


	public function mostra_Requisicoes_Equipamentos_admin()
	{

			$data['salas_requisitass']=$this->Privado_m->mostrar_Requisicoes_Equipamentos();
			
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_equipamentos_admin',$data);
			$this->load->view('templates/Footer');

	}

	// Mostrar os equipamentos requisitados pelo user 
	public function mostra_Requisicoes_Equipamentos_user()
	{
			$user_id = $this->session->userdata("usuario_logado")[0]['id'];
			
			$data['salas_requisitass']=$this->Privado_m->mostrar_Requisicoes_Equipamentos_user($user_id);
			
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_equipamentos_user',$data);
			$this->load->view('templates/Footer');

	}

	// Pesquisa salas requisitadas
	public function mostra_Requisicoes_Salas_admin()
	{

			$data['salas_requisitass']=$this->Privado_m->mostra_Salas_Requesitadas_admin();
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_salas_admin',$data);
			$this->load->view('templates/Footer');

	}
	
	
	// O admin apaga requisição
	public function apaga_Requisicao_admin()
	{

		$id_requisição = $this->input->post('id_requisicao');
		$this->Privado_m->elimina_requisicao($id_requisição);


		// Quando uma requisicao é cancelada, pega na quantidade dos equipamentos
		// que foram requisitados e volta a adicionar na tabela equipamentos.
		$quantidade_Equipamento = $this->input->post();


		// Carrego as views
		// $this->load->view('templates/Header');
		// // $this->load->view('publico/Requisicoes_salas_admin');
		// $this->load->view('templates/Footer');
		redirect('Requisicoes_salas_admin', 'refresh');
	}



	// Cancela equipamentos das requisições
	public function cancelar_equipamento_requisicao_admin()
	{
		
		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		$this->Privado_m->cancelar_equipamento_requisicao_admin_m($id_requisição,$id_equipamento);
			
		
			$this->load->view('templates/header');
			// $this->load->view('publico/Requisicoes_equipamentos_admin',$data);
			$this->load->view('templates/Footer');

			// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
			redirect('Requisicoes_equipamentos_admin', 'refresh');
		
		
	}


	// Cancela o equipamento requesitado e faz update à quantidade dos equipamentos
	public function cancelar_equipamento_requisicao_user()
	{
		
		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		$id_requisicao_equipamento = $this->input->post('id_requisicao_equipamento');
		
	



		// Vai à base de dados buscar a quantidade atual dos equipamentos
		$array_Equipamento_requesito = $this->Privado_m->busca_quantidade_equipamento($id_equipamento);

		$quantidade = $array_Equipamento_requesito[0]['quantidade'];
		$id_equipamento_bd = $array_Equipamento_requesito[0]['id'];


		// post da quantidade que foi requisitada para depois somar e voltar a fazer update
		$quantidade_requisitada = $this->input->post('quantidade');	
		
		// Soma a quantidade atual dos equipamentos à quantidade que foi requisitada
		$quantidade_final = $quantidade + $quantidade_requisitada; 
		

		$data = array(
					
					'quantidade' => $quantidade_final
					);

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade
		$this->Privado_m->atualiza_Equipamento_depois_cancelar($data,$id_equipamento_bd);


		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		$this->Privado_m->cancelar_equipamento_requisicao_user_m($id_requisicao_equipamento);
			
			$this->load->view('templates/header');
			// $this->load->view('publico/Requisicoes_equipamentos_admin',$data);
			$this->load->view('templates/Footer');

			// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
			redirect('Requisicoes_equipamentos_user', 'refresh');
		
		
	}
	

	

}
