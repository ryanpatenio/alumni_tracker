$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');

    $('#addForm').submit(function(e){
        e.preventDefault();

        $url = baseUrl + "AdvisoryRecordsController/store";
        let Data = $(this).serialize();

        AjaxPost(
            $url,
            'POST',
            Data,

            function(){
                logs(true);
            },

            function(response){
                res(response);
                if(response['message'].code != 0){
                    msg(response['message'].message,'error');
                    return;
                }

                message('New Records added successfully!','success');
                formModalClose(addModal,$('#addForm'));
            },

            function(){
                logs(false);
            }
        )

    });

    $(document).on('click','#edit_btn',function(e){
        e.preventDefault();

        resetForm($('#updateForm'));

        let id = $(this).attr('data-id');
        $url = baseUrl + "AdvisoryRecordsController/get";

        AjaxPost(
            $url,
            'POST',
            {id:id},

            function(){
                logs(true);
            },

            function(response){
                //res(response);
                if(response['message'].code != 0){
                    msg(response['message'].message,'error');
                    return;
                }

                $('#prof-id').val(response['message'].data[0].prof_id);
                $('#prof-id').text(response['message'].data[0].prof_name);

                $('#sy-id').val(response['message'].data[0].sy_id);
                $('#sy-id').text(response['message'].data[0].sy);

                $('#course-id').val(response['message'].data[0].course_id);
                $('#course-id').text(response['message'].data[0].course);

                $('#batch-id').val(response['message'].data[0].batch_id);
                $('#batch-id').text(response['message'].data[0].batch_name);

                $('#section-id').val(response['message'].data[0].sect_id);
                $('#section-id').text(response['message'].data[0].section);

                $('#advisory-id').val(response['message'].data[0].advisor_id);

                editModal.modal('show');

            },

            function(){
                logs(false);
            }
        )

    });

    $('#updateForm').submit(function(e){
        e.preventDefault();

        $url = baseUrl + "AdvisoryRecordsController/update";
        let Data = $(this).serialize();

        swalMessage('custom','are you sure you want to update this Records?',function(){

            AjaxPost(
                $url,
                'POST',
                Data,

                function(){
                    logs(true);
                },

                function(response){
                   
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }
                    message('Records Updated Successfully!','success');
                    formModalClose(editModal,$('#updateForm'));
                },

                function(){
                    logs(false);
                }
            )

        });

    });

    $(document).on('click','#delete_btn',function(e){
        e.preventDefault();

        let id  = $(this).attr('data-id');
        $url = baseUrl + "AdvisoryRecordsController/delete";


        swalMessage('custom','Are you sure you want to Delete this Records?',function(){
            AjaxPost(
                $url,
                'POST',
                {id:id},

                function(){
                    logs(true);
                },

                function(response){
                  
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }

                    message('Selected Records Deleted Successfully!','success');

                },

                function(){
                    logs(false);
                }
            )

        });

       
    });


});