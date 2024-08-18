<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BE_Controller extends CI_Controller
{
    public $user_id;
    public $user;
    protected $message;
    protected $orig_message;
    protected $log_data;
    protected $dbs;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('BE_Exception');
        $this->load->database();

        $this->dbs[0] = $this->db;

       // $authorization 	= explode(",", $this->input->get_request_header('Authorization'));
        $message = json_decode(trim(file_get_contents('php://input')), true);
        $this->message = isset($message['message']) ? $message['message'] : '';
        $this->orig_message = $this->message; 

        $this->init_access_log();
        $this->be_exception->init($this->dbs, $this->log_data);

        $this->check_request_method();
        $this->check_content_type();
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
}
?>
