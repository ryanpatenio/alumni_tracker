$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');

   $(document).on('submit','#addForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        $url = baseUrl + "syController/store";

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

                message('New School Year added successfully!','success');
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

        let id  = $(this).attr('data-id');
        $url = baseUrl + "syController/get";

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

                $('#sy-id').val(response['message'].data[0].sy_id);
                $('#sy-name').val(response['message'].data[0].sy_name);
                
                editModal.modal('show');
            },

            function(){
                logs(false);
            }
        )
    });

    $(document).on('submit','#updateForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        $url = baseUrl + "syController/update";

        swalMessage('custom','are you sure you want to update this School Year?',function(){
            AjaxPost(
                $url,
                'POST',
                Data,

                function(){
                    logs(true);
                },

                function(response){
                    //success callback
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }

                    message('School Year updated Successfully!','success');
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
        $url = baseUrl + "syController/delete";

        swalMessage('custom','Are you sure you want to Delete this School Year?',function(){
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

                    message('School Year Removed Successfully!','success');
                },

                function(){
                    logs(false);
                }
            )

        });
    })

})