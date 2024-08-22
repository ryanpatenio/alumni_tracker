<?php

class ProfessorController extends BE_Controller{
    
    public function __construct()
    {
        parent::__construct();


    }

    public function getAll(){
        $query = "SELECT * FROM professor WHERE status = 'A'";
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'No records to display.',
            'data' => $result #this return empty array
         ];

         if( ! empty($result)){
            $message = message(EXIT_SUCCESS,0,$result);
         }
         
       $this->be_exception->show_result($message);
    }

    public function store(){
        // Receive incoming data
        $receiveData = $this->message;

        // Define required fields
        $req_fields = ['prof_name', 'email', 'contact', 'address', 'degree'];
        
        // Perform validation
        $validation_result = formValidator($receiveData, $req_fields);
        
            // If validation fails, return the error message
            if ($validation_result['code'] === EXIT_FORM_NULL) {
               $message = $validation_result;
               $this->be_exception->show_result($message);
                return;
            }

        // Extract necessary fields
        $name    = $receiveData['prof_name'];
        $email   = $receiveData['email'];
        $contact = $receiveData['contact'];
        $address = $receiveData['address'];
        $degree  = $receiveData['degree'];

            // Check if the email already exists
            if ($this->isEmailExist($email)) {
                $message = message(EXIT_BE_ERROR, 'Email already exists');
                $this->be_exception->show_result($message);
                return;
            }

            // Prepare the query and parameters
            $query  = "INSERT INTO professor (name, email, contact, address, degree, status) VALUES(?, ?, ?, ?, ?, 'A')";
            $params = [$name, $email, $contact, $address, $degree];

            // Execute the query
            $result = $this->Common_model->regular_query($query, $params);

                // Prepare the final message based on the query result
                if ($result) {
                    $message = message(EXIT_SUCCESS, 'OK');
                } else {
                    $message = message(EXIT_BE_ERROR, 'An error occurred while processing your request.');
                }

        // Return the final result
        $this->be_exception->show_result($message);
}


    public function getProfessor(){
        $id = $this->message['filter'];

        $query = "SELECT * FROM professor WHERE prof_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);


        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'An Error Occured While Processing Your Request.'
        ];

            if(empty($result)){
                    
                $message = [
                    'code'      => EXIT_BE_ERROR,
                    'message'   => 'No Records Found!.'
                ];
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

        $req_fields = ['prof_name','email','contact','address','degree','id'];

        #validate Data
        $validation_result = formValidator($receiveData,$req_fields);

        #if validation fail it will return error message
        if($validation_result['code'] === EXIT_FORM_NULL){
            $message = $validation_result;
            $this->be_exception->show_result($message);
            return;
        }

        $prof_name = $receiveData['prof_name'];
        $email = $receiveData['email'];
        $contact = $receiveData['contact'];
        $address = $receiveData['address'];
        $degree = $receiveData['degree'];
        $id = $receiveData['id'];

        #current Date Time 
        $currentDateTime = current_datetime();
       // Check if the email already exists
       if ($this->isEmailExist($email,$id) == 1) {
           
            $this->be_exception->show_result([
                'code' => EXIT_BE_ERROR,
                'message' => 'Email already Exist',
                
            ]);
            return;
        }

        //check if this professor is exist
        if($this->isExist($id) == 1){
            #user not exist
            $msg = message(EXIT_BE_ERROR,'User Not Found');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "UPDATE professor SET name = ?,email = ?, contact = ?, address = ? ,degree = ? ,last_updated = ? WHERE prof_id = ?";
        $params = [$prof_name,$email,$contact,$address,$degree,$currentDateTime,$id];

        #execute Query
        $result = $this->Common_model->regular_query($query,$params);

        #show error if this query will fail
        $message = message(EXIT_BE_ERROR);
           

        if($result){
            #success
            $message = message(EXIT_SUCCESS);
        }     

     $this->be_exception->show_result($message);

    }

    public function destroy(){
        $receiveData = $this->message;

        $req_fields = ['filter'];
        $validation_result = formValidator($receiveData,$req_fields);

        if($validation_result['code'] === EXIT_FORM_NULL){
            $msg = $validation_result;
            $this->be_exception->show_result($msg);
            return;
        }

        #required Prof_ID
        $id = $receiveData['filter'];

        #check if professor is EXIST in DBs
        if($this->isExist($id) == 1){
            #user not exist
            $msg = message(EXIT_BE_ERROR,'User is Not Exist');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "UPDATE professor SET status = 'U' WHERE prof_id = ?";
        $param = [$id];

        #execute Query
        $result = $this->Common_model->regular_query($query,$param);

        #if query fails will return error msg
        $message = message(EXIT_BE_ERROR);

        if($result){
           
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'ok' 
            ];
    
        }
        #final result        
        $this->be_exception->show_result($message);
    }

    private function isEmailExist($email,$id = null) {
            
       if($id != null){
            $query = "SELECT * from professor where email = ? and prof_id != ?";
            $params = [$email,$id];

            $result = $this->Common_model->regular_query($query,$params);

            if( empty($result)){
                #email is not exist
                return 2;
            }else{
                #emil is exist
                return 1;
            }
            
        }

            $query = "SELECT * from professor where email = ?";
            $param = [$email];
            $result = $this->Common_model->regular_query($query,$param);


            if( ! empty($result)){
                #true email is already exist
            return 1;
            }
       
    }
    #check only if user is exist by using ID
    private function isExist($id){
        $query = "SELECT * FROM professor WHERE prof_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            #user not exist
          return 1;
            
        }else{
            return 2;
        }
        
    }


}