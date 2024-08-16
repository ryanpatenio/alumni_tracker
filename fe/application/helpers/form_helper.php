<?php 

#note!!!
#coz of this customize form_helper some of the default CI method override
#sample the form error method



#$text = "<p>Hello <b>World</b>!</p>";
#$clean_text = strip_tags($text);
#echo $clean_text;  // Outputs: "Hello World!"


if ( ! function_exists('set_val_rule')) {

    function set_val_rule($field, $label, $rules) {
        $CI =& get_instance();  // Get CodeIgniter instance
        $CI->load->library('form_validation');

        // Check if $rules is an array or a string
        if (is_array($rules)) {
            $rules = implode('|', $rules);
        }

        $CI->form_validation->set_rules($field, $label, $rules);
    }
}



if( ! function_exists('json_response')){

    function json_response($message, $statusCode,$error = null) {
        $CI =& get_instance();  // Get CodeIgniter instance

        if($error != null){
            #when u used this error you must know this[put this in the form_validation_error if this run() === false]
            # $errors = $this->form_validation->error_string();
            $CI->output
            ->set_content_type('application/json')
            ->set_status_header($statusCode)
            ->set_output(json_encode(['message' => strip_tags($message)]));
            
        }else{
            $CI->output
            ->set_content_type('application/json')
            ->set_status_header($statusCode)
            ->set_output(json_encode(['message' => $message]));

        }

       
    }
}


if ( ! function_exists('form_error'))
{
    function form_error($field = '', $prefix = '', $suffix = '')
    {
        $CI =& get_instance();
        $errors = $CI->form_validation->error($field);
        return $prefix . $errors . $suffix;
    }
}

#this will only return array with 2 params label and rules
if( ! function_exists('arr')){

    function arr($label,$rules){

        return array(
            'label' => $label,
            'rules' => $rules
        );
    
    }
}
