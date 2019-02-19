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

	 

	  public function mostra_salas()
	{
		
		$data['salas']=$this->Privado_m->busca_salas();
		$this->load->view('templates/header');
		$this->load->view('publico/Sala_admin',$data);
		$this->load->view('templates/footer');
		
	}


	public function inserir_sala()
	{
		// Valida a Password
		$this->form_validation->set_rules('tiposala', 'Tipo de Sala','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('capaciadade', 'Capaciadade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('disponibilidade', 'Disponibilidade','required',
			array('required' => 'Você tem de preencher campo %s.')
			);
		$this->form_validation->set_rules('foto', 'Foto',
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

		// Busca o id do tipo de sala que foi inserido

		$array_sala = $this->Privado_m->mostrar_Sala($tiposala);
		$id_sala = $array_sala[0]['id'];
		var_dump($array_sala);

			// Se o form validation nao tiver erros.
			if ($this->form_validation->run() == TRUE) {
				
				

				$data = array (
						'capacidade' => $capaciadade,
						'disponibilidade' => $disponibilidade,
						'nome' => $nomesala,
						'sala_id' => $id_sala

				);
				var_dump($id_sala);

				var_dump($data);
				$this->Privado_m->inserir_Casa($data);
				$this->load->view('templates/Header');
				$this->load->view('publico/Inserir_sala', $data);
				$this->load->view('templates/Footer');

				redirect('home', 'refresh');

				
				

			} else {
				$data['erros'] = array('mensagens' => validation_errors());
				
				$this->load->view('templates/Header');
				$this->load->view('publico/Inserir_sala', $data);
				$this->load->view('templates/Footer');
				
				

					}
				}
		
			// Eliminar Sala
			public function editar_Sala()
				{

					// Valida a Password
					$this->form_validation->set_rules('capacidade', 'Capacidade','required',
					array(
						'required'      => 'Não preencheu %s.')
						
					);
					$this->form_validation->set_rules('nome_sala', 'Nome Sala','required|is_unique[tipologia.nome]',
					array(
						'required'      => 'Não preencheu %s.')
						
					);

					// $this->form_validation->set_rules('imagem', 'Tipo de Sala','required',
					// array(
					// 	'required'      => 'Não preencheu %s.')
						
					// );

					$this->form_validation->set_rules('disponibilidade', 'Tipo de Sala','required',
					array(
						'required'      => 'Não preencheu %s.',
						'is_unique'     => 'Este %s já existe.'
						)
					);






					// Guarda os valores inseridos no registo
					$capacidade = $this->input->post("capacidade");
					$nome_sala = $this->input->post("nome_sala");
					$imagem = $this->input->post("imagem");
					$disponibilidade = $this->input->post("disponibilidade");
					




					$data['salas']=$this->Privado_m->busca_salas();
					$this->load->view('templates/header');
					$this->load->view('publico/Sala_admin',$data);
					$this->load->view('templates/footer');
					
				}


		// Eliminar Sala

		public function Apaga_Sala()
		{

			$id_sala = $this->input->post('id_sala');
			$this->Privado_m->eliminar_Sala($id_sala);

			 // Carrego as views
			$this->load->view('templates/Header');
			// $this->load->view('publico/Home');
			$this->load->view('templates/Footer');
			redirect('Sala_admin', 'refresh');
		}
	
}
