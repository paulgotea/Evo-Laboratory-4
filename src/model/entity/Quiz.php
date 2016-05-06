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
class Quiz
{

    public $id;
    public $name;
    public $description;
    public $questions;

    public function __construct($data = null)
    {
        $this->id = null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->questions = $data['questions'];
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQuestionNumber()
    {
        return count($this->questions);
    }

    public function getQuestions()
    {
        return $this->questions;
    }

}
