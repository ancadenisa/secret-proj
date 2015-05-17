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
    
}
