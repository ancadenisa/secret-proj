<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
    include_once 'library/class/User.php';
    include_once 'library/class/Connection.php';
    
    /*
     * SUPER-USER - RADU
     */
    /*
    $password = md5('parola');
    $username = 'radu';
    $email = 'radu@mail.com';
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, 1, NULL, NULL)');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('SELECT `id` FROM `user` WHERE `username` = :username');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $name = 'Radu Baloiu';
    $birth_date = "1993-02-19";
    $hire_date = "2009-04-01";
    $created_at = date('Y-m-d H:m:s');
    $updated_at = date('Y-m-d H:m:s');
    $user_id = $result['id'];
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `super_user` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':birth_date', $birth_date, PDO::PARAM_STR);
    $query->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
    $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
    $query->execute();*/
    
    /*
     * ADMIN - ANCA
     */
    
    /*
    $username = 'anca';
    $email = 'anca@mail.com';
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, 1, NULL)');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('SELECT `id` FROM `user` WHERE `username` = :username');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $name = 'Anca Barbu';
    $birth_date = "1993-11-11";
    $hire_date = "2012-08-14";
    $created_at = date('Y-m-d H:m:s');
    $updated_at = date('Y-m-d H:m:s');
    $user_id = $result['id'];
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `admin` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':birth_date', $birth_date, PDO::PARAM_STR);
    $query->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
    $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
    $query->execute(); */
   
    /*
     * SECRETAR - MIHAI
     */
    
    /*
    $username = 'mihai';
    $email = 'mihai@mail.com';
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, NULL, 1)');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute(); 
    
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('SELECT `id` FROM `user` WHERE `username` = :username');
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $name = 'Mihai Stefanescu';
    $birth_date = "1992-11-05";
    $hire_date = "2014-07-25";
    $created_at = date('Y-m-d H:m:s');
    $updated_at = date('Y-m-d H:m:s');
    $user_id = $result['id'];
    $handler = Connection::getInstance()->getConnection();
    $query   = $handler->prepare('INSERT INTO `secretar` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':birth_date', $birth_date, PDO::PARAM_STR);
    $query->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
    $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
    $query->execute(); */
    
    
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style/bootstrap/bootstrap.css"">
        <link rel="stylesheet" type="text/css" href="style/bootstrap/bootstrap-theme.css">
    </head>
    <body>
        <script src="script/jquery/jquery.js"></script>
        <script src="script/bootstrap/bootstrap.js"></script>
        
        
    </body>
</html>
