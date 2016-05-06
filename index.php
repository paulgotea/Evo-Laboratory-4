<?php

include_once('src/autoloader.php');
        
// path to app directory
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT'].'/Lab4MVC/src/');
define('BASE_URL', 'http://localhost/Lab4MVC/');

//start the session
session_start();

//start the application front controller
$application = new Framework\Application;
$application->run();
    