<?php

class AdvisoryRecordsController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query = "select ad.advisor_id,prof.name as prof_name,s.sy_name as 'sy',crs.course_name as course,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id";
        
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code' => EXIT_BE_ERROR,
            'message' => 'No Records to Display.',
            'data'   => $result
        ];

        if( ! empty($result)){
            $message = [
                'code' => EXIT_SUCCESS,
                'message' => 'OK',
                'data'    => $result
            ];
    
        }
       
        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        #validations 
        $req_fields = ['prof_id','sy_id','course_id','sect_id'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }


        $prof_id = $receiveData['prof_id'];
        $sy_id = $receiveData['sy_id'];
        $course_id = $receiveData['course_id'];
        $section_id = $receiveData['sect_id'];

        $query  = "INSERT INTO advisor_records (prof_id,sy_id,course_id,sect_id) VALUES(?,?,?,?)";
        $params = [$prof_id,$sy_id,$course_id,$section_id];

        $result = $this->Common_model->regular_query($query,$params);

        #if query fails
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

        #validations
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id = $receiveData['filter'];
        
        $query = "select ad.advisor_id,prof.name as prof_name,s.sy_name as 'sy',crs.course_name as course,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id and ad.advisor_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        #query fails
        $message = message(EXIT_BE_ERROR,'No Records Found.');

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

        #validations 
        $req_fields = ['prof_id','sy_id','sect_id','course_id','advisor_id'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $prof_id = $receiveData['prof_id'];
        $sy_id = $receiveData['sy_id'];
        $course_id = $receiveData['course_id'];
        $section_id = $receiveData['sect_id'];
        $update_date = current_datetime();
        $id = $receiveData['advisor_id'];

        #check if this requested data is exist in database
        if($this->isExist($id) != 1){
            #not exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data not Exist'));
            return;
        }

        $query = "UPDATE advisor_records SET prof_id = ? , sy_id = ? , course_id = ? , sect_id = ? , last_updated = ? WHERE advisor_id = ?";
        $params = [$prof_id,$sy_id,$course_id,$section_id,$update_date,$id];

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
        $receiveData = $this->message;

        #validations
        $req_field = ['filter'];
        $val_res = formValidator($receiveData,$req_field);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $id = $receiveData['filter'];

        #check if this request data is exist before updating

        if($this->isExist($id) != 1){
            #this request data is not exist in DB
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Data not Exist'));
            return;
        }

        $query = "UPDATE advisor_records SET status = 'U' WHERE advisor_id = ?";
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

    private function isExist($id){
        $query = "SELECT * FROM advisor_records WHERE advisor_id = ? LIMIT 1";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if( !empty($result)){
            #true
            return 1;
        }else{
            return 2;
        }

    }
}