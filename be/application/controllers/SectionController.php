<?php

class SectionController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query = "SELECT * FROM sections WHERE status = 'A'";
        $result = $this->Common_model->regular_query($query);

        if(! $result){
            #false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
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
        $receiveData = $this->message;

        $section_n = $receiveData['number'];
        $query = "INSERT INTO sections (number) VALUES(?)";
        $param = [$section_n];

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

        $query = "SELECT * FROM sections WHERE sect_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            #no data found
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
        $receiveData = $this->message;
        
        $sect_num = $receiveData['number'];
        $id = $receiveData['sect_id'];

        $query = "UPDATE sections SET number = ? WHERE sect_id = ?";
        $params = [$sect_num,$id];

        $result  = $this->Common_model->regular_query($query,$params);

        if(! $result){
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

        $query = "UPDATE sections SET status = 'U' WHERE sect_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(! $result){
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