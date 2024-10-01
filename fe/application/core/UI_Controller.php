<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UI_Controller extends CI_Controller {

	
	public function __construct()
	{
        parent::__construct();
        date_default_timezone_set('Asia/Manila');

        /**
         * What controllers are exempted from authentication checking?
         * Put it inside the array here
         * @see $login_auth_whitelist
         */
        
        /**
         * checking api access token if expired or not
         * 101 api code = Token Expired
         * redirect to default login page
         * @see is_token_expired @see auth_helper
         *  */

        $req_data = default_req_data();
  
        $api_endpoint 		= api_url('StudentController/GetAll');
        $api_res 			= send_request($req_data, $api_endpoint);

        $login_auth_whitelist = ['authController'];
    

        if( ! in_array($this->router->fetch_class(), $login_auth_whitelist)) {
            is_logged_in();

            is_token_expired($api_res['code']);

        }

        

	}


}
