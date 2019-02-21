<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Privado_m extends CI_Model 
{

    
    public function __construct() {
        parent::__construct();
    }

    public function busca_salas($slug = false)
    {
        if ($slug === false) {
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome "nome_sala",tipologia.id "tipoid",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
            $this->db->from('sala');
            $this->db->join('tipologia', 'tipologia.sala_id = sala.id');
            $query = $this->db->get();
            return $query->result_array();
        }
        else{
            echo 'erro';
            // $this->db->select('automovel.id "id",automovel.disponibilidade,automovel.matricula,cor.nome "cor",modelo.nome "modelo",fabricante.nome "fabricante"');
            // $this->db->from('automovel');
            // $this->db->join('modelo', 'modelo.id = automovel.modelo_id');
            // $this->db->join('cor', 'cor.id = automovel.cor_id');
            // $this->db->join('fabricante', 'fabricante.id = modelo.fabricante_id');
            // $this->db->like('fabricante.nome',$slug);
            // // se quisermos multiplas procuras colocamos or_like.
            // $this->db->or_like('modelo.nome',$slug);
            // $this->db->or_like('cor.nome',$slug);
            // $this->db->or_like('automovel.matricula',$slug);
            // $query = $this->db->get();
            // return $query->result_array();
       
        }
    }


    


     // Mostra todos os dados das salas onde o tipo de sala é igual ao que foi inserido
     function mostrar_Sala($tiposala)
     {
        $this->db->where('tipo_sala',$tiposala);
        $inserir_sala = $this->db->get("sala");
        return $inserir_sala->result_array();
     }


    // Insere o registo na tabela utilizador
    public function inserir_Sala($data)
    {
        $this->db->insert('tipologia', $data);

    }

    // Elimina a sala selecionada
    public function eliminar_Sala($id_sala)
    {
        $this->db->where('id',$id_sala);
        $this->db->delete('tipologia');
    }

    // Edita sala
    public function atualiza_Sala($inputs,$id_tiposala)
    {
    $this->db->where('id', $id_tiposala);
    $this->db->update('tipologia', $inputs);
    }
    
    
	// function FileUpload($data){
	// 	$this->db->insert('Table Name',$data);
	
    // }


    // Seleciona todos os equipamentos que existem
    public function selecionarEquipamento()
        { 
            $query=$this->db->get('Equipamento');
            return $query->result_array();         
        }

     // Insere um novo equipamento
     public function inserir_Equipamento($data)
     {
         $this->db->insert('equipamento', $data);
 
     }

<<<<<<< HEAD
     // Edita equipamento
    public function atualiza_Equipamento($inputs,$id_equipamento)
    {
    $this->db->where('id', $id_equipamento);
    $this->db->update('equipamento', $inputs);
=======
     public function atualiza_utilizador($data,$email)
    {
        $this->db->where('email', $email);
        return $this->db->update('utilizador', $data);
    }


    public function Selecionar_Utilizadores()
    { 
            $query=$this->db->get('utilizador');
            return $query->result_array();         
    }

    
    public function atualiza_tipo($id_user,$data)
    {
        $this->db->where('id', $id_user);
        return $this->db->update('utilizador', $data);
    }


    public function Eliminar_User($id_user)
    {
        $this->db->where('id',$id_user);
        $this->db->delete('utilizador');
>>>>>>> duarte
    }
 
}