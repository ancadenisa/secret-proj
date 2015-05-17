<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Anca
 */
include_once 'Connection.php';
class Post {
    protected $id;
    protected $fk_aviz;
    protected $title;
    protected $content;
    protected $created_at;
    protected $updated_at;
    protected $created_by;
    protected $updated_by;
    
    
    function __construct() {
        
    }
    
    function getId() {
        return $this->id;
    }

    function getFk_aviz() {
        return $this->fk_aviz;
    }

    function getTitle() {
        return $this->title;
    }

    function getContinut() {
        return $this->content;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function getCreated_by() {
        return $this->created_by;
    }

    function getUpdated_by() {
        return $this->updated_by;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFk_aviz($fk_aviz) {
        $this->fk_aviz = $fk_aviz;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContinut($continut) {
        $this->content = $continut;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }

    function setCreated_by($created_by) {
        $this->created_by = $created_by;
    }

    function setUpdated_by($updated_by) {
        $this->updated_by = $updated_by;
    }

    public static function getAllPostsByAvizierId($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `post` WHERE `fk_aviz` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $allPosts = array();
        while ($currPost = $query->fetch(PDO::FETCH_ASSOC))
            $allPosts[] = $currPost;
        return $allPosts;
    }    
    public static function getPostById($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `post` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $post = $query->fetch(PDO::FETCH_ASSOC);
        return $post;
    }
    public static function insertPost($title_, $content_, $aviz_id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('INSERT INTO `post` VALUES(NULL, :id_aviz, :title, :content, NULL, NULL, :userId, :userId )');
        $query->bindParam(':id_aviz', $aviz_id_, PDO::PARAM_INT);
        $query->bindParam(':title', $title_, PDO::PARAM_STR);
        $query->bindParam(':content', $content_, PDO::PARAM_STR);
        echo $_SESSION['user']['id'];
        $query->bindParam(':userId', $_SESSION['user']['id'], PDO::PARAM_INT);
        $query->execute();
        
        $sql = 'SELECT `id` FROM `post` WHERE `title` = :title';
        $query = $handler->prepare($sql);
        $query->bindParam(':title', $title_, PDO::PARAM_STR);
        $query->execute();
        $post = $query->fetch(PDO::FETCH_ASSOC);
        return $post['id'];
    }
    
    public static function editPost($title_, $content, $id_){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'UPDATE `post` SET `title` = :title, `content` = :content, `updated_at` = :updated_at, `updated_by` = :updated_by WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->bindParam(':title', $title_, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $date = date('Y-m-d H:m:s');
        $query->bindParam(':updated_at', $date, PDO::PARAM_STR);
        $query->bindParam(':updated_by', $_SESSION['user']['id'], PDO::PARAM_STR);
        $query->execute();      
    }
    
    public static function deletePostById($id_){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('DELETE FROM `post` WHERE `id` = :id_');
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
    }
    
    public static function getNumberOfPosts(){
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `post`');
        $query->execute();
        $posts = array();
        while ($post = $query->fetch(PDO::FETCH_ASSOC))
            $posts[] = $post;
        return count($posts);
    }
}