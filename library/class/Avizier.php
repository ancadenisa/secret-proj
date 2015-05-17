<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Avizier
 *
 * @author Anca
 */
include_once 'Connection.php';


class Avizier {

    public static function getAllAviziere() {
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `notice_board`');
        $query->execute();
        $notice_boards = array();
        while ($curr_notice = $query->fetch(PDO::FETCH_ASSOC))
            $notice_boards[] = $curr_notice;
        return $notice_boards;
    }

    public static function insertAvizier($type_, $title_, $desc_) {
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `category` WHERE `name` = :type_');
        $query->bindParam(':type_', $type_, PDO::PARAM_STR);
        $query->execute();
        $category = $query->fetch(PDO::FETCH_ASSOC);

        $query = $handler->prepare('INSERT INTO `notice_board` VALUES(NULL, :id_categ, :title, :desc)');
        $query->bindParam(':id_categ', $category['id'], PDO::PARAM_INT);
        $query->bindParam(':title', $title_, PDO::PARAM_STR);
        $query->bindParam(':desc', $desc_, PDO::PARAM_STR);
        $query->execute();
    }

    public static function getAvizierCatNameById($id_) {
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `category` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $category = $query->fetch(PDO::FETCH_ASSOC);
        return $category['name'];
    }
    
    public static function deleteAvizierById($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('DELETE FROM `notice_board` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
    }
    
    public static function getAvizierByCatId($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `notice_board` WHERE `id_cat` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
    
    public static function getAllPostsByAvizierId($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `post` WHERE `fk_aviz` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
    
    public static function getNumberOfAviziere(){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `notice_board`');
        $query->execute();
        $notice_boards = array();
        while ($curr_notice = $query->fetch(PDO::FETCH_ASSOC))
            $notice_boards[] = $curr_notice;
        return count($notice_boards);
    }

}
