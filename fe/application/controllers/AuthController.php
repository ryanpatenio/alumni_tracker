<?php

class AuthController extends CI_Controller{


    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Manila');
    }


    public function index(){


        $data['page_title'] = 'Login';

		$this->form_validation->set_rules([
			[
				'field'		=> 'email',
				'label'		=> '<strong> Email </strong>',
				'rules'		=> 'required|trim'
			],
			[
				'field'		=> 'password',
				'label'		=> '<strong> Password </strong>',
				'rules'		=> 'required'
			]
		]);
	
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login', $data);


		} else {
			$this->_login();

		}
    }

    public function _login()
	{
		$username	= $this->input->post('email');
		$password 	= $this->input->post('password');

		$post_data = [
			
			'info'=> [
				'user'=> $username,
				'password'=> $password
		]
	];

		$api_endpoint = api_url('authController/login');
		$api_response = send_request($post_data, $api_endpoint);

		if(is_success($api_response['code'])){
			//echo 'success'.' I-  '.$api_response['code'].'- '.json_encode($api_response['data']);

			$this->session->set_userdata($api_response['data']);
			$this->session->set_userdata('capabilities', $api_response['capabilities']);
			$this->session->set_userdata('token', $api_response['token']);
			redirect(site_url('dashboard'));
			//echo 'success';

		}else{

			flash_message($api_response['message'], 'danger');
			//json_response($api_response['code'],200);
			redirect(site_url());

		}

		//redirect('Search');

		
	} // END method -- _login();

    public function logout()
	{
		$post_data = [
			'message'	=> [
				'user'	=> $this->session->email
			]
		];

		$api_response = send_request($post_data, api_url('authController/logout'));
		
		$this->session->sess_destroy();

		redirect(site_url(''));

	} // END method -- logout();

	public function blocked()
    {
        $this->load->view('auth/blocked');
    }

}