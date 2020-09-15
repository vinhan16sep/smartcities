<?php

class Status_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function insert($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }
    
    public function update($type, $id, $information){
        $this->db->set($information)
            ->where('client_id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }
    
    public function fetch_by_client_id($id = null, $eventYear = null){
        $this->db->select('*');
        $this->db->from('status');
        $this->db->where('client_id', $id);
        $this->db->where('year', $eventYear);
        return $result = $this->db->get()->row_array();
    }

    public function fetch_by_is_final($is_final = 0, $eventYear = null){
        $this->db->select('*');
        $this->db->from('status');
        $this->db->where('is_final', $is_final);
        $this->db->where('year', $eventYear);
        return $result = $this->db->get()->result_array();
    }

    public function check_company_submitted($client_id, $year){
        $query = $this->db->select('*')
            ->from('status')
            ->where('client_id', $client_id)
            ->where('year', $year)
            ->where('is_final', 1)
            ->get();

        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }
}