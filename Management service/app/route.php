<?php
/**
 * Routing system
 */
$route = new Route();

$route->add('/',function(){
    echo json_encode("BKSOICT SERVER SERVICE!");
});
// Routing controller

$route->add('/login','login');
$route->add('/logout','logout');
$route->add('/group','group');
$route->add('/notification','notification');
$route->add('/schedule','schedule');
$route->add('/student','student');
$route->add('/user_class','user_class');
$route->add('/user','user');

//
$route->run();

