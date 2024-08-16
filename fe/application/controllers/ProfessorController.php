<?php

class ProfessorController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
         // Enable error reporting
         error_reporting(E_ALL);
         ini_set('display_errors', 1);

         if (!isset($this->form_validation)) {
            echo "Form Validation library is not loaded.";
        }
    }

    public function index(){
        $req_data = [];
  
        $api_endpoint 		= api_url('ProfessorController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);
    
        //$data['Products'] 	= $api_res['result'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
        $data['content']    = 'admin/professor'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';
    
        $this->load->view('_partials/header', $data); 
    }

    public function store(){
        $fields = array(
            'prof_name' => arr('Professor Name','required'),
            'email'     => arr('Email','required'),
            'address'   => arr('Address','required'),
            'contact'   => arr('Contact','max_length[11]'),
            'degree'     => arr('Degree','required')
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
           $errors = $this->form_validation->error_array();
            
            // Send JSON response with errors
            json_response($errors, 400);
        } else {
            // Handle successful validation

            json_response('success',200);
        }

    }
}