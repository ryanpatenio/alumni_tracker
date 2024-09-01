$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');


    $(document).on('submit','#addForm',function(e){
        e.preventDefault();


        $url = baseUrl + "courseController/store";

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

                message('New Course added successfully!','success');
                formModalClose(addModal,$('#addForm'));
            },

            function(){
                logs(false);
            }
        );


    });

    $(document).on('click','#edit_btn',function(e){
        e.preventDefault();

        resetForm($('#updateForm'));

        let id = $(this).attr('data-id');

        $url = baseUrl + "courseController/get";

        AjaxPost(
            $url,
            'POST',
            {id:id},

            function(){
                logs(true);
            },

            function(response){
                //success callback
                if(response['message'].code != 0){
                    msg(response['message'].message,'error');
                    return;
                }

                editModal.modal('show');
                $('#course-name').val(response['message'].data[0].course_name);
                $('#id').val(response['message'].data[0].course_id);
            },

            function(){
                logs(false);
            }
        );

    });

    $(document).on('submit','#updateForm',function(e){
        e.preventDefault();

        $url = baseUrl + "courseController/update";
        let Data = $(this).serialize();

        swalMessage('custom','Are you Sure you want to update this Course?',function(){
            AjaxPost(
                $url,
                'POST',
                Data,

                function(){
                    logs(true);
                },

                function(response){
                    //success callback
                    //res(response);
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }

                    message('Selected updated successfully!','success');
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

        let id = $(this).attr('data-id');
        $url = baseUrl + "courseController/delete";

        swalMessage('custom','Are you sure you want to Delete this Course?',function(){
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

                    message('Selected Course removed successfully!','success');
                    formModalClose(editModal,$('#updateForm'));
                },

                function(){
                    logs(false);
                }
            )

        });
    })


});