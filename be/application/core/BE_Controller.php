<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BE_Controller extends CI_Controller
{
    public $user_id;
    public $user;
    public $email;
    public $token;

    protected $message;
    protected $orig_message;
    protected $log_data;
    protected $dbs;

    

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');

        $this->load->library('BE_Exception');
        $this->load->database();

        $this->dbs[0] = $this->db;

       // log_message('error', 'Authorization Header: ' . $this->input->get_request_header('Authorization'));


      //  $authorization 	= explode(",", $this->input->get_request_header('Authorization'));
     //  log_message('error', 'Authorization Header: ' . $authorization);

     $authorizationHeader = $this->input->get_request_header('Authorization');
     if ($authorizationHeader) {
         // Assuming the header is in the format "Bearer token_value"
         $tokenParts = explode(' ', $authorizationHeader);
         if (count($tokenParts) === 2 && strtolower($tokenParts[0]) === 'bearer') {
             $accessToken = $tokenParts[1]; // This is your access token
         } else {
             // Handle invalid Authorization header format
             $accessToken = null;  
         }
     } else {
         // Authorization header is not present
         $accessToken = null;  
     }

     //log_message('error',$accessToken);
     

        
        $user   		= '';
        $passwd 		= '';

        $this->token 		= $accessToken;

        $message = json_decode(trim(file_get_contents('php://input')), true);

        $this->message = isset($message['message']) ? $message['message'] : '';
        $this->orig_message = $this->message; 

        $this->init_access_log();
        $this->be_exception->init($this->dbs, $this->log_data);

        $this->check_request_method();
        $this->check_content_type();

     
		$this->user = (isset($this->message['info']['user']) ? $this->message['info']['user'] : null);

        if(is_null($this->user)) {
            $this->be_exception->show_result([
                'code'		=> EXIT_ACCESS_TOKEN,
                'message'	=> 'user is invalid.'
            ]); 

		}


        if( ! $this->_check_user($this->user)) {
			$this->be_exception->show_result([
				'code'		=> EXIT_ACCESS_TOKEN,
				'message'	=> 'User not valid.'
			]);

        }

        if( ! $this->_check_token($this->user_id)) {
            $msg = [
                'code' => EXIT_ACCESS_TOKEN,
                'message' => 'Access token not valid'
            ];
			$this->be_exception->show_result($msg);

		 }
      
      
    }

    private function check_request_method()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            $msg = array(
                'code' => EXIT_BE_ERROR,
                'message' => 'Request must be POST'
            );

            $this->be_exception->show_result($msg);
        }
    }

    private function check_content_type()
    {
        if ($this->input->get_request_header('Content-Type') !== "application/json") {
            $msg = array(
                'code' => EXIT_BE_ERROR,
                'message' => 'Content type must be application/json'
            );

            $this->be_exception->show_result($msg);
        }
    }

    private function init_access_log()
    {
        $this->log_data = array(
            // Initialize your log data here
        );
    }

    

    private function _check_token($user_id)
	{
		$this->load->model('Common_model');
    
        #get the lates Data in the Access Token
        #then the old ones will be deleted or UPDATE to status U
       $query = "SELECT max(id) as id,max(token) as token,max(user_id) as user_id,max(ip_address) as ip_address,max(update_date) as update_date,max(status) as status  FROM access_token WHERE user_id = ? and ip_address = ?  and status = 'A' and token = ? ";
       // $query = "SELECT *  FROM access_token WHERE user_id = ? and ip_address = ?  and status = 'A' and token = ? ";
        $params = [$this->user_id,$this->input->ip_address(),$this->token];
        $check_token = $this->Common_model->regular_query($query,$params);
     
		if(empty($check_token)) {
			return false;

		}
       // log_message('error',print_r($check_token,1));
        #update all the accesss token except the the result of this query above [id] of access_token
        #update only all data where user_id = current users
        $update_query = "UPDATE access_token SET status = 'U' WHERE user_id = ? and id not in(?)";
        $parameter = [$this->user_id,$check_token[0]->id];

        $execute_update = $this->Common_model->regular_query($update_query,$parameter);

        #check if the token is = to the current user token
        #@ only one device can access this web app and only one account per device
        if($this->token != $check_token[0]->token && $check_token[0]->user_id != $this->user_id){
            $error = [
                'code' => EXIT_ACCESS_TOKEN,
                'message'=> 'Invalid access token'
            ];

            $this->be_exception->show_result($error);
          
        }

		$sess_last_update = $check_token[0]->update_date;

		if( ! empty($sess_last_update)) {
		 	 $session_datetime = new DateTime($sess_last_update);
		 	 $current_datetime = new Datetime(current_datetime());

			 $interval = $session_datetime->diff($current_datetime);
			
			if($interval->d > 0 || $interval->h > 0 || $interval->i > 5 ) {
				// If session is greater than 5 minutes without activity

                #get the latest log_id in
                //  $qry = "SELECT max(log_id) as log_id FROM user_logs WHERE user_id = ? LIMIT 1";
                //  $param1 = [$this->user_id];
                //  $res = $this->Common_model->regular_query($qry,$param1);

                //  #update user logs date logout 
                //  $up = "UPDATE user_logs SET date_logout = ? WHERE log_id = ?";
                //  $param2 = [current_datetime(),$res[0]->log_id];
                //  $update = $this->Common_model->regular_query($up,$param2);
                

                $error = [
                    'code' => EXIT_ACCESS_TOKEN,
                    'message'=> 'Invalid access token'
                ];

                $this->be_exception->show_result($error);
              
			}


	     }

		
        $query = "UPDATE access_token SET update_date = ? WHERE id = ?";
        $params = [current_datetime(),$check_token[0]->id];

        $result = $this->Common_model->regular_query($query,$params);

		return true;

	} // END method -- _check_token();

    
	private function _check_user($email)
	{
		$this->load->model('Common_model');

		$user_inquiry = $this->Common_model->select_from_table('users', [
			'select'	=> '*',
			'where'		=> [
				'email'	=> $email
			]
		]);


		if(empty($user_inquiry)) {
			return false;

		}

		$this->user_id 	= $user_inquiry[0]['user_id'];
		$this->user 	= $user_inquiry[0]['email'];

        // log_message('error','user_id '.$this->user_id);
        // log_message('error','user_email '.$this->user);

		return true;

	} // END method -- _check_user();

}
?>
