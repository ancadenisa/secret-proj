<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Theme
 *
 * @author radu
 */

include_once 'Connection.php';

class Theme {
    
    static public function getCurrentTheme(){
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `theme`';
        $query   = $handler->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['type'];
    }
    
    static public function changeTheme($type_){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'UPDATE `theme` SET `type` = :type ';
        $query = $handler->prepare($sql);
        $query->bindParam(':type', $type_, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
}
