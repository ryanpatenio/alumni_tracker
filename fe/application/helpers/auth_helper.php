<?php


function is_logged_in()
{
    $agent_type = get_instance()->session->type;

    if( ! $agent_type) {
        get_instance()->session->sess_destroy();
        flash_message('User not valid', 'danger');
        redirect(site_url(''));

    }

}

function is_token_expired($api_code){
    if($api_code === 101){
        #Access Token Expired
        #redirect to Login
        
        get_instance()->session->sess_destroy();
        flash_message('Access Token Expired!', 'danger');
        redirect(site_url());
        
    }
}




function check_access()
{
    $agent_type = get_instance()->session->agent_type;

    if( ! $agent_type) {
        get_instance()->session->sess_destroy();
        flash_message('User not valid', 'danger');
        redirect(site_url(''));

    }

}
