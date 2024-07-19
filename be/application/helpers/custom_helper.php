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




if( ! function_exists('error_code') ) {
    function error_code( $error_code, $controller = null ) {
        if(is_null($controller)) {
            $controller = get_instance()->router->fetch_class();

        }

        get_instance()->load->model('Common_model');

        $response = get_instance()->Common_model->select_from_table('error_codes', [
            'select'    => 'controller, code, message',
            'where'     => [
                'LOWER(controller)'     => strtolower($controller),
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
}