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
$route->add('/group','group');
$route->add('/notification','notification');
$route->add('/schedule','schedule');
$route->add('/student','student');
$route->add('/user_class','user_class');
$route->add('/user','user');

//
$route->run();

