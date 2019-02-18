<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Publico_m extends CI_Model 
{

    
    public function __construct() {
        parent::__construct();
    }

    public function busca_salas($slug = false)
    {
        if ($slug === false) {
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome "nome_sala",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
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

    
           // Mostrar Utilizadores
           function motrar_Utilizadores($username)
           {
               $this->db->where('username',$username);
               $dadosuser = $this->db->get("utilizador");
               return $dadosuser->result_array();
           }
    
    
}