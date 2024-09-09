$(document).ready(function(){
    let newPass = $('#new-password');
    let re_pass = $('#re-password');

    let submitBtn = $('#change-pass-btn');
    let err = $('#error_message');

    submitBtn.attr('disabled',true);

    $(document).on('submit','#changePasswordForm',function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        $url = baseUrl + "UserProfileController/changePass";

        swalMessage('custom','Are you sure you want to change your Password?',function(){
            AjaxPost(
                $url,
                'POST',
                Data,

                function(){
                    logs(true);
                },

                function(response){
                    res(response);
                },

                function(){
                    logs(false);
                }
            )

        });
       
    });

    $('#re-password').keyup(function(){
        if(newPass.val() != "" && newPass.val() != null){
            //check password match or not
            if(newPass.val() != re_pass.val()){
                //not match
                err.text('Password Not Match!').css('color','red');
                submitBtn.attr('disabled',true);
            }else{
                err.text('Password Match!').css('color','green');
                submitBtn.attr('disabled',false);
            }
        }else{
            err.text("");
        }
    });
    $('#new-password').keyup(function(){
        if(re_pass.val() != "" && re_pass.val() != null){
            //check password match or not
            if(re_pass.val() != newPass.val()){
                //not match
                err.text('Password Not Match!').css('color','red');
                submitBtn.attr('disabled',true);
            }else{
                err.text('Password Match!').css('color','green');
                submitBtn.attr('disabled',false);
            }
        }else{
            err.text('');
        }
       
    })

    function empty(element){
        let bol = false;
        if(element.val() != "" || element.val() != null){
            bol = true;
        }else{
            bol = false;
        }
    }

});