<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product3 extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }


        $this->load->model('product3_model');

        $this->load->helper('url');
        $this->load->model('information_model');
        $this->load->model('status_model');
        $this->load->model('users_model');
        $this->load->model('team_model');
        $this->load->library('session');

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['reg_status'] = $this->status_model->fetch_by_client_id($this->data['user']->id, $this->data['eventYear']);
        $this->data['ctrl_name'] = 'product' . ($this->data['user_service_type']);
    }

    public function products(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'client/product3/products';
        $total_rows = $this->product3_model->count_product($this->data['user']->id, $this->data['eventYear']);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['allYear'] = $this->product3_model->getAllProductYears();
        $this->data['products'] = $this->product3_model->get_all_product_for_client($this->data['user']->id, $per_page, $this->data['page'], 'product3');

        $this->render('client/product3/list_view');
    }

    public function detail_product($id = NULL){
        $this->data['product'] = $this->product3_model->fetch_product_by_user_and_id($this->data['ctrl_name'], $this->data['user']->id, $id);
        if(!empty($this->data['product'])){
            foreach($this->data['product'] as $key => $value){
                $this->data['product'][$key] = htmlspecialchars_decode(htmlspecialchars_decode($value));
            }
        }
        $this->render('client/product3/detail_view');
    }

    public function remove_product($id = null){
        // Check if product has registered in table [team]
        // NEED TO CHECK AGAIN, BECAUSE NOW HAVE 4 TABLES FOR PRODUCT =============================================
        $check_product_in_team = $this->team_model->check_exist_product_id('team', $id, $this->data['eventYear'], $this->data['user']->service_type);
        // NEED TO CHECK AGAIN, BECAUSE NOW HAVE 4 TABLES FOR PRODUCT =============================================
        if ( $check_product_in_team > 0 ) {
            $this->session->set_flashdata('message_error', 'Sản phẩm đã được đăng ký vào danh sách ứng cử');
            redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
        }else{
            $deleted = $this->product3_model->delete($this->data['ctrl_name'], $id);
            if ($deleted) {
                $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
                redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
            }else{
                $this->session->set_flashdata('message_error', 'Có lỗi trong quá trình xóa sản phẩm');
                redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
            }
        }
    }

    public function create_product(){
        if (isset($this->data['service_types'][$this->data['user']->service_type])){
            $this->data['user_service_types'] = $this->data['service_types'][$this->data['user']->service_type];
        } else {
            redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_product_complete();
            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product3/create_view');
            } else {
                if ($this->input->post()) {
                    // if(!empty($_FILES['file']['name'])){
                    //     $this->check_file($_FILES['file']['name']);
                    //     $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    // }

                    // $service = json_encode($this->input->post('service'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        // 'service' => $service,

                        'field_1' => $this->input->post('field_1'),
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => json_encode($this->input->post('field_3')),
                        'field_4' => $this->input->post('field_4'),
                        'field_5' => $this->input->post('field_5'),
                        'field_6' => $this->input->post('field_6'),
                        'field_7' => $this->input->post('field_7'),
                        'field_8' => $this->input->post('field_8'),
                        'field_9' => $this->input->post('field_9'),
                        'field_10' => $this->input->post('field_10'),
                        'field_11' => $this->input->post('field_11'),
                        'field_12' => $this->input->post('field_12'),
                        'field_13' => $this->input->post('field_13'),
                        'field_14' => $this->input->post('field_14'),
                        'field_15' => $this->input->post('field_15'),
                        'field_16' => $this->input->post('field_16'),
                        'field_17' => $this->input->post('field_17'),
                        'field_18' => $this->input->post('field_18'),
                        'field_19' => $this->input->post('field_19'),
                        'field_20' => $this->input->post('field_20'),
                        'field_21' => $this->input->post('field_21'),
                        'field_22' => $this->input->post('field_22'),
                        'field_23' => $this->input->post('field_23'),
                        'field_24' => $this->input->post('field_24'),
                        'field_25' => $this->input->post('field_25'),
                        'field_26' => $this->input->post('field_26'),
                        'field_27' => $this->input->post('field_27'),
                        'field_28' => $this->input->post('field_28'),
                        'field_29' => $this->input->post('field_29'),
                        'field_30' => $this->input->post('field_30'),
                        'field_31' => $this->input->post('field_31'),
                        'field_32' => $this->input->post('field_32'),
                        'field_33' => $this->input->post('field_33'),

                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }
                    $insert = $this->product3_model->insert_product($this->data['ctrl_name'], $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_product_temporary();
            // var_dump($this->form_validation->run());die;

            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product3/create_view');
            } else {
                if ($this->input->post()) {

                    // if(!empty($_FILES['file']['name'])){
                    //     $this->check_file($_FILES['file']['name']);
                    //     $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    // }
                    // $image = $this->upload_image('certificate', $_FILES['certificate']['name'], 'assets/upload/product', 'assets/upload/product/thumbs');
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        // 'service' => $service,

                        'field_1' => $this->input->post('field_1'),
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => json_encode($this->input->post('field_3')),
                        'field_4' => $this->input->post('field_4'),
                        'field_5' => $this->input->post('field_5'),
                        'field_6' => $this->input->post('field_6'),
                        'field_7' => $this->input->post('field_7'),
                        'field_8' => $this->input->post('field_8'),
                        'field_9' => $this->input->post('field_9'),
                        'field_10' => $this->input->post('field_10'),
                        'field_11' => $this->input->post('field_11'),
                        'field_12' => $this->input->post('field_12'),
                        'field_13' => $this->input->post('field_13'),
                        'field_14' => $this->input->post('field_14'),
                        'field_15' => $this->input->post('field_15'),
                        'field_16' => $this->input->post('field_16'),
                        'field_17' => $this->input->post('field_17'),
                        'field_18' => $this->input->post('field_18'),
                        'field_19' => $this->input->post('field_19'),
                        'field_20' => $this->input->post('field_20'),
                        'field_21' => $this->input->post('field_21'),
                        'field_22' => $this->input->post('field_22'),
                        'field_23' => $this->input->post('field_23'),
                        'field_24' => $this->input->post('field_24'),
                        'field_25' => $this->input->post('field_25'),
                        'field_26' => $this->input->post('field_26'),
                        'field_27' => $this->input->post('field_27'),
                        'field_28' => $this->input->post('field_28'),
                        'field_29' => $this->input->post('field_29'),
                        'field_30' => $this->input->post('field_30'),
                        'field_31' => $this->input->post('field_31'),
                        'field_32' => $this->input->post('field_32'),
                        'field_33' => $this->input->post('field_33'),

                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }
                    $insert = $this->product3_model->insert_product($this->data['ctrl_name'], $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
                }
            }
        }

    }

    public function edit_product($request_id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_product_complete();

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->product3_model->fetch_product_by_user_id($this->data['ctrl_name'], $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
                }
                $this->render('client/product3/edit_view');
            } else {
                if ($this->input->post()) {
                    // if(!empty($_FILES['file']['name'])){
                    //     $this->check_file($_FILES['file']['name']);
                    //     $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    // }
                    // $service = json_encode($this->input->post('service'));
                    $data = array(
                        // 'service' => $service,
                        
                        'field_1' => $this->input->post('field_1'),
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => json_encode($this->input->post('field_3')),
                        'field_4' => $this->input->post('field_4'),
                        'field_5' => $this->input->post('field_5'),
                        'field_6' => $this->input->post('field_6'),
                        'field_7' => $this->input->post('field_7'),
                        'field_8' => $this->input->post('field_8'),
                        'field_9' => $this->input->post('field_9'),
                        'field_10' => $this->input->post('field_10'),
                        'field_11' => $this->input->post('field_11'),
                        'field_12' => $this->input->post('field_12'),
                        'field_13' => $this->input->post('field_13'),
                        'field_14' => $this->input->post('field_14'),
                        'field_15' => $this->input->post('field_15'),
                        'field_16' => $this->input->post('field_16'),
                        'field_17' => $this->input->post('field_17'),
                        'field_18' => $this->input->post('field_18'),
                        'field_19' => $this->input->post('field_19'),
                        'field_20' => $this->input->post('field_20'),
                        'field_21' => $this->input->post('field_21'),
                        'field_22' => $this->input->post('field_22'),
                        'field_23' => $this->input->post('field_23'),
                        'field_24' => $this->input->post('field_24'),
                        'field_25' => $this->input->post('field_25'),
                        'field_26' => $this->input->post('field_26'),
                        'field_27' => $this->input->post('field_27'),
                        'field_28' => $this->input->post('field_28'),
                        'field_29' => $this->input->post('field_29'),
                        'field_30' => $this->input->post('field_30'),
                        'field_31' => $this->input->post('field_31'),
                        'field_32' => $this->input->post('field_32'),
                        'field_33' => $this->input->post('field_33'),

                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by'],
                    );
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }
                    try {
                        $this->product3_model->update_product($this->data['ctrl_name'], $this->data['user']->id, $id, $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_product_temporary();
            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->product3_model->fetch_product_by_user_id($this->data['ctrl_name'], $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/' . $this->data['ctrl_name'] . '/product', 'refresh');
                }
                $this->render('client/product3/edit_view');
            } else {
                if ($this->input->post()) {
                    // if(!empty($_FILES['file']['name'])){
                    //     $this->check_file($_FILES['file']['name']);
                    //     $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    // }
                    // $service = json_encode($this->input->post('service'));
                    // echo "<pre>";
                    // print_r($this->input->post());
                    // echo "<pre>";die;
                    $data = array(
                        // 'service' => $service,

                        'field_1' => $this->input->post('field_1'),
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => json_encode($this->input->post('field_3')),
                        'field_4' => $this->input->post('field_4'),
                        'field_5' => $this->input->post('field_5'),
                        'field_6' => $this->input->post('field_6'),
                        'field_7' => $this->input->post('field_7'),
                        'field_8' => $this->input->post('field_8'),
                        'field_9' => $this->input->post('field_9'),
                        'field_10' => $this->input->post('field_10'),
                        'field_11' => $this->input->post('field_11'),
                        'field_12' => $this->input->post('field_12'),
                        'field_13' => $this->input->post('field_13'),
                        'field_14' => $this->input->post('field_14'),
                        'field_15' => $this->input->post('field_15'),
                        'field_16' => $this->input->post('field_16'),
                        'field_17' => $this->input->post('field_17'),
                        'field_18' => $this->input->post('field_18'),
                        'field_19' => $this->input->post('field_19'),
                        'field_20' => $this->input->post('field_20'),
                        'field_21' => $this->input->post('field_21'),
                        'field_22' => $this->input->post('field_22'),
                        'field_23' => $this->input->post('field_23'),
                        'field_24' => $this->input->post('field_24'),
                        'field_25' => $this->input->post('field_25'),
                        'field_26' => $this->input->post('field_26'),
                        'field_27' => $this->input->post('field_27'),
                        'field_28' => $this->input->post('field_28'),
                        'field_29' => $this->input->post('field_29'),
                        'field_30' => $this->input->post('field_30'),
                        'field_31' => $this->input->post('field_31'),
                        'field_32' => $this->input->post('field_32'),
                        'field_33' => $this->input->post('field_33'),

                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    foreach($data as $key => $value){
                        $data[$key] = htmlspecialchars_decode($value);
                    }
                    try {
                        $this->product3_model->update_product($this->data['ctrl_name'], $this->data['user']->id, $id, $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
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

    protected function check_file($filename){
        $map = strripos($filename, '.')+1;
        $fileextension = substr($filename, $map,(strlen($filename)-$map));
        $array_image = array('docx', 'doc', 'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xls', 'pdf');
        if( !in_array($fileextension, $array_image)){
            $this->session->set_flashdata('message_error', 'Định dạng file không đúng');
            redirect('client/' . $this->data['ctrl_name'] . '/products');
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


    private function validate_product_complete(){
        $this->form_validation->set_rules('field_1', 'Tên dự án BĐS CN', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_2', 'Hạng mục đăng ký tham gia', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_3[]', 'Hồ sơ pháp lý gửi kèm', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        $this->form_validation->set_rules('field_4', 'Tổng diện tích dự án', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_5', 'Vị trí dự án', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_6', 'Tổng mức đầu tư', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_7', 'Hạ tầng kỹ thuật', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_8', 'Danh mục các dịch vụ và tiện ích đang cung cấp', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_9', 'Ưu điểm khác', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_10', 'Các thông tin khác', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        $this->form_validation->set_rules('field_11', 'Phê duyệt (Đã hoặc Đang trình)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_12', 'Tỷ lệ giải phóng mặt bằng (%)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_13', 'Tỷ lệ lấp đầy (%)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_14', 'Hạ tầng kỹ thuật: (Đã/Đang/Chưa hoàn thiện)', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        
        
        // check require
        $this->form_validation->set_rules('field_15', 'Đang mở rộng và phát triển thêm', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_16', 'Kiến trúc tổng thể CNTT của khu', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_17', 'Hạ tầng dữ liệu', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_18', 'Các tiện ích thông minh của dự án', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_19', 'Thiết bị điện và chiếu sáng', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_20', 'Môi trường/cây xanh/không khí', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_21', 'Cấp nước', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_22', 'Xử lý nước và chất thải', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_23', 'Cung cấp năng lượng, Điện', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_24', 'Thiết bị kết nối: IoT, smart home, camera giám sát, hệ thống phòng cháy chữa cháy…', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_25', 'Phòng cháy chữa cháy', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_26', 'Theo dõi, giám sát, cứu nạn', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_27', 'Bảo mật, an toàn thông tin', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_28', 'Xây dựng nhà xưởng thông minh', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_29', 'Các dịch vụ hỗ trợ doanh nghiệp, nhà đầu tưCác tiện ích thông minh khác', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_30', 'Các tiện ích thông minh khác', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        
        // check word + require
        // $this->form_validation->set_rules('field_15', 'Kiến trúc tổng thể CNTT của khu/toà nhà', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_16', 'Hạ tầng dữ liệu', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_17', 'Các tiện ích thông minh của dự án/khu đô thị/toà nhà:', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_18', 'Thiết bị điện và chiếu sáng', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_19', 'Môi trường/cây xanh/không khí', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_20', 'Cấp nước', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_21', 'Xử lý nước và chất thải', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_22', 'Cung cấp năng lượng, Điện', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_23', 'Thiết bị kết nối: IoT, smart home, camera giám sát, hệ thống phòng cháy chữa cháy…', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_24', 'Phòng cháy chữa cháy', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_25', 'Theo dõi, giám sát, cứu nạn', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_26', 'Bảo mật, an toàn thông tin', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_27', 'Mạng xã hội cho dân cư', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_28', 'Các ứng dụng quản lý dân cư', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_29', 'Các tiện ích thông minh khác', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        $this->form_validation->set_rules('field_31', 'Các tiêu chuẩn kỹ thuật, an toàn, phòng cháy chữa cháy, môi trường đang áp dụng', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_33', 'Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        // $this->form_validation->set_rules('field_32', 'Ngày', 'trim|numeric|numeric|min_length[1]|max_length[2]', array(
        //     'required' => '%s không được trống.',
        //     'numeric' => '%s phải là số.',
        //     'min_length' => '%s ít nhất 1 chữ số',
        //     'max_length' => '%s nhiều nhất 2 chữ số.',
        // ));
        // $this->form_validation->set_rules('field_33', 'Tháng', 'trim|numeric|numeric|min_length[1]|max_length[2]', array(
        //     'required' => '%s không được trống.',
        //     'numeric' => '%s phải là số.',
        //     'min_length' => '%s ít nhất 1 chữ số.',
        //     'max_length' => '%s nhiều nhất 2 chữ số.',
        // ));
    }

    private function validate_product_temporary(){
        $this->form_validation->set_rules('field_1', 'Tên dự án BĐS', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_2', 'Hạng mục đăng ký tham gia', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_3[]', 'Hồ sơ pháp lý gửi kèm', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        // $this->form_validation->set_rules('field_15', 'Kiến trúc tổng thể CNTT của khu/toà nhà', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_16', 'Hạ tầng dữ liệu', 'trim|required|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_17', 'Các tiện ích thông minh của dự án/khu đô thị/toà nhà:', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_18', 'Thiết bị điện và chiếu sáng', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_19', 'Môi trường/cây xanh/không khí', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_20', 'Cấp nước', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_21', 'Xử lý nước và chất thải', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_22', 'Cung cấp năng lượng, Điện', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_23', 'Thiết bị kết nối: IoT, smart home, camera giám sát, hệ thống phòng cháy chữa cháy…', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_24', 'Phòng cháy chữa cháy', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_25', 'Theo dõi, giám sát, cứu nạn', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_26', 'Bảo mật, an toàn thông tin', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_27', 'Mạng xã hội cho dân cư', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_28', 'Các ứng dụng quản lý dân cư', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_29', 'Các tiện ích thông minh khác', 'trim|max_word[300]', array(
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_32', 'Ngày', 'trim|numeric|min_length[1]|max_length[2]', array(
        //     'numeric' => '%s phải là số.',
        //     'min_length' => '%s ít nhất 1 chữ số',
        //     'max_length' => '%s nhiều nhất 2 chữ số.',
        // ));
        // $this->form_validation->set_rules('field_33', 'Tháng', 'trim|numeric|min_length[1]|max_length[2]', array(
        //     'numeric' => '%s phải là số.',
        //     'min_length' => '%s ít nhất 1 chữ số.',
        //     'max_length' => '%s nhiều nhất 2 chữ số.',
        // ));
    }



}
