<?php

namespace controller;

use model\entity\User as User;
use model\repository\UserRepository as Repository;
use Framework\Request as Request;

/**
 * Manage the Authentification
 *
 * @author paulgotea
 */
class Auth extends \Framework\Controller
{

    private $repository;

    public function __construct()
    {

        //check if the user is logged
        if ($this->isLogged() && Request::get('action') != 'logout') {
            $this->redirect(BASE_URL . 'index.php?page=home');
        }

        parent::__construct(); //for session instance
        //epository object
        $this->repository = new Repository;
    }

    /*
     * Load the view for login 
     */

    public function login()
    {
        $this->renderView('login');
    }

    /*
     * Load the view for register
     */

    public function register()
    {
        $this->renderView('register');
    }

    /*
     * Login the user
     */

    public function doLogin()
    {

        //check if all the fields were filled
        if (!Request::checkVars(Request::postData(), array('username', 'password'))) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "Complete all the fields!", "type" => "error")));
            exit;
        }

        //create the user entity with the spcific login data
        $userEntity = new User(array('username' => Request::post('username'), 'password' => Request::post('password'), 'email' => null, 'name' => null));

        //check if the user exists and get it as entity if exists
        if (!$userEntity = $this->repository->findUser($userEntity)) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "The username does not exist!", "type" => "error")));
            exit;
        }

        //get the user ID from database
        $userEntity->setAttr('access', $this->repository->getAccessByUsername(Request::post('username')));

        //check if the login credentials are correct for login
        if (!$this->repository->checkLogin($userEntity, Request::post('password'))) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "The user/email is incorrect!", "type" => "error")));
            exit;
        }

        $userEntity->setAttr('access', $this->repository->getAccessByUsername(Request::post('username')));

        //set the session using the user data
        $this->session->setSession($userEntity);

        echo json_encode(
                array(
                    "swal" => array("title" => "Success!", "text" => "You successfully logged in!", "type" => "success", "hideConfirmButton" => true),
                    "redirect" => array("url" => BASE_URL . '/index.php?page=home', 'time' => 1)
                )
        );
    }

    /*
     * Register the user - safe the data into DB
     */

    public function doRegister()
    {

        //check if all the fields are filled
        if (!Request::checkVars(Request::postData(), array('username', 'password'))) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "Complete all the fields!", "type" => "error")));
            exit;
        }

        //create the user entity based on filled data
        $userEntity = new User(Request::postData());

        //check if the user exists and get it as entity if exists
        if ($this->repository->findUser($userEntity)) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "The username/email already exists!", "type" => "error")));
            exit;
        }

        //add the user into DB
        $this->repository->addUser($userEntity);

        echo json_encode(
                array(
                    "swal" => array("title" => "Success!", "text" => "Your account has been created!", "type" => "success", "hideConfirmButton" => true),
                    "redirect" => array("url" => BASE_URL . '/index.php?page=home', 'time' => 1)
                )
        );
    }

    /*
     * Logout the user - destroy the session
     */

    public function logout()
    {
        session_destroy();
        $this->redirect(BASE_URL . 'index.php?page=home');
    }

}
