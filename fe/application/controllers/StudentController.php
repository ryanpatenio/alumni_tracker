<?php

class StudentController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

   public function index(){
    $req_data = [];
  
    $api_endpoint 		= api_url('StudentController/GetAll');
    $api_res 			= send_request($req_data, $api_endpoint);

    $data['Students'] 	= $api_res['data']['student'];
    $data['Professors'] = $api_res['data']['professor'];
    $data['page_title'] = '';
    $data['sidebar']    = '_partials/sidebar';
    $data['content']    = 'admin/Students'; 
    $data['js_file']    = 'assets/admin-assets/ajax/products.js';

    $this->load->view('_partials/header', $data);

   }
}