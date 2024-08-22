<?php

class CourseController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getALl(){
        $query = "SELECT * FROM courses WHERE status = 'A'";
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'No Record(s) to Display.',
            'data' => $result #return empty array
        ];

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data' => $result
            ];
        }

       

        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        $required_fields = ['course_name'];

        $validation_result = formValidator($receiveData,$required_fields);

        if($validation_result['code'] === EXIT_FORM_NULL){
            $msg = $validation_result;
            $this->be_exception->show_result($msg);
            return;
        }
        
        $course_name = $receiveData['course_name'];
        $query = "INSERT INTO courses (course_name,status) VALUES(?,'A')";
        $param = [$course_name];
        
        $result = $this->Common_model->regular_query($query,$param);

        $message = message(EXIT_BE_ERROR);

        if( !empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];    
        }
       
        $this->be_exception->show_result($message);
    }

    public function get(){
        $receiveData = $this->message;

        #field validation
        $req_field = ['filter'];
        $val_result = formValidator($receiveData,$req_field);

        #if validation fails
        if($val_result['code'] === EXIT_FORM_NULL){
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        $id = $receiveData['filter'];

        $query = "SELECT * FROM courses WHERE course_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);
        $message = message(EXIT_BE_ERROR);

        if(empty($result)){
            $message = message(EXIT_BE_ERROR,'No Data Found');
        }

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data' => $result
            ];
        }      

        $this->be_exception->show_result($message);


    }

    public function update(){
        $receiveData = $this->message;

        $req_fields = ['course_name','course_id'];
        $val_result = formValidator($receiveData,$req_fields);

        if($val_result['code'] === EXIT_FORM_NULL){
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        #required DATA
        $course_name = $receiveData['course_name'];
        $id  = $receiveData['course_id'];
        $currentDateTime = current_datetime();


        #check if this course is exist in db
        if($this->isExist($id) == 2){
            #not exist
            $msg = message(EXIT_BE_ERROR,'No Data Found');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "UPDATE courses SET course_name = ? , last_updated = ? WHERE course_id = ?";
        $params = [$course_name,$id,$currentDateTime];

        #execute Query
        $result = $this->Common_model->regular_query($query,$params);

        #if query fails return error message
        $message = message(EXIT_BE_ERROR);

        if($result){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'ok'
            ];
        }

        $this->be_exception->show_result($message);
    }


    public function destroy(){
        $receiveData = $this->message;

        $req_field  = ['filter'];
        $val_result = formValidator($receiveData,$req_field);

        if($val_result['code'] === EXIT_FORM_NULL){
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        #request Data
        $id = $receiveData['filter'];

        if($this->isExist($id) == 2){
            #not exist 
            $msg = message(EXIT_BE_ERROR,'No Data Found!');
            $this->be_exception->show_result($msg);
            return;
        }
        
        $query = "UPDATE courses SET status = 'U' WHERE course_id = ?";
        $param = [$id];

        #execute query
        $result = $this->Common_model->regular_query($query,$param);

        #if query fails
        $message = message(EXIT_BE_ERROR);

        if($result){          
            $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
            ];
        }

        $this->be_exception->show_result($message);
    }

    private function isExist($id){
        $query = "SELECT * FROM courses WHERE course_id = ?";
        $param = [$id];
        $result = $this->Common_model->regular_query($query,$param);

        if( ! empty($result)){
            #true
            return 1;
        }else{
            return 2;
        }
    }
}