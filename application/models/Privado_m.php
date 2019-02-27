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

     // Edita equipamento
    public function atualiza_Equipamento($inputs,$id_equipamento)
    {
    $this->db->where('id', $id_equipamento);
    $this->db->update('equipamento', $inputs);

    }

    // Atualiza utilizador
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
    }
    

    // Insere uma nova requisição
    public function faz_Requisicao($data)
    {
        $this->db->insert('requisicao', $data);
    }

    // Pesquisa as salas requisitadas por id do user
    public function mostrar_Requisicoes_Equipamentos()
    {
       

        $this->db->select('requisicao.id "idreq",requisicao.data_inicio,requisicao.data_fim,requisicao.hora_inicio,requisicao.hora_fim,
        requisicao.utilizador_id,requisicao.tipologia_id,utilizador.nome "nomeuser",tipologia.id,tipologia.nome,requisicao_has_equipamento.quantidade,
        requisicao_has_equipamento.equipamento_id,equipamento.nome "equipnome"');
        $this->db->from('requisicao');
        $this->db->join('utilizador', 'utilizador.id = requisicao.utilizador_id');
        $this->db->join('tipologia', 'tipologia.id = requisicao.tipologia_id');
        $this->db->join('requisicao_has_equipamento', 'requisicao_has_equipamento.requisicao_id = requisicao.id' );
        $this->db->join('equipamento', 'equipamento.id = requisicao_has_equipamento.equipamento_id');
        $query = $this->db->get();
        return $query->result_array();
     }

     
 
     // Insere uma nova requisição
    public function adiciona_Equipamento_Requisicao($data)
    {
        $this->db->insert('requisicao_has_equipamento', $data);
    }


     // Mostra dados do equipamento que foi inserido / (Inserir equipamento requisicao)
     function busca_Equipamento($nome_Equipamento)
     {
         $this->db->where('nome',$nome_Equipamento);
         $dadosequipamento = $this->db->get("equipamento");
         return $dadosequipamento->result_array();
     }


     // Update Equipamento (adicionar equipamento à requisição)
    public function update_Equipamento($data,$id_Equipamento)
    {
    $this->db->where('id', $id_Equipamento);
    $this->db->update('equipamento', $data);
    }


    // Insere na requisicao has equipamento
    public function requisicao_has_equipamento($informacao)
    {
        $this->db->insert('requisicao_has_equipamento', $informacao);
    }

    // Eliminar requisição selecionada
    public function elimina_requisicao($id_requisição)
    {
        $this->db->where('id',$id_requisição);
        $this->db->delete('requisicao');
    }


    // Update a requisição
    public function edita_Requisicoa($id_requisicao)
    {
    $this->db->where('id', $id_requisicao);
    $this->db->update('requisicao', $data);
    }

    // Mostra todas requisicoes para o admin

    public function mostra_Salas_Requesitadas_admin()
    { 
        $query=$this->db->get('requisicao');
        return $query->result_array();         
    }

    

     // Mostra todas requisicoes para o admin

     public function selecionar_salas_requisitadas()
     { 
        $this->db->select('requisicao.id "idreq",requisicao.data_inicio,requisicao.data_fim,requisicao.hora_inicio,requisicao.hora_fim,
        requisicao.utilizador_id,requisicao.tipologia_id,tipologia.id,tipologia.nome,
        
        ');
        $this->db->from('requisicao');
        $this->db->join('tipologia', 'tipologia.id = requisicao.tipologia_id');
        $query = $this->db->get();
        return $query->result_array();




        //  $this->db->where('utilizador_id',$user_id_salas);
        // $mostrar_dados = $this->db->get("requisicao");

        // return $mostrar_dados->result_array();
     }


     

      // Cancela equipamento da requisiçao (admin)
    public function cancelar_equipamento_requisicao_admin_m($id_requisição,$id_equipamento)
    {
        $this->db->where('equipamento_id',$id_equipamento);
        $this->db->where('requisicao_id',$id_requisição);
        $this->db->delete('requisicao_has_equipamento');
    }

      // Cancela equipamento da requisiçao (user)
      public function cancelar_equipamento_requisicao_user_m($id_requisicao_equipamento)
      {
          $this->db->where('id',$id_requisicao_equipamento);
          
          $this->db->delete('requisicao_has_equipamento');
      }


    // Pesquisa as salas requisitadas por id do user
    public function mostrar_Requisicoes_Equipamentos_user($user_id)
    {
       

        $this->db->select('requisicao.id "idreq",requisicao.data_inicio,requisicao.data_fim,requisicao.hora_inicio,requisicao.hora_fim,
        requisicao.utilizador_id,requisicao.tipologia_id,utilizador.nome "nomeuser",tipologia.id,tipologia.nome,requisicao_has_equipamento.quantidade,
        requisicao_has_equipamento.equipamento_id,equipamento.nome "equipnome",requisicao_has_equipamento.id "idreqequip"');
        $this->db->from('requisicao');
        $this->db->join('utilizador', 'utilizador.id = requisicao.utilizador_id');
        $this->db->join('tipologia', 'tipologia.id = requisicao.tipologia_id');
        $this->db->join('requisicao_has_equipamento', 'requisicao_has_equipamento.requisicao_id = requisicao.id' );
        $this->db->join('equipamento', 'equipamento.id = requisicao_has_equipamento.equipamento_id');

        $this->db->where('utilizador_id',$user_id);
        

        
        $query = $this->db->get();
        return $query->result_array();
     }



     
     // Mostra dados do equipamento que foi pedido na requesição
     function busca_quantidade_equipamento($id_equipamento)
     {
         $this->db->where('id',$id_equipamento);
         $dadosequipamentoreq = $this->db->get("equipamento");
         return $dadosequipamentoreq->result_array();
     }


      // Edita equipamento
    public function atualiza_Equipamento_depois_cancelar($data,$id_equipamento_bd)
    {
    $this->db->where('id', $id_equipamento_bd);
    $this->db->update('equipamento', $data);

    }

    
    
     // Mostra dados do equipamento que foi pedido na requesição
     function busca_id_requisicao_equipamento($id_requisição,$id_equipamento)
     {
         $this->db->where('id',$id_equipamento);
         $dadosequipamentoreq = $this->db->get("equipamento");
         return $dadosequipamentoreq->result_array();
     }
}
