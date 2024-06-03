<?php
class Column_rule_Model extends CI_Model {
	#Assumption, table should have id column
	const TABLE_ID = 'id';
	
	protected $table_name='column_rule';
	
	public function __construct()
    {
        parent::__construct();
    }
    
    public function getcols($table_name)
    {
    	
    	$filter = array('table' => $table_name);
    	$this->db->where($filter);
    	//echo ($filter['table']);
    	$this->db->from($this->table_name);
    	
    	$query = $this->db->get();
    	
    	return $query->result();
    }
 
}
?>