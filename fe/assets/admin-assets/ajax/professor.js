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


    $(document).on('click','#get',function(e){
        e.preventDefault();

        $url = baseUrl + "professorController/getProfessor";
        let ID = 1;
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
            },
            function() {
                // Complete callback
                logs(false);
            }
        )
    })

});