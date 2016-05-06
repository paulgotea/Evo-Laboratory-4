<?php

/**
 * Get the $_POST and $_GET requests, check them and transform into an easy form
 *
 * @author paulgotea
 */

namespace Framework;

class Request
{
    /*
     * Get the $_GET params and check them
     * @param string $param - the param you want to get from url request
     * @return string - the string from $_GET
     */

    public static function get($param)
    {
        if (isset($_GET[$param]) && !empty($_GET[$param])) {
            return $_GET[$param];
        }
        return false;
    }

    /*
     * Get the $_GET params and check them
     * @return array - the whole data from url request
     */

    public static function getData()
    {
        if (isset($_GET) && !empty($_GET)) {
            return $_GET;
        }
        return false;
    }

    /*
     * Get the $_POST params and check them
     * @param string $param - the param you want to get from url request
     * @return string - the string from $_POST
     */

    public static function post($param)
    {
        if (isset($_POST[$param]) && !empty($_POST[$param])) {
            return $_POST[$param];
        }
        return false;
    }

    /*
     * Get the $_POST params and check them
     * @return string - the string from $_POST
     */

    public static function postData()
    {
        if (isset($_POST) && !empty($_POST)) {
            return $_POST;
        }
        return false;
    }

    /*
     * Check if the whole data from an array exists in another array
     * @param array $array - first array
     * @param array $list - second array
     * @return bool
     */

    public static function checkVars($array, $list = array())
    {
        foreach ($list as $var) {
            if (!isset($array[$var]) || empty($array[$var]))
                return false;
        }
        return true;
    }

}
