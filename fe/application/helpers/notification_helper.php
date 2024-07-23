<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('alert_message')) {
    function alert_message($message, $type) {
        $alert_message      = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        $alert_message      .= $message;
        $alert_message      .= '</div>';
        
        return $alert_message;
    }
}




if ( ! function_exists('flash_message')) {
    function flash_message($message, $type) {

        /**
         * Same as the alert_message(); method
         * * Only difference is flash_message() automatically set is to  a session flashdata
         */

        $alert_message      = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        $alert_message      .= $message;
        $alert_message      .= '</div>';

        get_instance()->session->set_flashdata('flash-message', $alert_message);

        // dd(get_instance()->session->flashdata('flash-message'));
        
        return true;
    }
}


