<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Date_m extends CI_Model 
{

    
    public function __construct() {
        parent::__construct();

    }


    public function selecionarSala()
        {
               
            $query=$this->db->get('sala');
            

            return $query->result_array();
            
        }

        public function busca_salas($salas)
    {
       
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome "nome_sala",tipologia.id "tipoid",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
            $this->db->from('sala');
            $this->db->join('tipologia', 'tipologia.sala_id = sala.id');
            if($salas != ""){
                $this->db->like('sala.tipo_sala', $salas);  
            }
            $query = $this->db->get();
            return $query->result_array();
       
      
    }

    public function busca_salas_re($id)
    {
       
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome,tipologia.id "tipoid",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
            $this->db->from('tipologia');
            $this->db->join('sala', 'tipologia.sala_id = sala.id');
            $query = $this->db->get();
            $query = $this->db->get_where('tipologia', array('id' => $id));
            return $query->row_array(); 
    }


    public function saveCar($id = 0)
    {
 
       
        
        if ($id == 0) {
            return $this->db->insert('automovel', $data);
        } else {
            $query = $this->db->get_where('aluga', array('id_carro' => $id));
           
            if(empty($query->row_array())){
                $this->db->where('id', $id);
                return $this->db->update('automovel', $data); 
            }
        }
    }





}
