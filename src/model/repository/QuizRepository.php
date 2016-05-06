<?php

namespace model\repository;

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
class QuizRepository
{

    private $table;

    public function __construct()
    {
        $this->table = BASE_DIR . 'database/quiz.json';
    }

    //decode the database
    public function getTableData()
    {
        $content = file_get_contents($this->table);
        $content = json_decode($content, true);

        return $content;
    }

    public function addQuiz($quiz)
    {
        $database = $this->getTableData();

        $quiz = serialize($quiz);

        array_push($database, $quiz);

        $database = json_encode($database);

        file_put_contents($this->table, $database);
    }

    public function getLastID()
    {
        $database = $this->getTableData();

        return count($database);
    }
    
    public function getQuizzes()
    {
        $database = $this->getTableData();

        $quizzes = array();

        foreach ($database as $quiz) {
            $quizzes[] = unserialize($quiz);
        }

        return $quizzes;
    }
    
    public function getQuizByID($id)
    {
        $database = $this->getTableData();

        if( !array_key_exists($id, $database) ) {
            //error goes here - 404
            echo 'Oops! This quiz does not exist!';
            exit;
        }
        return unserialize($database[$id]);
    }        

}
