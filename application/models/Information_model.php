<?php

class Information_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    // public function fetch_all1($type){
    //     $query = $this->db->select('*')
    //         ->from($type)
    //         ->get();

    //     if($query->num_rows() > 0){
    //         return $query->result_array();
    //     }

    //     return false;
    // }
    // public function update_by_ids($type, $id, $data){
    //     $this->db->set($data)
    //         ->where('id', $id)
    //         ->update($type);

    //     if($this->db->affected_rows() == 1){
    //         return true;
    //     }

    //     return false;
    // }
    
    
    
    public function fetch_all($type){
        $query = $this->db->select('*')
            ->from($type)
            ->where('is_deleted', 0)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_all_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('information');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_all_product($id, $limit = NULL, $start = NULL, $year = null) {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('client_id', $id);
        $this->db->where('year', $year);
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_all_product_for_team($table, $id, $year = null) {
        $this->db->select($table . '.*, users.company');
        $this->db->from($table);
        $this->db->join('users', $table . '.client_id = users.id');
        $this->db->where($table . '.client_id', $id);
        $this->db->where($table . '.year', $year);
        $this->db->where($table . '.is_deleted', 0);
        $this->db->order_by($table . '.id', "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_all_product_by_year($year = null) {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('year', $year);
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
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

    public function get_all_product_and_status($id, $limit = NULL, $start = NULL, $year = null) {
        $this->db->select('product.*, status.is_final');
        $this->db->from('product');
        $this->db->join('status', 'product.client_id = status.client_id');
        $this->db->where('product.client_id', $id);
        $this->db->where('product.is_deleted', 0);
        if($year != null){
            $this->db->where('product.year', $year);
        }
        $this->db->where('status.is_final', 1);
        $this->db->limit($limit, $start);
        $this->db->group_by('product.id');
        $this->db->order_by("product.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_personal_products($stype, $ids, $year){
        $table = 'product' . $stype;
        $company_city = ($stype == 1) ? 'city' : 'company';
        $query = $this->db->select($table . '.*, ' . $company_city . '.id AS companyId')
            ->from($table)
            ->join($company_city, $table . '.client_id = ' . $company_city . '.client_id')
            ->where($company_city . '.year', $year)
            ->where_in($table . '.id', $ids)
            ->order_by($table . ".id", "desc");
        return $query->get()->result_array();
    }

    public function get_product($year = null) {
        $this->db->select('*');
        $this->db->from('product');
        if($year != null){
            $this->db->where('year', $year);
        }
        $this->db->order_by("id", "desc");

        return $this->db->get()->result_array();
    }

    public function get_product_for_team($table, $year = null) {
        $this->db->select('*');
        $this->db->from($table);
        if($year != null){
            $this->db->where('year', $year);
        }
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");

        return $this->db->get()->result_array();
    }

    public function fetch_all_by_type($type){
        $query = $this->db->select('*')
            ->from('information')
            ->where('type', $type)
            ->where('is_deleted', 0)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_all_submitted_products_by_type_and_year($year, $type = null){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('year', $year);
        $this->db->where('is_submit', 1);
        if($type != null){
            $this->db->where('main_service', $type);
        }

        return $this->db->get()->result_array();
    }

    public function fetch_latest_informations($quantity){
        $query = $this->db->select('*')
            ->from('information')
            ->where('is_deleted', 0)
            ->order_by('created_at', 'desc')
            ->limit($quantity)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function count_all() {
        $query = $this->db->select('*')
            ->from('information')
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function count_informations() {
        $query = $this->db->select('*')
            ->from('information')
            ->get();

        return $query->num_rows();
    }

    public function count_companys($year = null) {
        $query = $this->db->select('*')
            ->join('users', 'users.id = company.client_id')
            ->from('company')
            ->where('year', $year)
            ->get();

        return $query->num_rows();
    }

    public function count_companies_by_type($stype, $year = null) {
        $query = $this->db->select('*')
            ->join('users', 'users.id = company.client_id')
            ->from('company')
            ->where('company.year', $year)
            ->where('users.service_type', $stype)
            ->get();

        return $query->num_rows();
    }

    public function count_cities_by_type($stype, $year = null) {
        $query = $this->db->select('*')
            ->join('users', 'users.id = city.client_id')
            ->from('city')
            ->where('city.year', $year)
            ->where('users.service_type', $stype)
            ->get();

        return $query->num_rows();
    }

    public function count_all_product() {
        $query = $this->db->select('*')
            ->from('product')
            ->get();

        return $query->num_rows();
    }

    public function count_all_current_year_product($type, $year) {
        $query = $this->db->select('*')
            ->from($type)
            ->where('year', $year)
            ->get();

        return $query->num_rows();
    }

    public function count_product($id, $year) {
        $query = $this->db->select('*')
            ->from('product')
            ->where('client_id', $id)
            ->where('year', $year)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function count_product1($id, $year) {
        $query = $this->db->select('*')
            ->from('product1')
            ->where('client_id', $id)
            ->where('year', $year)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function count_product2($id, $year) {
        $query = $this->db->select('*')
            ->from('product2')
            ->where('client_id', $id)
            ->where('year', $year)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function count_product3($id, $year) {
        $query = $this->db->select('*')
            ->from('product3')
            ->where('client_id', $id)
            ->where('year', $year)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function fetch_by_id($type, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_product_by_id_for_leader($type, $id, $stype, $year){
        $table = 'product' . $stype;
        $company_city = ($stype == 1) ? 'city' : 'company';
        $query = $this->db->select($table . '.*, ' . $company_city . '.id AS companyId')
            ->from($table)
            ->join($company_city, $table . '.client_id = ' . $company_city . '.client_id')
            ->where($company_city . '.year', $year)
            ->where($table . '.id', $id)
            ->get();

            if($query->num_rows() == 1){
                return $query->row_array();
            }
    
            return false;
    }

    public function fetch_user_by_id($id){
        $query = $this->db->select('*')
            ->from('users')
            ->where('id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_by_user_id($type, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('client_id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_extra_by_identity($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_by_user_identity($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_by_user_information_id_and_year($type, $information, $year){
        $query = $this->db->select('*')
            ->from($type)
            ->where('information_id', $information)
            ->where('year', $year)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_company_by_identity_and_year($type, $identity, $year){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->where('year', $year)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_by_identity($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->order_by("year", "desc")
            ->get()->result_array();

        return $query;
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

    public function fetch_product_by_id($type, $id){
        $query = $this->db->select('*')
            ->from($type)
            ->where('id', $id)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_product_by_ids($type, $ids){
        $query = $this->db->select('*')
            ->from($type)
            ->where_in('id', $ids)
            ->limit()
            ->get()->result_array();

        return $query;
    }

    public function insert($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_company($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
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

    public function update($type, $id, $information){
        $this->db->set($information)
            ->where('client_id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update_by_identity($type, $identity, $information){
        $this->db->set($information)
            ->where('identity', $identity)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update_by_information_and_year($type, $identity, $year, $data){
        $this->db->set($data)
            ->where('identity', $identity)
            ->where('year', $year)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
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

    public function fetch_all_company_by_type_pagination($limit = NULL, $start = NULL, $year = null, $stype) {
        $this->db->select('company.*, users.company as company, status.is_final as final');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('status', 'status.client_id = company.client_id');
        if($year != null){
            $this->db->where('company.year', $year);
            $this->db->where('status.year', $year);
            // $this->db->where('status.is_final', 1);
            $this->db->where('users.service_type', $stype);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by("company.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_all_city_by_type_pagination($limit = NULL, $start = NULL, $year = null, $stype) {
        $this->db->select('city.*, users.company as city, status.is_final as final');
        $this->db->from('city');
        $this->db->join('users', 'users.id = city.client_id');
        $this->db->join('status', 'status.client_id = city.client_id');
        if($year != null){
            $this->db->where('city.year', $year);
            $this->db->where('status.year', $year);
            // $this->db->where('status.is_final', 1);
            $this->db->where('users.service_type', $stype);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by("city.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all_company_pagination($year = null) {
        $this->db->select('company.*, users.company as company, status.is_final as final');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('status', 'status.client_id = company.client_id');
        if($year != null){
            $this->db->where('company.year', $year);
            $this->db->where('status.year', $year);
            $this->db->where('status.is_final', 1);
        }

        return $this->db->get()->num_rows();
    }

    public function fetch_all_company_for_team($limit = NULL, $start = NULL, $year = null) {
        $this->db->select('company.*, users.company as company, status.is_final as final');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('status', 'status.client_id = company.client_id');
        if($year != null){
            $this->db->where('company.year', $year);
            $this->db->where('status.year', $year);
            $this->db->where('status.is_final', 1);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by("company.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_company_city_by_stype($stype, $year = null) {
        if($stype == 1){
            $table = 'city';
        }else{
            $table = 'company';
        }

        $this->db->select( $table . '.client_id, users.company as company, status.is_final as final');
        $this->db->from($table);
        $this->db->join('users', 'users.id = ' . $table . '.client_id');
        $this->db->join('status', 'status.client_id = ' . $table . '.client_id');
        if($year != null){
            $this->db->where($table . '.year', $year);
            $this->db->where('status.year', $year);
            $this->db->where('status.is_final', 1);
            $this->db->where('users.service_type', $stype);
        }
        $this->db->order_by($table . ".id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_company_by_id($id = null){
        $this->db->select('company.*, users.*, information.*, company.id as company_id');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('information', 'information.client_id = company.client_id');
        $this->db->where('company.id', $id);
        // $this->db->where('company.is_submit', 1);
        return $result = $this->db->get()->row_array();
    }

    public function fetch_city_by_id($id = null){
        $this->db->select('city.*, users.*, information.*, city.id as company_id');
        $this->db->from('city');
        $this->db->join('users', 'users.id = city.client_id');
        $this->db->join('information', 'information.client_id = city.client_id');
        $this->db->where('city.id', $id);
        // $this->db->where('company.is_submit', 1);
        return $result = $this->db->get()->row_array();
    }

    public function fetch_company_by_client_id($id = null){
        $this->db->select('company.*, users.*, information.*');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('information', 'information.client_id = company.client_id');
        $this->db->where('company.client_id', $id);
        $this->db->where('company.is_submit', 1);
        return $result = $this->db->get()->row_array();
    }

    public function fetch_company_by_client_id_2($id = null, $eventYear){
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('client_id', $id);
        $this->db->where('year', $eventYear);
        return $result = $this->db->get()->row_array();
    }

    public function count_company_search($search = '', $year = null) {
        $query = $this->db->select('company.*, users.*')
            ->from('company')
            ->join('users', 'users.id = company.client_id')
            ->like('users.company', $search)
            ->where('year', $year)
            ->get();

        return $query->num_rows();
    }

    public function count_company_search_by_type($search = '', $year = null, $stype) {
        $query = $this->db->select('company.*, users.*')
            ->from('company')
            ->join('users', 'users.id = company.client_id')
            ->like('users.company', $search)
            ->where('company.year', $year)
            ->where('users.service_type', $stype)
            ->get();

        return $query->num_rows();
    }

    public function count_city_search_by_type($search = '', $year = null, $stype) {
        $query = $this->db->select('city.*, users.*')
            ->from('city')
            ->join('users', 'users.id = city.client_id')
            ->like('users.city', $search)
            ->where('city.year', $year)
            ->where('users.service_type', $stype)
            ->get();

        return $query->num_rows();
    }

    public function fetch_all_company_by_type_pagination_search($limit = NULL, $start = NULL, $search = '', $year = null, $stype) {
        $this->db->select('company.*, users.company as company, status.is_final as final');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('status', 'status.client_id = company.client_id');
        $this->db->limit($limit, $start);
        $this->db->like('users.company', $search);
        if($year != null){
            $this->db->like('company.year', $year);
            $this->db->where('status.year', $year);
            // $this->db->where('status.is_final', 1);
            $this->db->where('users.service_type', $stype);
        }
        $this->db->order_by("company.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_all_city_by_type_pagination_search($limit = NULL, $start = NULL, $search = '', $year = null, $stype) {
        $this->db->select('city.*, users.company as company, status.is_final as final');
        $this->db->from('city');
        $this->db->join('users', 'users.id = city.client_id');
        $this->db->join('status', 'status.client_id = city.client_id');
        $this->db->limit($limit, $start);
        $this->db->like('users.company', $search);
        if($year != null){
            $this->db->like('city.year', $year);
            $this->db->where('status.year', $year);
            // $this->db->where('status.is_final', 1);
            $this->db->where('users.service_type', $stype);
        }
        $this->db->order_by("city.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_company_pagination_search($search = '', $year = null) {
        $this->db->select('company.*, users.company as company, status.is_final as final');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->join('status', 'status.client_id = company.client_id');
        $this->db->like('users.company', $search);
        if($year != null){
            $this->db->like('company.year', $year);
            $this->db->where('status.year', $year);
            $this->db->where('status.is_final', 1);
        }

        return $result = $this->db->get()->num_rows();
    }

    public function fetch_client_id($id = null){
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('client_id', $id);
        $this->db->where('is_submit', 1);
        return $result = $this->db->get()->row_array();
    }

    public function get_all_for_export($type, $client_id = null, $requestYear){
        $this->db->select('*');
        $this->db->from($type);
        if($client_id != null){
            $this->db->where('client_id', $client_id);
        }
        $this->db->where('year', $requestYear);
        $this->db->order_by("id", "asc");

        return $result = $this->db->get()->result_array();
    }

    public function get_company_for_export_by_stype($requestYear, $stype){
        $this->db->select('company.*, users.company AS company_name, users.service_type AS stype');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->where('company.year', $requestYear);
        $this->db->where('users.service_type', $stype);
        $this->db->order_by("company.id", "asc");

        return $result = $this->db->get()->result_array();
    }

    public function get_city_for_export_by_stype($requestYear, $stype){
        $this->db->select('city.*, users.company AS company_name, users.service_type AS stype');
        $this->db->from('city');
        $this->db->join('users', 'users.id = city.client_id');
        $this->db->where('city.year', $requestYear);
        $this->db->where('users.service_type', $stype);
        $this->db->order_by("city.id", "asc");

        return $result = $this->db->get()->result_array();
    }

    public function get_all_product_for_export($type, $client_id = null, $year){
        $this->db->select('users.company, product.*');
        $this->db->from($type);
        $this->db->join('users', 'users.id = product.client_id');
        $this->db->where('product.year', $year);
        $this->db->order_by("product.client_id", "asc");

        return $result = $this->db->get()->result_array();
    }

    public function get_product_for_export_by_stype($table, $year, $stype){
        $this->db->select("users.company, $table.*");
        $this->db->from($table);
        $this->db->join('users', "users.id = $table.client_id");
        $this->db->join('status', "$table.client_id = status.client_id");
        $this->db->where("status.is_final", 1);
        $this->db->where("$table.year", $year);
        $this->db->order_by("$table.client_id", "asc");

        return $result = $this->db->get()->result_array();
    }

    public function fetch_company_by_member_id_pagination_search($member_id, $limit = NULL, $start = NULL, $search = '') {
        $this->db->select('company.*, users.company as company');
        $this->db->from('company');
        $this->db->join('users', 'users.id = company.client_id');
        $this->db->limit($limit, $start);
        $this->db->like('users.company', $search);
        $this->db->where('company.member_id', $member_id);
        $this->db->order_by("company.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_company_search_by_member_id($member_id, $search = '') {
        $query = $this->db->select('company.*, users.*')
            ->from('company')
            ->join('users', 'users.id = company.client_id')
            ->like('users.company', $search)
            ->where('company.member_id', $member_id)
            ->get();

        return $query->num_rows();
    }

    public function count_company_by_member_id($member_id) {
        $query = $this->db->select('*')
            ->from('company')
            ->where('member_id', $member_id)
            ->get();

        return $query->num_rows();
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

    public function update_main_service($type, $id, $information){
        $this->db->set($information)
            ->where('id', $id)
            ->update($type);
        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function check_exist_information($identity){
        $query = $this->db->select('*')
            ->from('information')
            ->where('identity', $identity)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function check_exist_company_by_year($identity, $year){
        $query = $this->db->select('*')
            ->from('company')
            ->where('information_id', $identity)
            ->where('year', $year)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function checkExist($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->get();

        return $query->num_rows();
    }

    public function checkExistProduct($type, $identity){
        $query = $this->db->select('*')
            ->from($type)
            ->where('identity', $identity)
            ->where('is_deleted', 0)
            ->get();

        return $query->num_rows();
    }

    public function fetch_list_company_by_identity($identity){
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_list_city_by_identity($identity){
        $query = $this->db->select('*')
            ->from('city')
            ->where('identity', $identity)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_list_company_by_identity_and_year($identity, $year){
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->where('year', $year)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_list_city_by_identity_and_year($identity, $year){
        $query = $this->db->select('*')
            ->from('city')
            ->where('identity', $identity)
            ->where('year', $year)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function count_companies($identity) {
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->get();

        return $query->num_rows();
    }

    public function count_city($identity) {
        $query = $this->db->select('*')
            ->from('city')
            ->where('identity', $identity)
            ->get();

        return $query->num_rows();
    }

    public function getCurrentYearCompany($identity, $eventYear){
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->where('year', $eventYear)
            ->get();

        return $query->num_rows();
    }

    public function getCurrentYearCity($identity, $eventYear){
        $query = $this->db->select('*')
            ->from('city')
            ->where('identity', $identity)
            ->where('year', $eventYear)
            ->get();

        return $query->num_rows();
    }

    public function get_detail_information_with_select_by_id($id){
        $this->db->select('information.*');
        $this->db->from('company');
        $this->db->join('information', 'information.client_id = company.client_id');
        $this->db->where('company.id', $id);
        // $this->db->where('company.is_submit', 1);
        return $result = $this->db->get()->row_array();
    }

    public function get_personal_members($ids){
        $query = $this->db->select('*')
            ->from('users')
            ->where_in('id', $ids);
        return $query->get()->result_array();
    }

    public function fetch_product_by_client_ids_with_search_pagination($year, $client_ids = array(), $limit = NULL, $start = NULL, $search = '', $main_service = '') {
        $this->db->select('id, client_id, name, main_service, year');
        $this->db->from('product');
        $this->db->where('year', $year);
        $this->db->where('is_deleted', 0);
        $this->db->where_in('client_id', $client_ids);
        $this->db->limit($limit, $start);
        if ( $main_service != '' && $main_service != null) {
            $this->db->where('main_service', $main_service);
        }
        if ( $search != '') {
            $this->db->like('name', $search);
        }
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_product_by_client_ids_with_search($year, $client_ids = array(), $search = '', $main_service = '') {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('year', $year);
        $this->db->where('is_deleted', 0);
        $this->db->where_in('client_id', $client_ids);
        if ( $main_service != '') {
            $this->db->where('main_service', $main_service);
        }
        if ( $search != '') {
            $this->db->like('name', $search);
        }

        return $this->db->get()->num_rows();
    }

    function getAllProductYears(){
        $query = $this->db->select('year')
            ->from('product')
            ->where('is_deleted', 0)
            ->group_by('year');
        return $query->get()->result_array();
    }

    function check_choose_type($client_id, $year){
        $query = $this->db->select('field_21')
            ->from('product3')
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
}
