<?php

class AdvisoryRecordsController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query = "select bc.batch_name,ad.advisor_id,prof.name as prof_name,s.sy_name as 'sy',crs.course_name as course,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect,batch bc where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id and ad.batch_id = bc.batch_id and ad.status != 'U' order by ad.advisor_id DESC";
        
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
        $req_fields = ['batch_id','prof_id','sy_id','course_id','sect_id'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }

        $batch_id = $receiveData['batch_id'];
        $prof_id = $receiveData['prof_id'];
        $sy_id = $receiveData['sy_id'];
        $course_id = $receiveData['course_id'];
        $section_id = $receiveData['sect_id'];

         #check if the records is already exist without professor checking
         if($this->isRecordsExistWithoutProf($batch_id,$sy_id,$course_id,$section_id) == 1){
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Records is already Exist OR this Records contains same Section or Batch and also Course! Make sure to Encode Correctly to Avoid redunduncy!'));
            return;
        }

        #check if the records is already exist
        if($this->isRecordsExistWithProf($batch_id,$prof_id,$sy_id,$course_id,$section_id) == 1){
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Records is already Exist!'));
            return;
        }
        

        $query  = "INSERT INTO advisor_records (batch_id,prof_id,sy_id,course_id,sect_id) VALUES(?,?,?,?,?)";
        $params = [$batch_id,$prof_id,$sy_id,$course_id,$section_id];

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
        
        $query = "select bc.batch_id,bc.batch_name,ad.advisor_id,prof.prof_id,prof.name as prof_name,s.sy_id,s.sy_name as 'sy',crs.course_id,crs.course_name as course,sect.sect_id,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect, batch bc where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id and ad.batch_id = bc.batch_id and ad.advisor_id = ?";
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
        $req_fields = ['batch_id','prof_id','sy_id','sect_id','course_id','advisor_id'];
        $val_res = formValidator($receiveData,$req_fields);

        if($val_res['code'] === EXIT_FORM_NULL){
            $this->be_exception->show_result($val_res);
            return;
        }
        $batch_id = $receiveData['batch_id'];
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

        #check if this records is already exist in the database
        if($this->isRecordsExist($id,$batch_id,$sy_id,$course_id,$section_id) == 1){
            #already exist
            $this->be_exception->show_result(message(EXIT_BE_ERROR,'Records is already Exist OR this Records contains same Section or Batch and also Course! Make sure to Encode Correctly to Avoid redunduncy!'));
            return;
            
        }

        $query = "UPDATE advisor_records SET batch_id = ? ,prof_id = ? , sy_id = ? , course_id = ? , sect_id = ? , last_updated = ? WHERE advisor_id = ?";
        $params = [$batch_id,$prof_id,$sy_id,$course_id,$section_id,$update_date,$id];

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

    //without professor checking
    private function isRecordsExistWithoutProf($batch_id,$sy_id,$course_id,$sect_id){
        $query = "SELECT * FROM advisor_records WHERE batch_id = ? and sy_id = ? and course_id = ? and sect_id = ? and status != 'U'";
        $param = [$batch_id,$sy_id,$course_id,$sect_id];
        $result = $this->Common_model->regular_query($query,$param);

        if( ! empty($result)){
            #true
            return 1;
        }else{
            #false
            return 2;
        }
    }
    //with professor checking
    private function isRecordsExistWithProf($batch_id,$prof_id,$sy_id,$course_id,$sect_id){
        $query = "SELECT * FROM advisor_records WHERE batch_id = ? and prof_id = ? and sy_id = ? and course_id = ? and sect_id = ? and status != 'U'";
        $param = [$batch_id,$prof_id,$sy_id,$course_id,$sect_id];
        $result = $this->Common_model->regular_query($query,$param);

        if( ! empty($result)){
            #true
            return 1;
        }else{
            #false
            return 2;
        }
    }

    private function isRecordsExist($advisor_id,$batch_id,$sy_id,$course_id,$sect_id){
        $query = "SELECT * FROM advisor_records WHERE batch_id = ? and sy_id = ? and course_id = ? and sect_id = ? and status != 'U' and advisor_id != ?";
        $param = [$batch_id,$sy_id,$course_id,$sect_id,$advisor_id];
        $result = $this->Common_model->regular_query($query,$param);

        if( ! empty($result)){
            #true
            return 1;
        }else{
            #false
            return 2;
        }
    }
}