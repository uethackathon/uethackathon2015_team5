<?php
class User_Model extends Model {
	//id int(50) primary key,name text,email text,photo_url text
    protected $_table = 'users';
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