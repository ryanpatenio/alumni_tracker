<?php


class SYController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getAll(){
        $query = "SELECT * FROM sy WHERE status  = 'A'";
        $result = $this->Common_model->regular_query($query);

        #returns error message if no data found
        $message = message(EXIT_BE_ERROR,'No Records to Display',$result);

        if( ! empty($result)){
            #if found Data
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data' => $result
            ];
        }      

        $this->be_exception->show_result($message);
    }

    public function store(){
        $receivedData = $this->message;

        #validate received data
        $req_field = ['sy_name'];
        $val_res = formValidator($receivedData,$req_field);
        
        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $sy = $receivedData['sy_name'];

        $query = "INSERT INTO sy (sy_name) VALUES(?)";
        $param = [$sy];

        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if(! empty($result)){
            #success
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK'
            ];
        }   
        
        $this->be_exception->show_result($message);
    }

    public function get(){
        $receivedData = $this->message;

        #validate received data
        $req_field = ['filter'];
        $val_res = formValidator($receivedData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id = $receivedData['filter'];

        #check if ID is exist
        if( ! is_object($this->isIdExist($id))){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'No Data Found'));
            return;
        }

        $query = "SELECT * FROM sy WHERE sy_id = ?";
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
        $receivedData = $this->message;

        #validate received data
        $req_field = ['sy_name','sy_id'];
        $val_res = formValidator($receivedData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        #sanitize Data
        $sy_name = $receivedData['sy_name'];
        $id = $receivedData['sy_id'];


        #check if this id exist in DB
        if( ! is_object($this->isIdExist($id))){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data not Found!'));
            return;
        }

        
        $query = "UPDATE sy SET sy_name = ? WHERE sy_id = ?";
        $params = [$sy_name,$id];

        $result = $this->Common_model->regular_query($query,$params);

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

    public function destroy(){
        $receivedData = $this->message;

        #val data
        $req_field = ['filter'];
        $val_res = formValidator($receivedData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id  = $receivedData['filter'];

        #check if ID is Exist
        if( ! is_object($this->isIdExist($id))){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data Not Found!'));
            return;
        }
       
        $query = "UPDATE sy SET status = 'U' WHERE sy_id = ?";
        $param = [$id];

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

    private function isIdExist($id){
        $query = "SELECT * FROM sy WHERE sy_id = ?";
        $param = [$id];

        $res = $this->Common_model->regular_query($query,$param);

        if(! empty($res)){
            return $res[0];
        }else{
            return 2;
        }
    }

}