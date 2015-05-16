<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author Anca
 */
include_once 'Connection.php';
class Question {
    public static function getAllQuestions(){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `question`');
        $query->execute();
        $allQuestions = array();
        while ($currQuest = $query->fetch(PDO::FETCH_ASSOC))
            $allQuestions[] = $currQuest;
        return $allQuestions;
    }
    
    public static function getQuestionById($id_, $property_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `question` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $question = $query->fetch(PDO::FETCH_ASSOC);
        switch ($property_){
            case "title":
                return $question['title'];
            case "content":
                return $question['content'];
        }
    }
    
    public static function deleteQuestionById($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('DELETE FROM `question` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
    }
    
    public static function setVisible($id_){
        $handler = Connection::getInstance()->getConnection();
        $query2= $handler->prepare('UPDATE `question` SET `visible` = 1 WHERE `id` = :id');
        $query2->bindParam(':id', $id_, PDO::PARAM_INT);
        $query2->execute();
    }
    
    public static function setNotVisible($id_){
        $handler = Connection::getInstance()->getConnection();
        $query2= $handler->prepare('UPDATE `question` SET `visible` = 0 WHERE `id` = :id');
        $query2->bindParam(':id', $id_, PDO::PARAM_INT);
        $query2->execute();
    }
    
    public static function insertQuestion($title_, $content_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('INSERT INTO `question` VALUES(NULL, :title, :content, :false, :false)');
        $false_ = 0;
        $query->bindParam(':title', $title_, PDO::PARAM_STR);
        $query->bindParam(':content', $content_, PDO::PARAM_STR);
        $query->bindParam(':false', $false_, PDO::PARAM_INT);
        $query->bindParam(':false', $false_, PDO::PARAM_INT);
        $query->execute();
    }
}
