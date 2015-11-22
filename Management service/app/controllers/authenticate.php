<?php

require 'app/models/session_model.php';
class Authenticate {    

    function __construct() {
    }
    /**
     * Check user have login to google ID
     * @param  [text] $user_id  [parameter which user post to server]
     * @param  [text] $id_token [parameter which user post to server]
     * @return [type]           [description]
     */
    function checkLogin($user_id,$id_token){        	
    	$models = new Session_Model();  
    	if($this->isValidUser($user_id,$id_token)){
    		return true;    	
    	}    		    	
    	if($this->checkAccountFromGoogle($user_id,$id_token)){
    		$data = array('id'=>2,'id_token'=>$id_token,'user_id'=>$user_id,'date_created'=>time());    		    		    	
    		if($models->insertRecord($data)){
    			return true;
    		}        	    		
    	}    	
    	return false;
    }
    /**
     * Check account is valid from google ID
     * @param  [type] $user_id  [description]
     * @param  [type] $id_token [description]
     * @return [type]           [description]
     */
    function checkAccountFromGoogle($user_id,$id_token){	       	 		
		$response = file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$id_token);			
		if(!isset($response))
			return false;		
		$json = json_decode($response);
		if($user_id == $json->sub){
			return true;
		}else{
			return false;
		}
    	
    }
    /**
     * Check if user is login to system
     * @param  [type]  $user_id  [description]
     * @param  [type]  $id_token [description]
     * @return boolean           [description]
     */
    function isValidUser($user_id,$id_token){
    	$model = new Session_Model();    	
    	$result = $model->selectWhere('*',"user_id = "."'$user_id'");
    	if(!isset($result)){
    		return false;	
    	}    		
    	if($result[0]['date_created']+3600>time()){
    		return true;
    	}    		
    	return false;
    }
}

