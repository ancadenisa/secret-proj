<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SuperUser
 *
 * @author radu
 */
include_once 'User.php';

class Superuser{
    protected $user;
    protected $name;
    protected $birth_date;
    protected $hire_date;
    protected $perm;
    
    //NOT TESTED
    public function __construct($user){
        //retine inregistrarea din tabela `user` aferenta acesui superuser
        $this->user = $user;
        
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `user` WHERE `username` = :username';
        $query   = $handler->prepare($sql);
        $query->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->execute();
        $u = $query->fetch(PDO::FETCH_ASSOC);
        
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `super_user` WHERE `fk_user_id` = :id';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id', $u['id'], PDO::PARAM_INT);
        $query->execute();
        $suser = $query->fetch(PDO::FETCH_ASSOC);
        $this->setName($suser['name']);
        //permission set
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name_){
        $this->name = $name_;
    }
    
    public function getPerm(){
        return $this->perm;
    }
    
    public function setPerm($password_){
        $this->perm = $perm_;
    }
    
    public static function deleteUserById($id_){
        echo $id_;
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'DELETE FROM `super_user` WHERE `fk_user_id` = :id_';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        echo $id_;
    }
    
}
