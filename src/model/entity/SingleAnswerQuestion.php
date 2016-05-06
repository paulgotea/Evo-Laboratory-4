<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model\entity;

use model\entity\AbstractQuestion as AbstractQuestion;

/**
 * Description of TextAnswerQuestion
 *
 * @author GPaul
 */
class SingleAnswerQuestion extends AbstractQuestion
{

    private $correctAnswer;

    public function __construct($data)
    {
        $this->id = null;
        $this->type = 'single';
        $this->question = $data['question'];
        $this->answer = $data['answer'];
        $this->correctAnswer = $data['correctAnswer'];
        $this->points = $data['points'];
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getCorrentAnswer()
    {
        return $this->correctAnswer;
    }

    public function checkAnswer($answer)
    {
        if ($this->getCorrentAnswer() != $answer)
            return false;

        return true;
    }

}
