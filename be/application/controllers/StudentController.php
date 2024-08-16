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

         
        $this->custom_exception->show_result([
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'data'    => $result
        ]);
    }

    public function store(){

    }

    public function getStudent(){

    }

    public function update(){

    }

    public function destroy(){
        
    }
}