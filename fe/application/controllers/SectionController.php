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
    
        $data['sections'] 	= $api_res['data'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/sections'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }

    public function store(){
        $fields = array(
            'sect_name' => arr('Section','required')
        );

        // Set validation rules for each field
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
                'number' => $data['sect_name']
                ]
            ];

        $api_url = api_url("sectionController/store");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function get(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some Data are missing! Contact your Administrator'
            ];

            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
                ]
            ];
        $api_url = api_url("sectionController/get");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function update(){
        $fields = array(
            'sect_number' => arr('sections','required')
        );

        // Set validation rules for each field
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
            'message'=> [
                'number' => $data['sect_number'],
                'sect_id' => $data['id']
                ]
            ];

        $api_url = api_url("sectionController/update");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function delete(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some Important Data are missing! Contact your Administrator1'
            ];
            json_response($err,200);
            return;
        }

        $req_data = [
            'message'=> [
                'filter' => $id
                ]
            ];

        $api_url = api_url("sectionController/destroy");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }
}