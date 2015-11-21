<?php
 class Registry{
     /**
      * The instance of the registry     
      */     
    private static $_instance;
    /**
     *   Array of object
     */
    private static $_obj = array();
    
    public function __construct() {}
    
    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new Registry;
        }
        return self::$_instance;
    }
    public static function set($key, $object){      
        self::$_instance->_obj[$key]=$object;         
    }
    public static function get($key){                 
        if(isset(self::$_instance->_obj[$key]))
            return self::$_instance->_obj[$key];
        return NULL;
    }
    
}

