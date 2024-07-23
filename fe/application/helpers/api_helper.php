<?php

if( ! function_exists('api_url') )
{

	function api_url($url)
	{

		#put your backend URL here! modify this before anything else
		$api_endpoint = 'http://localhost/alumni_tracker/be/' . $url;

		if(ENVIRONMENT == 'production') {
			$api_endpoint = 'http://localhost/ci_api/ci_backend/' . $url; 
			#This will change once we have a PRODUCTION server/domain.
			
		}

		return $api_endpoint;
		
	}
} // END method -- api_url();




if( ! function_exists('is_success') )
{
	#check api response
	function is_success($result_code)
	{
		if( substr($result_code, -1) == 0 ) {
			return TRUE;
		
		} else {
			return FALSE;

		}
		
	}
} // END method of is_success();




// if( ! function_exists('guzzle_post') ) {

// 	function guzzle_post($json_data, $url, $header = null, $jwt_encode = true) {

// 		$ci_instance =& get_instance();

// 		if(is_null($header)) {
// 			$header = [
//                 'Content-Type'  => 'application/json',
//                 // 'Authorization' => 'Basic dWJzQHBheTFzdC5jb20ucGg6MTIzNDU='
//             ];

// 		}

//         // $ci_instance->load->library('CI_Jwt');

//         $json_data = (is_object($json_data) ? $json_data : json_encode($json_data));

//         // if($jwt_encode == true) {
//         //     $json_data = json_encode(['message' => $ci_instance->ci_jwt->jwt_encode($json_data)]);

//         // }


//         $client = new GuzzleHttp\Client();
// 		$response = $client->post($url, [
// 			'headers'   => $header,
//             'body'      => $json_data,
//             'verify'    => false, // SSL Verification
//             // 'verify'    => true, 
// 		]);

// 		return $response->getBody()->getContents();

// 	} // END method -- curlClient();

// }

if( ! function_exists('send_request') ) {

	function send_request($user_data, $api_endpoint, array $header = ['Content-Type: application/json']) {
		$ci_instance =& get_instance();


		// $access_token = get_instance()->session->token;

		// if( ! is_null($access_token)) {
		// 	$auth_header = 'Authorization: Bearer ' . $access_token;
		// 	array_push($header, $auth_header);

		// }


		if( ! isset($user_data['message'])) {
			$post_data['message'] = $user_data;

		} else {
			$post_data = $user_data;

			//  if( ! isset($user_data['message']['info'])) {
			//  	$post_data['message']['info'] = ['user' => get_instance()->session->username];

			//  }

		}

        $post_data = (is_object($post_data) ? $post_data : json_encode($post_data));

		// Initialize cURL session
        $curl = curl_init();

        // Set common cURL options
        curl_setopt($curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return the response as a string
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); // Timeout for the connection
        curl_setopt($curl, CURLOPT_TIMEOUT, 10); // Timeout for the entire request
		curl_setopt($curl, CURLOPT_POST, 1); // Force to do a POST request
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        // Execute cURL request and get the response
        $response = curl_exec($curl);

		curl_close($curl);

		return json_decode($response, true);

	} // END method -- curl_request();

}