<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Team extends Admin_Controller{

    private $excel = null;
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');
        $this->load->model('team_model');
        $this->load->model('status_model');
        $this->load->model('new_rating_model');

        $this->excel = new PHPExcel();
	}

    public function index($year = null){
        if($year == null){
            redirect('admin/dashboard', 'refresh');
        }
	    $teams = $this->team_model->fetch_all_team($year);

	    $this->data['leaders'] = $this->users_model->fetch_all_leaders();
        $this->data['members'] = $this->users_model->fetch_all_members();
        $this->data['companys'] = $this->information_model->fetch_all_company_for_team(null, null, $this->data['eventYear']);
	    $_products1 = $this->information_model->get_product_for_team('product1', $this->data['eventYear']);
	    $_products2 = $this->information_model->get_product_for_team('product2', $this->data['eventYear']);
	    $_products3 = $this->information_model->get_product_for_team('product3', $this->data['eventYear']);
	    $_products4 = $this->information_model->get_product_for_team('product4', $this->data['eventYear']);
        if ($_products1) {
            foreach ($_products1 as $key => $value) {
                $user = $this->users_model->fetch_by_id($value['client_id']);
                $_products1[$key]['company'] = $user['company'];
            }
        }
        if ($_products2) {
            foreach ($_products2 as $key => $value) {
                $user = $this->users_model->fetch_by_id($value['client_id']);
                $_products2[$key]['company'] = $user['company'];
            }
        }
        if ($_products3) {
            foreach ($_products3 as $key => $value) {
                $user = $this->users_model->fetch_by_id($value['client_id']);
                $_products3[$key]['company'] = $user['company'];
            }
        }
        if ($_products4) {
            foreach ($_products4 as $key => $value) {
                $user = $this->users_model->fetch_by_id($value['client_id']);
                $_products4[$key]['company'] = $user['company'];
            }
        }
        $this->data['products1'] = $_products1;
        $this->data['products2'] = $_products2;
        $this->data['products3'] = $_products3;
        $this->data['products4'] = $_products4;
        $this->data['teams'] = $teams;
        $this->render('admin/team/list_team_view');
	}

	public function create(){
	    $name = $this->input->get('name');
	    $stype = $this->input->get('stype');

        $insert = $this->team_model->insert('team', array('name' => $name, 'stype' => $stype, 'year' => $this->data['eventYear']));
        if($insert){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $name)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi tạo nhóm hội đồng')));
    }

    public function add_team_leader(){
        $team_id = $this->input->get('team_id');
        $leader_id = $this->input->get('leader_id');

        $team = $this->team_model->fetch_by_id('team', $team_id);
        $update = $this->team_model->update('team', $team_id, array('leader_id' => $leader_id));
        if($update){

            $team_product_ids = $this->team_model->get_team_products($team_id);
            $team_products_string = explode(',', $team_product_ids[0]['product_id']);
            $team_products_array = array_filter($team_products_string, function($value){
                return $value != '';
            });
            if(!empty($team_products_array)){
                $this->new_rating_model->delete_rating($team_products_array, $team['leader_id']);
            }

            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $team['name'])));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi chọn trưởng nhóm hội đồng')));
    }

    public function add_team_member(){
        $team_id = $this->input->get('team_id');
        $member_id = $this->input->get('member_id');

        $team = $this->team_model->fetch_by_id('team', $team_id);
        $string_team_members = $team['member_id'];
        $team_members = explode(',', $team['member_id']);

        if($team['member_id'] == ''){
            $update = $this->team_model->update('team', $team_id, array('member_id' => ',' .$member_id .','));
        }else{
            if(in_array($member_id, $team_members)){
                $update = false;
            }else{
                $string_team_members .= $member_id . ',';
                $update = $this->team_model->update('team', $team_id, array('member_id' => $string_team_members));
            }
        }
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $team['name'])));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi chọn thành viên hội đồng hoặc thành viên đã tồn tại trong nhóm')));
    }

    public function remove_team_member(){
        $team_id = $this->input->get('team_id');
        $member_id = $this->input->get('member_id');

        $team = $this->team_model->fetch_by_id('team', $team_id);
        $team_members = explode(',', $team['member_id']);

        if (($key = array_search($member_id, $team_members)) !== false) {
            unset($team_members[$key]);
            $update = $this->team_model->update('team', $team_id, array('member_id' => implode(',', $team_members)));
        }
        if($update){

            $team_product_ids = $this->team_model->get_team_products($team_id);
            $team_products_string = explode(',', $team_product_ids[0]['product_id']);
            $team_products_array = array_filter($team_products_string, function($value){
                return $value != '';
            });
            if(!empty($team_products_array)){
                $this->new_rating_model->delete_rating($team_products_array, $member_id);
            }

            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $team['name'])));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi xoá thành viên hội đồng')));
    }

    public function get_products(){
        $client_id = $this->input->get('client_id');
        $user = $this->users_model->fetch_by_id($client_id);
        $table = 'product' . $user['service_type'];
        
        $products = $this->information_model->get_all_product_for_team($table, $client_id, $this->data['eventYear']);
        foreach ($products as $key => $value) {
            $check_product_in_team = $this->team_model->check_exist_product_id('team', $value['id'], $this->data['eventYear'], $user['service_type']);
            $is_company_submitted = $this->status_model->check_company_submitted($client_id, $this->data['eventYear']);
            if ( $check_product_in_team > 0 || !$is_company_submitted ) {
                unset($products[$key]);
            }
            if($user['service_type'] == 1){
                $products[$key]['title'] = $this->data['type_smart_city'][$value['field_21']];
            }elseif($user['service_type'] == 2){
                $products[$key]['title'] = $value['field_1'];
            }elseif($user['service_type'] == 3){
                $products[$key]['title'] = $value['field_1'];
            }elseif($user['service_type'] == 4){
                $products[$key]['title'] = $value['name'];
            }
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('products' => $products)));
    }

    public function get_company_city_by_stype(){
        $stype = $this->input->get('stype');
        $company_city = $this->information_model->get_company_city_by_stype($stype, $this->data['eventYear']);
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('company_city' => $company_city)));
    }

    public function add_product(){
        $team_id = $this->input->get('team_id');
        $product_id = $this->input->get('product_id');

        $team = $this->team_model->fetch_by_id('team', $team_id);
        $string_team_products = $team['product_id'];
        $team_products = explode(',', $team['product_id']);

        if($team['product_id'] == ''){
            $update = $this->team_model->update('team', $team_id, array('product_id' => ',' . $product_id . ','));
        }else{
            if(in_array($product_id, $team_products)){
                $update = false;
            }else{
                $string_team_products .= $product_id . ',';
                $update = $this->team_model->update('team', $team_id, array('product_id' => $string_team_products));
            }
        }
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $team['name'])));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi chọn sản phẩm hoặc sản phẩm đã tồn tại trong nhóm')));
    }

    public function remove_team_product(){
        $team_id = $this->input->get('team_id');
        $product_id = $this->input->get('product_id');

        $team = $this->team_model->fetch_by_id('team', $team_id);
        $team_products = explode(',', $team['product_id']);

        if (($key = array_search($product_id, $team_products)) !== false) {
            unset($team_products[$key]);
            $update = $this->team_model->update('team', $team_id, array('product_id' => implode(',', $team_products)));
        }
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $team['name'])));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi xoá thành viên hội đồng')));
    }

    public function change_name(){
        $team_id = $this->input->get('id');
        $name = $this->input->get('name');
        $update = $this->team_model->update('team', $team_id, array('name' => $name));
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => $name)));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi đổi tên nhóm hội đồng')));
    }

    public function delete_team(){
        $team_id = $this->input->get('id');
        $update = $this->team_model->update('team', $team_id, array('is_deleted' => $team_id));
        if($update){
            return $this->output->set_status_header(200)
                ->set_output(json_encode(array('name' => 'thành công')));
        }
        return $this->output->set_status_header(200)
            ->set_output(json_encode(array('message' => 'Có lỗi khi xoá nhóm hội đồng')));
    }
}