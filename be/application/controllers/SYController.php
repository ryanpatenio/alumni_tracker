<?php


class SYController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getAll(){
        $query = "SELECT * FROM sy WHERE status  = 'A'";
        $result = $this->Common_model->regular_query($query);

        if(!$result){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'ann error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data' => $result
        ];

        $this->be_exception->show_result($message);
    }

    public function store(){
        $receivedData = $this->message;
        $sy = $receivedData['sy_name'];

        $query = "INSERT INTO sy (sy_name) VALUES(?)";
        $param = [$sy];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            #false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
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

        $query = "SELECT * FROM sy WHERE sy_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            #empty
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No Data Found.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data'    => $result
        ];

        $this->be_exception->show_result($message);

    }

    public function update(){
        $receivedData = $this->message;

        $sy_name = $receivedData['sy_name'];
        $id = $receivedData['sy_id'];
        $current_date = current_datetime();

        $query = "UPDATE sy SET sy_name = ?, last_updated = ? WHERE sy_id = ?";
        $params = [$sy_name,$current_date,$id];

        $result = $this->Common_model->regular_query($query,$params);
        
        if( ! $result){
            #false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }

    public function destroy(){
        $id = $this->message['filter'];

        $query = "UPDATE sy SET status = 'U' WHERE sy_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if( ! $result){
            #false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }

}