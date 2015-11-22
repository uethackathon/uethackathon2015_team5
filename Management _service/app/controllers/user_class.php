<?php
/**
 * 
 */
class User_Class extends Controller {

    function __construct($title) {
        parent::__construct($title);   
        //f(!Session::get('logined')){
        //	header('location: '.URL.'login');
        //}    
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
     	if(!isset($_POST['submit'])){
     		echo json_encode("failed");
     		exit();
     	}
     	$data = array();
     	$data['user_id'] = $_POST['user_id'];
     	$data['class_id'] = $_POST['class_id'];
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
    function detroy($id) {        
        $where = "id = '$id'";
        if($this->model->delete($where)){
        	echo json_encode(array("success",$id));
        }                
    }

}
