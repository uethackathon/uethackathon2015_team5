<?php
class Group_Model extends Model {
	//id int(50) primary key,name text,description text,size int(3)
    protected $_table = 'group';
    
    function __construct() {
        parent::__construct();
    }     
    /**
     * insert data 
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
   function insertRecord($data){    	      	
    	$id = $models->selectWhere(array('id'),'1 order by id desc limit 1');
    	$data['id'] = $id[0]['id'];	
        return $this->insert($data);       	
    }
}