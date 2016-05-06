<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author paulgotea
 */

namespace Framework;

class Application
{
    /*
     * Initialize the Controller for the choosed page
     */

    public function run()
    {
        //check if the controller class exists
        if (!self::isControllerValid(Request::get('page'))) {
            echo 'The page does not exist!';
            exit;
        }

        //create the controller path
        $controllerPath = '\controller\\' . ucfirst(Request::get('page'));
        //initialize the controller
        $this->controller = new $controllerPath;

        //check if the choosed method exists. if it doesn', call the default method
        if (!Request::get('action')) {
            call_user_func(array($this->controller, 'show'));
            return;
        }

        //check if the method exists. if not, show an error message
        if (!method_exists($this->controller, Request::get('action'))) {
            echo 'Method does not exist for that page!';
            exit;
        }

        //call the choosed method for the desired controller
        call_user_func_array(array($this->controller, Request::get('action')), array(Request::getData()));
    }

    /*
     * Check if a controller exists
     * @param string $controllerName - name of the controller
     * @return bool 1 if the controoler exists, 0 if not
     */

    public function isControllerValid($controllerName)
    {
        $controllerName = ucfirst($controllerName);

        //class exists
        if (file_exists(BASE_DIR . '/controller/' . $controllerName . '.php')) {
            return 1;
        }

        return 0;
    }

}
