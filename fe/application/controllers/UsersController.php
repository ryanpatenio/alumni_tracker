<?php

class UsersController extends UI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

   public function index(){
    $req_data = [];
  
    $api_endpoint 		= api_url('UserController/GetAll');
    $api_res 			= send_request($req_data, $api_endpoint);

   # $data['users'] 	= $api_res['data'];
    $data['page_title'] = '';
    $data['sidebar']    = '_partials/sidebar';
    $data['content']    = 'admin/users'; 
    $data['js_file']    = 'assets/admin-assets/ajax/products.js';

    $this->load->view('_partials/header', $data);

   }
}