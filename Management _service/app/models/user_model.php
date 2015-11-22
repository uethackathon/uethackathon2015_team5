<?php
class User_Model extends Model {
	//id int(50) primary key,name text,email text,photo_url text
    protected $_table = 'user';
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