<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Anca
 */
class Admin{
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
        $query->bindParam(':username', $this->user->getUsername(), PDO::PARAM_STR);
        $query->execute();
        $user = $user->fetch(PDO::FETCH_ASSOC);
        
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `admin` WHERE `fk_user_id` = :id';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id', $this->user->$user['id'], PDO::PARAM_STR);
        $query->execute();
        $suser = $suser->fetch(PDO::FETCH_ASSOC);
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
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'DELETE FROM `admin` WHERE `fk_user_id` = :id_';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_STR);
        $query->execute();
    }
}
