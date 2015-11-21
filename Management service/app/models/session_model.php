<?php
class Session_Model extends Model {
    //name text,start_date timestamp,description text,owner_id int(50),address text
    protected $_table = 'session';
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