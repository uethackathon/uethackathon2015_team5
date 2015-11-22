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
$route->add('/class_room','class_room');
$route->add('/session','session');

//
$route->run();

