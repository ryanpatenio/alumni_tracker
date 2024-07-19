<?php

class ProductController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $req_data 			= [];
		$api_endpoint 		= api_url('ProductController/GetAll');
		$api_res 			= send_request($req_data, $api_endpoint);

		//$data['Products'] 	= $api_res['result'];
        $data['page_title'] = '';
        $data['sidebar']    = '_partials/sidebar';
		$data['content']    = 'admin/Products'; 
        $data['js_file']    = 'assets/admin-assets/ajax/products.js';

		$this->load->view('_partials/header', $data);
    }


    public function insert(){
        
         $this->form_validation->set_rules('product_name','Product Name','required');

        if($this->form_validation->run() == FALSE){
            $message 		= [
				'code'		=> EXIT_ERROR,
                'message' 	=> 'Validation False'		
			];
          
            echo json_encode($message);
            return;
            
        }
        #SET POST DATA INTO DATA VARIABLE
        $data = $this->input->post();

       // echo json_encode($data);

        $data = $this->input->post();

        $api_endpoint = api_url('ProductController/insert');

        $req_data = ['message'=>[
                'product_name'=> $data['product_name']
            ]
        ];

        $api_response = send_request($req_data,$api_endpoint);

        $message = [
			'code'		=> $api_response['code'],
			'message'	=> $api_response['message'],
		];


        
		if(is_success($api_response['code'])) {
			$message 		= [
				'code'		=> $api_response['code'],
				'message'	=> $api_response['message'],
				'data'      => $api_response['result']
			];

		}

        header('Content-Type: application/json');
		echo json_encode($message);
    }

    public function edit(){

        $id = $this->input->get('id');
       
        //check if null
        if($id == null || $id == ''){
            $message 		= [
				'code'		=> EXIT_ERROR,
                'message' 	=> 'id_null'		
			];
          
            echo json_encode($message);
            return;
        }

        $filter 		= ['id'	=> $id];
        

        $api_endpoint = api_url('ProductController/get');
        #data
        $req_data = ['message'=>[
                'filter'=> $filter,
            ]
        ];

        #process request
        $api_response = send_request($req_data,$api_endpoint);

        #set response message
        $message = [
			'code'		=> $api_response['code'],
			'message'	=> $api_response['message'],
		];

        #check response
        if(is_success($api_response['code'])) {
			$message 		= [
				'code'		=> $api_response['code'],
				'message'	=> $api_response['message'],
				'data'      => $api_response['result']
			];

		}

        #echo response
        header('Content-Type: application/json');
		echo json_encode($message);
        
    }

    public function update(){
         #validations
         $this->form_validation->set_rules('product_name','Product Name','required');
 
         if($this->form_validation->run() == FALSE){
            $message 		= [
				'code'		=> EXIT_ERROR,
                'message' 	=> 'validation_false'		
			];
          
            echo json_encode($message);
            return;
         }
 
         #product id
         $id = $this->input->post('product_id');
        
         
        #check id
        if($id === null || $id === ''){
            #error id null
            $message = [
                'code' => EXIT_ERROR,
                'message' => 'id_null'
            ];
            echo json_encode($message);
            return; #processing will stop then return an error
        }

        #pass the post data into data variable
        $data = $this->input->post();

        #data to send in api
        $req_data = ['message'=>[
            'product_name' => $data['product_name'],
            'id'           => $id,
          ]
        ];
        #api url
        $api_endpoint = api_url('ProductController/update');

         #process request
         $api_response = send_request($req_data,$api_endpoint);

         $message = [
             'code'		=> $api_response['code'],
             'message'	=> $api_response['message'],
         ];


         #check response
        if(is_success($api_response['code'])) {
			$message 		= [
				'code'		=> $api_response['code'],
				'message'	=> $api_response['message'],
				'data'      => $api_response['result']
			];

		}

        #echo response
        header('Content-Type: application/json');
		echo json_encode($message);
 

    }

    public function delete(){
        $id = $this->input->post('id');

        #check id
        if($id == "" || $id == null){
            $message = [
                'code' => EXIT_ERROR,
                'message' => 'id_null'

            ];
            echo json_encode($message);
            return; #return with Error
        }

        #data to send in the api
        $req_data = [ 'message' => [
            'id' => $id
            ],      

        ];
        
        #api url
        $api_endpoint = api_url("productController/delete");

        #api response
        $api_response = send_request($req_data,$api_endpoint);

        #set message for return
        $message = [
			'code'		=> $api_response['code'],
			'message'	=> $api_response['message'],
		];

        #check if success code = true
        if(is_success($api_response['code'])) {
			$message 		= [
				'code'		=> $api_response['code'],
				'message'	=> $api_response['message']
			];
		}
        #header json to make sure that the response will be json array
		header('Content-Type: application/json');
		echo json_encode($message);

    }
}