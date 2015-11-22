<?php
//Base controller
abstract class Controller {

    function __construct($title) {

    }       
    /**
     * 
     */
    abstract function index();
    /**
     * 
     * @param type $name Name of the model
     * @param string $path Location of the model
     */
    public function loadModel($name, $modelPath){
        $path = $modelPath.$name.'_model.php';       
        if(file_exists($path)){
            require $path;
            $modelName = $name.'_Model';
            $this->model = new $modelName();
        }
    }
}
