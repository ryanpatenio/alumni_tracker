<?php

class UserController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll(){
        $id = 2; #dummy user_id @change this using current_session user_id in fe
        
        #validate user_id
        $receiveData = $this->message;
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

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

        #!TO DO!!
        #change this code when you add FILE(img)
        
        $receiveData = $this->message;

        #validate received Data
        $req_field = ['name','email','password','type'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data
        $name = $receiveData['name'];
        $email = $receiveData['email'];
        $password = password_hash($receiveData['password'],PASSWORD_DEFAULT);
        $type = $receiveData['type'];

        #check if email is already Exist
        if($this->isEmailExist($email) != 2){
            #email is already Exist
            $this->be_exception->show_result(message(EXIT_ERROR,'Email is already Exist!'));
            return;
        }   

       #$this->be_exception->show_result(message(EXIT_BE_ERROR,0,$this->isEmailExist($email)));


        $query = "INSERT INTO users (name,email,password,type) VALUES(?,?,?,?)";
        $params = [$name,$email,$password,$type];

        $result = $this->Common_model->regular_query($query,$params);
        
        #query fails
        $message = message(EXIT_BE_ERROR);

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
           
        }

        $this->be_exception->show_result($message);
    }

    public function get(){
        $receiveData = $this->message;

        #validate Received Data
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }
        
        #sanitize Data
        $id = $receiveData['filter'];
       
        #check if USER is exist in DB
        if($this->isUserExist($id) != 1){
            #user not Found
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'user not found.'));
            return;
        }
        
        $query = "SELECT user_id,email,type FROM users WHERE user_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR);

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

        #validate Received data
        $req_field = ['name','email','user_id','password'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data        
        $new_name = $receiveData['name'];
        $new_email = $receiveData['email'];
        $user_id = $receiveData['user_id'];
        $hash_p = password_hash($receiveData['password'],PASSWORD_DEFAULT);

        #check if user is Exist
        if($this->isUserExist($user_id) != 1){
            #user not found
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'user not found!'));
            return;
        }
       
        #check if email is exist

        if($this->isEmailExist($new_email,$user_id) != 2){
            #email is already exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Email is already Exist'));
            return;
        }

        $query = "UPDATE users SET email = ? , name = ? , password = ? WHERE user_id = ?";
        $params = [$new_email,$new_name,$hash_p,$user_id];

        $result = $this->Common_model->regular_query($query,$params);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if($result){
          
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
        }

        $this->be_exception->show_result($message);
    }

    public function destroy(){
        $receiveData = $this->message;

        #validate received Data
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data
        $user_id = $receiveData['filter'];

        #check if this user is already exist
        if($this->isUserExist($user_id) != 1){
            #user not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'user not found.'));
            return;
        }

        $query = "UPDATE users SET status = 'U' WHERE user_id = ?";
        $param = [$user_id];

        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if($result){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
        }

        $this->be_exception->show_result($message);
    }

    #method for checking email
    private function isEmailExist($email,$id = null)
    {
        if($id != null){
            #check email if exist
            $query = "SELECT * FROM users WHERE email = ? and user_id not in(?) LIMIT 1";
            $params = [$email,$id];
            $result = $this->Common_model->regular_query($query,$params);

            if( ! empty($result)){
                #email is exist!
                return 1;
             }else{
                return 2;
             }
        }


        $query  = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $param = [$email];

        $res = $this->Common_model->regular_query($query,$param);

        if( ! empty($res)){
            #email is exist
            return 1;
        }else{
            return 2;
        }
    }

    private function isUserExist($id){
        $query = "SELECT *  FROM users WHERE user_id = ?";
        $param = [$id];

        $res = $this->Common_model->regular_query($query,$param);

        if( ! empty($res)){
            #has data
            return 1;
        }
        else{
            return 2;
        }
    }
}