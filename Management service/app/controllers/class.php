<?php

class Class extends Controller {

    function __construct($title) {
        parent::__construct($title);
    }
   
    /**
     * Show all resource
     * @return [type] [description]
     */
    function index() {
          $data = $this->model->select('*');
          echo json_encode($data);
    }
    /**
     * Display the specified resource. 
     * @param  [String] $id [description]
     * @return [type]     [description]
     */
    function show($id){
    
    }
    /**
     * Store a newly created resource
     */
    function store($data) {        
        $this->model->insert($data);
        echo json_encode($data);        
    }    
    /**
     * Remove the specified resource 
     * @return [type] [description]
     */
    function detroy($id) {        
        $where = "id = '$id'";
        if($this->model->delete($where)){
        	$r = new HttpRequest(URL.':'.USER_CLASS_MICS_PORT.'delete', HttpRequest::METH_POST);
			$r->setOptions(array('cookies' => array('lang' => 'en')));
			$r->addPostFields(array('data' => '{"class_id":'.$id'}'));		
			try {
			    echo $r->send()->getBody();
			} catch (HttpException $ex) {
			    echo $ex;
			}
        }                
    }

}