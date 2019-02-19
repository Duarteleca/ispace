<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Publico_m extends CI_Model 
{

    
    public function __construct() {
        parent::__construct();
    }
    public function Contar_salas() {
 
        return $this->db->count_all("tipologia");
        
  
    }


    // Mostrar Utilizadores
    function mostrar_Utilizadores($username)
    {
        $this->db->where('username',$username);
        $dadosuser = $this->db->get("utilizador");
        return $dadosuser->result_array();
        var_dump($dadosuser);
    }

    // Mostra lista todas as salas que existem   
    public function selecionarSala()
        {
               
            $query=$this->db->get('sala');

            return $query->result_array();
            
        }
    
    

    public function busca_salas($limit, $start,$sala="")
    {
        $this->db->limit($limit, $start);
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome "nome_sala",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
            $this->db->from('sala');
            $this->db->join('tipologia', 'tipologia.sala_id = sala.id');
            if($sala != ""){
                $this->db->like('sala.tipo_sala', $sala);  
            }
            $query = $this->db->get();
            return $query->result_array();
       
      
    }

    // Seleciona todos os equipamentos que existem
    public function selecionarEquipamento()
        {
               
            $query=$this->db->get('Equipamento');

            return $query->result_array();
            
        }


    public function busca_equipamento($limit, $start,$equipamento="")
    {
        $this->db->limit($limit, $start);
            $this->db->select('imagem,nome,quantidade');
            $this->db->from('equipamento');
            if($equipamento != ""){
                $this->db->like('equipamento.nome', $equipamento);  
            }
            $query = $this->db->get();
            return $query->result_array();
       
    }

    

            // Insere o registo na tabela utilizador
            public function inserir_Registo($data)
            {
                var_dump($data);
                $this->db->insert('utilizador', $data);
        
            }

           
}