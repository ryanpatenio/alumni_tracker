$(document).ready(function(){

    const addModal = $('#addModal');
    const editModal = $('#editModal');
    const viewModal = $('#viewModal');


    $('#addForm').submit(function(e){
        e.preventDefault();
       
        $url = baseUrl + "professorController/store";
        $param = $(this).serialize();

        AjaxPost(
            $url,
            'POST',
            $param,

            function() {
                // Before send callback
                logs(true);
            },
            function(response) {
                // Success callback
                
                if(response.code != 0){
                    message('An Error Occured While Processing your request.','error');
                }
                message('New Record added!','success');
                formModalClose(addModal,$('#addForm'));
            },
            function() {
                // Complete callback
                logs(false);
            }

        );
       
    });


    $(document).on('click','#edit_btn',function(e){
        e.preventDefault();

        resetForm($('#updateForm'));

        $url = baseUrl + "professorController/getProfessor";
        let ID = $(this).attr('data-id');
        AjaxPost(
            $url,
            'POST',
            {ID:ID},
            function() {
                // Before send callback
                logs(true);
            },
            function(response) {
                // Success callback
                res(response)

               if(response['message'].code != 0){
                msg(response['message'].message,'error');
                return;
               }

               $('#prof_name').val(response['message'].data[0].name);
               $('#email').val(response['message'].data[0].email);
               $('#contact').val(response['message'].data[0].contact);
               $('#address').val(response['message'].data[0].address);
               $('#degree').val(response['message'].data[0].degree);

               $('#id').val(response['message'].data[0].prof_id);
               editModal.modal('show');
               
            },
            function() {
                // Complete callback
                logs(false);
            }
        )
    });

    $(document).on('submit','#updateForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();

        $url = baseUrl + "professorController/update";

     swalMessage('update','',function(){

            AjaxPost(
                $url,
                'POST',
                Data,
                function() {
                    // Before send callback
                    logs(true);
                },
                function(response) {
                    // Success callback
                    res(response)
                    if(response['message'].code != 0){
                        msg(response['message'].message);
                        return;
                    }

                    message('Data updated successfully','success');
                    formModalClose(editModal,$('#updateForm'));
                },
                function() {
                    // Complete callback
                    logs(false);
                }
            )
     });
       

    });

    $(document).on('click', '#delete_btn', function(e) {
        e.preventDefault();
    
        let id = $(this).attr('data-id');
        let url = baseUrl + "professorController/delete";
    
        swalMessage('delete', '', function() {
            AjaxPost(
                url,
                'POST',
                { id: id },
                function() {
                    // beforesend
                    logs(true);
                },
                function(response) {
                    // success callback
                    if (response['message'].code != 0) {
                        msg(response['message'].message, 'error');
                        return;
                    }
                    message('Professor Removed Successfully!', 'success');
                },
                function() {
                    logs(false);
                }
            );
        });
    });
    

});