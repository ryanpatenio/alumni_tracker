<?php

class CourseController extends UI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $req_data = default_req_data();
  
        $api_endpoint 		= api_url('CourseController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);
    
        $data['courses'] 	= $api_res['data'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/courses'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }

    public function store(){
        $fields = array(
            'course_name' => arr('Course field required','required')
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
                'course_name' => $data['course_name']
             ]
        ];

        $api_url = api_url('courseController/store');
        $api_response = send_request($req_data,$api_url);

        json_response($api_response,200);
    }

    public function get(){
        $id = $this->input->post('id');
        $err = [
            'code' => 2,
            'message' => 'some important Data are missing!'
        ];

        if($id === null || $id === ""){
            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
            ]
            ];

        $api_url = api_url('courseController/get');
        $api_response = send_request($req_data,$api_url);

        json_response($api_response,200);
    }

    public function update(){
       
        $fields = array(
            'course_name' => arr('Course','required')
        );

        foreach($fields as $field => $details){
            set_val_rule($field, $details['label'],$details['rules']);
        }

        if($this->form_validation->run() == FALSE){
            $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
            return;
        }

        $data = $this->input->post();
        if($data['id'] === null || $data['id'] === ""){
            $err = [
                'code' => 2,
                'message' => 'some important Data is Missing!'
            ];
            json_response($err,200);
            return;
        }

    
        $req_data = ['message'=> [
            'course_id' => $data['id'],
            'course_name' => $data['course_name']
             ]
        ];

        $api_url = api_url('courseController/update');
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function delete(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => "some important Data is missing!"
            ];
            json_response($err,200);
            return;
        }

        $req_data = ['message' => [
            'filter' => $id
           ]
        
        ];

        $api_url = api_url('courseController/destroy');
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

}