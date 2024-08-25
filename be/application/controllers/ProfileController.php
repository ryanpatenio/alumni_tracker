<?php

class ProfileController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    public function getMyInfo(){
        $user_id = $this->message['filter'];

        $query = "SELECT user_id, name , email , avatar , case type WHEN 1 THEN 'ADMIN' WHEN 2 THEN 'SUB-ADMIN' END as 'role' FROM users WHERE user_id = ?";
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

        #validate received Data
        $req_fields = ['user_id','newName'];
        $val_res = formValidator($receivedData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'All Field is required'));
            return;
        }

        $user_id = $receivedData['user_id'];
        $newName = $receivedData['newName'];

        #set FORM DATA
        $data_toUpdate = [
            'name' => $newName
        ];

        if ( ! empty($_FILES['e_avatar']['name']) && file_exists('./uploads/avatar/' . $receivedData['cur_avatar'])){

            # Define max size in bytes (5MB = 5120KB)
            $max_size = 5120 * 1024; // 5MB in bytes

            # Get the file size from the $_FILES array
            $file_size = $_FILES['e_avatar']['size'];
            # Check if the file size exceeds the limit

            if ($file_size > $max_size) {
                // File size is too large
                $this->be_exception->show_result(message(EXIT_BE_ERROR, 'The file size exceeds the 5MB limit.'));
                return;
            }
                 
             # Set up all configuration
             $config['upload_path'] = './uploads/avatar/';
             $config['allowed_types'] = 'gif|jpg|jpeg|png';
             $config['max_size'] = 5120; // 5MB in KB
             $config['file_name'] = 'avatar_' . date('YmdHis');
 
             $this->upload->initialize($config);
 
             if (!$this->upload->do_upload('e_avatar')) {
                 # Error in uploading
                 $error = $this->upload->display_errors();
                 $this->be_exception->show_result(message(EXIT_BE_ERROR,'an error occured while uploading file.'));
                 return;              
             }
 

              # GET THE UPLOAD DATA
              $data = $this->upload->data();
              $file_name = $data['file_name'];
 
              unlink('./uploads/avatar/' . $receivedData['cur_avatar']); #delete the old avatar
 
             #APPEND FORM DATA
             $data_toUpdate['avatar'] = $file_name;
        }


            # Dynamically build the query
            $query = "UPDATE users SET ";
            $setPart = [];
            $params = [];

            # Add fields to update
            foreach ($data_toUpdate as $column => $value) {
                $setPart[] = "{$column} = ?";
                $params[] = $value;
            }

            # Add user_id to the condition
            $query .= implode(', ', $setPart) . " WHERE user_id = ?";
            $params[] = $user_id;

            
            # Execute the query
            $result = $this->Common_model->regular_query($query, $params);

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