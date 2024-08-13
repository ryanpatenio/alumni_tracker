<?php

class SectionController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $req_data = [];
  
        $api_endpoint 		= api_url('SectionController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);
    
        //$data['Products'] 	= $api_res['result'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/sections'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }
}