<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Analyze extends Admin_Controller{

    private $excel = null;

	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');
        $this->load->model('status_model');

        $this->excel = new PHPExcel();
	}
	
    public function index($year = null){
    	if ($year == null) {
    		redirect('admin', 'refresh');
    	}
    	$this->load->helper('form');
        $this->load->library('form_validation');
        $this->data['total_2019'] = false;
        $this->data['service'] = '';
        $this->data['year'] = $year;
        if($this->input->post('submit') == 'Xác nhận') {
            $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            if ($this->form_validation->run() == TRUE) {
            	$service_check = $this->input->post('service');
	        	$products = $this->information_model->get_all_product_by_year($year);
		        $this->data['total_2019'] = 0;
		        $this->data['service'] = $service_check[0];
		        foreach ($products as $key => $value) {
		        	// check box
		            $is_company_submitted = $this->status_model->check_company_submitted($value['client_id'], $year);
		            $service = (array)json_decode($value['service'], true);
		            if ( in_array($service_check[0], $service) && $is_company_submitted ) {
		                $this->data['total_2019'] += $value['income_2017'];
		            }
		        }
		    }
        }
	        
        $this->render('admin/analyze/index');
    }
}
