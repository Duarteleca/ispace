<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilizador_m extends CI_Model 
{

    public function Verify_User($email){
        $this->db->where("email",$email);
        $email_bd=$this->db->get("utilizador")->row_array();
        return $email_bd;

    }

    public function save($utilizador){
        
        return $this->db->insert("utilizador", $utilizador);
    
    }

    public function login_user($email,$password){
        $this->db->where("email",$email);
        $this->db->where("pw",$password);
        $utilizador=$this->db->get("utilizador")->row_array();
        return $utilizador;
    }


    
public function select_user($email_base)
{

    $this->db->select('id,nome,email,contato,pw');
    $this->db->from('utilizador');
    $query = $this->db->get();
    $query = $this->db->get_where('utilizador', array('email' => $email_base));
    
    return $query->row_array();
}


public function update_user($id)
    {
        $update_user= array(
            "nome" =>$this->input->post("nome"),
            "contato" =>$this->input->post("contato")
        );

       
            $this->db->where('id', $id);
            return $this->db->update('utilizador',  $update_user);
           
    }

    public function update_user_email($id)
    {
        

        $update_user_email= array(
            "nome" =>$this->input->post("nome"),
            "contato" =>$this->input->post("contato"),
            "pw" =>md5($this->input->post("password"))
        );

        $this->db->where('id', $id);
        return $this->db->update('utilizador',  $update_user_email);
           
    }

    public function verify_update($password){
        $this->db->where("pw",$password);
        $utilizador=$this->db->get("utilizador")->row_array();
        return $utilizador;
    }

    
}