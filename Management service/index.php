
<?php

require 'config.php';
require './authenticate.php';    
//use an autoloader to load libs folder
function __autoload($class){
    require LIBS.'core/'.$class.'.php';       
}

require 'app/route.php';
?>
        
