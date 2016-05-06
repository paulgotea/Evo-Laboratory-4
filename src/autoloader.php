<?php
spl_autoload_register(function($class) {
//    echo 'src/' . str_replace('\\', '/', $class) . '.php';
    require_once 'src/' . str_replace('\\', '/', $class) . '.php';
});