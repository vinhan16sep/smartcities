<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Information extends Admin_Controller{
	
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



    public function detail($requestYear = null, $identity = null, $stype = null){
        if($requestYear == null || $identity == null || $stype == null || !in_array($stype, array(1,2,3,4))){
            redirect('admin', 'refresh');
        }

        $this->data['submitted'] = $this->information_model->fetch_extra_by_identity('information', $identity);
        $this->data['user'] = $this->users_model->fetch_by_array(
            array('username' => $identity, 'service_type' => $stype)
        );
        if(!$this->data['user']){
            redirect('admin/dashboard', 'refresh');
        }
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($identity, $this->data['eventYear']);
        $this->render('admin/information/detail_view');

    }

}