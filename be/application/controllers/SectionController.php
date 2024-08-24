<?php

class SectionController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query = "SELECT * FROM sections WHERE status = 'A'";
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'No Records To Display',
            'data' => $result
        ];


        if($result){
            #false
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'Ok',
                'data'   => $result
            ];
        }

       
        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        $req_field = ['number'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $msg = $val_res;
            $this->be_exception->show_result($msg);
            return;
        }
        

        $section_n = $receiveData['number'];
        $query = "INSERT INTO sections (number) VALUES(?)";
        $param = [$section_n];

        $result = $this->Common_model->regular_query($query,$param);

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

        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $msg = $val_res;
            $this->be_exception->show_result($msg);
            return;
        }

        $id = $receiveData['filter'];

        #check if this id is exist
        if( ! is_object($this->isIdExist($id))){
            #id not exist
            $msg = message(EXIT_BE_ERROR,'Data Not Exist');
            $this->be_exception->show_result($msg);
            return;
        }

        $message  = message(EXIT_SUCCESS,0,$this->isIdExist($id));

        $this->be_exception->show_result($message);
    }

    public function update(){
        $receiveData = $this->message;

        $req_field = ['number','sect_id'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
          #return all field requireds
          $this->be_exception->show_result($val_res);
          return;
        }
        
        $sect_num = $receiveData['number'];
        $id = $receiveData['sect_id'];

        #check if the id is exist in DB
        if( ! is_object($this->isIdExist($id))){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data Not Exist'));
            return;
        }

        $query = "UPDATE sections SET number = ? WHERE sect_id = ?";
        $params = [$sect_num,$id];

        #execute query
        $result  = $this->Common_model->regular_query($query,$params);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if($result){
            #success
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
        }

       
        $this->be_exception->show_result($message);
    }

    public function destroy(){
        $receiveData = $this->message;

        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }
        
        $id = $receiveData['filter'];

        #Check if ID is Exist
        if( ! is_object($this->isIdExist($id))){
            #data not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data not Exist'));
            return;
        }

        $query = "UPDATE sections SET status = 'U' WHERE sect_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if($result){
            #success
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
    
        }

       
        $this->be_exception->show_result($message);
    }

    
    private function isIdExist($id){
        $query = "SELECT * FROM sections WHERE sect_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if( !empty($result)){
            return $result[0];
        }else{
            return 2;
        }
    }
}