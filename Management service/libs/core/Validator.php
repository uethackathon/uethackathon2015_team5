<?php
// Validator Util class
 class Validator {

    public function __construct() {
        
    }    
    /**
     * check data input
     * @param  [type] $data [description]
     * @param  [type] $arg  [description]
     * @return [type]       [description]
     */
    public static function minLength($data, $arg) {
        if ($arg != null)
            if (strlen($data) < $arg) {
                echo json_encode("Your string can only be $arg long";
            }
    }
    /**
     * check data input max
     * @param  [type] $data [description]
     * @param  [type] $arg  [description]
     * @return [type]       [description]
     */
    public static function maxLength($data, $arg) {
        if (strlen($data) < $arg) {
            echo json_encode("Your string can only be $arg long");
        }
    }
    /**
     * Check data input is digit ?
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function digit($data) {
        if (ctype_digit($data)) {
            echo json_encode("Your string must be a digit");
        }
    }    

}
