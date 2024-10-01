<?php

class BatchController extends UI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function Index(){

        $req_data = default_req_data();
  
        $api_endpoint 		= api_url('BatchController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);
    
        $data['batches'] 	= $api_res['data'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/batch'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }


    public function store(){
        $fields = array(
            'batch_name' => arr('Batch field','required')
        );

        // Set validation rules for each field
        foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

        if ($this->form_validation->run() == FALSE){
            $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
            return;
        }

        $data = $this->input->post();

        $req_data = ['message' =>[
                'batch_name' => $data['batch_name']
             ]
        ];

        $api_url = api_url('batchController/store');
        $api_response = send_request($req_data,$api_url);

        json_response($api_response,200);
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

        $api_url = api_url("batchController/get");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function update(){
        $fields = array(
            'batch_name' => arr('Batch field','required')
        );

        // Set validation rules for each field
        foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

        if ($this->form_validation->run() == FALSE){
            $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
            return;
        }

        if($this->input->post('id') === "" || $this->input->post('id') === null){
            $err = [
                'code' => 2,
                'message' => 'Some important Data are missing! Contact your Admin!'
            ];
            json_response($err,200);
            return;
        }

        $data = $this->input->post();

        $req_data = [
            'message' => [
                'batch_name' => $data['batch_name'],
                'batch_id'   => $data['id']
             ]
            ];  
        $api_url = api_url("batchController/update");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
        
    }

    public function delete(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'Some important Data are missing! Contact your admin!'
            ];
            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
                ]
            ];
        $api_url = api_url("batchController/destroy");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }
}