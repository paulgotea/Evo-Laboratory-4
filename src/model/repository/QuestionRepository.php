<?php

namespace model\repository;

/**
 * Repository Class for Questions with specific methods in order to manage the questions
 *
 * @author paulgotea
 */
class QuestionRepository
{

    private $table;

    public function __construct()
    {
        $this->table = BASE_DIR . 'database/questions.json';
    }

    /*
     * Get the data from Database
     * return array $content - all data from the content
     */

    public function getTableData()
    {
        $content = file_get_contents($this->table);
        $content = json_decode($content, true);

        return $content;
    }

    /*
     * Add a question into the database
     * @param object $question
     */

    public function addQuestion($question)
    {
        $database = $this->getTableData();

        $question = serialize($question);

        array_push($database, $question);

        $database = json_encode($database);

        file_put_contents($this->table, $database);
    }

    /*
     * Get the last ID from the database
     */

    public function getLastID()
    {
        $database = $this->getTableData();

        return count($database);
    }

    public function getQuestions()
    {
        $database = $this->getTableData();

        $questions = array();

        foreach ($database as $question) {
            $questions[] = unserialize($question);
        }

        return $questions;
    }

    public function getQuestionByID($id)
    {
        $database = $this->getTableData();

        return unserialize($database[$id]);
    }

}
