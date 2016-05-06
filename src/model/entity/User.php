<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model\entity;

/**
 * Description of UserHelper
 *
 * @author paulgotea
 */
class User
{

    private $email;
    private $username;
    private $name;
    private $password;
    private $access;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->name = $data['name'];
        $this->password = $data['password'];
        $this->access = '1';
    }

    public function getAttr($attribute)
    {
        return $this->$attribute;
    }

    public function setAttr($attribute, $value)
    {
        return $this->$attribute = $value;
    }

    public function isAdmin()
    {
        if ($this->access == 2)
            return true;

        return false;
    }

    public static function getAttributes()
    {
        return array(
            'email',
            'username',
            'name',
            'password',
            'access'
        );
    }

    public function serialize()
    {
        return array_combine(self::getAttributes(), array(
            $this->email,            
            $this->username,
            $this->name,
            $this->password,
            $this->access,
        ));
    }

}
