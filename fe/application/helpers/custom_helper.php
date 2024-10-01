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

#this is for index that send request in backend with empty array
if ( ! function_exists('default_req_data')) {
    function default_req_data() {
        return [
            "message" => []
        ];
    }
}
