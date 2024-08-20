<?php

class CourseController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getALl(){
        $query = "SELECT * FROM courses WHERE status = 'A'";
        $result = $this->Common_model->regular_query($query);

        if( ! $result){
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
        
        $course_name = $receiveData['course_name'];
        $query = "INSERT INTO courses (course_name) VALUES(?)";
        $param = [$course_name];
        
        $result = $this->Common_model->regular_query($query);

        if( empty($result)){
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

        $query = "SELECT * FROM courses WHERE course_id = ?";
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
            'data' => $result
        ];

        $this->be_exception->show_result($message);


    }

    public function update(){
        $receiveData = $this->message;

        $course_name = $receiveData['course_name'];
        $id  = $receiveData['course_id'];

        $query = "UPDATE courses SET course_name = ? WHERE course_id = ?";
        $params = [$course_name,$id];

        $result = $this->Common_model->regular_query($query,$params);

        if(! $result){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'ok'
        ];

        $this->be_exception->show_result($message);
    }


    public function destroy(){
        $id = $this->message['filter'];
        
        $query = "UPDATE courses SET status = 'U' WHERE course_id = ?";
        $param = [$id];

        $result = $this->Common_model->show_result($query,$param);

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