<?php
/**
 * 
 */
class Session {

    public static function init(){
        @session_start();
    }
    public static function set($key,$value){
        Session::init();
        $_SESSION[$key] = $value;
    }
    public static function get($key){
        Session::init();
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
    }
    public static function destroy(){
        Session::init();
        session_destroy();
    }

}

