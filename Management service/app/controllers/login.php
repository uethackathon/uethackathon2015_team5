<?php
/**
 * 
 */
require 'app/controllers/authenticate.php';
class Login extends Controller {

    function __construct($title) {
        parent::__construct($title);        
        
    }
    /**
     * Default method
     * @return [type] [description]
     */
    public function index(){
    	if(Session::get('logined')!==null){
        	if(Session::get('logined')){
        		$this->getUserLogin();
        		exit();
        	}        	
        }
    	$auth = new Authenticate();
        if(isset($_POST['user_id'])&&isset($_POST['id_token'])){	
        	$user_id = $_POST['user_id'];
        	$id_token = $_POST['id_token'];       	
        	if($auth->checkLogin($user_id,$id_token)){
	    		Session::init();
	    		Session::set('id_token',$id_token);
	    		Session::set('user_id',$user_id);
	    		Session::set('logined',true);
	    		echo json_encode('login success');
	    	}else{
    			echo json_encode('need login with google ID');
    			exit;
    		}    	
        }else{
    		echo json_encode('need login with google ID');
    	}        	
   }
   /**
    * Get user login information
    * @return [type] [description]
    */
   function getUserLogin(){
   		$user_id = Session::get('user_id');
   		$id_token = Session::get('id_token');
   		if(isset($user_id)&&isset($id_token)){
   			echo json_encode(array('user_id'=>$user_id,'id_token'=>$id_token));
   		}
   }
}
