<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BE_Exception extends Exception
{
    protected $dbs;
    protected $log_data;

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function init($dbs, $data)
    {
        if (!is_array($dbs)) {
            throw new InvalidArgumentException('Database connections must be an array');
        }

        $this->dbs = $dbs;
        $this->log_data = $data;
    }

    public function show_error($message)
    {
        $this->rollback_transaction();

        $this->log_data['status'] = '500';
        $this->log_data['end_date'] = date('Y-m-d H:i:s');
        $this->log_data['status_message'] = $message['message'];

        $this->start_transaction();
        $this->insert_log();
        $this->commit_transaction();

        header('Cache-Control: no-cache, must-revalidate');
        header("HTTP/1.1 500 Internal Server Error");

        echo json_encode($message);
        exit;
    }

    public function show_result($message, $commit_override = FALSE)
    {
        if ($message['code'] == EXIT_SUCCESS || $commit_override == TRUE) {
            $this->commit_transaction();
        } else {
            $this->rollback_transaction();
        }

        $this->log_data['status'] = $message['code'];
        $this->log_data['end_date'] = date('Y-m-d H:i:s');
        $this->log_data['status_message'] = $message['message'];

        $this->start_transaction();
        $this->insert_log();
        $this->commit_transaction();

        header('Cache-Control: no-cache, must-revalidate');
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');

        echo json_encode($message);
        exit;
    }

    private function start_transaction()
    {
        foreach ($this->dbs as $db_for_process) {
            $db_for_process->trans_begin();
        }
    }

    private function commit_transaction()
    {
        foreach ($this->dbs as $db_for_process) {
            $db_for_process->trans_commit();
        }
    }

    private function rollback_transaction()
    {
        foreach ($this->dbs as $db_for_process) {
            $db_for_process->trans_rollback();
        }
    }

    private function insert_log()
    {
        $CI =& get_instance();
        $CI->load->model('BE_Model', 'log_model', FALSE);

        // Uncomment and implement the following lines based on your logging requirements.
        // $CI->log_model->set_connection($this->dbs[0]);
        // $CI->log_model->set_table('access_log');
        // $CI->log_model->insert($this->log_data);
    }
}
?>
