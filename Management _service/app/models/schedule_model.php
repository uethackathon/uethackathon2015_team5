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
    function insertRecord($data){    	      	
    	$id = $this->selectWhere(array('id'),'1 order by id desc limit 1');
    	$data['id'] = $id[0]['id'];	
        return $this->insert($data);       	
    }
}