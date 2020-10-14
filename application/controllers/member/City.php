<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class City extends Member_Controller{

    private $excel = null;
	
	function __construct(){
		parent::__construct();
		$this->load->model('information_model');

        $this->excel = new PHPExcel();
	}

	public function detail($id, $identity){
        $this->load->model('users_model');
        $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('city', $identity, $this->data['eventYear']);
        $this->render('member/city/detail_view');
	}
}