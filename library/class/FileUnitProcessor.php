<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileUnitProcessor
 *
 * @author radu
 */

include_once 'Connection.php';

class FileUnitProcessor {
    
    public static function getAllFilesFromPostById($id_){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `file` A INNER JOIN `file_post` B ON A.id = B.id_file WHERE B.id_post = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
}
