<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product4 extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }


        $this->load->model('product4_model');


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
        $base_url = base_url() . 'client/product4/products';
        $total_rows = $this->product4_model->count_product($this->data['user']->id, $this->data['eventYear']);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['allYear'] = $this->product4_model->getAllProductYears();
        $this->data['products'] = $this->product4_model->get_all_product_for_client($this->data['user']->id, $per_page, $this->data['page'], 'product4');

        $this->render('client/product4/list_view');
    }

    public function detail_product($id = NULL){
        $this->data['product'] = $this->product4_model->fetch_product_by_user_and_id('product4', $this->data['user']->id, $id);
        if(!empty($this->data['product'])){
            foreach($this->data['product'] as $key => $value){
                $this->data['product'][$key] = htmlspecialchars_decode(htmlspecialchars_decode($value));
            }
        }
        $this->render('client/product4/detail_view');
    }

    public function remove_product($id = null){
        // Check if product has registered in table [team]
        $check_product_in_team = $this->team_model->check_exist_product_id('team', $id, $this->data['eventYear'], $this->data['user']->service_type);
        if ( $check_product_in_team > 0 ) {
            $this->session->set_flashdata('message_error', 'Sản phẩm đã được đăng ký vào danh sách ứng cử');
            redirect('client/product4/products', 'refresh');
        }else{
            $deleted = $this->product4_model->delete('product4', $id);
            if ($deleted) {
                $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
                redirect('client/product4/products', 'refresh');
            }else{
                $this->session->set_flashdata('message_error', 'Có lỗi trong quá trình xóa sản phẩm');
                redirect('client/product4/products', 'refresh');
            }
        }
    }

    public function create_product(){
        if (isset($this->data['service_types'][$this->data['user']->service_type])){
            $this->data['user_service_types'] = $this->data['service_types'][$this->data['user']->service_type];
        } else {
            redirect('client/product4/products', 'refresh');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_product_complete();

            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product4/create_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }

                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        // 'compare' => $this->input->post('compare'),
                        'income_1' => $this->input->post('income_1'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->product4_model->insert_product('product4', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->load->model('status_model');
                    $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/product4/products', 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_product_temporary();
            // var_dump($this->form_validation->run());die;

            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product4/create_view');
            } else {
                if ($this->input->post()) {
                    $service = json_encode($this->input->post('service'));
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    // $image = $this->upload_image('certificate', $_FILES['certificate']['name'], 'assets/upload/product', 'assets/upload/product/thumbs');
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        // 'compare' => $this->input->post('compare'),
                        'income_1' => $this->input->post('income_1'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    $insert = $this->product4_model->insert_product('product4', $data);
                    if (!$insert) {
                        $this->session->set_flashdata('message', 'There was an error inserting item');
                    }
                    $this->session->set_flashdata('message', 'Item added successfully');

                    redirect('client/product4/products', 'refresh');
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
                $this->data['product'] = $this->product4_model->fetch_product_by_user_id('product4', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/product4/products', 'refresh');
                }
                $this->render('client/product4/edit_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        // 'compare' => $this->input->post('compare'),
                        'income_1' => $this->input->post('income_1'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by'],
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->product4_model->update_product('product4', $this->data['user']->id, $id, $data);
                        $this->load->model('status_model');
                        $this->status_model->update('status', $this->data['user']->id, array('is_product' => 1));
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/product4/products', 'refresh');
                }
            }
        }else{
            // VALIDATION
            $this->validate_product_temporary();

            $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
            if ($this->form_validation->run() == FALSE) {
                $this->data['product'] = $this->product4_model->fetch_product_by_user_id('product4', $this->data['user']->id, $id);
                if (!$this->data['product']) {
                    redirect('client/product4/products', 'refresh');
                }
                $this->render('client/product4/edit_view');
            } else {
                if ($this->input->post()) {
                    if(!empty($_FILES['file']['name'])){
                        $this->check_file($_FILES['file']['name']);
                        $file = $this->upload_file_word('file', 'assets/upload/file', $this->ion_auth->user()->row()->username . '_' . $this->vn_to_str($this->input->post('name')) . '_' . date('d-m-Y'));
                    }
                    $service = json_encode($this->input->post('service'));
                    $data = array(
                        'name' => $this->input->post('name'),
                        'service' => $service,
                        'copyright_certificate' => $this->input->post('copyright_certificate'),
                        'functional' => $this->input->post('functional'),
                        'process' => $this->input->post('process'),
                        'security' => $this->input->post('security'),
                        'positive' => $this->input->post('positive'),
                        // 'compare' => $this->input->post('compare'),
                        'income_1' => $this->input->post('income_1'),
                        'income_2016' => $this->input->post('income_2016'),
                        'income_2017' => $this->input->post('income_2017'),
                        'area' => $this->input->post('area'),
                        'open_date' => $this->input->post('open_date'),
                        'price' => $this->input->post('price'),
                        'customer' => $this->input->post('customer'),
                        'after_sale' => $this->input->post('after_sale'),
                        'team' => $this->input->post('team'),
                        'award' => $this->input->post('award'),
                        'certificate' => $this->input->post('certificate'),
                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    if(!empty($_FILES['file']['name'])){
                        $data['file'] = $file;
                    }
                    try {
                        $this->product4_model->update_product('product4', $this->data['user']->id, $id, $data);
                        $this->session->set_flashdata('message', 'Item updated successfully');
                    } catch (Exception $e) {
                        $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                    }
                    redirect('client/product4/products', 'refresh');
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
        $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        // $this->form_validation->set_rules('service', 'Data', 'trim|required');
        $this->form_validation->set_rules('copyright_certificate', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('functional', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('process', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('security', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('positive', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        // $this->form_validation->set_rules('compare', 'Data', 'trim|required', array(
        //     'required' => '%s không được trống.',
        // ));
        $this->form_validation->set_rules('income_1', 'Data', 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('income_2016', 'Data', 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('income_2017', 'Data', 'trim|required|numeric|max_length[10]', array(
            'required' => '%s không được trống.',
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('area', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('open_date', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('price', 'Data', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        $this->form_validation->set_rules('customer', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('after_sale', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('team', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('award', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('service[]', 'Lĩnh vực', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        // $this->form_validation->set_rules('file', 'Data', 'callback_check_file_selected');
    }

    private function validate_product_temporary(){
        $this->form_validation->set_rules('name', 'Data', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('income_1', 'Data', 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('income_2016', 'Data', 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
        $this->form_validation->set_rules('income_2017', 'Data', 'trim|numeric|max_length[10]', array(
            'numeric' => '%s phải là số.',
            'max_length' => 'Tối đa 10 chữ số'
        ));
    }
}
