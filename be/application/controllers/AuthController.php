<?php

class AuthController extends BE_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Common_model');
        $this->load->helper('custom_helper');
		date_default_timezone_set('Asia/Manila');
        
    }

    public function login(){
        #$payload = $this->message['info'];
        $username = $this->message['username'];
        $password = $this->message['password'];

		// Log incoming request
		log_message('debug', 'Login attempt: ' . json_encode($this->message));


        if(empty($username) || empty($password)) {
			$this->custom_exception->show_result([
				'code'		=> EXIT_BE_ERROR,
				'message'	=> error_code(0002)['pretty'],
			]);
           
		}
        
		// $params = [
		// 	'select'		=> '*',
		// 	'where'			=> [
		// 		'email'		=> $username
		// 	],
		// 	'limit'			=> 1
		// ];

		$query = "SELECT * from users WHERE email = ? ";
		$params = [$username];
		$user_inquire = $this->Common_model->regular_query($query,$params);
       
		// Log query result
		log_message('debug', 'User inquiry result: ' . json_encode($user_inquire));

		
        if (empty($user_inquire))  {
			 $this->custom_exception->show_result([
				'code'		=> EXIT_ERROR,
				'message'	=> 'Invalid Username OR Password!'
			]);
            
		}

		$user = $user_inquire[0];
        $pw_hash = $user['password'];

		if( ! password_verify($password, $pw_hash)) {
			$this->custom_exception->show_result([
				'code'		=> EXIT_BE_ERROR,
				'message'	=> 'Invalid Username OR Password'
			]);
           

		 }

        
		$insert_data = [
			'token'			=> $this->_generate_token(),
			'user_id'		=> $user['user_id'],
			'ip_address'	=> $this->input->ip_address()
		];	


		$n_email = $user['email'];
		$update_query = "UPDATE users set last_login_date = ? WHERE email = ?";
		$param = [current_datetime(),$n_email];

		// Log update query
		log_message('debug', 'Update query: ' . $update_query . ' Params: ' . json_encode($param));


       	$this->Common_model->insert('access_token', $insert_data);
		$this->Common_model->regular_query($update_query,$param);#update user last login Date


		$user_capabilities = [
            'orders'    => [
                // 'insert',
                'update',
                'submit',
                'view',
                'delete'
            ]
        ];


        $this->custom_exception->show_result([
			'code'		=> EXIT_SUCCESS,
			'message'	=> OK,
			'token'     =>$insert_data['token'],
				'data'		=> [
				'email'					=> $n_email,
				'name'			=> $user['name'],
				'type'					=> $user['type'],
				
			],
			'capabilities'	=> $user_capabilities
		]);


		
    }


    
	private function _generate_token()
	{
		return bin2hex(random_bytes(32));

	} // END method -- _generate_token();


	public function logout()
	{
		$user_email = $this->message['user'];
		$query = "UPDATE users SET last_logout_date = ? WHERE email = ?";
		$params = [current_datetime(),$user_email];

		//update last logout date of the user
		$this->Common_model->regular_query($query,$params);

	} // END method -- logout();

	function current_dt( $format = 'Y-m-d H:i:s' ) {
        return date( $format );
    }

}