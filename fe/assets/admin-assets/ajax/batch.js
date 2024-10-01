$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');

    $('#addForm').submit(function(e){
        e.preventDefault();

        $url = baseUrl + "batchController/store";
        let Data = $(this).serialize();

        AjaxPost(
            $url,
            'POST',
            Data,

            function(){
                logs(true);

            },
            function(response){
               // res(response);
                if(response['message'].code != 0){
                    msg(response['message'].message,'error');
                    return;
                }

                message('New Batch Created Successfully!','success');
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
        $url = baseUrl + "batchController/get";

        AjaxPost(
            $url,
            'POST',
            {id:id},

            function(){
                logs(true);
            },

            function(response){
                res(response);
                if(response['message'].code != 0){
                    msg(response['message'].message,'error');
                    return;
                }

                $('#id').val(response['message'].data[0].batch_id);
                $('#batch-name').val(response['message'].data[0].batch_name);

                editModal.modal('show');

            },

            function(){
                logs(false);
            }
        )

    });

    $('#updateForm').submit(function(e){
        e.preventDefault();

        $url = baseUrl + "batchController/update";
        let Data = $(this).serialize();

        swalMessage('custom','are you sure you want to update this Batch?',function(){
            AjaxPost(
                $url,
                'POST',
                Data,

                function(){
                    logs(true);
                },
                function(response){
                    //res(response);
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }   

                    message('Selected Batch Updated Successfully!','success');
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
        $url = baseUrl + "batchController/delete";

        swalMessage('custom','are you sure you want to Delete this Batch?',function(){
            AjaxPost(
                $url,
                'POST',
                {id:id},

                function(){
                    logs(true)
                },

                function(response){
                    res(response);
                    if(response['message'].code != 0){
                        msg(response['message'].message,'error');
                        return;
                    }
                    
                    message('Selected Batch Deleted Successfully!','success');

                }
            )

        })

    })

});