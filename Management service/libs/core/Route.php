<?php
/**
 * Routing system
 */
class Route {

    private $_urlList = array();    // url which you add 
    private $_url = array();        // GET['url']
    private $_method = array();     // method come with url    
    private $_controller = null;
    private $_controllerPath = 'app/controllers/';
    private $_modelPath = 'app/models/';
    private $_errorFile = 'error.php';
    private $_defaultFile = 'home.php';
    
    /**
     * add new url into Routing system
     * @param type $url
     * @param type $method
     */
    public function add($url,$method = null){
        $this->_urlList[] = trim($url,'/');
        if($method!=null){
            $this->_method[] = $method;
        }
    }
    /**
     * Make Routing system run
     * @return boolean
     */
    public function run(){
        //Sets the protected $_url
        $this->_getUrl();
        //Load the default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return FALSE;
        }
        foreach($this->_urlList as $key =>$value){
            if($value==null) 
                continue;
            if(preg_match("#^$value$#", $this->_url[0])){
                if(is_string($this->_method[$key])&&$this->_loadExistingController($this->_method[$key]))
                {
                    $this->_callControllerMethod();                    
                }
                else  
                    $this->_callUserFunction ($key);
                break;            
            }               
        }        
    }
     /**
     * This load if there is no GET parameter passed
     */
    private function _loadDefaultController() {        
        //require $this->_controllerPath.$this->_defaultFile;
        //$this->_controller= new Home('home');
        //$this->_controller->loadModel('home',$this->_modelPath);
        //$this->_controller->index();
        echo json_encode('hello');
    }

    /**
     * Load an existing controller if there is a GET parameter passed
     * @param type $name
     */
    private function _loadExistingController($name) {
        $file = $this->_controllerPath.$name.'.php';
        if (file_exists($file)) {
            require $file;
            $this->_controller= new $name($name);
            $this->_controller->loadModel($name,$this->_modelPath);
            return TRUE;
        } else {            
            return FALSE;
        }
    }

    /**
     * If a method is passed in the GET url parameter
     * Then call it method
     */
    private function _callControllerMethod() {
        // http://localhost/controller/method/(param)/(param)/(param)
        // url[0] = Controller
        // url[1] = Method
        // url[2] = Param
        // url[3] = Param
        // url[4] = Param
        //
        $length = count($this->_url);

        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1]))
                $this->_error();
        }
        switch ($length) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                //Controller->Method(Param1)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}(); //action()
                break;
            case 1:
                $this->_controller->index();
                break;
            default:
                $this->_error();
                break;
        }
    }
    /**
     * Get url from $_GET
     */
    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }
    /**
     * Call user define function
     * @param type $key
     */
    public function _callUserFunction($key){
        if(is_string($this->_method[$key])){
                    $method = $this->_method[$key];
                    new $method();
        }else
                {
                    call_user_func($this->_method[$key]);                    
                }
    }
    /**
     * 
     * @return boolean
     */
    private function _error() {
        //require $this->_controllerPath.$this->_errorFile;
        //$this->_controller = new Error();
        //$this->_controller->index();
        echo json_encode(['error'=>'404 Not Found!']);
        exit();
        return FALSE;
    }
}

