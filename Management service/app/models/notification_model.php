<?php
class Notification_Model extends Model {	
    //id int(50),type text,message text,create_date timestamp,owner_id int(50),scope varchar(20)
    protected $_table = 'notification';
    
    function __construct() {
        parent::__construct();
    }   

    function insert($data){    	    	
    	$data['id'] = $this->lastInsertId();        
        return $this->insert($data);       	
    }
}