<?php

/**
 * This Class contains the Admin page and specific methods for admin
 *
 * @author paulgotea
 */

namespace controller;

use Framework\Request as Request;
use model\entity\Quiz as Quiz;
use model\repository\QuizRepository as QuizRepository;
use model\repository\QuestionRepository as Repository;

class Admin extends \Framework\Controller
{

    private $repository;

    public function __construct()
    {
        //create the session
        parent::__construct();

        //check if the user is admin
        if (!$this->isAdmin()) {
            $this->redirect(BASE_URL . 'index.php?page=home');
        }

        $this->repository = new Repository;
    }

    /*
     * Show the specific view for this page (default method)
     */

    public function show()
    {
        $data['username'] = $this->session->get('username');
        $data['questions'] = $this->repository->getQuestions();

        $this->renderView('admin', $data);
    }

    /*
     * Create the Quiz using the data from Post Request
     */

    public function createQuiz()
    {
        //check if the all fields were filled
        if (!Request::checkVars(Request::postData(), array('name', 'description', 'questions'))) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "Complete all the fields!", "type" => "error")));
            exit;
        }

        //check if the minimum number of questions were choosed
        if (count(Request::post('questions')) < 2) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "Select more Questions!", "type" => "error")));
            exit;
        }

        //create the quiz object
        $quiz = new Quiz(Request::postData());

        //create the quiz repository
        $quizRepository = new QuizRepository;

        //set the quiz ID
        $quiz->setID($quizRepository->getLastID());

        //add the Quiz into DB
        $quizRepository->addQuiz($quiz);

        echo json_encode(
                array(
                    "swal" => array("title" => "Success!", "text" => "Your Quiz has been created!", "type" => "success", "hideConfirmButton" => true),
                    "redirect" => array("url" => BASE_URL . '/index.php?page=admin', 'time' => 2)
                )
        );
    }

    /*
     * Create a Question
     * @param array $params - array that contains URL data
     */

    public function createQuestion($params)
    {

        //check if the all fields were filled
        if (!Request::checkVars(Request::postData(), array('question', 'answer', 'points'))) {
            echo json_encode(array("swal" => array("title" => "Oops!", "text" => "Complete all the fields!", "type" => "error")));
            exit;
        }

        //create the entity path, based on question type
        $entityPath = '\model\entity\\' . ucfirst($params['type']) . 'AnswerQuestion';
        $question = new $entityPath(Request::postData());

        //set the question ID
        $question->setID($this->repository->getLastID());

        //add the question into DB
        $this->repository->addQuestion($question);

        echo json_encode(
                array(
                    "swal" => array("title" => "Success!", "text" => "Your Question has been created!", "type" => "success", "hideConfirmButton" => true),
                    "redirect" => array("url" => BASE_URL . '/index.php?page=admin', 'time' => 2)
                )
        );
    }

}
