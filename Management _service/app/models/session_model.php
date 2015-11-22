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
    function insertRecord($data){    	      	
    	$id = $this->selectWhere(array('id'),'1 order by id desc limit 1');
    	$data['id'] = $id[0]['id'];	
        return $this->insert($data);       	
    }
    
}