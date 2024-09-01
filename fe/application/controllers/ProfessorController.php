<?php

class ProfessorController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();

         // Enable error reporting
         error_reporting(E_ALL);
         ini_set('display_errors', 1);
    }

    public function index(){
        $req_data = [];
  
        $api_endpoint 		= api_url('ProfessorController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);
    
        $data['professors'] 	= $api_res['data'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/professor'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }

    public function store(){
        # associativie array
        # array(key=>value,key=>value,key=>value,etc.)
        $fields = array(
            'prof_name' => arr('Professor Name','required'),
            'email'     => arr('Email','required'),
            'address'   => arr('Address','required'),
            'contact'   => arr('Contact','max_length[11]'),
            'degree'    => arr('Degree','required')
            #sample you can add some rules
            #'sample'  => arr('label',array('required','maxlength[11]','valid_email'));
        );


         // Set validation rules for each field
         foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

          # Run validation
          if ($this->form_validation->run() == FALSE) {
            #collect Errors
           $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
        } else {
            // Handle successful validation

            $input = $this->input->post();

            $req_data 		= [ 'message'	=> [
				'prof_name'          	=> $input['prof_name'],
                'email'              	=> $input['email'],
                'address'       	=> $input['address'],
                'contact'          => $input['contact'],
                'degree'           => $input['degree']
              
			    ] 
		    ];

            $api_url = api_url('professorController/store');
            $api_req = send_request($req_data,$api_url);

            json_response($api_req,200);
        }

    }

    public function getProfessor(){
        $id = $this->input->post('ID');

        if($id == null || $id == ""){
            json_response('ID not Found!',400);
            return;
        }

            $req_data = ['message' => [
                'filter' => $id,
            ],
        ];

        $api_url = api_url('professorController/getProfessor');
        $api_req = send_request($req_data,$api_url);

        json_response($api_req,200);
    }

    public function update(){

        $fields = array(
            'prof_name' => arr('Professor Name','required'),
            'email'     => arr('Email','required'),
            'address'   => arr('Address','required'),
            'contact'   => arr('Contact','max_length[11]'),
            'degree'    => arr('Degree','required'),
            
            #sample you can add some rules
            #'sample'  => arr('label',array('required','maxlength[11]','valid_email'));
        );

        foreach ($fields as $field => $details) {
            set_val_rule($field, $details['label'],$details['rules']);
        }

         # Run validation
         if ($this->form_validation->run() == FALSE) {
            #collect Errors
           $errors = form_error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);

        }else{
            $input = $this->input->post();

            $req_data 		= [ 'message'	=> [
				'prof_name'          	=> $input['prof_name'],
                'email'              	=> $input['email'],
                'address'       	=> $input['address'],
                'contact'          => $input['contact'],
                'degree'           => $input['degree'],
                'id'               => $input['id'],
              
			    ] 
		    ];

            $api_url = api_url('professorController/update');
            $api_req = send_request($req_data,$api_url);

            json_response($api_req,200);
        }
    }

    public function delete(){
        $id = $this->input->post('id');

        if($id === null || $id === ""){
            $err = [
                'code' => 2,
                'message' => 'required Data not Found!',
                
            ];
            json_response($err,200);
            return;
        }

        $req_data = [
            'message' => [
                'filter' => $id
            ]
            
        ];

        $api_url = api_url('professorController/destroy');
        $api_req = send_request($req_data,$api_url);

        json_response($api_req,200);
    }
}