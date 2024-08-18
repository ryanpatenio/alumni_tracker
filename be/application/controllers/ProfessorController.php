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

         
        $this->be_exception->show_result([
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'data'    => $result
        ]);
    }

    public function store(){
        $receiveData = $this->message;
        
        $name = $receiveData['prof_name'];
        $email = $receiveData['email'];
        $contact = $receiveData['contact'];
        $address = $receiveData['address'];
        $degree = $receiveData['degree'];

        $query = "INSERT INTO professor (name,email,contact,address,degree,status) VALUES(?,?,?,?,?,'A')";
        $params = [$name,$email,$contact,$address,$degree];

        $result = $this->Common_model->regular_query($query, $params);
        
        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'An Error Occure While Processing Your Request.'
        ];

       
        if($result){
          
           $message = [
                'code'      => EXIT_SUCCESS,
                'message'   => 'OK',
            ];
        }

     
        $this->be_exception->show_result($message);

    }

    public function getProfessor(){
        $id = $this->message['filter'];

        $query = "SELECT * FROM professor WHERE prof_id = ?";
        $param =[$id];

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

    }

    public function destroy(){
        
    }
}