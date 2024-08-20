<?php

class BatchController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll(){
        $query = "SELECT * FROM batch where status = 'A'";
        
        $result = $this->Common_model->regular_query($query);

        if( ! $result){
                
            $message =
            [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message =
        [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data' => $result
        ];

        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        $batch_name = $receiveData['batch_name'];
        $adviser_id = $receiveData['adviser_id'];
        $student_id = $receiveData['student_id'];

        $query = "INSERT INTO batch (batch_name,adviser_id,student_id) VALUES(?,?,?,'A')";
        $params = [$batch_name,$adviser_id,$student_id];

        $result = $this->Common_model->regular_query($query,$params);

        if( empty($result)){
            $message = 
            [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request',
                
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }

    public function get(){
        $id = $this->message['filter'];

        $query = "SELECT * FROM batch WHERE batch_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No Data Found.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data' => $result
        ];

        $this->be_exception->show_result($message);
    }

    public function destroy(){
        $id = $this->message['filter'];
        
        $query = "UPDATE batch SET status = 'U' WHERE batch_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(! $result){
            #return false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'ann error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
        
    }
}
