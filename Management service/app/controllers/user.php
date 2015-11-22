<?php
/**
 * 
 */
require __DIR__.'/../models/user_class_model.php';
require __DIR__.'/../models/class_room_model.php';

class User extends Controller {

    function __construct($title) {
        parent::__construct($title); 
        if(!Session::get('logined')){
        	header('location: '.URL.'login');
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
    	$result = $this->model->selectWhere('*',"id = ".$id);
    	if(isset($result)){
    		echo json_encode($result);
    	}else{
    		echo json_encode('failed');
    	}    	    	
    }
    /**
     * Display class in which user attend. 
     * @param  [String] $id [description]
     * @return [type]     [description]
     */
    function getClass($user_id){
    	$result = array();
    	if(isset($user_id)){
    			$model = new User_Class_Model();
    			$class_id = $model->selectWhere(array('class_id'),"user_id = "."'$user_id'");
    			if(isset($class_id)){
    				$class_model = new Class_Room_Model();
    				foreach ($class_id as $key => $value) {    		
    					$record = $class_model->selectWhere('*',"id = ".$value['class_id']);
    					array_push($result,$record[0]);	
    			}
    	}
    	if(isset($result)){
    		echo json_encode($result);
    	}    	
    	}    	    	    	
    }
    /**
     * Store a newly created resource
     */
    function insert() {     	
     	if(!isset($_POST['submit'])){
     		echo json_encode("failed");
     		exit();
     	}
     	$data = array();
     	$data['name'] = $_POST['name'];
     	$data['email'] = $_POST['email'];
     	$data['photo_url'] = $_POST['photo_url'];
     	if(count($data)==0){
     		echo json_encode("failed");
     		exit();	
     	}
    	$arrTemp = array();
        foreach($data as $key=>$value){
            $arrTemp[$key] =$key."="."'$value'"; 
        }   
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
