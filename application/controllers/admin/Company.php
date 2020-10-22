<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Company extends Admin_Controller{

    private $excel = null;

	function __construct(){
		parent::__construct();
		$this->load->model('information_model');
        $this->load->model('users_model');
        $this->load->model('status_model');

        $this->excel = new PHPExcel();
	}

	public function index($year = null, $stype = null){
        $this->load->helper('form');
        $this->load->library('form_validation');

		$this->load->model('users_model');
		$members = $this->users_model->fetch_all_member();
		$this->data['members'] = $members;
		$keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $this->data['keywords'] = $keywords;

        // SERVICE TYPE CASE
        if ($stype != 1) {
            $total_rows  = $this->information_model->count_companies_by_type($year, $stype);
            if($keywords != ''){
                $total_rows  = $this->information_model->count_company_search_by_type($keywords, $year, $stype);
            }
        } else {
            $total_rows  = $this->information_model->count_cities_by_type($year, $stype);
            if($keywords != ''){
                $total_rows  = $this->information_model->count_city_search_by_type($keywords, $year, $stype);
            }
        }
        // SERVICE TYPE CASE

		$this->load->library('pagination');
		$config = array();
		$base_url = base_url('admin/company/index/' . $year . '/' . $stype);
		$per_page = 50;
		$uri_segment = 6;

		foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(6)) ? $this->uri->segment(6) - 1 : 0;

        // SERVICE TYPE CASE
        if ($stype != 1) {
            $result = $this->information_model->fetch_all_company_by_type_pagination($per_page, $per_page*$this->data['page'], $year, $stype);
            if($keywords != ''){
                $result = $this->information_model->fetch_all_company_by_type_pagination_search($per_page, $per_page*$this->data['page'], $keywords, $year, $stype);
            }
        } else {
            $result = $this->information_model->fetch_all_city_by_type_pagination($per_page, $per_page*$this->data['page'], $year, $stype);
            if($keywords != ''){
                $result = $this->information_model->fetch_all_city_by_type_pagination_search($per_page, $per_page*$this->data['page'], $keywords, $year, $stype);
            }
        }
        // SERVICE TYPE CASE
        foreach ($result as $key => $value) {
            $member_id = json_decode($value['member_id']);
            if($member_id){
                foreach ($member_id as $k => $val) {
                    $member = $this->users_model->fetch_by_id($val);
                    $result[$key]['member_name'][$val] = $member['first_name'].''.$member['last_name'].' ('.$member['username'].')';
                }
            }
            // SERVICE TYPE CASE
            if ($stype != 1) {
                $info = $this->information_model->fetch_company_by_id($value["id"]);
            } else {
                $info = $this->information_model->fetch_city_by_id($value["id"]);
            }
            // SERVICE TYPE CASE
            if($info){
                $result[$key]['avatar'] = $info["avatar"];
            }
        }
        if($this->data['page'] == 0){
             $number = $total_rows;
         }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
             $number = $total_rows - ($this->data['page'] * $per_page);
         };

        $this->data['number'] = $number;
        $this->data['companies'] = $result;
        // echo '<pre>';
        // print_r($this->data['companies']);die;
        $this->data['requestYear'] = $year;
        $this->data['stype'] = $stype;
		$this->render('admin/company/list_company_view');
	}

	public function income($year = null){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('users_model');
        $members = $this->users_model->fetch_all_member();
        $this->data['members'] = $members;
        $keywords = '';
        if($this->input->get('search')){
            $keywords = $this->input->get('search');
        }
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url('admin/company/income/' . $year);
        $per_page = 20;
        $uri_segment = 5;

        $this->data['keywords'] = $keywords;
        $total_rows  = $this->information_model->count_all_company_pagination($year);
        if($keywords != ''){
            $total_rows  = $this->information_model->count_company_pagination_search($keywords, $year);
        }

        foreach ($this->pagination_con($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;
        $result = $this->information_model->fetch_all_company_pagination($per_page, $per_page*$this->data['page'], $year);
        if($keywords != ''){
            $result = $this->information_model->fetch_all_company_pagination_search($per_page, $per_page*$this->data['page'], $keywords, $year);
        }
        $total_income = 0;
        foreach ($result as $key => $value) {
            $member_id = json_decode($value['member_id']);
            if($member_id){
                foreach ($member_id as $k => $val) {
                    $member = $this->users_model->fetch_by_id($val);
                    $result[$key]['member_name'][$val] = $member['first_name'].''.$member['last_name'].' ('.$member['username'].')';
                }
            }
            $info = $this->information_model->fetch_company_by_id($value["id"]);
            if($info){
                $result[$key]['avatar'] = $info["avatar"];
            }
            $total_income += $value['total_income_3'];
        }
        $this->data['total_income'] = $total_income;
        if($this->data['page'] == 0){
            $number = $total_rows;
        }elseif($total_rows < ($this->data['page'] + 1) * $per_page){
            $number = $total_rows - ($this->data['page'] * $per_page);
        }elseif($this->data['page'] > 0 && $total_rows > ($this->data['page'] + 1) * $per_page){
            $number = $total_rows - ($this->data['page'] * $per_page);
        };

        $this->data['number'] = $number;
        $this->data['companies'] = $result;
        $this->data['requestYear'] = $year;
        $this->render('admin/company/income_company_view');
    }

	public function detail($id, $requestYear, $stype){
        // SERVICE TYPE CASE
        if ($stype != 1) {
            $this->load->model('users_model');
            $company = $this->information_model->fetch_company_by_id($id);
            $member_id = json_decode($company['member_id']);
            $members = $this->users_model->fetch_all_member_with_where($member_id);
            $this->data['members'] = $members;
            $this->data['company'] = $company;
            $this->data['selectedYear'] = $requestYear;
            $this->data['user_service_type'] = $stype;
            $this->render('admin/company/detail_company_view');
        } else {
            $this->load->model('users_model');
            $company = $this->information_model->fetch_city_by_id($id);
            $member_id = json_decode($company['member_id']);
            $members = $this->users_model->fetch_all_member_with_where($member_id);
            $this->data['members'] = $members;
            $this->data['company'] = $company;
            $this->data['user_service_type'] = $stype;
            $this->render('admin/company/detail_city_view');
        }
        // SERVICE TYPE CASE
	}

    public function detail_by_client($client_id){
        $company = $this->information_model->fetch_company_by_client_id($client_id);
        $this->data['company'] = $company;
        $this->render('admin/company/detail_company_view');
    }

    public function change_member(){
    	$member_id = $this->input->get('member_id');
    	$client_id = $this->input->get('client_id');
        $company_id = $this->input->get('company_id');

        $member = $this->users_model->fetch_by_id($member_id);
        $array_company_id = array();
        $array_company_id = json_decode($member['company_id']);
        unset($array_company_id[array_search($company_id, $array_company_id)]);
        $new_company_id = [];
        foreach ($array_company_id as $key => $value) {
            $new_company_id[] = $value;
        }
        $new_company_id_json = json_encode($new_company_id);
        $user_data = array('company_id' => $new_company_id_json);

        $client = $this->information_model->fetch_by_user_id('company', $client_id);
        $upload = array();
        $upload = json_decode($client['member_id']);
        $key = array_search($member_id, $upload);
        unset($upload[$key]);
        $newUpload = [];
        foreach ($upload as $key => $value) {
            $newUpload[] = $value;
        }
        $member_id_json = json_encode($newUpload);
    	$where = array('member_id' => $member_id_json);
        $success = false;
        if($this->information_model->update('company', $client_id, $where) == true && $this->users_model->update_company($member_id, $user_data)){
            $success = true;
        }
    	$this->output->set_status_header(200)->set_output(json_encode(array('isExitsts' => $success)));
    }

    public function add_member()
    {
        $member_id = $this->input->get('member_id');
        $client_id = $this->input->get('client_id');
        $company_id = $this->input->get('company_id');

        $member = $this->users_model->fetch_by_id($member_id);
        $array_company_id = array();
        $array_company_id = json_decode($member['company_id']);
        if(isset($array_company_id)){
            array_push($array_company_id, $company_id);
        }else{
            $array_company_id[] = $company_id;
        }
        $array_company_id = json_encode($array_company_id);
        $user_data = array('company_id' => $array_company_id);

        $client = $this->information_model->fetch_by_user_id('company', $client_id);
        $upload = array();
        $upload = json_decode($client['member_id']);
        if(!empty($upload)){
            array_push($upload, $member_id);
        }else{
            $upload[] = $member_id;
        }

        $upload = json_encode($upload);
        $where = array('member_id' => $upload);
        $success = false;
        if($this->information_model->update('company', $client_id, $where) == true && $this->users_model->update_company($member_id, $user_data)){
            $success = true;
        }
        $this->output->set_status_header(200)->set_output(json_encode(array('isExitsts' => $success)));
    }

    public function export($requestYear, $stype){
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach doanh nghiep');

        // load database
        $this->load->database();

        // get all users in array formate
        if ($stype == 1) {
            $data = $this->information_model->get_city_for_export_by_stype($requestYear, $stype);
            $data_export = $this->data_export_stype_1($data);
        } else {
            $data = $this->information_model->get_company_for_export_by_stype($requestYear, $stype);
            $data_export = $this->data_export_stype_2_3_4($data, $stype, $requestYear);
        }
        // foreach($data as $key => $val){
        //     if(!$this->status_model->check_company_submitted($val['client_id'], $requestYear)){
        //         unset($data[$key]);
        //     }
        // }

        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export);

        if ($stype == 1) {
            $filename='Danh_sach_nhom_1_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        } elseif ($stype == 2) {
            $filename='Danh_sach_nhom_2_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        } elseif ($stype == 3) {
            $filename='Danh_sach_nhom_3_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
            
        } else {
            $filename='Danh_sach_nhom_4_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        }

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    private function data_export_stype_2_3_4($data, $stype, $requestYear) {
        $requestYear = (int) $requestYear;
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'phone' => 'Điện thoại',
                'address' => 'Địa chỉ',
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh',
                'lp_email' => 'Email',
                'lp_phone' => 'Di động',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh',
                'c_email' => 'Email',
                'c_phone' => 'Di động',
                'link' => 'Link download PĐK của DN',
                'description' => 'Giới thiệu chung',
                'linhvuckd' => 'Lĩnh vực kinh doanh',
                'themanh' => 'Thế mạnh'
            )
        );

        if ($stype == 4) {
            $data_export[0]['equity_1'] = 'Vốn điều lệ ' . ($requestYear - 3);
        }

        $data_export[0]['equity_2'] = 'Vốn điều lệ ' . ($requestYear - 2);
        $data_export[0]['equity_3'] = 'Vốn điều lệ ' . ($requestYear - 1);

        if ($stype == 4) {
            $data_export[0]['owner_equity_1'] = 'Tổng tài sản ' . ($requestYear - 3);
            $data_export[0]['owner_equity_2'] = 'Tổng tài sản ' . ($requestYear - 2);
            $data_export[0]['owner_equity_3'] = 'Tổng tài sản ' . ($requestYear - 1);
            $data_export[0]['total_income_1'] = 'Tổng doanh thu ' . ($requestYear - 3);
        }

        $data_export[0]['total_income_2'] = 'Tổng doanh thu ' . ($requestYear - 2);
        $data_export[0]['total_income_3'] = 'Tổng doanh thu ' . ($requestYear - 1);

        if ($stype == 4) {
            $data_export[0]['software_income_1'] = 'Tổng doanh thu lĩnh vực sản xuất phần mềm ' . ($requestYear - 3);
            $data_export[0]['software_income_2'] = 'Tổng doanh thu lĩnh vực sản xuất phần mềm ' . ($requestYear - 2);
            $data_export[0]['software_income_3'] = 'Tổng doanh thu lĩnh vực sản xuất phần mềm ' . ($requestYear - 1);
            
            $data_export[0]['it_income_1'] = 'Tổng doanh thu dịch vụ CNTT ' . ($requestYear - 3);
            $data_export[0]['it_income_2'] = 'Tổng doanh thu dịch vụ CNTT ' . ($requestYear - 2);
            $data_export[0]['it_income_3'] = 'Tổng doanh thu dịch vụ CNTT ' . ($requestYear - 1);
            
            $data_export[0]['export_income_1'] = 'Tổng doanh thu xuất khẩu ' . ($requestYear - 3);
            $data_export[0]['export_income_2'] = 'Tổng doanh thu xuất khẩu ' . ($requestYear - 2);
            $data_export[0]['export_income_3'] = 'Tổng doanh thu xuất khẩu ' . ($requestYear - 1);
            
            $data_export[0]['candidate_income_1'] = 'Tổng doanh thu lĩnh vực/dự án ' . ($requestYear - 3);
        }
            
        $data_export[0]['candidate_income_2'] = 'Tổng doanh thu lĩnh vực/dự án ' . ($requestYear - 2);
        $data_export[0]['candidate_income_3'] = 'Tổng doanh thu lĩnh vực/dự án ' . ($requestYear - 1);

        if ($stype == 4) {
            $data_export[0]['total_labor_1'] = 'Tổng số lao động ' . ($requestYear - 3);
        }
        $data_export[0]['total_labor_2'] = 'Tổng số lao động ' . ($requestYear - 2);
        $data_export[0]['total_labor_3'] = 'Tổng số lao động ' . ($requestYear - 1);

        if ($stype == 4) {
            $data_export[0]['total_ltv_1'] = 'Tổng số lập trình viên ' . ($requestYear - 3);
            $data_export[0]['total_ltv_2'] = 'Tổng số lập trình viên ' . ($requestYear - 2);
            $data_export[0]['total_ltv_3'] = 'Tổng số lập trình viên ' . ($requestYear - 1);
        }

        foreach($data as $key => $company){
            $extra_info = $this->information_model->fetch_company_by_id($company['id']);
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'phone' => $extra_info['phone'],
                'address' => $extra_info['address'],
                'website' => $extra_info['website'],
                'legal_representative' => $extra_info['legal_representative'],
                'lp_position' => $extra_info['lp_position'],
                'lp_email' => $extra_info['lp_email'],
                'lp_phone' => $extra_info['lp_phone'],
                'connector' => $extra_info['connector'],
                'c_position' => $extra_info['c_position'],
                'c_email' => $extra_info['c_email'],
                'c_phone' => $extra_info['c_phone'],
                'link' => $extra_info['link'],
                'description' => strip_tags(html_entity_decode($company['description'])),
                'linhvuckd' => strip_tags(html_entity_decode($company['linhvuckd'])),
                'themanh' => strip_tags(html_entity_decode($company['themanh']))
            );
            if ($stype == 4) {
                $data_export[$key + 1]['equity_1'] = strip_tags(html_entity_decode($company['equity_1']));
            }
    
            $data_export[$key + 1]['equity_2'] = strip_tags(html_entity_decode($company['equity_2']));
            $data_export[$key + 1]['equity_3'] = strip_tags(html_entity_decode($company['equity_3']));
    
            if ($stype == 4) {
                $data_export[$key + 1]['owner_equity_1'] = strip_tags(html_entity_decode($company['owner_equity_1']));
                $data_export[$key + 1]['owner_equity_2'] = strip_tags(html_entity_decode($company['owner_equity_2']));
                $data_export[$key + 1]['owner_equity_3'] = strip_tags(html_entity_decode($company['owner_equity_3']));
                $data_export[$key + 1]['total_income_1'] = strip_tags(html_entity_decode($company['total_income_1']));
            }
    
            $data_export[$key + 1]['total_income_2'] = strip_tags(html_entity_decode($company['total_income_2']));
            $data_export[$key + 1]['total_income_3'] = strip_tags(html_entity_decode($company['total_income_3']));
    
            if ($stype == 4) {
                $data_export[$key + 1]['software_income_1'] = strip_tags(html_entity_decode($company['software_income_1']));
                $data_export[$key + 1]['software_income_2'] = strip_tags(html_entity_decode($company['software_income_2']));
                $data_export[$key + 1]['software_income_3'] = strip_tags(html_entity_decode($company['software_income_3']));
                
                $data_export[$key + 1]['it_income_1'] = strip_tags(html_entity_decode($company['it_income_1']));
                $data_export[$key + 1]['it_income_2'] = strip_tags(html_entity_decode($company['it_income_2']));
                $data_export[$key + 1]['it_income_3'] = strip_tags(html_entity_decode($company['it_income_3']));
                
                $data_export[$key + 1]['export_income_1'] = strip_tags(html_entity_decode($company['export_income_1']));
                $data_export[$key + 1]['export_income_2'] = strip_tags(html_entity_decode($company['export_income_2']));
                $data_export[$key + 1]['export_income_3'] = strip_tags(html_entity_decode($company['export_income_3']));
                
                $data_export[$key + 1]['candidate_income_1'] = strip_tags(html_entity_decode($company['candidate_income_1']));
            }
                
            $data_export[$key + 1]['candidate_income_2'] = strip_tags(html_entity_decode($company['candidate_income_2']));
            $data_export[$key + 1]['candidate_income_3'] = strip_tags(html_entity_decode($company['candidate_income_3']));
    
            if ($stype == 4) {
                $data_export[$key + 1]['total_labor_1'] = strip_tags(html_entity_decode($company['total_labor_1']));
            }
            $data_export[$key + 1]['total_labor_2'] = strip_tags(html_entity_decode($company['total_labor_2']));
            $data_export[$key + 1]['total_labor_3'] = strip_tags(html_entity_decode($company['total_labor_3']));
    
            if ($stype == 4) {
                $data_export[$key + 1]['total_ltv_1'] = strip_tags(html_entity_decode($company['total_ltv_1']));
                $data_export[$key + 1]['total_ltv_2'] = strip_tags(html_entity_decode($company['total_ltv_2']));
                $data_export[$key + 1]['total_ltv_3'] = strip_tags(html_entity_decode($company['total_ltv_3']));
            }
        }
        return $data_export;
    }

    private function data_export_stype_1($data) {
        $data_export = array(
            '0' => array(
                'company' => 'Doanh nghiệp',
                'phone' => 'Điện thoại',
                'address' => 'Địa chỉ',
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh',
                'lp_email' => 'Email',
                'lp_phone' => 'Di động',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh',
                'c_email' => 'Email',
                'c_phone' => 'Di động',
                'link' => 'Link download PĐK của DN',
                'field_1' => 'Tên Đô thị (thành phố/thị xã/thị trấn/xã phường)',
                'field_2' => 'Giới thiệu ngắn về Đô thị (Tối đa 500 từ)',
                'field_3' => 'Vị trí địa lý, diện tích',
                'field_4' => 'Dân số, mật độ dân số',
                'field_5' => 'Tổng số quận, huyện, thị trấn, thị xã…',
                'field_6' => 'GDP/đầu người',
                'field_7' => 'GRDP',
                'field_8' => 'Các ngành kinh tế mũi nhọn',
                'field_9' => 'Số lượng các dự án bất động sản thông minh, khu công nghiệp, công nghệ, công nghệ cao, khu chế xuất trong tỉnh/thành phố hiện tại',
                'field_10' => 'Điểm mạnh/Lợi thế',
                'field_11' => 'Định hướng phát triển của đô thị đến năm 2025, định hướng 2030…',
                'field_12' => 'Các văn bản pháp lý liên quan đến chính sách, chương trình, dự án, đề án thành phố thông minh của tỉnh, thành phố',
                'field_13' => 'Tổng quan về đề án, dự án, chương trình, hoạt động về thành phố, đô thị thông minh của Tỉnh/thành phố và các kết quả đạt được (nêu tóm tắt thông tin, số liệu và gửi kèm đề án)',
                'field_14' => 'Tổng kinh phí của thành phố/đô thị cho các chương trình, dự án… thành phố thông minh năm 2018, 2019',
                'field_15' => 'Tổng thu ngân sách (triệu VNĐ) 2018',
                'field_16' => 'Tổng thu ngân sách (triệu VNĐ) 2019',
                'field_17' => 'Tốc độ tăng trưởng kinh tế (triệu VNĐ) 2018',
                'field_18' => 'Tốc độ tăng trưởng kinh tế (triệu VNĐ) 2019',
                'field_19' => 'Các thông tin khác'
            )
        );

        foreach($data as $key => $company){
            $extra_info = $this->information_model->fetch_company_by_id($company['id']);
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'phone' => $extra_info['phone'],
                'address' => $extra_info['address'],
                'website' => $extra_info['website'],
                'legal_representative' => $extra_info['legal_representative'],
                'lp_position' => $extra_info['lp_position'],
                'lp_email' => $extra_info['lp_email'],
                'lp_phone' => $extra_info['lp_phone'],
                'connector' => $extra_info['connector'],
                'c_position' => $extra_info['c_position'],
                'c_email' => $extra_info['c_email'],
                'c_phone' => $extra_info['c_phone'],
                'link' => $extra_info['link'],
                'field_1' => strip_tags(html_entity_decode($company['field_1'])),
                'field_2' => strip_tags(html_entity_decode($company['field_2'])),
                'field_3' => strip_tags(html_entity_decode($company['field_3'])),
                'field_4' => strip_tags(html_entity_decode($company['field_4'])),
                'field_5' => strip_tags(html_entity_decode($company['field_5'])),
                'field_6' => strip_tags(html_entity_decode($company['field_6'])),
                'field_7' => strip_tags(html_entity_decode($company['field_7'])),
                'field_8' => strip_tags(html_entity_decode($company['field_8'])),
                'field_9' => strip_tags(html_entity_decode($company['field_9'])),
                'field_10' => strip_tags(html_entity_decode($company['field_10'])),
                'field_11' => strip_tags(html_entity_decode($company['field_11'])),
                'field_12' => strip_tags(html_entity_decode($company['field_12'])),
                'field_13' => strip_tags(html_entity_decode($company['field_13'])),
                'field_14' => strip_tags(html_entity_decode($company['field_14'])),
                'field_15' => strip_tags(html_entity_decode($company['field_15'])),
                'field_16' => strip_tags(html_entity_decode($company['field_16'])),
                'field_17' => strip_tags(html_entity_decode($company['field_17'])),
                'field_18' => strip_tags(html_entity_decode($company['field_18'])),
                'field_19' => strip_tags(html_entity_decode($company['field_19'])),
                'field_1' => strip_tags(html_entity_decode($company['field_1']))
            );
        }
        return $data_export;
    }

    public function export_product($requestYear, $stype){
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Danh sach san pham');

        // load database
        $this->load->database();

        // get all users in array formate
        if ($stype == 1) {
            $data = $this->information_model->get_product_for_export_by_stype('product1', $requestYear, $stype);
            $data_export = $this->product_export_stype_1($data, $requestYear);

            $filename='Danh_sach_thanh_pho_nhom_1_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
        } elseif ($stype == 2) {
            $data = $this->information_model->get_product_for_export_by_stype('product2', $requestYear, $stype);
            $data_export = $this->product_export_stype_2($data, $requestYear);

            $filename='Danh_sach_BDS_nhom_2_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
        } elseif ($stype == 3) {
            $data = $this->information_model->get_product_for_export_by_stype('product3', $requestYear, $stype);
            $data_export = $this->product_export_stype_3($data, $requestYear);

            $filename='Danh_sach_BDS_nhom_3_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
        } else {
            $data = $this->information_model->get_product_for_export_by_stype('product4', $requestYear, $stype);
            $data_export = $this->product_export_stype_4($data, $requestYear);

            $filename='Danh_sach_san_pham_nhom_4_' . date("d-m-Y") . '.xls'; //save our workbook as this file name
        }

        // $data = $this->information_model->get_all_product_for_export('product4', null, $requestYear);
        // foreach($data as $key => $val){
        //     if(!$this->status_model->check_company_submitted($val['client_id'], $requestYear)){
        //         unset($data[$key]);
        //     }
        // }

        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray($data_export);

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    private function product_export_stype_4($data, $requestYear) {
        $requestYear = (int) $requestYear;
        $data_export = array(
            '0' => array(
                'company' => 'DN',
                'name' => 'Tên sản phẩm/giải pháp/ứng dụng đăng ký',
                'service' => 'Đăng ký tham gia lĩnh vực',
                'functional' => 'Mô tả công năng sản phẩm',
                'process' => 'Các công nghệ và quy trình chất lượng sử dụng để phát triển SP/GP/ƯD',
                'security' => 'Tính năng Bảo mật của SP/GP/ƯD',
                'positive' => 'Các ưu điểm nổi trội của SP/GP/ƯD so với SP cùng loại',
                'compare' => 'So sánh với các SP/GP/DV khác',
                'open_date' => 'Ngày thương mại hoá ra thị trường',
                'price' => 'Giá SP/GP/ƯD',
                'income_1' => 'Doanh thu của SP/GP/ƯD năm ' . ($requestYear - 3),
                'income_2016' => 'Doanh thu của SP/GP/ƯD năm ' . ($requestYear - 2),
                'income_2017' => 'Doanh thu của SP/GP/ƯD năm ' . ($requestYear - 1),
                'customer' => 'Thông tin khách hàng',
                'area' => 'Thị phần của SP/GP/ƯD',
                'after_sale' => 'Dịch vụ sau bán hàng',
                'team' => 'Đội ngũ phát triển SP/GP/ƯD',
                'award' => 'Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được',
                'copyright_certificate' => 'Số giấy chứng nhận bản quyền',
                'certificate' => 'Giấy chứng nhận bản quyền/cam kết bản quyền'
            )
        );

        foreach($data as $key => $extra_info){
            if (!empty($extra_info['service'])) {
                $services = json_decode($extra_info['service']);
                $s_arr = [];
                foreach ($services as $k => $v) {
                    $s_arr[] = $this->data['product_services'][$v];
                }
                $s_text = implode(', ', $s_arr);
            } else {
                $s_text = '';
            }
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'name' => html_entity_decode(strip_tags($extra_info['name'])),
                'service' => html_entity_decode(strip_tags($s_text)),
                'functional' => html_entity_decode(strip_tags($extra_info['functional'])),
                'process' => html_entity_decode(strip_tags($extra_info['process'])),
                'security' => html_entity_decode(strip_tags($extra_info['security'])),
                'positive' => html_entity_decode(strip_tags($extra_info['positive'])),
                'compare' => html_entity_decode(strip_tags($extra_info['compare'])),
                'open_date' => html_entity_decode(strip_tags($extra_info['open_date'])),
                'price' => html_entity_decode(strip_tags($extra_info['price'])),
                'income_1' => html_entity_decode(strip_tags($extra_info['income_1'])),
                'income_2016' => html_entity_decode(strip_tags($extra_info['income_2016'])),
                'income_2017' => html_entity_decode(strip_tags($extra_info['income_2017'])),
                'customer' => html_entity_decode(strip_tags($extra_info['customer'])),
                'area' => html_entity_decode(strip_tags($extra_info['area'])),
                'after_sale' => html_entity_decode(strip_tags($extra_info['after_sale'])),
                'team' => html_entity_decode(strip_tags($extra_info['team'])),
                'award' => html_entity_decode(strip_tags($extra_info['award'])),
                'copyright_certificate' => html_entity_decode(strip_tags($extra_info['copyright_certificate'])),
                'certificate' => html_entity_decode(strip_tags($extra_info['certificate']))
            );
        }
        return $data_export;

    }

    private function product_export_stype_3($data, $requestYear) {
        $requestYear = (int) $requestYear;
        $data_export = array(
            '0' => array(
                'company' => 'BDS',
                'field_1' => 'Tên dự án BĐS CN',
                'field_2' => 'Hạng mục đăng ký tham gia',
                'field_3' => 'Hồ sơ pháp lý gửi kèm',
                'field_4' => 'text',
                'field_5' => 'text',
                'field_6' => 'text',
                'field_7' => 'text',
                'field_8' => 'text',
                'field_9' => 'text',
                'field_10' => 'text',
                'field_11' => 'text',
                'field_12' => 'text',
                'field_13' => 'text',
                'field_14' => 'text',
                'field_15' => 'text',
                'field_16' => 'text',
                'field_17' => 'text',
                'field_18' => 'text',
                'field_19' => 'text',
                'field_20' => 'text',
                'field_21' => 'text',
                'field_22' => 'text',
                'field_23' => 'text',
                'field_24' => 'text',
                'field_25' => 'text',
                'field_26' => 'text',
                'field_27' => 'text',
                'field_28' => 'text',
                'field_29' => 'text',
                'field_30' => 'text',
                'field_31' => 'text',
                'field_32' => 'text',
                'field_33' => 'text'
            )
        );

        foreach($data as $key => $extra_info){
            if (!empty($extra_info['field_3'])) {
                $services = json_decode($extra_info['field_3']);
                $s_arr = [];
                foreach ($services as $k => $v) {
                    $s_arr[] = $this->data['attached_legal_documents_stype3'][$v];
                }
                $s_text = implode(', ', $s_arr);
            } else {
                $s_text = '';
            }
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'field_1' => html_entity_decode(strip_tags($extra_info['field_1'])),
                'field_2' => html_entity_decode(strip_tags($this->data['categories'][$extra_info['field_2']])),
                'field_3' => html_entity_decode(strip_tags($s_text)),
                'field_4' => html_entity_decode(strip_tags($extra_info['field_4'])),
                'field_5' => html_entity_decode(strip_tags($extra_info['field_5'])),
                'field_6' => html_entity_decode(strip_tags($extra_info['field_6'])),
                'field_7' => html_entity_decode(strip_tags($extra_info['field_7'])),
                'field_8' => html_entity_decode(strip_tags($extra_info['field_8'])),
                'field_9' => html_entity_decode(strip_tags($extra_info['field_9'])),
                'field_10' => html_entity_decode(strip_tags($extra_info['field_10'])),
                'field_11' => html_entity_decode(strip_tags($extra_info['field_11'])),
                'field_12' => html_entity_decode(strip_tags($extra_info['field_12'])),
                'field_13' => html_entity_decode(strip_tags($extra_info['field_13'])),
                'field_14' => html_entity_decode(strip_tags($extra_info['field_14'])),
                'field_15' => html_entity_decode(strip_tags($extra_info['field_15'])),
                'field_16' => html_entity_decode(strip_tags($extra_info['field_16'])),
                'field_17' => html_entity_decode(strip_tags($extra_info['field_17'])),
                'field_18' => html_entity_decode(strip_tags($extra_info['field_18'])),
                'field_19' => html_entity_decode(strip_tags($extra_info['field_19'])),
                'field_20' => html_entity_decode(strip_tags($extra_info['field_20'])),
                'field_21' => html_entity_decode(strip_tags($extra_info['field_21'])),
                'field_22' => html_entity_decode(strip_tags($extra_info['field_22'])),
                'field_23' => html_entity_decode(strip_tags($extra_info['field_23'])),
                'field_24' => html_entity_decode(strip_tags($extra_info['field_24'])),
                'field_25' => html_entity_decode(strip_tags($extra_info['field_25'])),
                'field_26' => html_entity_decode(strip_tags($extra_info['field_26'])),
                'field_27' => html_entity_decode(strip_tags($extra_info['field_27'])),
                'field_28' => html_entity_decode(strip_tags($extra_info['field_28'])),
                'field_29' => html_entity_decode(strip_tags($extra_info['field_29'])),
                'field_30' => html_entity_decode(strip_tags($extra_info['field_30'])),
                'field_31' => html_entity_decode(strip_tags($extra_info['field_31'])),
                'field_32' => html_entity_decode(strip_tags($extra_info['field_32'])),
                'field_33' => html_entity_decode(strip_tags($extra_info['field_33']))
            );
        }
        return $data_export;

    }

    private function product_export_stype_2($data, $requestYear) {
        $requestYear = (int) $requestYear;
        $data_export = array(
            '0' => array(
                'company' => 'BDS',
                'field_1' => 'text',
                'field_2' => 'text',
                'field_3' => 'text',
                'field_4' => 'text',
                'field_5' => 'text',
                'field_6' => 'text',
                'field_7' => 'text',
                'field_8' => 'text',
                'field_9' => 'text',
                'field_10' => 'text',
                'field_11' => 'text',
                'field_12' => 'text',
                'field_13' => 'text',
                'field_14' => 'text',
                'field_15' => 'text',
                'field_16' => 'text',
                'field_17' => 'text',
                'field_18' => 'text',
                'field_19' => 'text',
                'field_20' => 'text',
                'field_21' => 'text',
                'field_22' => 'text',
                'field_23' => 'text',
                'field_24' => 'text',
                'field_25' => 'text',
                'field_26' => 'text',
                'field_27' => 'text',
                'field_28' => 'text',
                'field_29' => 'text',
                'field_30' => 'text',
                'field_31' => 'text'
            )
        );

        foreach($data as $key => $extra_info){
            if (!empty($extra_info['field_3'])) {
                $services = json_decode($extra_info['field_3']);
                $s_arr = [];
                foreach ($services as $k => $v) {
                    $s_arr[] = $this->data['attached_legal_documents_stype2'][$v];
                }
                $s_text = implode(', ', $s_arr);
            } else {
                $s_text = '';
            }
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'field_1' => html_entity_decode(strip_tags($extra_info['field_1'])),
                'field_2' => html_entity_decode(strip_tags($this->data['categories_bds'][$extra_info['field_2']])),
                'field_3' => html_entity_decode(strip_tags($s_text)),
                'field_4' => html_entity_decode(strip_tags($extra_info['field_4'])),
                'field_5' => html_entity_decode(strip_tags($extra_info['field_5'])),
                'field_6' => html_entity_decode(strip_tags($extra_info['field_6'])),
                'field_7' => html_entity_decode(strip_tags($extra_info['field_7'])),
                'field_8' => html_entity_decode(strip_tags($extra_info['field_8'])),
                'field_9' => html_entity_decode(strip_tags($extra_info['field_9'])),
                'field_10' => html_entity_decode(strip_tags($extra_info['field_10'])),
                'field_11' => html_entity_decode(strip_tags($extra_info['field_11'])),
                'field_12' => html_entity_decode(strip_tags($extra_info['field_12'])),
                'field_13' => html_entity_decode(strip_tags($extra_info['field_13'])),
                'field_14' => html_entity_decode(strip_tags($extra_info['field_14'])),
                'field_15' => html_entity_decode(strip_tags($extra_info['field_15'])),
                'field_16' => html_entity_decode(strip_tags($extra_info['field_16'])),
                'field_17' => html_entity_decode(strip_tags($extra_info['field_17'])),
                'field_18' => html_entity_decode(strip_tags($extra_info['field_18'])),
                'field_19' => html_entity_decode(strip_tags($extra_info['field_19'])),
                'field_20' => html_entity_decode(strip_tags($extra_info['field_20'])),
                'field_21' => html_entity_decode(strip_tags($extra_info['field_21'])),
                'field_22' => html_entity_decode(strip_tags($extra_info['field_22'])),
                'field_23' => html_entity_decode(strip_tags($extra_info['field_23'])),
                'field_24' => html_entity_decode(strip_tags($extra_info['field_24'])),
                'field_25' => html_entity_decode(strip_tags($extra_info['field_25'])),
                'field_26' => html_entity_decode(strip_tags($extra_info['field_26'])),
                'field_27' => html_entity_decode(strip_tags($extra_info['field_27'])),
                'field_28' => html_entity_decode(strip_tags($extra_info['field_28'])),
                'field_29' => html_entity_decode(strip_tags($extra_info['field_29'])),
                'field_30' => html_entity_decode(strip_tags($extra_info['field_30'])),
                'field_31' => html_entity_decode(strip_tags($extra_info['field_31'])),
            );
        }
        return $data_export;
    }

    private function product_export_stype_1($data, $requestYear) {
        $requestYear = (int) $requestYear;
        $data_export = array(
            '0' => array(
                'company' => 'Thành phố/đô thị',
                'field_21' => 'Lĩnh vực đăng ký tham gia Giải thưởng',
                'field_2' => 'Hành lang pháp lý',
                'field_3' => 'Thực tế triển khai các đề án, dự án, chương trình ứng dụng CNTT',
                'field_4' => 'Các ứng dụng công nghệ, tiện ích thông minh cho người dân và doanh nghiệp trong lĩnh vực đăng ký xét trao Giải',
                'field_5' => 'Quy mô và tỉ lệ đầu tư cho xây dựng Hạ tầng dữ liệu/hạ tầng số của tỉnh/thành phố trên tổng mức đầu tư cho xây dựng và phát triển thành phố thông minh; tỉ lệ  CNTT trong các dự án đầu tư',
                'field_6' => 'Mức độ hoàn thiện của chính quyền điện tử/chính quyền số',
                'field_7' => 'Bảo mật an toàn thông tin, an ninh cho người dân',
                'field_8' => 'Khả năng tiếp cận cơ hội số của người dân, cộng đồng và doanh nghiệp tại thành phố',
                'field_9' => 'Các chính sách, chương trình, hoạt động khuyến khích khởi nghiệp đổi mới sáng tạo của tỉnh, thành phố (cung cấp thông tin nếu đăng ký lĩnh vực “Thành phố hấp dẫn Khởi nghiệp ĐMST”), gồm',
                'field_10' => 'Số lượng DN thành lập mới năm 2018, 2019',
                'field_11' => 'Các chính sách của tỉnh/thành phố cho startups',
                'field_12' => 'Các chương trình hỗ trợ, thúc đẩy startups năm 2018, 2019',
                'field_13' => 'Tổng ngân sách cho hỗ trợ, thúc đẩy startups năm 2018, 2019',
                'field_14' => 'Các đơn vị phụ trách, vườn ươm, trung tâm hỗ trợ/thúc đẩy khởi nghiệp',
                'field_15' => 'Kết quả đạt được trong 2018, 2019',
                'field_16' => 'Sự chuẩn bị nguồn nhân lực cho xây dựng thành phố thông minh, gồm',
                'field_17' => 'Các khoá đào tạo liên quan đến thành phố thông minh và số lượng người tham gia năm 2018, 2019',
                'field_18' => 'Kinh phí cho đào tạo liên quan đến thành phố thông minh năm 2018, 2019',
                'field_19' => 'Các tiêu chí, tiêu chuẩn chuyên ngành, kỹ thuật riêng của từng lĩnh vực đăng ký (nếu có)',
                'field_20' => 'Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh)'
            )
        );

        foreach($data as $key => $extra_info){
            $data_export[$key + 1] = array(
                'company' => $extra_info['company'],
                'field_21' => html_entity_decode(strip_tags($this->data['type_smart_city'][$extra_info['field_21']])),
                'field_2' => html_entity_decode(strip_tags($extra_info['field_2'])),
                'field_3' => html_entity_decode(strip_tags($extra_info['field_3'])),
                'field_4' => html_entity_decode(strip_tags($extra_info['field_4'])),
                'field_5' => html_entity_decode(strip_tags($extra_info['field_5'])),
                'field_6' => html_entity_decode(strip_tags($extra_info['field_6'])),
                'field_7' => html_entity_decode(strip_tags($extra_info['field_7'])),
                'field_8' => html_entity_decode(strip_tags($extra_info['field_8'])),
                'field_9' => html_entity_decode(strip_tags($extra_info['field_9'])),
                'field_10' => html_entity_decode(strip_tags($extra_info['field_10'])),
                'field_11' => html_entity_decode(strip_tags($extra_info['field_11'])),
                'field_12' => html_entity_decode(strip_tags($extra_info['field_12'])),
                'field_13' => html_entity_decode(strip_tags($extra_info['field_13'])),
                'field_14' => html_entity_decode(strip_tags($extra_info['field_14'])),
                'field_15' => html_entity_decode(strip_tags($extra_info['field_15'])),
                'field_16' => html_entity_decode(strip_tags($extra_info['field_16'])),
                'field_17' => html_entity_decode(strip_tags($extra_info['field_17'])),
                'field_18' => html_entity_decode(strip_tags($extra_info['field_18'])),
                'field_19' => html_entity_decode(strip_tags($extra_info['field_19'])),
                'field_20' => html_entity_decode(strip_tags($extra_info['field_20']))
            );
        }
        return $data_export;
    }

    public function export_company_detail($id){
        //activate worksheet number 1


        // $sheet_basic = $this->excel->createSheet(0);
        // $sheet_basic->setTitle('Thong Tin Co Ban');
        $sheet = $this->excel->createSheet(1);
        $sheet->setTitle('Thong Tin Doanh Nghiep');

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Thong Tin Co Ban');

        // load database
        $this->load->database();

        // get all users in array formate
        $select_basic = 'website, legal_representative, lp_position, lp_email, lp_phone, connector, c_position, c_email, c_phone';
        $data_basic = $this->information_model->get_detail_information_with_select_by_id($id);

        $data = $this->information_model->fetch_company_by_id($id);

        // Get user info
        $target_user = $this->users_model->fetch_by_id($data['client_id']);

        $data_basic_export = array(
            '0' => array(
                'website' => 'Website',
                'legal_representative' => 'Tên người đại diện pháp luật',
                'lp_position' => 'Chức danh người đại diện pháp luật',
                'lp_email' => 'Email người đại diện pháp luật',
                'lp_phone' => 'Di động người đại diện pháp luật',
                'connector' => 'Tên người liên hệ với BTC',
                'c_position' => 'Chức danh người liên hệ với BTC',
                'c_email' => 'Email người liên hệ với BTC',
                'c_phone' => 'Di động người liên hệ với BTC',
            )
        );

        $data_basic_export[] = array(
            'website' => $data_basic['website'],
            'legal_representative' => $data_basic['legal_representative'],
            'lp_position' => $data_basic['lp_position'],
            'lp_email' => $data_basic['lp_email'],
            'lp_phone' => $data_basic['lp_phone'],
            'connector' => $data_basic['connector'],
            'c_position' => $data_basic['c_position'],
            'c_email' => $data_basic['c_email'],
            'c_phone' => $data_basic['c_phone']
        );
        $this->excel->getActiveSheet()->fromArray($data_basic_export);

        $data_export = array(
            '0' => array(
                'equity_1' => 'Vốn điều lệ năm '. $this->data['rule3Year'][0] .' (triệu VND)',
                'equity_2' => 'Vốn điều lệ năm '. $this->data['rule3Year'][1] .' (triệu VND)',
                'equity_3' => 'Vốn điều lệ năm '. $this->data['rule3Year'][2] .' (triệu VND)',
                'owner_equity_1' => 'Tổng tài sản '. $this->data['rule3Year'][0] .' (triệu VND)',
                'owner_equity_2' => 'Tổng tài sản '. $this->data['rule3Year'][1] .' (triệu VND)',
                'owner_equity_3' => 'Tổng tài sản '. $this->data['rule3Year'][2] .' (triệu VND)',
                'total_income_1' => 'Tổng doanh thu DN '. $this->data['rule3Year'][0],
                'total_income_2' => 'Tổng doanh thu DN '. $this->data['rule3Year'][1],
                'total_income_3' => 'Tổng doanh thu DN '. $this->data['rule3Year'][2],
                'software_income_1' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][0] .' (Triệu VND)',
                'software_income_2' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][1] .' (Triệu VND)',
                'software_income_3' => 'Tổng DT lĩnh vực sx phần mềm '. $this->data['rule3Year'][2] .' (Triệu VND)',
                'it_income_1' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][0] .' (triệu VND)',
                'it_income_2' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][1] .' (triệu VND)',
                'it_income_3' => 'Tổng doanh thu dịch vụ CNTT '. $this->data['rule3Year'][2] .' (triệu VND)',
                'export_income_1' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][0],
                'export_income_2' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][1],
                'export_income_3' => 'Tổng DT xuất khẩu (USD) '. $this->data['rule3Year'][2],
                'total_labor_1' => 'Tổng số lao động của DN '. $this->data['rule3Year'][0],
                'total_labor_2' => 'Tổng số lao động của DN '. $this->data['rule3Year'][1],
                'total_labor_3' => 'Tổng số lao động của DN '. $this->data['rule3Year'][2],
                'total_ltv_1' => 'Tổng số LTV '. $this->data['rule3Year'][0],
                'total_ltv_2' => 'Tổng số LTV '. $this->data['rule3Year'][1],
                'total_ltv_3' => 'Tổng số LTV '. $this->data['rule3Year'][2],
                'main_service' => 'SP dịch vụ chính của DN',
                'main_market' => 'Thị trường chính',
                'description' => 'Giới thiệu chung',
            )
        );
        $str_main_service = '';
        if (( !empty($data['main_service']) && $data['main_service'] != 'null' && $data['main_service'] != null )) {
            $main_service = json_decode($data['main_service']);
            foreach ($main_service as $key => $value) {
                $str_main_service .= $value . ' ,';
            }
        }

        $str_main_market = '';
        if (( !empty($data['main_market']) && $data['main_market'] != 'null' && $data['main_market'] != null )) {
            $main_market = json_decode($data['main_market']);
            foreach ($main_market as $key => $value) {
                $str_main_market .= $value . ' ,';
            }
        }


        $data_export[] = array(
            'equity_1' => $data['equity_1'],
            'equity_2' => $data['equity_2'],
            'equity_3' => $data['equity_3'],
            'owner_equity_1' => $data['owner_equity_1'],
            'owner_equity_2' => $data['owner_equity_2'],
            'owner_equity_3' => $data['owner_equity_3'],
            'total_income_1' => $data['total_income_1'],
            'total_income_2' => $data['total_income_2'],
            'total_income_3' => $data['total_income_3'],
            'software_income_1' => $data['software_income_1'],
            'software_income_2' => $data['software_income_2'],
            'software_income_3' => $data['software_income_3'],
            'it_income_1' => $data['it_income_1'],
            'it_income_2' => $data['it_income_2'],
            'it_income_3' => $data['it_income_3'],
            'export_income_1' => $data['export_income_1'],
            'export_income_2' => $data['export_income_2'],
            'export_income_3' => $data['export_income_3'],
            'total_labor_1' => $data['total_labor_1'],
            'total_labor_2' => $data['total_labor_2'],
            'total_labor_3' => $data['total_labor_3'],
            'total_ltv_1' => $data['total_ltv_1'],
            'total_ltv_2' => $data['total_ltv_2'],
            'total_ltv_3' => $data['total_ltv_3'],
            'main_service' => $str_main_service,
            'main_market' => $str_main_market,
            'description' => html_entity_decode(strip_tags($data['description'])),
        );
        $sheet->fromArray($data_export);

        // read data to active sheet

        $filename='Chi_tiet_doanh_nghiep_' . str_replace(' ', '-', $target_user['company']) . '_' . date("d-m-Y") . '.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}
