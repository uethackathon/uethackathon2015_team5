<?php

class User_Group extends Controller {
	// id int(50) primary key auto_increment,student_id int(50),group_id int(50)
    function __construct($title) {
        parent::__construct($title);
        $auth = new Authenticate();
    	if($auth->checkLogin($user_id,$id_token)){
    		Session::init();
    		Session::set('id_token',$id_token);
    		Session::set('user_id',$user_id);
    	}else{
    		echo json_encode('need login with google ID!');
    		exit;
    	}
    }
   
     /**
     * Show all resource
     * @return [type] [description]
     */
    function index() {
          $data = $this->model->select('*');
          echo json_encode($data);
    }
    /**
     * Display the specified resource. 
     * @param  [String] $id [description]
     * @return [type]     [description]
     */
    function get($id){
    	$result = $model->selectWhere('*',"id = "."'$id'");
    	if($result==null)
    		echo json_encode('failed');
    	echo json_encode($result);
    }
    /**
     * Store a newly created resource
     */
    function insert() {     	
    	$jsonData = $_POST['data'];          	
    	$data = json_decode($jsonData);
    	if($this->model->insert($data)){
    		echo json_encode(array("success",$data['id']));
    	}else{
    		echo json_encode("failed");
    	}       

    }
    /**
     * Update specific resource
     * @return [type] [description]
     */
    function update(){
    	$data = json_decode($_POST['data'],true);				
    	$this->model->update($data,"id = ".$data[i]);
    }    
    /**
     * Remove the specified resource 
     * @return [type] [description]
     */
    function detroy($id) {        
        $where = "id = '$id'";
        $this->model->delete($where);
        echo "1";
    }
}
