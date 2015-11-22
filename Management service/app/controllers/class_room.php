<?php
/**
 * 
 */
require __DIR__.'/../models/user_class_model.php';
require __DIR__.'/../models/user_model.php';
class Class_Room extends Controller {

    function __construct($title) {
        parent::__construct($title);
        if(Session::get('logined')!==null){
        	if(!Session::get('logined')){
        		header('location: '.URL.'login');
        	}        	
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
    	if(isset($id)){
    		$result = $this->model->selectWhere('*',"id = "."'$id'");
    		echo json_encode($result);
    	}else{
    		echo json_encode('failed');
    	}    	
    }
    /**
     * Get student attend to class
     * @param  [type] $class_id [description]
     * @return [type]           [description]
     */
    function getStudent($class_id){
    	$result = array();
    	$owner_id = $this->model->selectWhere(array('owner_id'),"id = "."'$class_id'");    	    
    	if(isset($class_id)){
    		$UserClassModel = new User_Class_Model();    		
    		$user_id = $UserClassModel->selectWhere(array('user_id'),"class_id = "."'$class_id'");
    		if(isset($user_id)){
    			foreach ($user_id as $key => $value) {
    				$UserModel = new User_Model();    				
    				$user_id = $value['user_id'];
    				if($owner_id[0]['owner_id']==$user_id)
    					continue;
    				$user = $UserModel->selectWhere('*',"	id = "."'$user_id'");
    				array_push($result, $user);
    			}
    			echo json_encode($result[0]);
    		}
    	}else{
    		echo json_encode('failed');
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
     	$data['start_date'] = $_POST['start_date'];
     	$data['description'] = $_POST['description'];
     	$data['owner_id'] = $_POST['owner_id'];
     	$data['address'] = $_POST['address'];
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
     * Remove the specified resource 
     * @return [type] [description]
     */
    function destroy($id) {        
        $where = "id = '$id'";
        if($this->model->delete($where)){
        	$r = new HttpRequest(URL.':'.USER_CLASS_MICS_PORT.'delete', HttpRequest::METH_POST);
			$r->setOptions(array('cookies' => array('lang' => 'en')));
			$r->addPostFields(array('data' => '{"class_id":'.$id.'}'));		
			try {
			    echo $r->send()->getBody();
			} catch (HttpException $ex) {
			    echo $ex;
			}
        }                
    }
    function join(){
    	if(!isset($_POST['submit'])){
     		echo json_encode("failed");
     		exit();
     	}
     	$data = array();
     	$data['class_id'] = $_POST['class_id'];
     	$data['user_id'] = $_POST['user_id'];
     	if(count($data)==0){
     		echo json_encode("failed");
     		exit();	
     	}
     	$UserClassModel = new User_Class_Model(); 
     	$UserModel = new User_Model();
     	$class_id = $data['class_id'];
     	$user_id = $data['user_id'];
     	$isAttend = $$UserClassModel->selectWhere('*',"class_id = '$class_id' and user_id = '$user_id'");
     	$isExistClass =$this->selectWhere('*',"id = '$class_id'");  
     	$isExistUser = $UserModel->selectWhere('*',"id = '$user_id'");
     	if(isset($isAttend)){
     		echo json_encode(array("failed",'message'=>'You are attend this class!'));
     		exit();
     	}
     	if(!isset($isExistClass)||!isset($isExistUser)){
     		echo json_encode(array("failed",'message'=>'Class or user not exist!'));
     		exit();
     	}
    	$arrTemp = array();
        foreach($data as $key=>$value){
            $arrTemp[$key] =$key."="."'$value'"; 
        }           
    	if($UserClassModel->insert($data)){
    		echo json_encode(array("success",$data['id']));
    	}else{
    		echo json_encode("failed");
    	}       
    }

}
