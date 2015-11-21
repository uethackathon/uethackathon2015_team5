<?php
class NotificationModel extends Model {
    protected $_table = 'notification';
    function __construct() {
        parent::__construct();
    }
     /**
     * Show all resource
     * @return [type] [description]
     */
    function index() {
          $data = $this->select('*');
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
        $this->insert($data);
        echo json_encode($data);        
    }    
    /**
     * Remove the specified resource 
     * @return [type] [description]
     */
    function detroy($id) {        
        $where = "id = '$id'";
        $this->delete($where);
        echo "1";
    }
}