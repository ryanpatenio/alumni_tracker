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
            'message'   => 'No records to display.'
         ];

         
        $this->be_exception->show_result([
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'data'    => $result
        ]);
    }

    public function store(){
        $receiveData = $this->message;

        $name       = $receiveData['name'];
        $email      = $receiveData['email'];
        $contact    = $receiveData['contact'];
        $batch_id   = $receiveData['batch_id'];

        $query = "INSERT INTO students (name,email,contact,batch_id,status) VALUES(?,?,?,?,'A')";
        $params = [$name,$email,$contact,$batch_id];

        $result = $this->Common_model->regular_query($query,$params);

            $message = [
                'code'      => EXIT_BE_ERROR,
                'message'   => 'An Error Occure While Processing Your Request.'
            ];

            if( ! empty($result)){
                $message  = [
                    'code' => EXIT_SUCCESS,
                    'message' => 'ok'
                ];
            }

        $this->be_exception->show_result($message);

    }

    public function getStudent(){
        $id = $this->message['filter'];

        $query = "SELECT * from students WHERE student_id = ? ";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No Data Found!'
            ];
        }

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'ok',
                'data' => $result
            ];
        }

        $this->be_exception->show_result($message);

    }

    public function update(){
        $receiveData = $this->message;

        $name = $receiveData['name'];
        $email = $receiveData['email'];
        $contact = $receiveData['contact'];
        $batch_id = $receiveData['batch_id'];

        $id = $receiveData['id'];

        $query = "UPDATE students SET name = ?, email = ? , contact = ? , batch_id = ? WHERE student_id = ?";
        $params = [$name,$email,$contact,$batch_id,$id];

        $result = $this->Common_model->regular_query($query,$params);
        
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
        $id = $this->message['filter'];

        $query = "UPDATE students SET status = 'U' WHERE student_id = ?";
        $param = [$id];

        $result = $this->Common_model->reqular_query($query,$param);

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
}