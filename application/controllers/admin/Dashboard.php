<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('information_model');
    }

    public function index(){
    	$this->load->model('users_model');

    	/* Total companys */
    	$total_companys = $this->information_model->count_companys($this->data['eventYear']);

    	/* total clients */
    	$total_users = $this->users_model->count_all_users_groups();
    	
    	/* total products */
    	$this->data['total_products1'] = $this->information_model->count_all_current_year_product('product1', $this->data['eventYear']);
    	
    	$this->data['total_products2'] = $this->information_model->count_all_current_year_product('product2', $this->data['eventYear']);
    	$this->data['total_products3'] = $this->information_model->count_all_current_year_product('product3', $this->data['eventYear']);
    	$this->data['total_products4'] = $this->information_model->count_all_current_year_product('product4', $this->data['eventYear']);
    	
    	
    	$this->data['total_products1'] = $this->information_model->count_all_current_year_product('product1', $this->data['eventYear']);
    	
    // 	update data product1,2,3,4
    // 	$company = $this->information_model->fetch_all1('product4');
    // 	foreach($company as $key => $value){
    // 	    foreach($value as $k => $v){
    // 	        $value[$k] = htmlspecialchars_decode(htmlspecialchars_decode(htmlspecialchars_decode(htmlspecialchars_decode(htmlspecialchars_decode($v)))));
    // 	    }
    // 	    $this->information_model->update_by_ids('product4', $value['id'], $value);
    // 	}

    	$this->data['total_companys'] = $total_companys;
    	$this->data['total_users'] = $total_users;
        $this->render('admin/dashboard_view');
    }
}