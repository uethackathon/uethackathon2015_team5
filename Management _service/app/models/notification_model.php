<?php
class Notification_Model extends Model {	
    //id int(50),type text,message text,create_date timestamp,owner_id int(50),scope varchar(20)
    protected $_table = 'notification';
    
    function __construct() {
        parent::__construct();
    }   

    function insertRecord($data){    	      	
    	$id = $this->selectWhere(array('id'),'1 order by id desc limit 1');
    	$data['id'] = $id[0]['id'];	
        return $this->insert($data);       	
    }
}