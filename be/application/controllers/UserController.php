<?php

class UserController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll(){
        $id = 2; #dummy user_id @change this using current_session user_id

        $query = "SELECT name,status FROM users WHERE status = 'A' and user_id not in(?)";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'an error occured while processing your request.'
        ];
        
        if($result){
            #true
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

        $name = $receiveData['name'];
        $email = $receiveData['email'];
        $password = password_hash($receiveData['password'],PASSWORD_DEFAULT);
        $type = $receiveData['type'];

        $query = "INSERT INTO users (name,email,password,type) VALUES(?,?,?,?)";
        $params = [$name,$email,$password,$type];

        $result = $this->Common_model->regular_query($query,$params);
        
        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'an error occured while processing your request.'
        ];

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
           
        }

        $this->be_exception->show_result($message);
    }

    public function get(){
        $id = $this->message['filter'];
        
        $query = "SELECT user_id,email,type FROM users WHERE user_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'No Data Found'
        ];

        if( ! empty($result)){

            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data'    => $result
            ];
        }

        

        $this->be_exception->show_result($message);
    }

    public function update(){
        $receiveData = $this->message;
        
        $new_name = $receiveData['name'];
        $new_email = $receiveData['email'];
        $user_id = $receiveData['user_id'];
        $hash_p = password_hash($receiveData['password'],PASSWORD_DEFAULT);

        #check email if exist
        $query = "SELECT * FROM users WHERE email = ? and user_id not in(?) LIMIT 1";
        $params = [$new_email,$user_id];
        $result = $this->Common_model->regular_query($query,$params);

        if( ! empty($result)){
            #email is exist!
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'Email is Exist',
                
            ];
        }
        $query = "UPDATE users SET email = ? , name = ? , password = ? WHERE user_id = ?";
        $params = [$new_email,$new_name,$hash_p,$user_id];

        $result = $this->Common_model->regular_query($query,$params);

        if( ! $result){
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
        $user_id = $this->message['filter'];

        $query = "UPDATE users SET status = 'U' WHERE user_id = ?";
        $param = [$user_id];

        $result = $this->Common_model->regular_query($query,$param);

        if( ! $result){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing you request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }
}