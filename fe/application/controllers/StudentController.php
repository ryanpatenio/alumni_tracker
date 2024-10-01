<?php

class StudentController extends UI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

   public function index(){
    $req_data = default_req_data();
  
    $api_endpoint 		= api_url('StudentController/GetAll');
    $api_res 			= send_request($req_data, $api_endpoint);

    $data['Students'] 	= $api_res['data']['student'];
    $data['Professors'] = $api_res['data']['professor'];
        
    $data['api'] = $api_res['message'];
    $data['page_title'] = '';
    $data['sidebar']    = '_partials/sidebar';
    $data['content']    = 'admin/Students'; 
    $data['js_file']    = 'assets/admin-assets/ajax/products.js';

    $this->load->view('_partials/header', $data);

   }

   public function get(){
        $id = 1;
       
        $req_data = [
            'message' => [
                'filter' => $id
                ]
            ];

        $api_url = api_url("studentController/get");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
   }
}