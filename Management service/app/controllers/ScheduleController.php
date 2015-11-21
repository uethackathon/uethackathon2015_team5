<?php

class ScheduleController extends Controller {

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
        $this->model->delete($where);
        echo "1";
    }

}
