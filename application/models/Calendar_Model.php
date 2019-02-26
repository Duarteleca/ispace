<?php

class Calendar_Model extends CI_Model
{


    public function get_events($data_inicio, $data_fim)
    {
        return $this->db->where("data_inicio >=", $data_inicio)->where("data_fim <=", $data_fim)->get("requisicao");
    }
    
    public function add_event($data)
    {
        $this->db->insert("requisicao", $data);
    }
    
    public function get_event($id)
    {
        return $this->db->where("id", $id)->get("requisicao");
    }
    
    public function update_event($id, $data)
    {
        $this->db->where("id", $id)->update("requisicao", $data);
    }

    public function dragupdate_event($id, $data)
    {
        $this->db->where("id", $id)->update("requisicao", $data);
    }
    
    public function delete_event($id)
    {
        $this->db->where("id", $id)->delete("requisicao");
    }




}

?>