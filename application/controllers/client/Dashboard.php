<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Client_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }


        $this->load->model('information_model');

        $this->load->model('product1_model');
        $this->load->model('product2_model');
        $this->load->model('product3_model');
        $this->load->model('product4_model');

        $this->load->model('status_model');
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id, $this->data['eventYear']);
        if(empty($this->data['reg_status'])){
            $status = array(
                'client_id' => $this->data['user']->id,
                'is_information' => 1,
                'is_company' => 0,
                'is_product' => 0,
                'is_final' => 0,
                'year' => $this->data['eventYear'],
            );
            $this->status_model->insert('status', $status);
        }
    }

    public function index(){
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['information_submitted'] = $this->information_model->fetch_extra_by_identity('information', $this->data['user']->username);
        if ($this->data['user']->service_type != 1) {
            $this->data['company_submitted'] = $this->information_model->fetch_list_company_by_identity_and_year($this->data['user']->username, $this->data['eventYear']);
        } else {
            $this->data['company_submitted'] = $this->information_model->fetch_list_city_by_identity_and_year($this->data['user']->username, $this->data['eventYear']);
        }
        if($this->data['user_service_type'] == '4'){
            $this->data['count_product'] = $this->product4_model->count_product($this->data['user']->id, $this->data['eventYear']);
        } elseif ($this->data['user_service_type'] == '2'){
            $this->data['count_product'] = $this->product2_model->count_product($this->data['user']->id, $this->data['eventYear']);
        } elseif ($this->data['user_service_type'] == '3'){
            $this->data['count_product'] = $this->product3_model->count_product($this->data['user']->id, $this->data['eventYear']);
        } else {
            $this->data['count_product'] = $this->product1_model->count_product($this->data['user']->id, $this->data['eventYear']);
        }

        $checkInformation = $this->information_model->checkExist('information', $this->data['user']->username);
        if ($this->data['user']->service_type != 1) {
            $checkCompany = $this->information_model->checkExist('company', $this->data['user']->username);
        } else {
            $checkCompany = $this->information_model->checkExist('city', $this->data['user']->username);
        }
        if($this->data['user_service_type'] == '4'){
            $checkProduct = $this->product4_model->checkExistProduct('product4', $this->data['user']->username);
        } elseif ($this->data['user_service_type'] == '2'){
            $checkProduct = $this->product2_model->checkExistProduct('product2', $this->data['user']->username);
        } elseif ($this->data['user_service_type'] == '3'){
            $checkProduct = $this->product3_model->checkExistProduct('product3', $this->data['user']->username);
        } else {
            $checkProduct = $this->product1_model->checkExistProduct('product1', $this->data['user']->username);
        }
        $this->data['complete'] = 0;
        if($checkInformation > 0 && $checkCompany > 0 && $checkProduct > 0){
            $this->data['complete'] = 1;
        }

        $this->data['noMoreTemporaryData'] = 0;
        if($this->data['reg_status']['is_information'] == 1 && $this->data['reg_status']['is_company'] == 1 && $this->data['reg_status']['is_product'] == 1){
            $this->data['noMoreTemporaryData'] = 1;
        }

        $this->render('client/dashboard_view');
    }
}