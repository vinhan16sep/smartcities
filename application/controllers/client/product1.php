<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product1 extends Client_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('clients')) {
            //redirect them to the login page
            redirect('client/user/login', 'refresh');
        }

        $this->load->helper('url');


        $this->load->model('product1_model');


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
        $this->data['categories'] = [
            '1' => 'Khu Công nghệ thông minh',
            '2' => 'Khu Công nghệ cao thông minh',
            '3' => 'Khu Công nghiệp thông minh',
            '4' => 'Khu chế xuất thông minh'
        ];

        $this->data['attached_legal_documents'] = [
            '1' => 'Quyết định thành lập KCN',
            '2' => 'Giấy chứng nhận đầu tư',
            '3' => 'Quyết định phê duyệt quy hoạch 1:500',
            '4' => 'Các giấy phép khác',
        ];
        $this->data['ctrl_name'] = 'product' . ($this->data['user_service_type']);

        // Kiểm tra lĩnh vực đã được chọn hay chưa, nếu đã chọn, disable radio button
        $this->data['check_choose_type'] = $this->product1_model->check_choose_type($this->data['user']->id, $this->data['eventYear']);
    }

    public function maintenance(){
        $this->render('client/city/maintenance');
    }

    public function products(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'client/product1/products';
        $total_rows = $this->product1_model->count_product($this->data['user']->id, $this->data['eventYear']);
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['allYear'] = $this->product1_model->getAllProductYears();
        $this->data['products'] = $this->product1_model->get_all_product_for_client($this->data['user']->id, $per_page, $this->data['page'], 'product1');

        $this->render('client/product1/list_view');
    }

    public function detail_product($id = NULL){
        $this->data['product'] = $this->product1_model->fetch_product_by_user_and_id($this->data['ctrl_name'], $this->data['user']->id, $id);
        $this->render('client/product1/detail_view');
    }

    public function remove_product($id = null){
        // Check if product has registered in table [team]
        // NEED TO CHECK AGAIN, BECAUSE NOW HAVE 4 TABLES FOR PRODUCT =============================================
        $check_product_in_team = $this->team_model->check_exist_product_id('team', $id, $this->data['eventYear']);
        // NEED TO CHECK AGAIN, BECAUSE NOW HAVE 4 TABLES FOR PRODUCT =============================================
        if ( $check_product_in_team > 0 ) {
            $this->session->set_flashdata('message_error', 'Sản phẩm đã được đăng ký vào danh sách ứng cử');
            redirect('client/' . $this->data['ctrl_name'] . '/products', 'refresh');
        }else{
            $deleted = $this->product1_model->delete($this->data['ctrl_name'], $id);
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
                $this->render('client/product1/create_view');
            } else {
                if ($this->input->post()) {
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => $this->input->post('field_3'),
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

                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    $insert = $this->product1_model->insert_product($this->data['ctrl_name'], $data);
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

            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product1/create_view');
            } else {
                if ($this->input->post()) {
                    $data = array(
                        'client_id' => $this->data['user']->id,
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => $this->input->post('field_3'),
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

                        'information_id' => $this->data['user']->information_id,
                        'identity' => $this->data['user']->username,
                        'year' => $this->data['eventYear'],
                        'created_at' => $this->author_info['created_at'],
                        'created_by' => $this->author_info['created_by'],
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    $insert = $this->product1_model->insert_product($this->data['ctrl_name'], $data);
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
        $this->data['user_service_types'] = $this->data['service_types'][$this->data['user']->service_type];

        $id = isset($request_id) ? (int) $request_id : (int) $this->input->post('id');
        $this->data['product'] = $this->product1_model->fetch_product_by_user_id($this->data['ctrl_name'], $this->data['user']->id, $id);
        if (!$this->data['product']) {
            redirect('client/' . $this->data['ctrl_name'] . '/product', 'refresh');
        }

        if($this->input->post('submit') == 'Hoàn thành') {
            // VALIDATION
            $this->validate_product_complete();
            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product1/edit_view');
            } else {
                if ($this->input->post()) {
                    $data = array(
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => $this->input->post('field_3'),
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

                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by'],
                    );
                    try {
                        $this->product1_model->update_product($this->data['ctrl_name'], $this->data['user']->id, $id, $data);
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
            if ($this->form_validation->run() == FALSE) {
                $this->render('client/product1/edit_view');
            } else {
                if ($this->input->post()) {
                    $data = array(
                        'field_2' => $this->input->post('field_2'),
                        'field_3' => $this->input->post('field_3'),
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

                        'is_submit' => 1,
                        'modified_at' => $this->author_info['modified_at'],
                        'modified_by' => $this->author_info['modified_by']
                    );
                    try {
                        $this->product1_model->update_product($this->data['ctrl_name'], $this->data['user']->id, $id, $data);
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
        $this->form_validation->set_rules('field_21', 'Lĩnh vực đăng ký', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_2', 'Hành lang pháp lý: các văn bản pháp lý liên quan đến lĩnh vực đăng ký tham gia Giải thưởng', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_3', 'Thực tế triển khai các đề án, dự án, chương trình ứng dụng CNTT (của lĩnh vực đăng ký xét trao Giải thưởng) của tỉnh/thành phố (mức độ triển khai, hoàn thành của các đề án, dự án, chương trình…)', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        $this->form_validation->set_rules('field_4', 'Các ứng dụng công nghệ, tiện ích thông minh cho người dân và doanh nghiệp trong lĩnh vực đăng ký xét trao Giải (vd: lĩnh vực quy hoạch/ điều hành/ dịch vụ công/ giao thông, logistics/ y tế/ giáo dục/ môi trường/ năng lượng/ cấp thoát nước/ du lịch/ bảo mật, an ninh, an toàn…): nêu chi tiết các thiết bị, giải pháp, ứng dụng và dịch vụ công nghệ, tổng kinh phí, số lượng người dùng, số lượng tương tác, đo lường hiệu quả…', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_5', 'Quy mô và tỉ lệ đầu tư cho xây dựng Hạ tầng dữ liệu/hạ tầng số của tỉnh/thành phố trên tổng mức đầu tư cho xây dựng và phát triển thành phố thông minh; tỉ lệ  CNTT trong các dự án đầu tư', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_6', 'Mức độ hoàn thiện của chính quyền điện tử/chính quyền số', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_7', 'Bảo mật an toàn thông tin, an ninh cho người dân (các ứng dụng, giải pháp cho bảo mật, an toàn thông tin cho các cơ quan quản lý; các thiết bị IoT, giám sát, hệ thống báo cáo, phản ánh hiện trường; tổng mức đầu tư, vận hành; thành tích, kết quả đạt được)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_8', 'Khả năng tiếp cận cơ hội số của người dân, cộng đồng và doanh nghiệp tại thành phố (các phương tiện, công cụ giao tiếp với người dân, doanh nghiệp; mức độ tiếp cận thông tin, dữ liệu (trung tâm dữ liệu mở) của thành phố/đô thị; số lượng tương tác của người dân/doanh nghiệp cho các dịch vụ công, các phương tiện phản ánh;…)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_9', 'Các chính sách, chương trình, hoạt động khuyến khích khởi nghiệp đổi mới sáng tạo của tỉnh, thành phố (cung cấp thông tin nếu đăng ký lĩnh vực “Thành phố hấp dẫn Khởi nghiệp ĐMST”), gồm:', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_10', 'Số lượng DN thành lập mới năm 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        $this->form_validation->set_rules('field_11', 'Các chính sách của tỉnh/thành phố cho startups', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_12', 'Các chương trình hỗ trợ, thúc đẩy startups năm 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_13', 'Tổng ngân sách cho hỗ trợ, thúc đẩy startups năm 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_14', 'Các đơn vị phụ trách, vườn ươm, trung tâm hỗ trợ/thúc đẩy khởi nghiệp', 'trim|required', array(
            'required' => '%s không được trống.'
        ));
        
        
        // check require
        $this->form_validation->set_rules('field_15', 'Kết quả đạt được trong 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_16', 'Sự chuẩn bị nguồn nhân lực cho xây dựng thành phố thông minh, gồm:', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_17', 'Các khoá đào tạo liên quan đến thành phố thông minh và số lượng người tham gia năm 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_18', 'Kinh phí cho đào tạo liên quan đến thành phố thông minh năm 2018, 2019', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_19', 'Các tiêu chí, tiêu chuẩn chuyên ngành, kỹ thuật riêng của từng lĩnh vực đăng ký (nếu có)', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        $this->form_validation->set_rules('field_20', 'Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh):', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
        
        // check word + require
        // $this->form_validation->set_rules('field_15', 'Kết quả đạt được trong 2018, 2019', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_16', 'Sự chuẩn bị nguồn nhân lực cho xây dựng thành phố thông minh, gồm:', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_17', 'Các khoá đào tạo liên quan đến thành phố thông minh và số lượng người tham gia năm 2018, 2019', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_18', 'Kinh phí cho đào tạo liên quan đến thành phố thông minh năm 2018, 2019', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_19', 'Các tiêu chí, tiêu chuẩn chuyên ngành, kỹ thuật riêng của từng lĩnh vực đăng ký (nếu có)', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
        // $this->form_validation->set_rules('field_20', 'Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh):', 'trim|required|max_word[300]', array(
        //     'required' => '%s không được trống.',
        //     'max_word' => '%s Tối đa 300 từ'
        // ));
    }

    private function validate_product_temporary(){
        $this->form_validation->set_rules('field_21', 'Lĩnh vực đăng ký', 'trim|required', array(
            'required' => '%s không được trống.',
        ));
    }



}
