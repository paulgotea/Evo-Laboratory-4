<?php

namespace Framework;

use Framework\sessionInstance as Session;

/**
 * A Class that contains common methods and attributes used by all controllers
 *
 * @author paulgotea
 */
abstract class Controller
{

    protected $session;

    public function __construct()
    {
        $this->session = new Session;
    }

    /*
     * Show the view template for choosed page (controller) with specific data 
     * @param string $viewName - the view
     * @param array $data - specific data used in view
     */

    public function renderView($viewName, $data = array())
    {
        extract($data);
        //setup the choosed view path
        $viewPath = BASE_DIR . '/view/' . $viewName . '.phtml';
        //setup the header view path
        $headerPath = BASE_DIR . '/view/header.phtml';
        //setup the footer view path
        $footerPath = BASE_DIR . '/view/footer.phtml';

        //check if the choosed view exists
        if (!file_exists($viewPath)) {
            //404 error goes here
            echo 'This view does not exist!';
            exit;
        }

        //use the data files into the view 
        ob_start();
        require_once($headerPath);
        require_once($viewPath);
        require_once($footerPath);
        ob_end_flush();
    }

    /*
     * Check if a user is logged (has the session saved in the browser)
     * @return bool - true if is logged, false if not
     */

    public static function isLogged()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    /*
     * Check if a user is admin (has the session access value 2)
     * @return bool - true if is logged, false if not
     */

    public static function isAdmin()
    {
        if (!self::isLogged())
            return false;

        if ($_SESSION['user']['access'] == 2) {
            return true;
        }

        return false;
    }

    /*
     * Redirect a user to a choosed URL
     * @param string $url - the url where you want to redirect the user
     */

    public function redirect($url)
    {
        //check if the headers were sent, if not, use the PHP header for redirect
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit();
        }

        //use the JS redirect
        echo('<script type="text/javascript">window.location="' . $url . '"</script>');
        exit;
    }

}
