<?php

class UserController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
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
        
        $receiveData = $this->message;

        #validate received Data
        $req_field = ['name','email','password','type','avatar'];
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
            $this->be_exception->show_result(message(EXIT_ERROR,'Email is already in use!'));
            return;
        }  
                
        if(empty($_FILES['avatar']['name'])){
            #no File Detected
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'No File Detected'));
            return;
        }

         # Define max size in bytes (5MB = 5120KB)
         $max_size = 5120 * 1024; // 5MB in bytes

         # Get the file size from the $_FILES array
         $file_size = $_FILES['avatar']['size'];
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

        if(!$this->upload->do_upload('avatar')){
            # Error in uploading
            $error = $this->upload->display_errors();
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'an error occured while uploading file.'));
            return;
        }

        # Get the upload data
        $data = $this->upload->data();
        $file_name = $data['file_name'];

        #$this->be_exception->show_result(message(EXIT_BE_ERROR,0,$this->isEmailExist($email)));


        $query = "INSERT INTO users (name,email,password,type,avatar) VALUES(?,?,?,?,?)";
        $params = [$name,$email,$password,$type,$file_name];

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
        
        $query = "SELECT user_id,email,type,avatar FROM users WHERE user_id = ?";
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
        $req_field = ['name','email','user_id','cur_avatar'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data        
        $new_name = $receiveData['name'];
        $new_email = $receiveData['email'];
        $user_id = $receiveData['user_id'];
       
        #check if user is Exist
        if($this->isUserExist($user_id) != 1){
            #user not found
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'user not found!'));
            return;
        }
       
        #check if email is exist
        if($this->isEmailExist($new_email,$user_id) != 2){
            #email is already exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Email is already in use!'));
            return;
        }
        #SET FORM DATA
        $data_toUpdate = [
            'email' => $new_email,
            'name'  => $new_name

        ];

       # Check if user changed the password
        if (!empty($receiveData['password'])) {
            $hash_p = password_hash($receiveData['password'], PASSWORD_DEFAULT);
            $data_toUpdate['password'] = $hash_p;
        }

       
        

        if ( ! empty($_FILES['e_avatar']['name']) && file_exists('./uploads/avatar/' . $receiveData['cur_avatar'])){
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
    
             # GET THE UPLOAD DATA
             $data = $this->upload->data();
             $file_name = $data['file_name'];

             unlink('./uploads/avatar/' . $receiveData['cur_avatar']); #delete the old avatar

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