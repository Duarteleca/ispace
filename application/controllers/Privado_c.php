<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privado_c extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model("Privado_m");
			
			
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}

//  --------------------------------------Salas----------------------------------------------

	// Mostra todas as salas
	  public function mostra_salas(){
		// Array com todas as salas
		$data['salas'] = $this->Privado_m->busca_salas();
		
		// Carregamento das views
		$this->load->view('templates/header');
		$this->load->view('publico/Sala_admin',$data);
		$this->load->view('templates/footer');
		
	}

	// Insere salas
	public function inserir_sala(){
		// Array com todas as salas (preciso disto, pois quando inserir , ao recarregar a pagina, preciso das informações das salas)
		$data['salas'] = $this->Privado_m->selecionarSala();

		// Validações de todos os campos
		$this->form_validation->set_rules('tiposala', 'Tipo de Sala','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('capacidade', 'Capacidade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);

		$this->form_validation->set_rules('nomesala', 'Nome da Sala','required',
			array(
				'required' => 'Não preencheu %s.',
				)
		);

		// Guarda os valores inseridos no registo
		$tiposala = $this->input->post("tiposala");
		$capacidade = $this->input->post("capacidade");
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

		// Se não for inserida uma imagem, adiciona uma predifinida que está na pasta
		if($post_image == null){

			$post_image = 'semimagem1.jpg';

		}else{
			$post_image = $_FILES['postimage2']['name'];

		}
		
		// Endereço predefinido pois é o caminho onde está guardado as imagens.
		$endereco ='assets/img/salas/';
		
		// Concatena o endereço com a imagem
		$imagem = $endereco.$post_image;
			
			// Busca o id do tipo de sala que foi inserido
			$array_sala = $this->Privado_m->mostrar_Sala($tiposala);
			
			$id_sala = $array_sala[0]['id'];


			// Data referente ao dados da sala que for inserida
			$data = array (
					'capacidade' => $capacidade,
					'disponibilidade' => $disponibilidade,
					'nome' => $nomesala,
					'sala_id' => $id_sala,
					'imagem' => $imagem
					
			);
			
			// Passa dos dados por parametro e insere
			$this->Privado_m->inserir_Sala($data);

			// Mensagem de sucesso
			$this->session->set_flashdata("inseriu_sala_sucesso", "Sala inserida com sucesso!");

			// Refresh à página
			// redirect('Sala_admin', 'refresh');
			redirect(base_url("/Sala_admin"));

			// Mostra os erros
		}else{ 
		
			$data['erros'] = array('mensagens' => validation_errors());
			
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_sala', $data);
			$this->load->view('templates/Footer');
		}
			
	}
		
	// Editar Sala
	public function editar_Sala(){

			// Validações com o forma validation
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
				// Guarda os valores inseridos no registo através do post
				$id_tiposala = $this->input->post("id_tiposala");
				$capacidade = $this->input->post("capacidade");
				$nome_sala = $this->input->post("nome_sala");
				$disponibilidade = $this->input->post("disponibilidade");
				
					// array referente aos dados alterados da sala
					$inputs = array(
									'capacidade' => $capacidade,
									'disponibilidade' => $disponibilidade ,
									'nome' => $nome_sala,
								
									);

				$this->Privado_m->atualiza_Sala($inputs,$id_tiposala);
				$this->session->set_flashdata("Sala_sucesso", "Sala editada com sucesso!");
				
				// Refresh da página
				// redirect('Sala_admin', 'refresh');
				redirect(base_url("/Sala_admin"));

			}else{

			$endereco = 'assets/img/salas/';
			$imagem = $endereco.$post_image;
				
			// Guarda os valores inseridos no registo
			$id_tiposala = $this->input->post("id_tiposala");
			$capacidade = $this->input->post("capacidade");
			$nome_sala = $this->input->post("nome_sala");
			$disponibilidade = $this->input->post("disponibilidade");
			
				// Dados referentes à sala editada
				$inputs = array(
								'capacidade' => $capacidade,
								'disponibilidade' => $disponibilidade ,
								'nome' => $nome_sala,
								'imagem' => $imagem
								);
									
			// Passa os valores como parametro e atualiza a sala
			$this->Privado_m->atualiza_Sala($inputs,$id_tiposala);
			// Mensagem de sucesso
			$this->session->set_flashdata("Sala_sucesso", "Sala editada com sucesso!");
			
			// Refresh à página
			// redirect('Sala_admin', 'refresh');
			redirect(base_url("/Sala_admin"));
							
			}
			
			}else{
			
				// Como é uma tabela, tenho de chamar esta funão, para mostrar a tabela
				$data['salas'] = $this->Privado_m->busca_salas();

				// Array com os erros
				$data['erros'] = array('mensagens' => validation_errors());
		
				// Carregamento das views
				$this->load->view('templates/Header');
				$this->load->view('publico/Sala_admin', $data);
				$this->load->view('templates/Footer');
				
			}
			
		}

	// Eliminar Sala
	public function Apaga_Sala(){

		// Faz o post do id da sala
		$id_sala = $this->input->post('id_tiposala');
		$this->Privado_m->eliminar_Sala($id_sala);

		// Mensagem de sucesso
		$this->session->set_flashdata("sala_eliminada_sucesso", "Sala eliminada com sucesso!");

		redirect(base_url("/Sala_admin"));
		// redirect('Sala_admin', 'refresh');

		
	}


	// Função para mostrar dinamicamente a quantidade disponivel depois de selecionar cada equipamento
	public function Ajax(){


		$equipamento = $this->input->post('equipamento');
		// echo $equipamento;

		// Como recebo uma row array, para selecionar diretamento o id que tenho , basta
		// fazer ['quantidade'], caso fosse com array de arrays, tinha de fazer o encode, 
		// descomentar o dataType: "json" no scprit para ele fazer isso automatico e fazer um ciclo for.
		$array = $this->Privado_m->mostra_equipamento($equipamento);
		$quantidade = $array['quantidade'];

		// Para apresentar os valores em ajax, tem de ser com echos'.
		echo $quantidade;
	}

// ------------------------------------------------Equipamentos------------------------------------

	// Mostrar equipamentos

		public function mostra_equipamento(){
			// Array dos equipamentos para depois listar
			$data['equipamentos'] = $this->Privado_m->selecionarEquipamento();
			// Load das views
			$this->load->view('templates/header');
			$this->load->view('publico/Equipamento_admin',$data);
			$this->load->view('templates/footer');
			
		}

	// Inserir Equipamentos
	public function inserir_equipamento(){

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
		
		// Se não for introduziduo uma imagem , insere uma predefinida
		if($post_image == null){

			$post_image = 'semimagem1.jpg';

		}else{
			$post_image = $_FILES['postimage2']['name'];

		}

		// Coloco o caminho onde voi estar guardado as imagens
		$endereco ='assets/img/equipamento/';
		
		// Concateno o edereço com a imagem para depois guardar na base de dados
		$imagem = $endereco.$post_image;
			
			

			// Guarda no array os valores do equipamento
			$data = array (
					'nome' => $nome_Equipamento,
					'quantidade' => $quantidade,
					'disponibilidade' => $disponibilidade,
					'imagem' => $imagem
					
			);
			
			// Passa dos valores como parâmetro e insere
			$this->Privado_m->inserir_equipamento($data);

			$this->session->set_flashdata("equipamento_inserido_sucesso", "Equipamento inserido com sucesso");

			redirect(base_url("/Equipamento_admin"));

			// Mostra os erros
		}else{
		 
			// Array com os erros
			$data['erros'] = array('mensagens' => validation_errors());
			
			$this->load->view('templates/Header');
			$this->load->view('publico/Inserir_equipamento', $data);
			$this->load->view('templates/Footer');
		}
			
	}

	// Eliminar Equipamento
	public function Apaga_Equipamento(){

		// Faz o post do do id tipo sala para depois eliminar
		$id_tiposala = $this->input->post('id_tiposala');
		// Passa como parâmetro do id para depois eliminar
		$this->Privado_m->eliminar_Sala($id_tiposala);
		
		// Mensagem de sucesso
		$this->session->set_flashdata("equipamento_eliminado_sucesso", "Equipamento eliminado com sucesso!");
		// Refresh da página

		redirect(base_url("/Equipamento_admin"));
	}


	// Atualiza perfil do utilizador
	// Irá verificar se fez alterações na pass e foto, faz alteração atraves do e-mail
	public function atualizar_perfil()
	{

		// Valida o Nome
		$this->form_validation->set_rules('nome', 'Nome', 'required',
		array(
					'required'      => 'Não preencheu %s.',
			)
		);
		$this->form_validation->set_rules('confirm_altera', 'Confirmar atual Password', 'required',
		array(
					'required'      => 'Não preencheu %s.',
			)
		);
		
		// Guarda os valores inseridos na pagina
		$nome = $this->input->post("nome");
		// $username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$confirm_altera = $this->input->post("confirm_altera");

		$user_pass = $this->session->userdata("usuario_logado")[0]['password'];
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
			if(password_verify($confirm_altera,$user_pass)){

				if(empty($password)){

				// Se não inserir imagem
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
					$data['error'] = 'Nome alterado com sucesso'; 
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
		}else{
			$data['error'] = 'pass de confirmação errada'; 
			$this->load->view('templates/header');
			$this->load->view('privado/perfil',$data);
			$this->load->view('templates/footer');


		}
				
			} else {
				
				$data['erros'] = array('mensagens' => validation_errors());
				
				$this->load->view('templates/Header');
				$this->load->view('privado/perfil',$data);
				$this->load->view('templates/Footer');

					}
		}
	
	// Lista todos os users
	public function users(){
			// dentro da listagem o admin pode adicionar um user

			// Form validation
			$this->form_validation->set_rules('username', 'Username','required',
				array(
					'required'      => 'Não preencheu %s.')
					
				);

				// Se nao der erro
				if ($this->form_validation->run() == TRUE) {

					$tipo = $this->input->post("tipo_user");
					$id_user = $this->input->post('id_user');

					// Leva o tipo de utilizador (user, admin,admin temporario)
					$data = array (
						'tipo' => $tipo
					);
					
					// atualizad o tipo de utilizador
					$this->Privado_m->atualiza_tipo($id_user,$data);
					// array com os utilizadores
					$data['utilizadores'] = $this->Privado_m->Selecionar_Utilizadores();
					// Array com mensagens
					$data['error'] = "editado como sucesso";

					// Carrega as views
					$this->load->view('templates/header');
					$this->load->view('privado/users',$data);
					$this->load->view('templates/footer');

				}else{
					// Array com os dados dos utilizadores
					$data['utilizadores'] = $this->Privado_m->Selecionar_Utilizadores();
					$this->load->view('templates/header');
					$this->load->view('privado/users',$data);
					$this->load->view('templates/footer');
				}		
		}

	// Apaga utilizador
	public function apaga_utilizador(){
			// Post do id do user para depois eliminar
			$id_user = $this->input->post('id_user');
			// Elimina o user selecionado
			$this->Privado_m->Eliminar_User($id_user);

				// Array de mensagens
				$data['error'] = "eliminado como sucesso";
				// Array com os dados dos utilizadores
				$data['utilizadores'] = $this->Privado_m->Selecionar_Utilizadores();
				// Carregamento das views
				$this->load->view('templates/header');
				$this->load->view('privado/users',$data);
				$this->load->view('templates/footer');
		}


	// Editar Equipamento
	public function editar_Equipamento(){

			// Validações dos campos com o form validation
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

			
			// Se ao editar, não inserir uma nova imagem, faz o editar, sem fazer upload, caso contrario faz com imagem predifinida

			if($post_image == null){
		
				// Guarda os valores inseridos no registo
				$nome = $this->input->post("nome");
				$quantidade = $this->input->post("quantidade");
				$disponibilidade = $this->input->post("disponibilidade");
				$id_equipamento = $this->input->post("id_equipamento");
								
				// Inputs com a informação do equipamento que foi editado
				$inputs = array(
								'nome' => $nome,
								'quantidade' => $quantidade ,
								'disponibilidade' => $disponibilidade
								);

				// Atualiza o equipamento selecionado
				$this->Privado_m->atualiza_Equipamento($inputs,$id_equipamento);
				// Mensagem de sucesso
				$this->session->set_flashdata("Equipamento_sucesso", "Equipamento editado com sucesso!");
				
				redirect(base_url("/Equipamento_admin"));

			}else{

			$endereco = 'assets/img/equipamento/';
			$imagem = $endereco.$post_image;
			

			// Guarda os valores inseridos no registo
			$nome = $this->input->post("nome");
			$quantidade = $this->input->post("quantidade");
			$disponibilidade = $this->input->post("disponibilidade");
			$id_equipamento = $this->input->post("id_equipamento");
						
					// Guarda os valores inseridos para depois editar
					$inputs = array(
						'nome' => $nome,
						'quantidade' => $quantidade ,
						'disponibilidade' => $disponibilidade,
						'imagem' => $imagem
						);
									
			// Atualiza o equipamento atras do id, e com os dados acima
			$this->Privado_m->atualiza_Equipamento($inputs,$id_equipamento);
			// Mensagem de sucesso
			$this->session->set_flashdata("Equipamento_sucesso", "Equipamento editado com sucesso!");
			
			// Refresh à página
			redirect(base_url("/Equipamento_admin"));
							
			}
			
			}else{

				// Como é uma tabela, tenho de chamar esta função, para mostrar a tabela
				
				// Array referente aos equipamentos
				$data['equipamentos'] = $this->Privado_m->selecionarEquipamento();
				// Array referente às mesnagens do form validation.
				$data['erros'] = array('mensagens' => validation_errors());
		
				$this->load->view('templates/Header');
				$this->load->view('publico/Equipamento_admin', $data);
				$this->load->view('templates/Footer');
				
		
			}
			
		}
// -----------------------------Requisição---------------------------------

		// Mostra requisição
		public function fazer_requisicao(){
			// Guarda no array todas as informações das requisições
			$data['equipamentos'] = $this->Privado_m->selecionarEquipamento();

			// Carrega as views
			$this->load->view('templates/header');
			$this->load->view('publico/Fazer_requisicao');
			$this->load->view('templates/footer');
			
		}



		// Fazer requisição de sala
		public function requisitar_Sala()
		{
			
			// Guarda os valores inseridos 
			$id_user = $this->input->post("id_user");
			$id_sala = $this->input->post("id_sala");
			$data_inicio = $this->input->post("data_inicio");
			$data_fim = $this->input->post("data_fim");
			$hora_inicio = $this->input->post("hora_inicio");
			$hora_fim = $this->input->post("hora_fim");
			// Não pode inserir uma fora inicio maior que a hora final
			if(($hora_inicio > $hora_fim) ||  ($data_inicio > $data_fim)) {

				$this->session->set_flashdata("erro_hora_requisicao", "Hora/data de inicio não pode ser maior que a final");

			}else{
			
			// Verifica se existe datas e horas iguais ou interalos.
			$dados_Disponibilidade = $this->Privado_m->verifica_requisicao_disponibilidade($data_inicio,$data_fim,$hora_inicio,$hora_fim,$id_sala);
			
			// Se não retornar nada, quer dizer que está disponivel ao x dia e x hora, se não, quer dizer que encontrou 
			// requisições a tal dia e hora, que não estara disponivel para requisição, ou seja, erro.
			if($dados_Disponibilidade == null ){
				
				// Data referente à informação requirida durante a requisição de uma sala
				$data = array(
					'data_inicio' => $data_inicio,
					'data_fim' => $data_fim ,
					'hora_inicio' => $hora_inicio,
					'hora_fim' => $hora_fim,
					'utilizador_id' => $id_user,
					'tipologia_id' => $id_sala
					);
							
							
	
				$this->Privado_m->faz_Requisicao($data);
				$this->session->set_flashdata("requisicao_sucesso", "Requisição feita com sucesso!");

			}else{

				$this->session->set_flashdata("erro_requisicao", "Já existe uma requisicao para esse dia/hora");
			}

			}
			
			redirect(base_url("/Salas"));
			
		}




		// Editar requisição user
	public function edita_Requisicao(){

		// Post dos valores
		$id_requisicao = $this->input->post('id_requisicao');
		var_dump($id_requisicao);
		$data_inicio = $this->input->post('data_inicio');
		$data_fim = $this->input->post('data_fim');
		$hora_inicio = $this->input->post('hora_inicio');
		$hora_fim = $this->input->post('hora_fim');
		$id_Requisicao = $this->input->post('id_requisicao');
		$id_sala = $this->input->post("id_tipologia");

		// Não pode inserir uma fora inicio maior que a hora final
		if(($hora_inicio > $hora_fim) ||  ($data_inicio > $data_fim)) {

			$this->session->set_flashdata("erro_hora_requisicao", "Hora/data de inicio não pode ser maior que a final");

		}else{
		
		// Verifica se existe datas e horas iguais ou interalos.
		$dados_Disponibilidade = $this->Privado_m->verifica_requisicao_disponibilidade($data_inicio,$data_fim,$hora_inicio,$hora_fim,$id_sala);
		// var_dump($dados_Disponibilidade);
		

		if($dados_Disponibilidade != null){

		$id_user1 = $dados_Disponibilidade[0]['utilizador_id'];
		// var_dump($id_user1);
		$id_user2 = $this->session->userdata("usuario_logado")[0]['id'];
		// var_dump($id_user2);
		$id_req = $dados_Disponibilidade[0]['id'];
		// var_dump($id_req);
	

				if(($dados_Disponibilidade != null) || ($id_req != $id_requisicao)){
					// echo 'Não dá otário-';
					$this->session->set_flashdata("erro_requisicao", "Já existe uma requisicao para esse dia/hora");
					redirect(base_url("/Requisicao"));	
					
				}


		// Se não retornar nada, quer dizer que está disponivel ao x dia e x hora, se não, quer dizer que encontrou 
		// requisições a tal dia e hora, que não estara disponivel para requisição, ou seja, erro.
		}if(($dados_Disponibilidade == null)  || ($id_user1 == $id_user2)) {
			
			// Busca o id do user
			$id_user = $this->session->userdata("usuario_logado")[0]['id'];
			// var_dump($id_user);
			// Data referente à informação requirida durante a requisição de uma sala
			$data = array(
				'data_inicio' => $data_inicio,
				'data_fim' => $data_fim ,
				'hora_inicio' => $hora_inicio,
				'hora_fim' => $hora_fim,
				'utilizador_id' => $id_user,
				'tipologia_id' => $id_sala
				);
						
				// var_dump($data);			
			$this->Privado_m->atualiza_Requisicao($id_Requisicao,$data);
			$this->session->set_flashdata("requisicao_editada_sucesso", "Requisição editada com sucesso!");

		}else{

			$this->session->set_flashdata("erro_requisicao", "Já existe uma requisicao para esse dia/hora");
		}

		}
		// Refresh da página
		redirect(base_url("/Requisicao"));
		
	}


		// Editar requisição admin
		public function edita_Requisicao_admin(){
	
			
			// Post dos valores
			$id_requisicao = $this->input->post('id_requisicao');
			$data_inicio = $this->input->post('data_inicio');
			$data_fim = $this->input->post('data_fim');
			$hora_inicio = $this->input->post('hora_inicio');
			$hora_fim = $this->input->post('hora_fim');
			$id_sala = $this->input->post('id_tipologia');
			$id_user = $this->input->post('id_user');
			
			// Não pode inserir uma fora inicio maior que a hora final
			if(($hora_inicio > $hora_fim) ||  ($data_inicio > $data_fim)) {
				// echo 'erro';
				$this->session->set_flashdata("erro_hora_requisicao", "Hora/data de inicio não pode ser maior que a final");
	
			}else{
			
			// Verifica se existe datas e horas iguais ou interalos.
			$dados_Disponibilidade = $this->Privado_m->verifica_requisicao_disponibilidade($data_inicio,$data_fim,$hora_inicio,$hora_fim,$id_sala);
			// var_dump($dados_Disponibilidade);
			$id_user1 = $dados_Disponibilidade[0]['utilizador_id'];
			// Se não retornar nada, quer dizer que está disponivel ao x dia e x hora, se não, quer dizer que encontrou 
			// requisições a tal dia e hora, que não estara disponivel para requisição, ou seja, erro.
			if(($dados_Disponibilidade == null ) ||  ($id_user1 == $id_user)) {
				
				// Busca o id do user
				// $id_user = $this->session->userdata("usuario_logado")[0]['id'];
				// Data referente à informação requirida durante a requisição de uma sala
				$data = array(
					'data_inicio' => $data_inicio,
					'data_fim' => $data_fim ,
					'hora_inicio' => $hora_inicio,
					'hora_fim' => $hora_fim
					);
							
							
	
				$this->Privado_m->atualiza_Requisicao($id_requisicao,$data);
				$this->session->set_flashdata("requisicao_editada_sucesso", "Requisição editada com sucesso!");
				
	
			}else{
				
	
				$this->session->set_flashdata("erro_requisicao", "Já existe uma requisicao para esse dia/hora");
			}
			
			}
			// Refresh da página
			// redirect('Requisicoes_salas_admin', 'refresh');
			redirect(base_url("/Requisicao"));
			
		}



	// Mostrar Salas requisitadas pelo user
	public function mostra_salas_requisicao(){
		// Busca o id do user
		$user_id_salas = $this->session->userdata("usuario_logado")[0]['id'];
		
		// Array com as salas requisitadas pelo user
		$data['salas_requisitas'] = $this->Privado_m->selecionar_salas_requisitadas($user_id_salas);

		// Tenho de colocar a consulta de equipamentos para mostra na list drop dentro do modal
			$data['equipamentos'] = $this->Privado_m->selecionarEquipamento();
		
		$this->load->view('templates/header');
		$this->load->view('publico/Requisicao',$data);
		$this->load->view('templates/Footer');
		
	}


	// Mostrar equipamentos
	public function mostra_equipamento_requisitar(){

		$id = $this->uri->segment(2);
            
		if (empty($id))
		{
			show_404();
		}
		
		// Array com a todos os equipamentos
		$data['equipamento'] = $this->Privado_m->selecionarEquipamento();
	
		$this->load->view('templates/header');
		$this->load->view('publico/Equipamento_requisito',$data);
		$this->load->view('templates/Footer');
		
	}



	// Adiciona equipamentos à requesição
	public function adicionar_Equipamento_Requisito(){
		

		// Valida a quantidade, não pode ser negativa

		$this->form_validation->set_rules('quantidade', 'Quantidade', 'integer');
		array('integer' => 'O campo quantidade tem de ser inteiro.'
			);

		
		$id_Equipamento = $this->input->post("procuraEquipamento");
		$quantidade_Equipamento = $this->input->post("quantidade");

		if ($quantidade_Equipamento <= 0) {
			$this->session->set_flashdata("erro_quantidade_requisicao_equipamento", "Não pode escolher uma quantidade inválida");

			redirect(base_url("/Requisicao"));

		}

		if (($id_Equipamento == null) || ($quantidade_Equipamento == null)) {


			$this->session->set_flashdata("erro_requisicao_equipamento", "Tem de escolher um equipamento e quantidade");

			redirect(base_url("/Requisicao"));


		}

		
		// Ir à base de dados busca a quantidade do equipamento inserido

		$array_Equipamento = $this->Privado_m->busca_Equipamento($id_Equipamento);
		$quantidade_Atual = $array_Equipamento[0]['quantidade'];
		$id_Equipamento = $array_Equipamento[0]['id'];

		
		// var_dump($array_Equipamento);

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade

		if ($quantidade_Equipamento<= $quantidade_Atual) {
				$quantidade_Final = $quantidade_Atual - $quantidade_Equipamento;

				// Data referente ao equipamento
				$data = array(
				'id' => $id_Equipamento,
				'quantidade' => $quantidade_Final
				);
			
				// faz update na quantidade do equipamento requisitado.
				$this->Privado_m->update_Equipamento($data,$id_Equipamento);


				// Faz update na tabela requisicao_has_requipamento
				$id_requisicao = $this->input->post("id_requisicao");

				// Busca o id do user que está logado.
				$user_id = $this->session->userdata("usuario_logado")[0]['id'];

				// Informação referente ao equipamento e requisição
				$informacao = array(
					'equipamento_id' => $id_Equipamento,
					'requisicao_id' => $id_requisicao,
					'quantidade' => $quantidade_Equipamento
					);

				$this->Privado_m->requisicao_has_equipamento($informacao);
				$this->session->set_flashdata("equipamento_adicionado_sucesso", "Equipamento adicionado com sucesso");

		} else {
			$this->session->set_flashdata("erro_quantidade", "Não existe tanta quantidade");

		}

		redirect(base_url("/Requisicao"));

	}

	
	public function apaga_Requisicao()
	{
		// Se a requisição tiver equipamento reservado, guardo a quantidade do equipamento e o id do mesmo
		$id_requisição = $this->input->post('id_requisicao');
		// var_dump($id_requisição);

		// Pesquisa se existe na requiscao_has_equipamentos um equpipamento/equipamentos com esse id
		$informaçao = $this->Privado_m->mostrar_Requisicoes_Equipamentos_Apagar_Requisicao($id_requisição);
		// var_dump($informaçao);

		for ($i = 0; $i < count($informaçao); $i++) {
			

			//funçao para fazer update de quantidade
			$id_equip = $informaçao[$i]['equipamento_id'];
			// var_dump($id_equip); // 2 e 3
			$nome_Equipamento = $informaçao[$i]['equipnome'];
			// var_dump($nome_Equipamento);
			$quantidade_passado = $informaçao[$i]['quantidade'];
			// var_dump($quantidade_passado);
			
			$quantidade_equipamento_origem = $this->Privado_m->busca_Equipamentos($nome_Equipamento);
			// var_dump($quantidade_equipamento_origem);
			
			for ($c = 0; $c < count($quantidade_equipamento_origem); $c++) {
				
				$quantidade_restante_origem = $quantidade_equipamento_origem[$c]['quantidade'];
				$id_quantidade_restante_origem = $quantidade_equipamento_origem[$c]['id'];
	
			
			$quantidade_fazer_update = $quantidade_restante_origem + $quantidade_passado;
			$id_Equipamento = $id_quantidade_restante_origem;
			// var_dump($quantidade_fazer_update);
			// var_dump($id_Equipamento);
			$data = array(
				'quantidade' => $quantidade_fazer_update,
			);
			$this->Privado_m->update_Equipamento($data,$id_Equipamento);
		}
		
		}
		$this->Privado_m->elimina_requisicao($id_requisição);
		$this->session->set_flashdata("elimina_requisicao", "Requisição eliminada com sucesso");
		// Refresh à página
		redirect(base_url("/Requisicao"));
		
}


	

	// Mostrar todas as requisições para o admin
	public function mostra_Requisicoes_Equipamentos_admin(){
		$slug = $this->input->post('pesquisar');

		// Trás no array todos os dados das das requisições juntamente com os equipamentos
		$data['salas_requisitass'] = $this->Privado_m->mostrar_Requisicoes_Equipamentos($slug);
			
		$this->load->view('templates/header');
		$this->load->view('publico/Requisicoes_equipamentos_admin',$data);
		$this->load->view('templates/Footer');

	}

	// Mostrar os equipamentos requisitados pelo user 
	public function mostra_Requisicoes_Equipamentos_user(){
			$slug = $this->input->post('pesquisar');
			
			// Trás no array todos os equipamentos requisitados pelo user (id)
			$data['salas_requisitass'] = $this->Privado_m->mostrar_Requisicoes_Equipamentos_user($slug);
			// var_dump($data['salas_requisitass']);
			// var_dump($user_id);
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_equipamentos_user',$data);
			$this->load->view('templates/Footer');

	}

	// Mostrar os equipamentos requisitados pelo user 
	public function mostra_Requisicoes_Equipamentos_user2(){
			$slug = $this->input->post('pesquisar');
			$user_id = $this->session->userdata("usuario_logado")[0]['id'];
			
			// Trás no array todos os equipamentos requisitados pelo user (id)
			$data['salas_requisitass'] = $this->Privado_m->mostrar_Requisicoes_Equipamentos_user2($user_id,$slug);
			// var_dump($data['salas_requisitass']);
			// var_dump($user_id);
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_equipamentos_user',$data);
			$this->load->view('templates/Footer');

	}

	// Pesquisa salas requisitadas admin
	public function mostra_Requisicoes_Salas_admin()
	{
			$slug = $this->input->post('pesquisar');
			$data['salas_requisitas_admin'] = $this->Privado_m->mostra_Salas_Requesitadas_admin($slug);
			// var_dump($data['salas_requisitass']);
			$this->load->view('templates/header');
			$this->load->view('publico/Requisicoes_salas_admin',$data);
			$this->load->view('templates/Footer');

	}
	
	// O admin apaga requisição
	public function apaga_Requisicao_admin(){
		// Se a requisição tiver equipamento reservado, guardo a quantidade do equipamento e o id do mesmo
		$id_requisição = $this->input->post('id_requisicao');
		// Pesquisa se existe na requiscao_has_equipamentos um equpipamento/equipamentos com esse id

		$informaçao = $this->Privado_m->mostrar_Requisicoes_Equipamentos_Apagar_Requisicao($id_requisição);
		// var_dump($informaçao);

		for ($i = 0; $i < count($informaçao); $i++) {
			// echo $informaçao[$i]['quantidade'];

			$id_equip = $informaçao[$i]['equipamento_id'];
			// var_dump($id_equip); // 2 e 3

			$nome_Equipamento = $informaçao[$i]['equipnome'];
			// var_dump($nome_Equipamento);

			$quantidade_passado = $informaçao[$i]['quantidade'];

			
			$quantidade_equipamento_origem=$this->Privado_m->busca_Equipamentos($nome_Equipamento);

			// var_dump($quantidade_equipamento_origem);
			
			for ($c = 0; $c < count($quantidade_equipamento_origem); $c++) {
				// echo $quantidade_equipamento_origem[$c]['quantidade'];
				// echo $quantidade_equipamento_origem[$c]['id'];
				$quantidade_restante_origem = $quantidade_equipamento_origem[$c]['quantidade'];
				$id_quantidade_restante_origem = $quantidade_equipamento_origem[$c]['id'];
				// echo $quantidade_equipamento_origem[$i]['id'];

			
			$quantidade_fazer_update = $quantidade_restante_origem + $quantidade_passado;
			$id_Equipamento = $id_quantidade_restante_origem;

			// var_dump($quantidade_fazer_update);
			// var_dump($id_Equipamento);
			$data = array(
				'quantidade' => $quantidade_fazer_update,
			);
			$this->Privado_m->update_Equipamento($data,$id_Equipamento);


		}
		$this->Privado_m->elimina_requisicao($id_requisição);
		
		
		}
		// Refresh à página
		redirect(base_url("/Requisicoes_salas_admin"));

	}



	// Cancela equipamentos das requisições
	public function cancelar_equipamento_requisicao_admin(){


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
		
		// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
		$data = array(
					'quantidade' => $quantidade_final
					);

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade
		$this->Privado_m->atualiza_Equipamento_depois_cancelar($data,$id_equipamento_bd);


		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		
		// Cancela o equipamento através do id do equipamento que está na requisição
		$this->Privado_m->cancelar_equipamento_requisicao_admin_m($id_requisicao_equipamento);
		// Mensagem
		$this->session->set_flashdata("equipamento_cancelado_sucesso", "Equipamento cancelado com sucesso");

		// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
		// redirect('Requisicoes_equipamentos_admin', 'refresh');
		redirect(base_url("/Requisicoes_equipamentos_admin"));
		
	}


	// Cancela o equipamento requesitado e faz update à quantidade dos equipamentos user
	public function cancelar_equipamento_requisicao_user(){
		
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
		
		// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
		$data = array(
					'quantidade' => $quantidade_final
					);

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade
		$this->Privado_m->atualiza_Equipamento_depois_cancelar($data,$id_equipamento_bd);


		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');

		// Cancela o equipamento através do id do equipamento que está na requisição
		$this->Privado_m->cancelar_equipamento_requisicao_user_m($id_requisicao_equipamento);
		// Mensagem
		$this->session->set_flashdata("equipamento_cancelado_sucesso", "Equipamento cancelado com sucesso");

			$this->load->view('templates/header');
			// $this->load->view('publico/Requisicoes_equipamentos_admin',$data);
			$this->load->view('templates/Footer');

			// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
			// redirect('Requisicoes_equipamentos_user', 'refresh');	
			redirect(base_url("/Requisicoes_equipamentos_user"));
		
	}


	public function editar_equipamento_requisicao_user(){
		
		
		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		$quantidade_modal = $this->input->post('quantidade');	
		$id_requisicao_equipamento = $this->input->post('id_requisicao_equipamento');

		// Vai à base de dados buscar a quantidade atual dos equipamentos nas requisiçoes
		$array_Equipamento_requesito = $this->Privado_m->busca_quantidade_equipamento_requisito($id_equipamento);

		$quantidade_bd_requisita = $array_Equipamento_requesito[0]['quantidade'];
		$id_equipamento_bd = $array_Equipamento_requesito[0]['equipamento_id'];

		// Vai à base de dados buscar a quantidade atual dos equipamentos 
		$array_Equipamento_requesito = $this->Privado_m->busca_quantidade_equipamento($id_equipamento);

		$quantidade_equipamento = $array_Equipamento_requesito[0]['quantidade'];
		$id_equipamento_bd_equipamento = $array_Equipamento_requesito[0]['id'];

		// se for menor que a base de dados 
		$diferenca=0;

		$diferenca_quantidade = $quantidade_bd_requisita - $quantidade_modal;

		$quantidade_final_equipamento = $quantidade_equipamento + $diferenca_quantidade;

	if ($quantidade_final_equipamento > $diferenca) {
		// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
		$data_requisita = array( 
					'quantidade' => $quantidade_modal
					);

		
			// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
			$data_equipamento = array(
						'quantidade' => $quantidade_final_equipamento
						);

			// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade
			$this->Privado_m->atualiza_Equipamento_depois_cancelar($data_equipamento,$id_equipamento_bd_equipamento);
			$this->Privado_m->atualiza_Equipamento_depois_update($data_requisita,$id_equipamento_bd);


		}else{
			$this->session->set_flashdata("erro_quantidade", "Não existe tanta quantidade");
		}
			
			// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
			// redirect('Requisicoes_equipamentos_user', 'refresh');	
			redirect(base_url("/Requisicoes_equipamentos_user"));
			
		
	}


	public function editar_equipamento_requisicao_admin(){
		


		$id_requisição = $this->input->post('id_requisicao');
		$id_equipamento = $this->input->post('id_equipamento');
		$quantidade_modal = $this->input->post('quantidade');	
		$id_requisicao_equipamento = $this->input->post('id_requisicao_equipamento');

		// Vai à base de dados buscar a quantidade atual dos equipamentos nas requisiçoes
		$array_Equipamento_requesito = $this->Privado_m->busca_quantidade_equipamento_requisito($id_equipamento);

		$quantidade_bd_requisita = $array_Equipamento_requesito[0]['quantidade'];
		$id_equipamento_bd = $array_Equipamento_requesito[0]['equipamento_id'];

		// Vai à base de dados buscar a quantidade atual dos equipamentos 
		$array_Equipamento_requesito = $this->Privado_m->busca_quantidade_equipamento($id_equipamento);

		$quantidade_equipamento = $array_Equipamento_requesito[0]['quantidade'];
		$id_equipamento_bd_equipamento = $array_Equipamento_requesito[0]['id'];

		// se for menor que a base de dados 
			 $diferenca=0;
			$quantidade_final = $quantidade_modal;
			$diferenca_quantidade = $quantidade_bd_requisita - $quantidade_modal;
			$quantidade_final_equipamento = $quantidade_equipamento + $diferenca_quantidade;

			if ($quantidade_final_equipamento > $diferenca) {
			// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
		$data_requisita = array(
	
			'quantidade' => $quantidade_final
			);

	
		// Referente à quantidade para depois voltar a somar na quantidade original dos equipamentos
		$data_equipamento = array(
	
					'quantidade' => $quantidade_final_equipamento
					);

		// Fazer update da quantidade, ou seja quando requisitar tem de diminuir a quantidade
		$this->Privado_m->atualiza_Equipamento_depois_cancelar($data_equipamento,$id_equipamento_bd_equipamento);
		$this->Privado_m->atualiza_Equipamento_depois_update($data_requisita,$id_equipamento_bd);


		} else {
			$this->session->set_flashdata("erro_quantidade", "Não existe tanta quantidade");
		}
			
			// Temos de fazer redirect, porque se mandarmos carregar a pagina da erro porque nao encontra nada
			// redirect('Requisicoes_equipamentos_admin', 'refresh');	
			redirect(base_url("/Requisicoes_equipamentos_admin"));
		
	}


}
