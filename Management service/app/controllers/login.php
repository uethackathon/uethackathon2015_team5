<?php
/**
 * 
 */
class Login extends Controller {

    function __construct($title) {
        parent::__construct($title);
        // Need authenticate first
        $auth = new Authenticate();
    	if($auth->checkLogin($user_id,$id_token)){
    		Session::init();
    		Session::set('id_token',$id_token);
    		Session::set('user_id',$user_id);
    	}else{
    		echo json_encode('need login with google ID');
    		exit;
    	}
    }
    public function index(){
    	echo json_encode('success');    
    }
   
}
