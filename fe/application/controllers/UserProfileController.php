<?php

use PhpParser\Node\Stmt\Foreach_;

class UserProfileController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

   public function index(){
    $req_data = [];
  
    $api_endpoint 		= api_url('UserProfileController/GetAll');
    $api_res 			= send_request($req_data, $api_endpoint);

    //$data['Products'] 	= $api_res['result'];
    $data['page_title'] = '';
    $data['sidebar']    = '_partials/sidebar';
    $data['content']    = 'admin/profile'; 
    $data['js_file']    = 'assets/admin-assets/ajax/products.js';

    $this->load->view('_partials/header', $data);

   }

   public function changePass(){
        $fields = array(
            'currentPassword' => arr('Old Password','required'),
            'newPassword' => arr('New Password','required')
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

        json_response($data,200);
        #!TO DO!!! change this when you fix the log in session

   }
}