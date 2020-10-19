<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Product extends Admin_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('rating_model');
		$this->load->model('new_rating_model');
        $this->load->model('team_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->model('Product1_model');
        $this->load->model('Product2_model');
        $this->load->model('Product3_model');
        $this->load->model('Product4_model');

        $this->excel = new PHPExcel();
	}

	public function index($requestYear = null, $identity = null, $stype = null){
        if($requestYear == null || $identity == null || $stype == null || !in_array($stype, array(1,2,3,4))){
            redirect('admin', 'refresh');
        }
        $table_name = 'product'.$stype;
        $model_name = 'Product'.$stype.'_model';
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/product/index');
        $total_rows = $this->{$model_name}->count_product_by_identity($identity, $this->data['eventYear']);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['allYear'] = $this->{$model_name}->getAllProductYears();
        $this->data['products'] = $this->{$model_name}->get_all_product_for_client_by_identity($identity, $requestYear, 100, 0,$table_name);

        $this->render('admin/product/list_view');
    }


    public function detail($requestYear = null, $identity = null, $id = null, $stype = null){
        if($requestYear == null || $identity == null || $id == null || $stype == null || !in_array($stype, array(1,2,3,4))){
            redirect('admin', 'refresh');
        }
        $table_name = 'product'.$stype;
        $model_name = 'Product'.$stype.'_model';

        $this->data['product'] = $this->{$model_name}->fetch_product_by_identity($identity, $requestYear, $id, $table_name);
        if(!$this->data['product']){
            redirect('admin/dashboard', 'refresh');
        }
        foreach($this->data['product'] as $key => $value){
            $this->data['product'][$key] = htmlspecialchars_decode(htmlspecialchars_decode($value));
        }

        $this->render('admin/product/detail_view_'.$stype);

    }
}