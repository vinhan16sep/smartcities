<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Public_Controller {

    private $_lang = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->data['page_title'] = "Smart Cities Award";
    }

    public function index(){
        $this->load->view('homepage_view');

        $this->render('homepage_view');
    }

}
