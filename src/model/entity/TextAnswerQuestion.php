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
class TextAnswerQuestion extends AbstractQuestion
{

    public function __construct($data)
    {
        $this->id = null;
        $this->type = 'text';
        $this->question = $data['question'];
        $this->answer = $data['answer'];
        $this->points = $data['points'];
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function checkAnswer($answer)
    {
        if( $this->getAnswer() == $answer )
            return true;
        else
            return false;
    }

}
