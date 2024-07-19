<?php
class BE_Model extends CI_Model {
	#Assumption, table should have id column
	const DATE_SEPARATOR = '-';
	const TABLE_ID = 'id';
	
	protected $table_name;
	protected $conn;
    protected $image_type;
	

	public function __construct()
    {
        parent::__construct();
        
    }
    
    public function set_connection($db)
    {
        $this->conn = $db;
    }
    
    public function set_table($table)
    {
    	$this->table_name= $table;
    }




	public function manual_query($query, $params)
	{	
		$result = $this->conn->query($query, $params);

		return $result->result();

	} // END method -- manual_query();




	public function find_one($filters)
    {
    	//echo 'FIND ONE '.$this->table_name;
    	$this->conn->where($filters);
    	$this->conn->from($this->table_name);
    	$this->conn->order_by(SELF::TABLE_ID,'desc');
    	$this->conn->limit(1);
    	$return = $this->conn->get();
    	
    	#$this->db->_error_message();
    	
    	$error = $this->db->error();


    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
		    				'code' => EXIT_BE_ERROR,
		    				'message' => $error['message']
		    			);
    		$this->be_exception->show_result($msg);
    	}
    	
    	return $return->row_array();
    }
    
    public function find_many($filters, $offset, $limit, $sort = 'asc')
    {
    	/*foreach ($filters as $field => $value)
    	 {
    	 echo $field."    ".$value;
    	 }*/
    	//echo $this->table_name;
    	$this->conn->where($filters);
    	$this->conn->from($this->table_name);
    	$this->conn->limit($limit, $offset);
    	$this->conn->order_by(SELF::TABLE_ID,$sort);
    	$return = $this->conn->get();

    	$error = $this->db->error();
    	

    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
		    				'code' => EXIT_BE_ERROR,
		    				'message' => $error['message']
		    			);

    		$this->be_exception->show_result($msg);
    	}
    	
    	return $return->result_array();
    }

    public function count($filters)
    {
    	/*foreach ($filters as $field => $value)
    	 {
    	 echo $field."    ".$value;
    	 }*/
    	//echo $this->table_name;
    	$this->conn->where($filters);
    	$this->conn->from($this->table_name);
    	$count = $this->conn->count_all_results();

    	$error = $this->db->error();
    	

    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
		    				'code' => EXIT_BE_ERROR,
		    				'message' => $error['message']
		    			);
    		$this->be_exception->show_result($msg);
    	}
    	
    	return $count;
    }
    
    public function insert($data)
    {
    	$this->validate('I', $data);
    	
		$data = $this->edit_data('I', $data);
    	//echo $this->table_name;
		//print_r($data);
    	$this->conn->insert($this->table_name, $data);
    	
    	$error = $this->conn->error();
    	
    	if ( $this->table_name == 'payment'
    			&& $error['code'] != 0 )
    	{
    		return null;
    	}
    	
    	log_message('error','Error Code after insert : '.$error['code']);

    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
		    				'code' => EXIT_BE_ERROR,
		    				'message' => $error['message']
		    			);
    		$this->be_exception->show_result($msg);
    	}
    	
    	return $this->conn->insert_id();
    }

   
    public function insert_noedit($data)
    {
        $edit_data['create_date'] 	= date('Y-m-d H:i:s');
        $edit_data['update_date']	= date('Y-m-d H:i:s');

    	$this->conn->insert($this->table_name, $data);
    	
    	$error = $this->conn->error();
    	
    	if ( $this->table_name == 'payment'
    			&& $error['code'] != 0 )
    	{
    		return null;
    	}

    	log_message('error','Error Code after insert : '.$error['code']);

    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
		    				'code' => EXIT_BE_ERROR,
		    				'message' => $error['message']
		    			);
    		$this->be_exception->show_result($msg);
    	}
    	return $this->conn->insert_id();
    }
    
    public function update($id, $data)
    {
    	///echo 'UPDATE '.$this->table_name.' '.$id;
		//print_r($data);
    	$this->validate('U', $data);
    	
		$data = $this->edit_data('U', $data);
    	//echo $this->table_name.'*************************************';
		//print_r($data);
		$this->conn->set($data);
		$this->conn->where(self::TABLE_ID, $id);
		$this->conn->update($this->table_name, $data);
    	
    	$error = $this->conn->error();

    	if ( $error['code'] != 0 )
    	{
    		$msg = array( 
    						'code' => EXIT_BE_ERROR,
    						'message' => $error['message']
    					);
    		$this->be_exception->show_result($msg);
    	}
    }
    
    public function update_many($filter, $data)
    {
		//$this->conn->set($data);
		//$this->conn->where($filter);
		//log_message('error',$filter);
		$this->conn->update($this->table_name, $data, $filter);
    	
    	$error = $this->conn->error();

    	if ( $error['code'] != 0 )
    	{
    		$msg = array( 
    						'code' => EXIT_BE_ERROR,
    						'message' => $error['message']
    					);
    		$this->be_exception->show_result($msg);
    	}
    }
    
    public function edit_data($function, $data)
    {
    	$edit_data = array();
    	
    	foreach ($data as $field => $value)
    	{
    		if ( $value == null )
    		{
    			$edit_data[$field] = '';
    		}
    		else 
    		{
    			$edit_data[$field] = $value;
    		}
    	}

    	if ( $this->conn == $this->db
    			&& $this->table_name == 'image' )
    	{
    	    $edit_data['image_type'] 	= $this->image_type;
    	}

    	if ( $this->conn == $this->db
    			&& $this->table_name != 'access_log' )
    	{
    	    if ( $function == 'I' )
    	    {
	    	   $edit_data['create_date'] 	= date('Y-m-d H:i:s');
    	    }

	    	$edit_data['update_date']	= date('Y-m-d H:i:s');
    	}
    	
    	return $edit_data;
    }
    
    public function lock_record($filter)
    {
    	$data = array( 'lock_flag'			=> '1' );

    	$this->conn->set($data);
    	$this->conn->where($filter);
    	$this->conn->update($this->table_name, $data);
    	 
    	$error = $this->conn->error();
    	
    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
    				'code' => EXIT_BE_ERROR,
    				'message' => $error['message']
    		);
    		$this->be_exception->show_result($msg);
    	}
    }

    public function unlock_record($filter)
    {
    	$data = array( 'lock_flag'			=> '0' );

    	$this->conn->set($data);
    	$this->conn->where($filter);
    	$this->conn->update($this->table_name, $data);
    	 
    	$error = $this->conn->error();
    	
    	if ( $error['code'] != 0 )
    	{
    		$msg = array(
    				'code' => EXIT_BE_ERROR,
    				'message' => $error['message']
    		);
    		$this->be_exception->show_result($msg);
    	}
    }
    
    public function validate($type, $data)
    {
    	$this->image_type = '';

    	//looping 
    	if ( $this->table_name == 'access_log' )
    	{
    		return;
    	}
    	
    	$valid = true;
    	$validate_message = '';
    	
    	$columns = $this->get_column_rules();
    	if ($columns == null)
    	{
    		return ;	
    	}
    	
    	//print_r($data);
    	foreach ($columns as $column) 
    	{
    		//print_r($column);
    		if ( $type == 'I' &&  $column->required == 'Y'
					&& ( !isset($data[$column->column]))
    			)
			{
				//echo $data[$column->column];
				$validate_message .= $column->column." of ".$this->table_name." is required, ";
				$valid = false;
			}
			
			if ( isset($data[$column->column]) )
			{    
                if ($column->data_type == 'ArrayNum' )
                {
                    for($i = 0; $i < count($data[$column->column]); $i++){
                if ( $column->data_type  == 'ArrayNum' && !is_numeric(trim($data[$column->column][$i])) )
                    {
                        $validate_message .= $column->column." of ".$this->table_name
                                            ." is not a number,";
                        $valid = false;
                    }
                }}
                if ($column->data_type == 'Array' )
                {
                    for($i = 0; $i < count($data[$column->column]); $i++){
                    if ( $column->min_length > 0 
                            && strlen($data[$column->column][$i]) < $column->min_length )
                    {
                        $validate_message .= $column->column." of ".$this->table_name
                                            ." min length error, ";
                        $valid = false;
                    }
                    
                    if ( $column->max_length < 99999
                            && strlen($data[$column->column][$i]) > $column->max_length )
                    {
                        $validate_message .= $column->column." of ".$this->table_name
                                            ." max length error, ";
                        $valid = false;
                    }
                    
                    if ( trim($column->valid_values) != '' )
                    {
                        //echo $column->column;
                        //echo trim($column->valid_values);
                        $values = explode( "|", trim($column->valid_values) );
                        //print_r($values) ;
                        
                        //not sure why in_array is not working
                        $found = false;
                        foreach($values as $value)
                        {
                            if ( $value == $data[$column->column][$i])
                            {
                                $found = true;
                            }
                        }
                        
                        if (!$found)
                        {
                            $validate_message .= $column->column." of ".$this->table_name
                                                ." value not allowed, ";
                            $valid = false;
                        }
                    }
                }}

				if ($column->data_type == 'String' )
				{
					if ( $column->min_length > 0 
							&& strlen($data[$column->column]) < $column->min_length )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." min length error, ";
						$valid = false;
					}
					
					if ( $column->max_length < 99999
							&& strlen($data[$column->column]) > $column->max_length )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." max length error, ";
						$valid = false;
					}
					
					if ( trim($column->valid_values) != '' )
					{
						//echo $column->column;
						//echo trim($column->valid_values);
						$values = explode( "|", trim($column->valid_values) );
						//print_r($values) ;
						
						//not sure why in_array is not working
						$found = false;
						foreach($values as $value)
						{
							if ( $value == $data[$column->column])
							{
								$found = true;
							}
						}
						
						if (!$found)
						{
							$validate_message .= $column->column." of ".$this->table_name
												." value not allowed, ";
							$valid = false;
						}
					}
				}
				
				if ( $column->data_type == 'Int' 
						|| $column->data_type == 'Number' 
					)
				{
					if ( $column->data_type == 'Int' 
							&& ( $data[$column->column] 
									- floor($data[$column->column]) ) > 0 )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not an integer, ";
						$valid = false;
					}
					
					if ( $column->data_type == 'Number' 
							&& ! is_numeric($data[$column->column]) )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not a number ("
											.$data[$column->column]
											."),";
						$valid = false;
					}
					
					if ( $column->min_value > 0
							&& $data[$column->column] < $column->min_value )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." min value errror, ";
						$valid = false;
					}

					if ( $column->max_value < 999999999
							&& $data[$column->column] > $column->max_value )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." max value errror, ";
						$valid = false;
					}
				}
				
				if ($column->data_type == 'Email' )
				{
					if ( !filter_var($data[$column->column], FILTER_VALIDATE_EMAIL) )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not a valid email address, ";
						$valid = false;
					}
				}
				
				if ($column->data_type == 'Date' )
				{
                    $start = strtotime(date('Y-m-d'));
                    $end = strtotime(date('Y-m-d', strtotime('+10 year')));

					if ( ! $this->date_valid($data[$column->column], self::DATE_SEPARATOR) )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not a valid date, ";
						$valid = false;
                    }

                    $time = strtotime($data[$column->column]);
                    if($time<$start || $time>$end){
                    $validate_message .= $column->column." of ".$this->table_name
                                            ." is not a valid date, ";
                    $valid = false;
                    }
                   
					}
				
				
				/*if ($column->data_type == 'Time' )
				{
					if ( ! $data[$column->column] instanceof DateTime ) 
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not a valid datetime, ";
						$valid = false;
					}
				}*/
				
				if ($column->data_type == 'Mobile' )
				{
					if ( ! $this->mobile_valid($data[$column->column]) )
					{
						$validate_message .= $column->column." of ".$this->table_name
											." is not a mobile number, ";
						$valid = false;
					}
				}
				
				if ( $column->data_type == 'Base64' )
				{				    
				    $imgdata = base64_decode($data[$column->column]);
				    $f = finfo_open();
                    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
                    $mime_split = explode("/", $mime_type);
                    $image_type = $mime_split[1];

				    if ( $image_type != 'png' && $image_type != 'jpg' 
				            && $image_type != 'gif' && $image_type != 'jpeg' )
				    {
						$validate_message .= $column->column." of ".$this->table_name
											." is not Base64 encoded, ";
						$valid = false;
				    }

                    $this->image_type = $image_type;

				}
			}
    	}
    	
    	if ( !$valid )
    	{
    		$validate_message = substr($validate_message,0, strlen($validate_message) - 2);
    		$msg = array( 
    						'code'	 	=> EXIT_BE_ERROR,
    						'message' 	=> $validate_message
    					);
    		//print_r($msg);
    		$this->be_exception->show_result($msg);
    	}
    }

    private function get_column_rules()
    {
    	$this->load->model('column_rule_model', 'column_rule_model', FALSE);
    	return ($this->column_rule_model->getcols($this->table_name));
    }
    
    private function date_valid($date, $separator) 
    {
    	$ret = true;
    	//echo count(explode($separator,$date));
    	if (count(explode($separator,$date)) == 3) 
    	{
    		
    		//$pattern = "/^([0-9]{2})".$separator."([0-9]{2})".$separator."([0-9]{4})$/";
    		$pattern = "/^([0-9]{4})".$separator."([0-9]{2})".$separator."([0-9]{2})$/";

    		if (preg_match ($pattern, $date, $parts))  
    		{
    			//echo 'true'.$parts[1]." ".$parts[2]." ".$parts[3];
    			
    			if ( ! checkdate($parts[2],$parts[3],$parts[1]) )
    			{
    				$ret = false;
    			}
    		}
    		else 
    		{
    			//echo 'else'.$parts[0]." ".$parts[1]." ".$parts[2];
    			$ret = false;
    		}
    	} 
    	else 
    	{
    		$ret = false;
    	}
    
    	return $ret;
	}
	
	public function average($filter, $field)
	{
	    //cho "AVG($field) as field_avg";
	    //print_r($filter);
	    $this->db->select("AVG(".$field.") as field_avg");
	    $this->conn->where($filter);
	    $this->conn->from($this->table_name);
	    $return = $this->conn->get();
	    
	    $error = $this->db->error();
	    
	    if ( $error['code'] != 0 )
	    {
	        $msg = array(
            	            'code' => EXIT_BE_ERROR,
            	            'message' => $error['message']
            	        );

	        $this->be_exception->show_result($msg);
	    }

	    return $return->row_array();
	}

	private function mobile_valid($mobile)
	{
		$ret = true;
		
		$pattern = "/^([0]{1})([9]{1})([0-9]{9})+$/";
		
		if ( !preg_match ($pattern, $mobile) )
		{
			$ret = false;
		}
		
		return $ret;
    }




}
