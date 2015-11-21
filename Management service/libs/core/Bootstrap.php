<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_controllerPath = 'controllers/';
    private $_modelPath = 'models/';
    private $_errorFile = 'error.php';
    private $_defaultFile = 'home.php';

    /**
     *  Start the Bootstrap
     * @return boolean
     */
    public function init() {
        //Sets the protected $_url
        $this->_getUrl();
        //Load the default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return FALSE;
        }
        $this->_loadExistingController();
        $this->_callControllerMethod();
    }

    public function setControllerPath($path) {
        $this->_controllerPath = $path.'/';
    }

    public function setModelPath($path) {
        $this->_modelPath = $path.'/';
    }
    /**
     * (Optional) Set a custom path to the error file
     * @param type $fileName
     */
    public function setErrorFile($fileName) {
        $this->_errorFile = $fileName;
    }
    /**
     * (Optional) Set a custom path to the error file
     * @param type $fileName
     */
    public function setDefaultFile($fileName) {
        $this->_defaultFile = $fileName;
    }

    /**
     * 
     */
    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    /**
     * This load if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath.$this->_defaultFile;
        $this->_controller= new Home('home');
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there is a GET parameter passed
     */
    private function _loadExistingController() {
        $file = $this->_controllerPath. $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        $this->_controller= new $this->_url[0]($this->_url[0]);
        echo $this->_url[0];
            $this->_controller->loadModel($this->_url[0],$this->_modelPath);
        } else {
            $this->_error();
            return FALSE;
        }
    }

    /**
     * If a method is passed in the GET url parameter
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
     * Display an error page
     * @return boolean
     */
    private function _error() {
        require $this->_controllerPath.$this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->index();
        exit();
        return FALSE;
    }
    
}
