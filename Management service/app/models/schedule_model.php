<?php
class Schedule_Model extends Model {
	//id int(50) ,title text,description text,exprire_date timestamp
    protected $_table = 'schedule';
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