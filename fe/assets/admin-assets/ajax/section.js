$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');

    $(document).on('submit','#addForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        $url = baseUrl + "sectionController/store";

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

                message('New Section added successfully!','success');
                formModalClose(addModal,$('#addForm'));
            },

            function(){
                logs(false);
            }
        )


    })

    $(document).on('click','#edit_btn',function(e){
        e.preventDefault();

        resetForm($('#updateForm'));

        let id = $(this).attr('data-id');
        $url = baseUrl + "sectionController/get";
      
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
                    $('#sect-id').val(response['message'].data['sect_id']);
                    $('#sect-number').val(response['message'].data['number']);
                    

                    editModal.modal('show');
                },

                function(){
                    logs(false);
                }
            );
    });

    $(document).on('submit','#updateForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        $url = baseUrl + "sectionController/update";

        swalMessage('custom','Are you sure you want to update this section?',function(){
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
                        msg(response['message'].message);
                        return;
                    }

                    message('Section updated successfully!','success');
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
        $url = baseUrl + "sectionController/delete";
        
        swalMessage('custom','Are you sure you want to Delete this Section?',function(){
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

                    message('Section removed Successfully!','success');

                },

                function(){
                    logs(false);
                }
            )

        });

    })

});