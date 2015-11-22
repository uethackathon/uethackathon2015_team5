
<?php

require 'config.php';
//use an autoloader to load libs folder
function __autoload($class){
    require LIBS.'core/'.$class.'.php';       
}
header('Access-Control-Allow-Origin: *');
require 'app/route.php';
?>
        
