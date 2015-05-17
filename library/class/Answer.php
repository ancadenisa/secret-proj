<?php

include_once 'Connection.php';
class Answer {

    public static function insertAnswer($content_, $question_id) {
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('INSERT INTO `answer` VALUES(NULL, :content, :fk_question, NULL, NULL, :userId )');
        $query->bindParam(':fk_question', $question_id, PDO::PARAM_INT);
        $query->bindParam(':content', $content_, PDO::PARAM_STR);
        $query->bindParam(':userId', $_SESSION['user']['id'], PDO::PARAM_INT);
        $query->execute();
        
        $query2= $handler->prepare('UPDATE `question` SET `answered` = 1 WHERE `id` = :fk_question');
        $query2->bindParam(':fk_question', $question_id, PDO::PARAM_INT);
        $query2->execute();
        
        
    }
    
    public static function getAllAnswersByQuestionId($question_id){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `answer` WHERE `fk_question` = :id_');
        $query->bindParam(':id_', $question_id, PDO::PARAM_INT);
        $query->execute();
        $answers = array();
        while ($currAnswer = $query->fetch(PDO::FETCH_ASSOC))
            $answers[] = $currAnswer;
        return $answers;  
    }
    
    public static function getNumberOfAnswers(){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `answer`');
        $query->execute();
        $questions = array();
        while ($question = $query->fetch(PDO::FETCH_ASSOC))
            $questions[] = $question;
        return count($questions);
    }
    
    

}
