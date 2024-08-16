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
            'message'   => 'No records to display.'
         ];

         
        $this->custom_exception->show_result([
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'data'    => $result
        ]);
    }

    public function store(){
        $query = '';
    }

    public function getStudent(){

    }

    public function update(){

    }

    public function destroy(){
        
    }
}