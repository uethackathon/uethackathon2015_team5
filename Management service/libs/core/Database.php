<?php
// Database Abstract Layer
class Database extends PDO {    
    protected $_result = null;
    public function __construct($db_type,$db_host,$db_name,$db_user,$db_pass) {
        parent::__construct($db_type.':host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
    }
    public function __destruct() {        
    }
    /**
     * insert data into this table     
     * @param String  $data An associative array
     * @Exam: insert(array('col1'=>'val1','col2'=>'val2')...)
     */
    public function insert($data){
        $table = $this->_table;
        ksort($data);        
        $fieldNames = implode(",", array_keys($data));
        $fieldValues = implode("','", array_values($data));        
        $pquery = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ('$fieldValues')");
        return $pquery->execute();
        
    }
    
    /**
     * update table     
     * @param String  $data An associative array
     * @param String  $where the WHERE query part
     * @example  update(array('col1'=>'val1','col2'=>'val2',...),'col1 = 'valX' ')
     * @return int Number of row effected
     */
    public function update($data,$where){
        $table = $this->_table;
        ksort($data);        
        $arrTemp = array();
        foreach($data as $key=>$value){
            $arrTemp[$key] =$key."="."'$value'"; 
        }        
        $fieldValues = implode(",", array_values($arrTemp));                
        $pquery = $this->prepare("UPDATE $table SET $fieldValues WHERE $where");
        $pquery->execute();
        $this->_result = $pquery;
        return $this->getCount();
    }
    /**
     * Select query. Exam: SELECT (col1,col2..) FROM TABLE_NAME
     * @param type $colname array string of column's name which you want to select
     *  if $colname = '*' then perform select all
     * @return An result array
     */    
    public function select($colname){
        $table = $this->_table;
        if ($colname == "*") {
            $arrTemp = $colname;
        } else {
            $arrTemp = implode(",", array_values($colname));
        }
        $pquery = $this->prepare("SELECT $arrTemp FROM $table");
        $pquery->setFetchMode(PDO::FETCH_ASSOC);
        $pquery->execute();
        $this->_result=$pquery;        
        return $pquery->fetchAll();
    }
    /**
     * Select query with condition. 
     * @param type $colname array string of column's name which you want to select
     * @param type $where
     * @return type
     * @example  SELECT (col1,col2..) FROM TABLE_NAME WHERE WHERE_CONDITION
     */
    public function selectWhere($colname,$where){
        $table = $this->_table;
         if ($colname == "*") {
            $arrTemp = $colname;
        } else {
            $arrTemp = implode(",", array_values($colname));
        }        
        $pquery = $this->prepare("SELECT $arrTemp FROM $table WHERE $where");
        $pquery->setFetchMode(PDO::FETCH_ASSOC);
        $pquery->execute();
        $this->_result=$pquery;
        return $pquery->fetch();
    }
    /**
     * Get count
     * @return Number of row effected
     */
    public function getCount() {        
        return $this->_result->rowCount();
    }    
    /**
     * Delete a record from table
     * @param type $where
     * 
     */
    public function delete($where){
        $table = $this->_table;
        $pquery = $this->prepare("DELETE FROM $table WHERE $where");
        return $pquery->execute();         
    }
    public function getList($start,$num,$by){        
        $pquery = $this->prepare("SELECT * FROM $this->_table ORDER BY $by DESC LIMIT $num OFFSET $start");
        $pquery->setFetchMode(PDO::FETCH_ASSOC);
        $pquery->execute();
        return $pquery->fetchAll();
    }
}
    
