<?php
class Common_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
        
    } // END __construct();


    public function regular_query($query, $params = null)
	{	
		$result     = $this->db->query($query, $params);
        $error_code = $this->db->error()['code'];

        if ($error_code != 0) {
            get_instance()->load->library('Custom_Exception');

            get_instance()->custom_exception->show_result([
                'code'      => EXIT_BE_ERROR,
                'message'   => $this->db->error()
            ]);

        }

        $query_type = strtoupper(substr(trim($query), 0, 6));

        switch ($query_type) {
            case 'SELECT':
                    return $result->result_array(); //result(); // For SELECT queries, return the result
                break;
                
            case 'INSERT':
                    $return['insert_id'] = $this->db->insert_id();
                    return $return; // For INSERT queries, return the insert ID
                break;
                
            case 'UPDATE':
                    return $result; // For UPDATE queries, return true or false based on success
                break;
              
            default:
                    return false; // Unsupported query type
                break;
        }
	} // END method -- regular_query();


    public function eloquent_query($query, $params = null)
{
    $this->load->database();

    // Determine the query type (SELECT, INSERT, UPDATE)
    $query_type = strtoupper(substr(trim($query), 0, 6));

    try {
        switch ($query_type) {
            case 'SELECT':
                $result = $this->db->query($query, $params);
                if ($result) {
                    return $result->result_array(); // Return the result for SELECT queries
                }
                break;

            case 'INSERT':
                $this->db->query($query, $params);
                $insert_id = $this->db->insert_id();
                return ['insert_id' => $insert_id]; // Return the insert ID for INSERT queries
                break;

            case 'UPDATE':
                $result = $this->db->query($query, $params);
                return $result; // Return true or false based on success for UPDATE queries
                break;

            default:
                throw new Exception("Unsupported query type: $query_type");
        }
    } catch (Exception $e) {
        get_instance()->load->library('Custom_Exception');
        get_instance()->custom_exception->show_result([
            'code'    => EXIT_BE_ERROR,
            'message' => $e->getMessage()
        ]);
    }

    return false; // Return false for unsupported query types
}




    public function select_from_table($table, $params) {
        /**
         * Sample call
         * @see $results = select_from_table('my_table', '*', array('id' => $id), 'date_created DESC', 10);
         */

        $this->db->select($params['select']);
        $this->db->from($table);
        
        if (isset($params['where']) && ! empty($params['where'])) {
            $this->db->where($params['where']);

        }




        if (isset($params['order_by']) && ! empty($params['order_by'])) {
            $this->db->order_by($params['order_by']);

        }


        if (isset($params['limit']) && ! empty($params['limit'])) {
            $this->db->limit($params['limit']);

        }


        $query = $this->db->get();

        
        if ($query->num_rows() > 0) {
            return $query->result_array();

        } else {
            return 1; // Return empty array if no results found

        }

    } // END method -- select_from_table();

    public function update($table, array $data, array $where) {
        // $this->db->where($where);
        // $this->db->update($table, $data);
        $query = $this->db->where($where)
            ->update($table,$data);

        $error_code = $this->db->error()['code'];

        if ($error_code != 0) {
            get_instance()->load->library('Custom_Exception');

            get_instance()->custom_exception->show_result([
                'code'      => EXIT_BE_ERROR,
                'message'   => $this->db->error()
            ]);

        }
        
        return $query->affected_rows();

    } // END method -- update();

    public function insert($table, array $data)
    {
        $this->db->insert($table, $data);

        $error_code = $this->db->error()['code'];

        if ($error_code != 0) {
            get_instance()->load->library('Custom_Exception');

            get_instance()->custom_exception->show_result([
                'code'      => EXIT_BE_ERROR,
                'message'   => $this->db->error()
            ]);
        }

        return $this->db->insert_id();

    } // END method -- insert();


}
