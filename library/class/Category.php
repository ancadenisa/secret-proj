<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author radu
 */

include_once 'Connection.php';

class Category {
    
    public static function getAllCategories(){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `category`';
        $query = $handler->prepare($sql);
        $query->execute();
        return $query;
    }
    
    public static function addCategory($title, $description, $user_id){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'INSERT INTO `category` VALUES (NULL, :description, :title,NULL, :updated_at, :created_by, :updated_by)';
        $query = $handler->prepare($sql);
        $updated_at = date('Y-m-d H:m:s');
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
        $query->bindParam(':created_by', $user_id, PDO::PARAM_INT);
        $query->bindParam(':updated_by', $user_id, PDO::PARAM_INT);
        $r =$query->execute();
        return $r;
    }
    
    public static function deleteCategoryById($id_){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'DELETE FROM `category` WHERE `id` = :id';
        $query = $handler->prepare($sql);
        $query->bindParam(':id', $id_, PDO::PARAM_STR);
        $query->execute();
    }
}
