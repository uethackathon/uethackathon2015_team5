<?php
//Base model
class Model extends Database {
    protected $_model;
    protected $_table=null;
    function __construct() {
        //construct and connect PDO
        parent::__construct(DB_TYPE,DB_HOST,DB_NAME,DB_USER,DB_PASS);
        $this->_model = get_class($this);
        if($this->_table==null)
            $this->_table = strtolower($this->_model)."s";
    
    }
    
}
