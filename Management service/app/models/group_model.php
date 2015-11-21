<?php
class Group_Model extends Model {
	//id int(50) primary key,name text,description text,size int(3)
    protected $_table = 'groups';
    
    function __construct() {
        parent::__construct();
    }     
    /**
     * insert data 
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function insert($data){    	    	
    	$data['id'] = $this->lastInsertId();        
        return $this->insert($data);       	
    }
}