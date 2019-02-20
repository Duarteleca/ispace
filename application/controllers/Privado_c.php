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

			// Valida a Password
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
				
					var_dump($id_tiposala);

				

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
			
				var_dump($id_tiposala);

			

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

		$this->form_validation->set_rules('quantidade', 'Capaciadade','required',
		array(
			'required' => 'Você tem de preencher campo %s.')
		);

		$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
		array(
			'required' => 'Você tem de preencher campo %s.')
		);


		// Guarda os valores inseridos no registo
		$nome_Equipamento = $this->input->post("nome_Equipamento");
		$quantidade = $this->input->post("quantidade");
		$disponibilidade = $this->input->post("disponibilidade");


		
		// Se o form validation nao tiver erros.
		if ($this->form_validation->run() == TRUE) {

		// Configurações da imagem que foi upload
		$config['upload_path']          = './assets/img/equipamento';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		
		$this->load->library('upload', $config);
		$this->upload->do_upload('postimage');		
	
		$post_image = $_FILES['postimage']['name'];
		
		$endereco ='assets/img/equipamento/';
		
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
	

}
