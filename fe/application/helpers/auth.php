<?php


function is_logged_in($role = false)
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('authController');
    }

    if ($role) {
        $role_id = $ci->session->userdata('type');

		if($role_id != $role) {
			redirect('authController/blocked');
		}
    }
}

function check_access($type_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('type_id', $type_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

