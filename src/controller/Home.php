<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author paulgotea
 */

namespace controller;

use \model\repository\QuizRepository as QuizRepository;
use model\repository\QuestionRepository as Repository;

class Home extends \Framework\Controller
{

    private $repository;

    public function __construct()
    {
        parent::__construct();
        if (!$this->isLogged()) {
            $this->redirect(BASE_URL . 'index.php?page=auth&action=login');
        }

        $this->repository = new Repository;
    }

    public function show()
    {
        $data['username'] = $this->session->get('username');
        
        $quizRepository = new QuizRepository;
        $data['quizzes'] = $quizRepository->getQuizzes();
        
        $this->renderView('homepage', $data);
    }

}
