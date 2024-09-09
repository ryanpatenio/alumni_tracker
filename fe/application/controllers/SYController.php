<?php

class SYController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

   public function index(){
    $req_data = [];
  
    $api_endpoint 		= api_url('SYController/GetAll');
    $api_res 			= send_request($req_data, $api_endpoint);

    $data['schoolYear'] 	= $api_res['data'];
    $data['page_title'] = '';
    $data['sidebar']    = '_partials/sidebar';
    $data['content']    = 'admin/sy'; 
    $data['js_file']    = 'assets/admin-assets/ajax/products.js';

    $this->load->view('_partials/header', $data);

   }

   public function store(){
        $fields = array(
            'sy_name' => arr('School Year','required')
        );

        foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

        if($this->form_validation->run() == FALSE){
            $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
            return;
        }

        $data = $this->input->post();

        $req_data = [
            'message' => [
                'sy_name' => $data['sy_name']
                ]
            ];

        $api_url = api_url("syController/store");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
   }

   public function get(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some Data are missing! Contact your Administrator!'
            ];
            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
                ]
            ];
        $api_url = api_url("syController/get");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
   }

   public function update(){
        $fields = array(
            'sy_name' => arr('School Year','required')
        );

        foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

        if($this->form_validation->run() == FALSE){
            $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
            return;
        }

        $data = $this->input->post();
        $id = $data['id'];

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some Data are Missing! Contact your Administrator!'
            ];

            json_response($err,200);
            return;

        }

        $req_data = [
            'message' => [
                'sy_id' => $id,
                'sy_name' => $data['sy_name']
             ]
            ];
        
        $api_url = api_url("syController/update");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);

   }

   public function delete(){
        $id = $this->input->post('id');

        if($id === NULL || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some Data are missing! Contact Your Adminstrator!'
            ];

            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
                ]
            ];

        $api_url = api_url("syController/destroy");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
   }
}