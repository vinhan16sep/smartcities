<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }

        $this->load->helper('url');
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->model('team_model');
        $this->load->library('session');

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id, $this->data['eventYear']);
        $this->data['service_types'] = [
            '1' => 'Nhóm 1: Các thành phố thông minh',
            '2' => 'Nhóm 2: Các dự án BĐS thông minh',
            '3' => 'Nhóm 3: Các dự án BĐS Công nghiệp thông minh',
            '4' => 'Nhóm 4: Giải pháp công nghệ số cho thành phố thông minh',
        ];
    }

    public function maintenance(){
        $this->render('client/city/maintenance');
    }

    public function index() {
        if($this->input->get('year')){
            $this->data['selectedYear'] = $this->input->get('year');
            // Called company but get from table city
            $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('city', $this->data['user']->username, $this->input->get('year'));
            $this->render('client/city/detail_view');
        }else{
            $this->load->library('pagination');
            $config = array();
            $base_url = base_url() . 'client/city/index';
            $total_rows = $this->information_model->count_city($this->data['user']->username);
            $per_page = 10;
            $uri_segment = 4;
            foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
                $config[$key] = $value;
            }
            $this->pagination->initialize($config);
            $this->data['page_links'] = $this->pagination->create_links();
            $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->data['companies'] =  $this->information_model->fetch_list_city_by_identity($this->data['user']->username);
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCity($this->data['user']->username, $this->data['eventYear']);
            $this->render('client/city/list_view');
        }
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('city', $this->data['user']->username, $this->input->get('year'));
        if(!empty($this->data['company'])){
            redirect('client/city/edit?year='.$this->input->get('year'), 'refresh');
        }
        
        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_company_complete();
            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/city/index', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/city/create_view');
            } else {
                if ($this->input->post()) {
                    $data = $this->generate_data('create', $this->input->post());
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }

                    $insert = $this->information_model->insert_company('city', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/city/index?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_company_temporary();

            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/city/index', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/city/create_view');
            }else{
                if ($this->input->post()) {
                    $data = $this->generate_data('create', $this->input->post());
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }

                    $insert = $this->information_model->insert_company('city', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/city/index?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }
    }

    public function edit($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_company_complete();

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                // Called company but get from table city
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('city', $this->data['user']->username, $this->input->get('year'));
                $this->data['year'] = $this->input->get('year');
                if (!$this->data['company']) {
                    redirect('client/city/index', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/city/index', 'refresh');
                }
                $this->render('client/city/edit_view');
            } else {
                if ($this->input->post()) {
                    $data = $this->generate_data('edit', $this->input->post());
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }

                    try {
                        $this->information_model->update_by_information_and_year('city', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/city/index?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_company_temporary();

            if ($this->form_validation->run() == FALSE) {
                // Called company but get from table city
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('city', $this->data['user']->username, $this->input->get('year'));
                $this->data['year'] = $this->input->get('year');
                if (!$this->data['company']) {
                    redirect('client/city/index', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/city/index', 'refresh');
                }
                $this->render('client/city/edit_view');
            } else {
                if ($this->input->post()) {

                    $data = $this->generate_data('edit', $this->input->post());
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }
                    try {
                        $this->information_model->update_by_information_and_year('city', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/city/index?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }

    }

    function check_file_selected(){
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_message(__FUNCTION__, 'Data không được trống');
            return false;
        }else{
            return true;
        }
    }

    public function set_final(){
        $this->status_model->update('status', $this->data['user']->id, array('is_final' => 1));
        redirect('client/dashboard', 'refresh');
    }

    protected function check_img($filename, $filesize){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('jpg', 'jpeg', 'png', 'gif');
        if( !in_array($fileextension, $array_image) || $filesize > 1228800){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng hoặc dung lượng ảnh vượt quá 1200Kb');
            redirect('client/information/extra');
        }
    }
    protected function check_file($filename){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('docx', 'doc', 'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'pdf');
        if( !in_array($fileextension, $array_image)){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng');
            redirect('client/information/products');
        }
    }

    private function generate_data($mode, $post_requests){
        $data = array(
            'field_1' => isset($post_requests['field_1']) ? $post_requests['field_1'] : null,
            'field_2' => isset($post_requests['field_2']) ? $post_requests['field_2'] : null,
            'field_3' => isset($post_requests['field_3']) ? $post_requests['field_3'] : null,
            'field_4' => isset($post_requests['field_4']) ? $post_requests['field_4'] : null,
            'field_5' => isset($post_requests['field_5']) ? $post_requests['field_5'] : null,
            'field_6' => isset($post_requests['field_6']) ? $post_requests['field_6'] : null,
            'field_7' => isset($post_requests['field_7']) ? $post_requests['field_7'] : null,
            'field_8' => isset($post_requests['field_8']) ? $post_requests['field_8'] : null,
            'field_9' => isset($post_requests['field_9']) ? $post_requests['field_9'] : null,
            'field_10' => isset($post_requests['field_10']) ? $post_requests['field_10'] : null,
            'field_11' => isset($post_requests['field_11']) ? $post_requests['field_11'] : null,
            'field_12' => isset($post_requests['field_12']) ? $post_requests['field_12'] : null,
            'field_13' => isset($post_requests['field_13']) ? $post_requests['field_13'] : null,
            'field_14' => isset($post_requests['field_14']) ? $post_requests['field_14'] : null,
            'field_15' => isset($post_requests['field_15']) ? $post_requests['field_15'] : null,
            'field_16' => isset($post_requests['field_16']) ? $post_requests['field_16'] : null,
            'field_17' => isset($post_requests['field_17']) ? $post_requests['field_17'] : null,
            'field_18' => isset($post_requests['field_18']) ? $post_requests['field_18'] : null,
            'field_19' => isset($post_requests['field_19']) ? $post_requests['field_19'] : null,
            'modified_at' => $this->author_info['modified_at'],
            'modified_by' => $this->author_info['modified_by']
        );
        if($mode === 'create'){
            $data['client_id'] = $this->data['user']->id;
            $data['identity'] = $this->data['user']->username;
            $data['year'] = $this->data['eventYear'];
            $data['created_at'] = $this->author_info['created_at'];
            $data['created_by'] = $this->author_info['created_by'];
        }
        return $data;
    }

    private function validate_company_complete(){
        $this->form_validation->set_rules('field_1', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_2', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_3', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_4', 'Nội dung   ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_5', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_6', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_7', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_8', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_9', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_10', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_11', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_12', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_13', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_14', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        ///////////////
        $this->form_validation->set_rules('field_15', 'Tổng thu ngân sách ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_16', 'Tổng thu ngân sách ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_17', 'Tốc độ tăng trưởng kinh tế ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_18', 'Tốc độ tăng trưởng kinh tế ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        ///////////////
        $this->form_validation->set_rules('field_19', 'Nội dung ' . $this->data['rule3Year'][0], 'trim|required', array(
            'required' => '%s không được trống.'
        ));
    }

    private function validate_company_temporary(){
        $this->form_validation->set_rules('field_15', 'Tổng thu ngân sách ' . $this->data['rule3Year'][1], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_16', 'Tổng thu ngân sách ' . $this->data['rule3Year'][2], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_17', 'Tốc độ tăng trưởng kinh tế ' . $this->data['rule3Year'][1], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('field_18', 'Tốc độ tăng trưởng kinh tế ' . $this->data['rule3Year'][2], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
    }
}
