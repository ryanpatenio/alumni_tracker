<?php


function is_logged_in()
{
    $agent_id = get_instance()->session->agent;

    if( ! $agent_id) {
        get_instance()->session->sess_destroy();
        flash_message('User not valid', 'danger');
        redirect(site_url('login'));

    }

}




function check_access()
{
    $agent_id = get_instance()->session->agent_id;

    if( ! $agent_id) {
        get_instance()->session->sess_destroy();
        flash_message('User not valid', 'danger');
        redirect(site_url('login'));

    }

}
