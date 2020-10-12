<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends Client_Controller {

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

    public function index() {
        $this->data['submitted'] = $this->information_model->fetch_by_user_id('information', $this->data['user']->id);
        if ($this->data['user']->service_type != 1) {
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
        } else {
            $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCity($this->data['user']->username, $this->data['eventYear']);
        }

        $this->render('client/information/detail_extra_view');
    }

    public function extra() {
        $this->data['submitted'] = $this->information_model->fetch_extra_by_identity('information', $this->data['user']->username);
        $this->data['hasCurrentYearCompanyData'] = $this->information_model->getCurrentYearCompany($this->data['user']->username, $this->data['eventYear']);
        $this->render('client/information/detail_extra_view');
    }

    public function create_extra() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        // VALIDATION
        $this->validate_extra();

        if ($this->form_validation->run() == FALSE) {
            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }
            $this->data['identity'] = $this->input->get('identity');
            $exist = $this->information_model->check_exist_information($this->input->get('identity'));
            if(!empty($exist)){
                $this->data['exist'] = $exist;
            }
            $this->render('client/information/create_extra_view');
        } else {
            if ($this->input->post()) {
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }
                $data = array(
                    'client_id' => $this->data['user']->id,
                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),
                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),
                    'website' => $this->input->post('website'),
                    'address' => $this->input->post('address'),
                    'link' => $this->input->post('link'),
                    'identity' => $this->data['user']->username,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );
                if (!empty($avatar)) {
                    $data['avatar'] = $avatar;
                }
                $exist = $this->information_model->check_exist_information($this->data['user']->username);
                if(!empty($exist)){
                    unset($data['created_at']);
                    unset($data['created_by']);
                    $update = $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1, 'year' => $this->data['eventYear']));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $exist['id']));
                }else{
                    $insert = $this->information_model->insert('information', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    $this->users_model->update('users', $this->data['user']->id, array('information_id' => $insert));
                    $this->session->set_flashdata('message', 'Item added successfully');
                }

                redirect('client/information/extra', 'refresh');
            }
        }
    }

    public function edit_extra($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        // VALIDATION
        $this->validate_extra();

        $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
        $this->data['extra'] = $this->information_model->fetch_by_user_identity('information', $this->data['user']->username);
        if ($this->form_validation->run() == FALSE) {

            if (!$this->data['extra']) {
                redirect('client/information', 'refresh');
            }

            if($this->data['reg_status'] == 1){
                redirect('client/information', 'refresh');
            }

            $this->render('client/information/edit_extra_view');
        } else {
            if ($this->input->post()) {
                $avatar = '';
                if(!empty($_FILES['avatar']['name'])){
                    $this->check_img($_FILES['avatar']['name'], $_FILES['avatar']['size']);
                    $avatar = $this->upload_avatar('avatar', 'assets/upload/avatar', $_FILES['avatar']['name']);
                }

                $data = array(
                    'legal_representative' => $this->input->post('legal_representative'),
                    'lp_position' => $this->input->post('lp_position'),
                    'lp_email' => $this->input->post('lp_email'),
                    'lp_phone' => $this->input->post('lp_phone'),
                    'connector' => $this->input->post('connector'),
                    'c_position' => $this->input->post('c_position'),
                    'c_email' => $this->input->post('c_email'),
                    'c_phone' => $this->input->post('c_phone'),
                    'website' => $this->input->post('website'),
                    'address' => $this->input->post('address'),
                    'link' => $this->input->post('link'),
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($avatar) {
                    $data = array('avatar' => $avatar);
                }

                try {
                    $this->information_model->update_by_identity('information', $this->data['user']->username, $data);
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_information' => 1));
                    if ( file_exists('assets/upload/avatar/' . $this->data['extra']['avatar']) && $avatar !='' ) {
                        unlink('assets/upload/avatar/' . $this->data['extra']['avatar']);
                    }
                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('client/information/extra', 'refresh');
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

    function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);
        $str = str_replace('.','-',$str);
        $str = str_replace(':','-',$str);

        return $str;

    }

    private function validate_extra(){
        $this->form_validation->set_rules('legal_representative', 'Tên người đại diện pháp luật', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_position', 'Chức danh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('connector', 'Tên người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('c_position', 'Chức danh người liên hệ với BTC', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('lp_email', 'Email', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('lp_phone', 'Di động', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));

        $this->form_validation->set_rules('c_email', 'Email người liên hệ với BTC', 'trim|required|valid_email', array(
            'required' => '%s không được trống.',
            'valid_email' => 'Định dạng email không đúng.',
        ));
        $this->form_validation->set_rules('c_phone', 'Di động người liên hệ với BTC', 'trim|required|integer|min_length[10]|max_length[12]', array(
            'required' => '%s không được trống.',
            'integer' => '%s phải là số nguyên.',
            'min_length' => '%s tối thiểu %s ký tự.',
            'max_length' => '%s tối đa %s ký tự.',
        ));
        $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('link', 'Link download PĐK của DN', 'trim|required');
    }
}
