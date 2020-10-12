<?php

class Product1_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function check_choose_type($client_id, $year){
        $query = $this->db->select('field_21')
            ->from('product1')
            ->where('client_id', $client_id)
            ->where('year', $year)
            ->where('is_deleted', 0);
        $result = $query->get()->result_array();
        $arr = [];
        foreach($result as $value){
            $arr[$value['field_21']] = $value['field_21'];
        }

        return $arr;
    }

    public function count_product($id, $year) {
        $query = $this->db->select('*')
            ->from('product1')
            ->where('client_id', $id)
            ->where('year', $year)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    function getAllProductYears(){
        $query = $this->db->select('year')
            ->from('product1')
            ->where('is_deleted', 0)
            ->group_by('year');
        return $query->get()->result_array();
    }

    public function get_all_product_for_client($id, $limit = NULL, $start = NULL, $table = 'product') {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('client_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_product_by_user_and_id($type, $user_id, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('client_id', $user_id)
            ->where('id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function delete($type, $id){
        $this->db->set('is_deleted', 1)
            ->where('id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function insert_product($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function fetch_product_by_user_id($type, $client_id, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('client_id', $client_id)
            ->where('id', $id)
            ->limit(1)
            ->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

    public function update_product($type, $client_id, $id, $information){
        // $this->db->query("SET GLOBAL innodb_file_format=Barracuda;");
        // $this->db->query("SET GLOBAL innodb_file_per_table=ON;");
        $this->db->query("ALTER TABLE ".$type." ENGINE = InnoDB ROW_FORMAT = DYNAMIC;");
        $this->db->set($information)
            ->where('client_id', $client_id)
            ->where('id', $id)
            ->update($type);
        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function checkExistProduct($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }
}
