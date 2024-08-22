<?php 


class StudentController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->helper('custom_helper');
        date_default_timezone_set('Asia/Manila');

    }

    public function getAll(){
        $query = "SELECT * FROM students WHERE student_status  = 'A'";
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'No records to display.',
            'data'      => [
                'student' => $result,
                'professor' => $this->getAllProfessor() #it will return empty array if no records to display
            ]
         ];

         if( !empty($result)){
           $message = [
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'data'    => [
                'student' =>$result,
                'professor' => $this->getAllProfessor()
                ]
           ];
         }
         
        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        $req_fields = ['name','email','contact','batch_id'];
        $validation_result = formValidator($receiveData,$req_fields);

        if($validation_result['code'] === EXIT_FORM_NULL){
            $msg = $validation_result;
            $this->be_exception->show_result($msg);
            return;
        }

        #required DATA
        $name       = $receiveData['name'];
        $email      = $receiveData['email'];
        $contact    = $receiveData['contact'];
        $batch_id   = $receiveData['batch_id'];

        #check if email is already exist

        if($this->isEmailExist($email) == 1){
            #email is already exist
            $msg = message(EXIT_BE_ERROR,'Email is already Exist');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "INSERT INTO students (name,email,contact,batch_id,student_status) VALUES(?,?,?,?,'A')";
        $params = [$name,$email,$contact,$batch_id];

        #execute Query
        $result = $this->Common_model->regular_query($query,$params);

        #if query fails return error message
        $message = message(EXIT_BE_ERROR);

            if( ! empty($result)){
                $message  = [
                    'code' => EXIT_SUCCESS,
                    'message' => 'ok'
                ];
            }

        $this->be_exception->show_result($message);

    }

    public function getStudent(){
        $receiveData = $this->message;

        $req_fields = ['filter'];
        $val_result = formValidator($receiveData,$req_fields);

        if($val_result['code'] === EXIT_FORM_NULL){
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        $id = $receiveData['filter'];

        #check if student is exist
        if( ! is_object($this->isStudentExist($id))){
            #student not exist
            $msg = message(EXIT_BE_ERROR,'User Not Found');
            $this->be_exception->show_result($msg);
            return;
        } 

        $message = message(EXIT_SUCCESS,0,$this->isStudentExist($id));

        $this->be_exception->show_result($message);

    }

    public function update(){
        $receiveData = $this->message;

        #validations
        $required_fields = ['name','email','contact','batch_id','id'];
        $val_result = formValidator($receiveData,$required_fields);

        #check validations 
        if($val_result['code'] === EXIT_FORM_NULL){
            #returns all fields that's null
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        $name = $receiveData['name'];
        $email = $receiveData['email'];
        $contact = $receiveData['contact'];
        $batch_id = $receiveData['batch_id'];

        #current date time
        $currentDateTime = current_datetime();

        $id = $receiveData['id'];

        #check if this student is exist!
        if( ! is_object($this->isStudentExist($id))){
            #returns error msg [student not exist]
            $msg = message(EXIT_BE_ERROR,'User Not Found!');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "UPDATE students SET name = ?, email = ? , contact = ? , batch_id = ?, last_updated = ? WHERE student_id = ?";
        $params = [$name,$email,$contact,$batch_id,$currentDateTime,$id];

        #execute Query
        $result = $this->Common_model->regular_query($query,$params);
        
        #if query fails it will return this error msg
        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'An error occured while processing your request.'
        ]; 

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

        #validations
        $req_fields = ['filter'];
        $val_result = formValidator($receiveData,$req_fields);

        #check validations
        if($val_result['code'] === EXIT_FORM_NULL){
            $msg = $val_result;
            $this->be_exception->show_result($msg);
            return;
        }

        $id = $receiveData['filter'];

        #check if this student is exist

        if( ! is_object($this->isStudentExist($id))){
            #user not Found!
            $msg = message(EXIT_BE_ERROR,'User Not Found!');
            $this->be_exception->show_result($msg);
            return;
        }

        $query = "UPDATE students SET student_status = 'U' WHERE student_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'an error occured while processing your request.'
        ];

        if($result){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'ok'
            ];
        }

        $this->be_exception->show_result($message);
    }

    private function getAllProfessor(){
        $query = "SELECT prof_id, name FROM professor WHERE status = 'A' ORDER BY name ASC";
        $result = $this->Common_model->regular_query($query);

        if( !empty($result)){
            return $result;
        }else{
            return array();
        }
    }

    private function isStudentExist($id){
        $query = "SELECT * FROM students WHERE student_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$id);

        if( !empty($result)){
            #student is exist
            return $result[0];
        }else{
            return 2;
        }
    }

    private function isEmailExist($email,$id = null){
        
        if($id != null){
            $query = "SELECT * FROM students WHERE email = ? and student_id != ?";
            $params = [$email,$id];

            $result = $this->Common_model->regular_query($query,$params);

            if(! empty($result)){
                #this email is already exist
                return 1;
            }else{
                return 2;
            }
        }

        $query = "SELECT * FROM students WHERE email = ?";
        $param = [$email];

        $result = $this->Common_model->regular_query($query,$param);
        
        if( !empty($result)){
            #email is already Exist
            return 1;
        }else{
            return 2;
        }
    }
}