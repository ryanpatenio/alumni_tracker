<?php

class ProfileController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    public function getMyInfo(){
        $user_id = $this->message['filter'];

        $query = "SELECT user_id, name , email , case type WHEN 1 THEN 'ADMIN' WHEN 2 THEN 'SUB-ADMIN' END as 'role' FROM users WHERE user_id = ?";
        $param = [$user_id];
        
        $result = $this->Common_model->regular_query($query,$param);
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No Data Found!.'
            ];

        if( ! empty($result)){

            $message = [
                'code' => EXIT_SUCCESS,
                'message' =>'OK',
                'data'    => $result
            ];
        }

       

        $this->be_exception->show_result($message);
    }

    public function changeNameAndAvatar(){
        $receivedData = $this->message;

        $user_id = $receivedData['user_id'];
        $newName = $receivedData['newName'];

        $query = "UPDATE users SET name = ? WHERE user_id = ?";
        #change this if u finished the add new user
    }

    public function changePass(){

        $receivedData = $this->message;

        #validate received Data
        $req_fields = ['user_id','oldPassword','newPassword'];
        $val_res = formValidator($receivedData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data
        $user_id = $this->message['user_id'];

        $oldPassword = $this->message['oldPassword']; 
        $newPass = $this->message['newPassword'];
         
        $hash_password = password_hash($newPass,PASSWORD_DEFAULT);

        #get USER latest password
        $user_pass = $this->getUserPassword($user_id);

        #if this method fails @getUserPassword($user_id)
        $message = message(EXIT_BE_ERROR);
       
        if( empty($user_pass)){
            #user not found
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'user not found!'));
            return;

        }        
           
            if( ! password_verify($oldPassword,$user_pass->password)){
                #Old Password Not Match!
                $this->be_exception->show_result(message(EXIT_BE_ERROR,'old Password Not Match!'));
                return;
            }

            $query = "UPDATE users SET password = ? WHERE user_id = ?";
            $param = [$hash_password,$user_id];

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

    private function getUserPassword($user_id){
       
        $query = "SELECT password FROM users WHERE user_id = ? ";
        $param = [$user_id];

        $result = $this->Common_model->regular_query($query,$param);
       
        if( !empty($result)){
           
            return $result[0];
        }

        #empty array
        return array();
    
    }

    private function getUserAvatar($user_id){
        
        $query = "SELECT avatar from users WHERE user_id = ?";
        $param = [$user_id];

        $result = $this->Common_model->regular_query($query,$param);
      
        if( ! empty($result)){
          return $result[0];
        }
        #return empty array
        return array();
      
    }
    
}