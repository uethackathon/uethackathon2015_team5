
<?php

require 'config.php';
require 'Registry.php';

//use an autoloader to load libs folder
function __autoload($class){
    require LIBS.'core/'.$class.'.php';       
}

require 'app/route.php';
//Load the Bootstrap!
//$boostrap = new Bootstrap();
//$boostrap ->init();

//$route = new Route();
//// User define function
//$route->add('/h',function(){
//    echo 'hey this is home page';
//});
//// Routing controller
//$route->add('/login','login');
//
//$route->run();
//Registry
//
//Registry::set($name, $object);
//Registry::get($name, $object);

?>
        
