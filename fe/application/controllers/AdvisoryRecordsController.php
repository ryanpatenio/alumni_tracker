<?php

class AdvisoryRecordsController extends UI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $req_data = default_req_data();
  
        $api_endpoint 		= api_url('AdvisoryRecordsController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);

        #prof api
        $api_url = api_url('ProfessorController/getAll');
        $api_res2 = send_request($req_data,$api_url);
        
    
        #course api
        $api_url2 = api_url('CourseController/getAll');
        $api_res3 = send_request($req_data,$api_url2);

        #section Api
        $api_url3 = api_url('SectionController/getAll');
        $api_res4 = send_request($req_data,$api_url3);

        #SY api
        $api_url4 = api_url('SYController/getAll');
        $api_res5 = send_request($req_data,$api_url4);

        #batch api
        $api_url5 = api_url('BatchController/getAll');
        $api_res6 = send_request($req_data,$api_url5);

        #advisory Records
        $data['professors'] = $api_res2['data'];
        $data['records'] 	= $api_res['data'];
        $data['courses']    = $api_res3['data'];
        $data['sections']   = $api_res4['data'];
        $data['schoolyear'] = $api_res5['data'];
        $data['batches']    = $api_res6['data'];

        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/advisoryRecords'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }

    public function store(){
       
        $fields = array(
            'batch_name' => arr('batch Name field required','required'),
            'course'     => arr('Course Field','required'),
            'prof_name'  => arr('Professor Field','required'),
            'section'    => arr('Section Field','required'),
            'sy'         => arr('School Year Field','required')
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

        $req_data = [
            'message' => [
                'batch_id' => $data['batch_name'],
                'course_id'     => $data['course'],
                'prof_id'  => $data['prof_name'],
                'sect_id'    => $data['section'],
                'sy_id'         => $data['sy']

                ]
            ];

        $api_url = api_url('AdvisoryRecordsController/store');
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function get(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $message = [
                'code' => 2,
                'message' => 'Some Important Data are missing! Contact Your Admin'
            ];
            json_response($message,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
             ]
            ];

        $api_url = api_url("AdvisoryRecordsController/get");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function update(){
        $fields = array(
            'batch_name' => arr('batch Name field required','required'),
            'course'     => arr('Course Field','required'),
            'prof_name'  => arr('Professor Field','required'),
            'section'    => arr('Section Field','required'),
            'sy'         => arr('School Year Field','required')
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

        $req_data = [
            'message' => [
                'batch_id' => $data['batch_name'],
                'course_id'=> $data['course'],
                'advisor_id'       => $data['id'],
                'prof_id'  => $data['prof_name'],
                'sect_id'  => $data['section'],
                'sy_id'    => $data['sy']
              ]
            ];

            $api_url = api_url("AdvisoryRecordsController/update");
            $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);
    }

    public function delete(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $message = [
                'code' => 2,
                'message' => 'Some important Data are missing! Contact Your Admin!'
            ];

            json_response($message,200);
            return;

        }

        $req_data = [
            'message' => [
                'filter' => $id
             ]
            ];

        $api_url = api_url("AdvisoryRecordsController/destroy");
        $api_res = send_request($req_data,$api_url);

        json_response($api_res,200);    
    }
        
}