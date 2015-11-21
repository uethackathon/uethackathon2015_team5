<?php

class Authenticate{
    public static function handleLogin(){
        Session::init();
        $logged = Session::get('loggedIn');        
        if($logged ==false){
            Session::destroy();
            header('location: '.URL.'login');
            exit;            
        }        
    }
    /**
     * Chung thuc admin
     */
    public static function adminProtected(){
        $role = Session::get('role');
        if($role != 'admin')
            header('location: '.URL.'home');
    }
}

