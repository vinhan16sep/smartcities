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
            $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
            $this->render('client/company/detail_view');
        }else{
            $this->load->library('pagination');
            $config = array();
            $base_url = base_url() . 'client/company/index';
            $total_rows = $this->information_model->count_companies($this->data['user']->username);
            $per_page = 10;
            $uri_segment = 4;
            foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
                $config[$key] = $value;
            }
            $this->pagination->initialize($config);
            $this->data['page_links'] = $this->pagination->create_links();
            $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->data['companies'] =  $this->information_model->fetch_list_company_by_identity($this->data['user']->username);
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
            $this->render('client/company/list_view');
        }
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_company_complete();
            if ($this->form_validation->run() === FALSE) {
                if($this->data['reg_status']['is_information'] == 0){
                    $this->session->set_flashdata('need_input_information_first', 'Cần nhập thông tin cơ bản của doanh nghiệp trước (tại đây)');
                    redirect('client/information/create_extra', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/company/index', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/company/create_view');
            } else {
                if ($this->input->post()) {
                    $data = $this->generate_data('create', $this->input->post());

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/company/index?year=' . $this->data['eventYear'], 'refresh');
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
                    redirect('client/company/index', 'refresh');
                }
                $this->data['year'] = $this->input->get('year');
                $this->render('client/company/create_view');
            }else{
                if ($this->input->post()) {
                    $data = $this->generate_data('create', $this->input->post());

                    $insert = $this->information_model->insert_company('company', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/company/index?year=' . $this->data['eventYear'], 'refresh');
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
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
                if (!$this->data['company']) {
                    redirect('client/company/index', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/company/index', 'refresh');
                }
                $this->render('client/company/edit_view');
            } else {
                if ($this->input->post()) {
                    $data = $this->generate_data('edit', $this->input->post());

                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_company' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/company/index?year=' . $this->data['eventYear'], 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_company_temporary();

            if ($this->form_validation->run() == FALSE) {
                $this->data['company'] = $this->information_model->fetch_company_by_identity_and_year('company', $this->data['user']->username, $this->input->get('year'));
                if (!$this->data['company']) {
                    redirect('client/company/index', 'refresh');
                }
                if($this->data['reg_status'] == 1){
                    redirect('client/information', 'refresh');
                }
                if($this->data['eventYear'] != $this->input->get('year')){
                    redirect('client/company/index', 'refresh');
                }
                $this->render('client/company/edit_view');
            } else {
                if ($this->input->post()) {

                    $data = $this->generate_data('edit', $this->input->post());
                    try {
                        $this->information_model->update_by_information_and_year('company', $this->data['user']->username, $this->data['eventYear'], $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }

                    redirect('client/company/index?year=' . $this->data['eventYear'], 'refresh');
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
        $main_service = isset($post_requests['main_service']) ? json_encode($post_requests['main_service']) : null;
        $main_market = isset($post_requests['main_market']) ? json_encode($post_requests['main_market']) : null;
        $data = array(
            'equity_1' => isset($post_requests['equity_1']) ? $post_requests['equity_1'] : null,
            'equity_2' => isset($post_requests['equity_2']) ? $post_requests['equity_2'] : null,
            'equity_3' => isset($post_requests['equity_3']) ? $post_requests['equity_3'] : null,
            'owner_equity_1' => isset($post_requests['owner_equity_1']) ? $post_requests['owner_equity_1'] : null,
            'owner_equity_2' => isset($post_requests['owner_equity_2']) ? $post_requests['owner_equity_2'] : null,
            'owner_equity_3' => isset($post_requests['owner_equity_3']) ? $post_requests['owner_equity_3'] : null,
            'total_income_1' => isset($post_requests['total_income_1']) ? $post_requests['total_income_1'] : null,
            'total_income_2' => isset($post_requests['total_income_2']) ? $post_requests['total_income_2'] : null,
            'total_income_3' => isset($post_requests['total_income_3']) ? $post_requests['total_income_3'] : null,
            'software_income_1' => isset($post_requests['software_income_1']) ? $post_requests['software_income_1'] : null,
            'software_income_2' => isset($post_requests['software_income_2']) ? $post_requests['software_income_2'] : null,
            'software_income_3' => isset($post_requests['software_income_3']) ? $post_requests['software_income_3'] : null,
            'it_income_1' => isset($post_requests['it_income_1']) ? $post_requests['it_income_1'] : null,
            'it_income_2' => isset($post_requests['it_income_2']) ? $post_requests['it_income_2'] : null,
            'it_income_3' => isset($post_requests['it_income_3']) ? $post_requests['it_income_3'] : null,
            'export_income_1' => isset($post_requests['export_income_1']) ? $post_requests['export_income_1'] : null,
            'export_income_2' => isset($post_requests['export_income_2']) ? $post_requests['export_income_2'] : null,
            'export_income_3' => isset($post_requests['export_income_3']) ? $post_requests['export_income_3'] : null,
            'candidate_income_1' => isset($post_requests['candidate_income_1']) ? $post_requests['candidate_income_1'] : null,
            'candidate_income_2' => isset($post_requests['candidate_income_2']) ? $post_requests['candidate_income_2'] : null,
            'candidate_income_3' => isset($post_requests['candidate_income_3']) ? $post_requests['candidate_income_3'] : null,
            'total_labor_1' => isset($post_requests['total_labor_1']) ? $post_requests['total_labor_1'] : null,
            'total_labor_2' => isset($post_requests['total_labor_2']) ? $post_requests['total_labor_2'] : null,
            'total_labor_3' => isset($post_requests['total_labor_3']) ? $post_requests['total_labor_3'] : null,
            'total_ltv_1' => isset($post_requests['total_ltv_1']) ? $post_requests['total_ltv_1'] : null,
            'total_ltv_2' => isset($post_requests['total_ltv_2']) ? $post_requests['total_ltv_2'] : null,
            'total_ltv_3' => isset($post_requests['total_ltv_3']) ? $post_requests['total_ltv_3'] : null,
            'description' => isset($post_requests['description']) ? $post_requests['description'] : null,
            'linhvuckd' => isset($post_requests['linhvuckd']) ? $post_requests['linhvuckd'] : null,
            'themanh' => isset($post_requests['themanh']) ? $post_requests['themanh'] : null,
            'main_service' => $main_service,
            'main_market' => $main_market,
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
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
        }
        $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        if($this->data['user_service_type'] != '2' && $this->data['user_service_type'] != '3') {
            if($this->data['user_service_type'] == '4') {
                $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                    'required' => '%s không được trống.',
                    'numeric' => '%s phải là số.',
                    'max_length' => 'Tối đa 10 chữ số'
                ));
            }
            $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
        }
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
        }
        $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('candidate_income_1', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
        }
        $this->form_validation->set_rules('candidate_income_2', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('candidate_income_3', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động ' . $this->data['rule3Year'][0], 'trim|required|numeric', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
            ));
        }
        $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động ' . $this->data['rule3Year'][1], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động ' . $this->data['rule3Year'][2], 'trim|required|numeric', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
        ));
        // When user select user_service_type = 2
        // if($this->data['user_service_type'] == '2') {
        //     $this->form_validation->set_rules('linhvuckd', 'Lĩnh vực kinh doanh ' . $this->data['rule3Year'][1], 'trim|max_word[200]', array(
        //         'max_word' => '%s Tối đa 200 từ'
        //     ));
        //     $this->form_validation->set_rules('themanh', 'Thế mạnh ' . $this->data['rule3Year'][2], 'trim|max_word[200]', array(
        //         'max_word' => '%s Tối đa 200 từ'
        //     ));
        // }
        // When user select user_service_type = 4
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|required|numeric|max_length[10]', array(
                'required' => '%s không được trống.',
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|required|integer', array(
                'required' => '%s không được trống.',
                'integer' => '%s phải là số nguyên.',
            ));
            $this->form_validation->set_rules('main_service[]', 'Sản phẩm dịch vụ chính của doanh nghiệp', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
            $this->form_validation->set_rules('main_market[]', 'Thị trường chính', 'trim|required', array(
                'required' => '%s không được trống.'
            ));
        }
        // When user select user_service_type = 4
    }

    private function validate_company_temporary(){
        $this->form_validation->set_rules('equity_1', 'Vốn điều lệ ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('equity_2', 'Vốn điều lệ ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('equity_3', 'Vốn điều lệ ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('owner_equity_1', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('owner_equity_2', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('owner_equity_3', 'Vốn chủ sở hữu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('total_income_1', 'Tổng doanh thu DN ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('total_income_2', 'Tổng doanh thu DN ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('total_income_3', 'Tổng doanh thu DN ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('candidate_income_1', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('candidate_income_2', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('candidate_income_3', 'Tổng doanh thu lĩnh vực ứng cử ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('total_labor_1', 'Tổng số lao động của DN ' . $this->data['rule3Year'][0], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('total_labor_2', 'Tổng số lao động của DN ' . $this->data['rule3Year'][1], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));
        $this->form_validation->set_rules('total_labor_3', 'Tổng số lao động của DN ' . $this->data['rule3Year'][2], 'trim|numeric', array(
            'numeric' => '%s phải là số.',
        ));

        // When user select user_service_type = 2
        // if($this->data['user_service_type'] == '2') {
        //     $this->form_validation->set_rules('linhvuckd', 'Lĩnh vực kinh doanh ' . $this->data['rule3Year'][1], 'trim|max_word[200]', array(
        //         'max_word' => '%s Tối đa 200 từ'
        //     ));
        //     $this->form_validation->set_rules('themanh', 'Thế mạnh ' . $this->data['rule3Year'][2], 'trim|max_word[200]', array(
        //         'max_word' => '%s Tối đa 200 từ'
        //     ));
        // }
        // When user select user_service_type = 4
        if($this->data['user_service_type'] == '4') {
            $this->form_validation->set_rules('software_income_1', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_2', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('software_income_3', 'Tổng DT lĩnh vực sx phần mềm ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_1', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_2', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('it_income_3', 'Tổng doanh thu dịch vụ CNTT ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_1', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][0], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_2', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][1], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('export_income_3', 'Tổng DT xuất khẩu ' . $this->data['rule3Year'][2], 'trim|numeric|max_length[10]', array(
                'numeric' => '%s phải là số.',
                'max_length' => 'Tối đa 10 chữ số'
            ));
            $this->form_validation->set_rules('total_ltv_1', 'Tổng số LTV ' . $this->data['rule3Year'][0], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_2', 'Tổng số LTV ' . $this->data['rule3Year'][1], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
            $this->form_validation->set_rules('total_ltv_3', 'Tổng số LTV ' . $this->data['rule3Year'][2], 'trim|numeric', array(
                'numeric' => '%s phải là số.',
            ));
        }
        // When user select user_service_type = 4
    }
}
