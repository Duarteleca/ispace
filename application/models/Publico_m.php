<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Publico_m extends CI_Model 
{

    
    public function __construct() {
        parent::__construct();
    }


    // Mostrar Utilizadores
    function mostrar_Utilizadores($username){
        $this->db->where('username',$username);
        $dadosuser = $this->db->get("utilizador");
        return $dadosuser->result_array();
    }

    // Mostra lista todas as salas que existem   
    public function selecionarSala(){
               
            $query=$this->db->get('sala');

            return $query->result_array();
            
        }
    
    

    public function busca_salas($salas){
       
            $this->db->select('sala.id "id",sala.tipo_sala,tipologia.nome "nome_sala",tipologia.id "tipoid",tipologia.capacidade "capacidade",tipologia.disponibilidade "disponibilidade",tipologia.imagem "imagem"');
            $this->db->from('sala');
            $this->db->join('tipologia', 'tipologia.sala_id = sala.id');
            if($salas != ""){
                $this->db->like('sala.tipo_sala', $salas);  
            }
            $query = $this->db->get();
            return $query->result_array();
       
    }

    // Seleciona todos os equipamentos que existem
    public function selecionarEquipamento(){
               
            $query=$this->db->get('Equipamento');

            return $query->result_array();
            
        }


    public function busca_equipamento($equipamento){
      
            $this->db->select('imagem,nome,quantidade');
            $this->db->from('equipamento');
            if($equipamento != ""){
                $this->db->like('equipamento.nome', $equipamento);  
            }
            $query = $this->db->get();
            return $query->result_array();
       
    }

    

    // Insere o registo na tabela utilizador
    public function inserir_Registo($data){
        $this->db->insert('utilizador', $data);

    }


    public function GuardarContato($contato){

        return $this->db->insert("contato", $contato);
    
    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    public function Verificar($email){
        
        $this->db->where('email', $email);
        $verifica=$this->db->get("utilizador")->row_array();
        return $verifica;

    }


    public function recupera_pass($email,$password_hash){

    $data = array(
    
        'password' => $password_hash
        
    );

    $this->db->where('email', $email);
    return $this->db->update('utilizador', $data);

    // fazer update da pass
                
    }

           
}