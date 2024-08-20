<?php

class AdvisoryRecordsController extends BE_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query = "select ad.advisor_id,prof.name as prof_name,s.sy_name as 'sy',crs.course_name as course,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id";
        
        $result = $this->Common_model->regular_query($query);

        if( ! $result){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data'    => $result
        ];

        $this->be_exception->show_result($message);
    }

    public function store(){
        $receiveData = $this->message;

        $prof_id = $receiveData['prof_id'];
        $sy_id = $receiveData['sy_id'];
        $course_id = $receiveData['course_id'];
        $section_id = $receiveData['section_id'];

        $query  = "INSERT INTO advisor_records (prof_id,sy_id,course_id,section_id) VALUES(?,?,?,?)";
        $params = [$prof_id,$sy_id,$course_id,$section_id];

        $result = $this->Common_model->regular_query($query,$params);

        if( empty($result)){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }

    public function get(){
        $id = $this->message['filter'];
        
        $query = "select ad.advisor_id,prof.name as prof_name,s.sy_name as 'sy',crs.course_name as course,sect.number as section from advisor_records ad,professor prof,sy s,courses crs, sections sect where ad.prof_id = prof.prof_id and ad.sy_id = s.sy_id and ad.course_id = crs.course_id and ad.sect_id = sect.sect_id and ad.advisor_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if(empty($result)){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No Data Found'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK',
            'data' => $result
        ];

        $this->Common_model->show_result($message);

    }

    public function update(){
        $receiveData = $this->message;

        $prof_id = $receiveData['prof_id'];
        $sy_id = $receiveData['sy_id'];
        $course_id = $receiveData['course_id'];
        $section_id = $receiveData['section_id'];
        $update_date = current_datetime();
        $id = $receiveData['advisor_id'];

        $query = "UPDATE advisor_records SET prof_id = ? , sy_id = ? , course_id = ? , section_id = ? , last_updated = ? WHERE advisor_id = ?";
        $params = [$prof_id,$sy_id,$course_id,$section_id,$update_date,$id];

        $result = $this->Common_model->regular_query($query,$params);

        if(! $result){
            #expected return false
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);


    }

    public function destroy(){
        $id = $this->message['filter'];

        $query = "UPDATE advisor_records SET status = 'U' WHERE advisor_id = ?";
        $param = [$id];

        $result = $this->Common_model->regular_query($query,$param);

        if( ! $result){
            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'an error occured while processing your request.'
            ];
        }

        $message = [
            'code' => EXIT_SUCCESS,
            'message' => 'OK'
        ];

        $this->be_exception->show_result($message);
    }
}