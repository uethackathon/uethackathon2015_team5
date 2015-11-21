<?php
/**
 * 
 */
require './app/models/session_model.php';

class Logout extends Controller {
    
    public function index(){
    	$user_id = Session::get('user_id');    	
    	$model = new Session_Model();
    	$model->delete("user_id = '$user_id'");
    	Session::destroy();	
    }
   
}
