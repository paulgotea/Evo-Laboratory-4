<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model\entity;

/**
 * Description of TextAnswerQuestion
 *
 * @author GPaul
 */
abstract class AbstractQuestion
{

    protected $id;
    protected $type;
    protected $question;
    protected $answer;
    protected $points;

    public function setID($id)
    {
        $this->id = $id;
    }
    
    public function getID()
    {
        return $this->id;
    }
    public function getType()
    {
        return $this->type;
    }        

    public function getQuestion()
    {
        return $this->question;
    }
    
    public function getPoints()
    {
        return $this->points;
    }
  
}
