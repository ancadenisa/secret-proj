<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include_once 'Connection.php';
 //include_once 'config.php';

/**
 * Description of User
 *
 * @author radu
 */
class User {
    
    protected $username;
    protected $password;
    protected $type;
    
    /**
     * 
     */
    public function __construct($username_, $password_){
        $this->username = $username_;
        $this->password = md5($password_);
        $this->type = NULL;
    }
    
    private function checkUser(){
        $handler = Connection::getInstance()->getConnection();
        $username = $this->username;
        $sql     = 'SELECT * FROM `user` WHERE `username` = :username';
        $query   = $handler->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }
    
    public function loginUser(){
        if ($user = $this->checkUser()) {
            $user = $user->fetch(PDO::FETCH_ASSOC);
            if ($user['password'] == $this->password){
                if($user['is_suser'] != NULL){
                    $this->type = 'IS_SUPERUSER';
                }
                else if($user['is_admin'] != NULL){
                    $this->type = 'IS_ADMIN';
                }
                else if($user['is_secrt'] != NULL){
                    $this->type = 'IS_SECRETAR';
                }
                return $user;
            }
            else {
                return null;
            }
        }
        else {
            return null;
        }
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setUsername($username_){
        $this->username = $username_;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password_){
        $this->password = $password_;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public static function getAllUsers(){
        $handler = Connection::getInstance()->getConnection();
        $query   = $handler->prepare('SELECT * FROM `user`');
        $query->execute();
        $allUsers = array();
        while($currUser = $query->fetch(PDO::FETCH_ASSOC))
            $allUsers[] = $currUser;
        return $allUsers;
    }
     
}
