<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('dd')) {
    function dd($dump) {
        die('<pre>' . print_r($dump, 1));
        
    }
}




if( ! function_exists('current_datetime') ) {
    function current_datetime( $format = 'Y-m-d H:i:s' ) {
        return date( $format );
    }
}

if( ! function_exists('err_response')){

    function err_response($message,$code, $statusCode = null) {
        $CI =& get_instance();  // Get CodeIgniter instance
            $CI->output
            ->set_content_type('application/json')
            ->set_status_header($statusCode)
            ->set_output(json_encode(['message' => $message,'code' => $code]));
    
    }
}

#natural response
if( ! function_exists('_response')){
    
    function _response($message){
        
        header('Cache-Control: no-cache, must-revalidate');
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');

        echo json_encode($message);
        exit;
    }

}



if( ! function_exists('error_code') ) {
    function error_code( $error_code, $controller = null ) {
        if(is_null($controller)) {
            $controller = get_instance()->router->fetch_class();

        }

        get_instance()->load->model('Common_model');

        $response = get_instance()->Common_model->select_from_table('error_codes', [
            'select'    => 'controller, code, message',
            'where'     => [               
                'code'                  => str_pad($error_code, 4, '0', STR_PAD_LEFT)
            ],
            'limit'     => 1
        ]);

        log_message('error', 'Last query: ' . json_encode(get_instance()->db->last_query()));


        $return = [
            'code'      => 9999,
            'message'   => 'System Error. Error code not found.',
            'pretty'    => '9999: System Error. Error code not found.'
        ];


        if( ! empty($response)) {
            $response = $response[0];

            $code       = $response['code'];
            $message    = $response['message'];

            $return = [
                'code'      => $code,
                'message'   => $message,
                'pretty'    => $code . ': ' . $message
            ];

        }

        return $return;

    }

    if (!function_exists('message')) {

        function message($code, $message = '', $data = null)
        {
            // Automatically set message for EXIT_BE_ERROR
            if ($code === EXIT_BE_ERROR && empty($message)) {
                $message = 'An error occurred while processing your request';
            }

            //Automatically set message for EXIT_SUCCESS
            if($code === EXIT_SUCCESS && empty($message)){
                $message = 'OK';
            }

            #message == 0 is for success
            #this code if the 3rd param[$data] is not null
            if($code === EXIT_SUCCESS && $message == 0){
                $message = 'OK';
            }
    
            // Prepare the message array
            $msg = [
                'code' => $code,
                'message' => $message
            ];
    
            // Include data if it is not null or empty
            if (!empty($data)) {
                $msg['data'] = $data;
            }
           
    
            return $msg;
        }
    }
    
}