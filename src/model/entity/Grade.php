<?php

namespace model\entity;

use model\entity\TextAnswerQuestion as TextAnswerQuestion;
use model\entity\SingleAnswerQuestion as SingleAnswerQuestion;
use model\entity\MultipleAnswerQuestion as MultipleAnswerQuestion;
use model\repository\QuestionRepository as QuestionRepository;

/**
 * Description of Grade
 *
 * @author GPaul
 */
class Grade
{

    private $points;
    private $repository;

    public function __construct()
    {
        $this->repository = new QuestionRepository;
    }

    public function setPoints($value)
    {
        $this->points = $value;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function calculate($answers)
    {

        $answers = $answers['answer'];
        $points = 0;

        foreach ($answers as $key => $answer) {
            $questions[] = $this->repository->getQuestionByID($key);
        }

        foreach ($questions as $question) {
            if ($question->checkAnswer($answers[$question->getID()])) {
                $points += $question->getPoints();
            }
        }

        self::setPoints($points);
    }

}
