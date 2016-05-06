<?php

namespace controller;

use Framework\Request as Request;
use model\entity\Grade as Grade;
use model\repository\QuestionRepository as QuestionRepository;
use model\repository\QuizRepository as QuizRepository;

/**
 * Begin a selected Quiz
 *
 * @author GPaul
 */
class Quiz extends \Framework\Controller
{

    private $quiz;
    private $repository;

    public function __construct()
    {
        $this->repository = new QuizRepository;
    }

    public function startQuiz($params)
    {
        $this->quiz = $this->repository->getQuizByID($params['id']);

        //get the questions
        $questionRepository = new QuestionRepository;
        foreach ($this->quiz->getQuestions() as $questionID) {
            $questions[] = $questionRepository->getQuestionByID($questionID);
        }

        $data['questions'] = $questions;

        $this->renderView('startQuiz', $data);
    }

    public function solveQuiz()
    {

        $grade = new Grade();
        $grade->calculate(Request::postData());

        echo json_encode(
                array(
                    "swal" => array("title" => "<strong class='highlight'>" . $grade->getPoints() . "</strong> points for this Quiz", "text" => "Your results were sent to your email!", "type" => "success", "hideConfirmButton" => true),
                    "redirect" => array("url" => BASE_URL . '/index.php?page=home', 'time' => 3)
                )
        );
    }

}
