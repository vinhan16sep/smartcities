<?php

class New_rating_model extends CI_Model {

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
            ->where('id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update_by_member_id_and_product_id($member_id='', $product_id = '', $data){
        $this->db->where('member_id', $member_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('new_rating', $data);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update_by_member_id_and_product_id_for_reset($member_id='', $product_id = '', $data){
        $this->db->set($data);
        $this->db->where('member_id', $member_id);
        $this->db->where('product_id', $product_id);
        $this->db->update('new_rating');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function fetch_by_product_id($type, $id){
        $query = $this->db->select('new_rating.*, users.*')
            ->from($type)
            ->join('users', 'users.id = new_rating.member_id')
            ->where('product_id', $id)
            ->get();

        return $query->result_array();
    }

    public function fetch_by_product_id_submited($type, $id){
        $query = $this->db->select('*')
            ->from('new_rating')
            ->where('product_id', $id)
            ->where('is_submit', 1)
            ->get();

        return $query->result_array();
    }

    public function fetch_by_product_id_and_logged_in_user($type, $id, $user_id){
        $query = $this->db->select('*')
            ->from('new_rating')
            ->where('product_id', $id)
            ->where('member_id', $user_id)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

    public function fetch_by_product_id_and_member_id($product_id, $user_id){
        $query = $this->db->select('*')
            ->from('new_rating')
            ->where('product_id', $product_id)
            ->where('member_id', $user_id)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

    public function check_rating_exist($table, $product_id, $member_id){
        $query = $this->db->select('*')
            ->from($table)
            ->where('product_id', $product_id)
            ->where('member_id', $member_id)
            ->where('is_submit', 1)
            ->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return false;
    }

    public function check_rating_exist_for_list($table, $product_id, $member_id){
        $query = $this->db->select('*')
            ->from($table)
            ->where('product_id', $product_id)
            ->where('member_id', $member_id)
            ->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return false;
    }

    public function check_rating_exist_by_product_id($table, $product_id, $user_id = null, $year = null){
        $this->db->select('*');
            $this->db->from($table);
            $this->db->where('product_id', $product_id);
            $this->db->where('member_id', $user_id);
            $this->db->where('is_submit', 1);
            if($year != null){
                $this->db->where('year', $year);
            }
        return $this->db->get()->num_rows();
    }

    public function get_rating_exist_by_product_id($table, $product_id, $user_id){
        $query = $this->db->select('*')
            ->from($table)
            ->where('product_id', $product_id)
            ->where('member_id', $user_id)
            ->where('is_submit', 1)
            ->get();
        return $query->row_array();
    }

   public function fetch_all(){
       $query = $this->db->select('*')
           ->from('new_rating')
           ->where('is_submit', 1)
           ->get();

       if($query->num_rows() > 0){
           return $query->result_array();
       }

       return false;
   }

   public function delete_rating($team_products, $user_id){
       $this->db->where_in('product_id', $team_products);
       $this->db->where('member_id', $user_id);
       $this->db->delete('new_rating');
   }
}