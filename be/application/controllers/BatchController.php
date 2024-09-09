<?php

class BatchController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll(){
        $query = "SELECT * FROM batch where status = 'A'";
        
        $result = $this->Common_model->regular_query($query);
        $message = message(EXIT_BE_ERROR);

        
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
        $receiveData = $this->message;

        #validation
        $req_fields = ['batch_name'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $batch_name = $receiveData['batch_name'];
    
        $query = "INSERT INTO batch (batch_name) VALUES(?)";
        $params = [$batch_name];

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

    public function update(){
        $receiveData = $this->message;

        #validations
        $req_fields = ['batch_name','batch_id'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $batch_name = $receiveData['batch_name'];
        $id = $receiveData['batch_id'];

        #check if this data is exist
        if($this->isExist($id) != 1){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'No Records Found'));
            return;
        }

        $query = "UPDATE batch SET batch_name = ? WHERE batch_id = ?";
        $param = [$batch_name,$id];

        #execute Query
        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR);

        if($result){
            $message = message(EXIT_SUCCESS);
        }

        $this->be_exception->show_result($message);
    }

    public function get(){
        $receiveData = $this->message;
        
        #validation
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id = $receiveData['filter'];
        
        $query = "SELECT * FROM batch WHERE batch_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        #if query fails
        $message =  message(EXIT_BE_ERROR,'No Records Found');

        if( ! empty($result)){
           
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data' => $result
            ];
        }

        $this->be_exception->show_result($message);
    }

    public function destroy(){
        $receiveData = $this->message;

        #validations
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id = $receiveData['filter'];

        if($this->isExist($id) != 1){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data Not Exist'));
            return;
        }

        $query = "UPDATE batch SET status = 'U' WHERE batch_id = ?";
        $param = [$id];

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

    private function isExist($id){
        $query = "SELECT * FROM batch WHERE batch_id = ? LIMIT 1";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if( ! empty($result)){
            #true
            return 1;
        }else{
            return 2;
        }
    }
}
