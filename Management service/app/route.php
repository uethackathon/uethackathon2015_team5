<?php
/**
 * Routing system
 */
$route = new Route();
// User define function
$route->add('/h',function(){
    echo 'hey this is home page';
});
$route->add('/logout',function(){    
    Session::destroy();
    header('location: '.URL."home");
});
// Routing controller

$route->add('/login','login');

//
$route->run();

