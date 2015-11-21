<?php
class User_Group_Model extends Model {
	//id int(50),student_id int(50),group_id int(50),foreign key (student_id) REFERENCES user(id),foreign key (group_id) REFERENCES groups(id)
    protected $_table = 'user_group';
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