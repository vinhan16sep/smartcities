<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Product extends Member_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
		$this->load->model('team_model');
        $this->load->library('ion_auth');
        $this->load->model('status_model');
        $this->load->model('new_rating_model');
		$this->load->model('product1_model');
		$this->load->model('product2_model');
		$this->load->model('product3_model');
		$this->load->model('product4_model');

        $this->excel = new PHPExcel();
	}

	public function index(){
        $this->load->model('users_model');
        $stype = $this->input->get('stype');

        $user = $this->ion_auth->user()->row();
        if ($user->member_role == 'manager') {
            $keywords = '';
            $rating_search = '';
            $team_search = null;
            $main_service_search = null;
            if($this->input->get('search')){
                $keywords = $this->input->get('search');
            }
            if($this->input->get('rating_search')){
                $rating_search = $this->input->get('rating_search');
            }
            if($this->input->get('team_search')){
                $team_search = $this->input->get('team_search');
            }

            $this->data['keywords'] = $keywords;
            $this->data['rating_search'] = $rating_search;
            $this->data['team_search'] = $team_search;

            $status = $this->status_model->fetch_by_is_final(1, $this->data['eventYear']);
            $client_ids = [];
            if ($status) {
                foreach ($status as $key => $value) {
                    $client_ids[] = $value['client_id'];
                }
            }
            

            $total_rows  = 0;
            

            $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;
            if ($team_search != null) {
                $product_by_client = $this->information_model->fetch_product_by_client_ids_with_search_pagination($this->data['eventYear'], $client_ids, $stype, null, null);
                if ($product_by_client) {
                    foreach ($product_by_client as $key => $value) {
                        $team = $this->team_model->get_by_product_id($value['id']);
                        if ($team) {
                            $product_by_client[$key]['team'] = $team['name'];
                            $product_by_client[$key]['team_id'] = $team['id'];
                        }else{
                            $product_by_client[$key]['team'] = 'Chưa có';
                            $product_by_client[$key]['team_id'] = 0;
                        }
                    }

                    $new_product_by_client = array();
                    foreach ($product_by_client as $key => $value) {
                        if ( $team_search != null ) {
                            if ( $value['team_id'] == $team_search) {
                                $new_product_by_client[$key] = $value;
                            }
                        }
                    }
                    $total_rows  = count($new_product_by_client);
                }else{
                    $total_rows  = 0;
                }
            }else{
                $total_rows  = $this->information_model->count_product_by_client_ids_with_search($this->data['eventYear'], $client_ids, $stype);
            
                
            }
            $per_page = 50;
            $this->load->library('pagination');
            $config = array();
            $base_url = base_url('member/product/index');
            
            $uri_segment = 4;
            foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
                $config[$key] = $value;
            }
            $this->pagination->initialize($config);

            $this->data['page_links'] = $this->pagination->create_links();
            $result =  array();
            if ($team_search == null && $team_search == '') {
                $result = $this->information_model->fetch_product_by_client_ids_with_search_pagination($this->data['eventYear'], $client_ids, $stype, $per_page, $per_page*$this->data['page']);
            }else{
                $result = $this->information_model->fetch_product_by_client_ids_with_search_pagination($this->data['eventYear'], $client_ids, $stype, null, null);
            }
            
            foreach ($result as $key => $value) {
                $team = $this->team_model->get_by_product_id($value['id']);
                if ($team) {
                    $result[$key]['team'] = $team['name'];
                    $result[$key]['team_id'] = $team['id'];
                }else{
                    $result[$key]['team'] = 'Chưa có';
                    $result[$key]['team_id'] = 0;
                }
                $new_rating_array = $this->new_rating_model->fetch_by_product_id_submited('new_rating', $value['id'], $stype);
                $new_rating_medium = array();
                $total_rating = 0;
                if ($new_rating_array) {
                    foreach ($new_rating_array as $index => $item) {
                        $total_rating += $item['total'];
                    }
                    $rating_medium = round($total_rating / count($new_rating_array), 2);
                }
                if ($total_rating != 0) {
                    $result[$key]['rating_medium'] = $rating_medium;
                }else{
                    $result[$key]['rating_medium'] = 0;   
                    
                }
                $result[$key]['year'] = $value['year'];
            }
            if ($result) {
                foreach ($result as $key => $value) {
                    $new_rating_medium[$key] = $value['rating_medium'];
                }
            }
            if ($rating_search != '' && $rating_search != 1) {
                if ($rating_search == 2) {
                    array_multisort($new_rating_medium, SORT_DESC, $result);
                }
                if ($rating_search == 3) {
                    array_multisort($new_rating_medium, SORT_ASC, $result);
                }
            }
            $new_result = array();
            foreach ($result as $key => $value) {
                if ( $team_search != null ) {
                    if ( $value['team_id'] == $team_search) {
                        $new_result[$key] = $value;
                    }
                }
            }
            if ( $team_search != null ) {
                $result = $new_result;
            }

            if($this->data['page'] == 0){
                $number = $total_rows;
            }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
                $number = $total_rows - ($this->data['page'] * $per_page);
            }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
                $number = $total_rows - ($this->data['page'] * $per_page);
            };

            $new_rating = $this->new_rating_model->fetch_all_by_year_and_stype($this->data['eventYear'], $stype);
            $list_products_rating = [];
            if (!empty($new_rating)) {
                foreach ($new_rating as $key => $value) {
                    $list_products_rating[] = $value['product_id'];
                }
            }

            $team = $this->team_model->fetch_all_team_by_stype($this->data['eventYear'], $stype);

            // Get company name in table users 
            $clients = $this->users_model->get_all_client_by_year($this->data['eventYear']);
            $client_mapping = [];
            foreach ($clients as $key => $val) {
                $client_mapping[$val['id']] = $val['company'];
            }

            $this->data['number'] = $number;
            $this->data['stype'] = $stype;
            $this->data['list_products_rating'] = $list_products_rating;
            $this->data['team'] = $team;
            $this->data['client_mapping'] = $client_mapping;
            $this->data['result'] = $result;

            $this->render('member/list_product_by_manager_view');
        }
	}

    public function detail_rating($team_id='', $product_id=''){
        if ($this->ion_auth->user()->row()->member_role != 'manager') {
            redirect('member/','refresh');
        }
        $stype = $this->input->get('stype');
        $team = $this->team_model->fetch_by_id('team', $team_id);
        $list_team = array();
        if ($team && $team['member_id']) {
            $member_ids = explode(',', $team['member_id']);
            if ( is_array($member_ids) && !empty($member_ids) ) {
                foreach($member_ids as $k => $val){
                    if(empty($val)){
                        unset($member_ids[$k]);
                    }
                }
                $member_ids[] = $team['leader_id'];
                if($member_ids){
                    $members = $this->information_model->get_personal_members($member_ids);
                    if ($members) {
                        foreach ($members as $key => $value) {
                            $check_rating = $this->new_rating_model->check_rating_exist('new_rating', $product_id, $value['id'], $stype);
                            $rating_detail = $this->new_rating_model->fetch_by_product_id_and_member_id($product_id, $value['id'], $stype);
                            if ( $check_rating && $check_rating['is_submit'] == 1) {
                                $members[$key]['is_rating'] = 1;
                            }elseif( $check_rating && $check_rating['is_submit'] == 0){
                                $members[$key]['is_rating'] = 2;
                            }else{
                                $members[$key]['is_rating'] = 0;
                            }
                            $members[$key]['total'] = $rating_detail['total'] ? $rating_detail['total'] : 0;
                        }
                        $list_team = $members;
                    }
                }

            }
        }
        $product = $this->information_model->fetch_by_id('product' . $stype, $product_id);
        $company = $this->information_model->fetch_by_id('users', $product['client_id']);


        $rating_array = $this->new_rating_model->fetch_by_product_id_submited('new_rating', $product_id, $stype);
        $total_rating = 0;
        if ($rating_array) {
            foreach ($rating_array as $index => $item) {
                $total_rating += $item['total'];
            }
            $rating_medium = round($total_rating / count($rating_array), 2);
        }
        if ($total_rating != 0) {
            $this->data['rating_medium'] = $rating_medium;
        }else{
            $this->data['rating_medium'] = 0;   
            
        }

        $this->data['team'] = $team;
        $this->data['stype'] = $stype;
        $this->data['company'] = $company;
        $this->data['product'] = $product;
        $this->data['list_team'] = $list_team;
        $this->data['product_id'] = $product_id;
        $this->data['main_service'] = $product ? $product['main_service'] : '';
        $this->render('member/list_team_by_manager_view');
    }

    public function detail($id = null, $stype, $client_id){
        if(!$id || !$stype){
            redirect('member/dashboard', 'refresh');
        }
        // $product = $this->information_model->fetch_product_by_id('product' . $stype, $id);
        $product = $this->product1_model->fetch_product_by_user_and_id('product' . $stype, $client_id, $id);
        if(!$product){
            redirect('member/dashboard', 'refresh');
        }
        $this->data['product'] = $product;
        $this->render('member/product/detail_view' . $stype);
    }
}