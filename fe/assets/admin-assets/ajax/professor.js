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
                res(response)
            },
            function() {
                // Complete callback
                logs(false);
            }

        );
       
    });

});