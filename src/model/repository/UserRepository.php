<?php

namespace model\repository;

use model\entity\User as User;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Repository
 *
 * @author paulgotea
 */
class UserRepository
{

    private $table;

    public function __construct()
    {
        $this->table = BASE_DIR . 'database/users.json';
    }

    //decode the database
    public function getTableData()
    {
        $content = file_get_contents($this->table);
        $content = json_decode($content, true);

        return $content;
    }

    public function findUser(User $user)
    {
        $database = $this->getTableData();

        //if database is empty, return false
        if (count($database) == 0)
            return false;

        foreach ($database as $value) {

            if ($value['username'] == $user->getAttr('username') || $value['email'] == $user->getAttr('email')) {
                return new User($value);
                return true;
            }
        }

        return false;
    }

    public function checkLogin(User $user, $password)
    {
        if (password_verify($password, $user->getAttr('password')))
            return true;

        return false;
    }

    public function addUser(User $user)
    {
        $database = $this->getTableData();
        
        $user = $user->serialize();
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        
        array_push($database, $user);
        
        $database = json_encode($database);

        file_put_contents($this->table, $database);
    }

    public function getLastID()
    {
        $database = $this->getTableData();

        return count($database);
    }

    public function getAccessByUsername($username)
    {
        $database = $this->getTableData();

        foreach ($database as $value) {

            if ($value['username'] == $username) {
                return $value['access'];
            }
        }
    }    
    
}
