<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include_once 'Connection.php';
 include_once 'Admin.php';
 include_once 'Secrt.php';
 include_once 'Superuser.php';
 
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
    
    public static function debug_to_console($data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
    }
    
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
    
     public static function deleteUserTypeById($id_){
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        echo $user['id'];   
        if($user['is_suser'] != NULL){
            Superuser::deleteUserById($id_);
        }
        else if($user['is_admin'] != NULL){
            Admin::deleteUserById($id_);
        }
        else if($user['is_secrt'] != NULL){
            Secrt::deleteUserById($id_);
        }
        
    }
    
    
    
    public static function deleteUserById($id_){
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'DELETE FROM `user` WHERE `id` = :id_';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_STR);
        $query->execute();
        //TO DO return - in Superuser, Admin, Secrt
    }
    
     public static function getInfo($id_, $column){
        $handler = Connection::getInstance()->getConnection();
        $sql     = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query   = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        //get other info too
        //User::debug_to_console($query);
            if($column == "superuser"){
                if($user['is_suser'] == 1)
                    return "selected";
                else
                    return "";
            }else  if($column == "admin"){
                if($user['is_admin'] == 1)
                    return "selected";
                else
                    return "";
            }else  if($column == "secrt"){
                if($user['is_secrt'] == 1)
                    return "selected";
                else
                    return "";
            }
   
        
        else if($column == "hire_date" || $column == "birth_date" || $column == "name"){
            if($user['is_suser'] != NULL){
                $table = "super_user";
            }else  if($user['is_admin'] != NULL){
                $table = "admin";
            }else  if($user['is_secrt'] != NULL){
                $table =  "secretar";
            }
            
            $sql2     = 'SELECT * FROM `secretar` WHERE `fk_user_id` = :id_';
            $query2   = $handler->prepare($sql2);
            $query2->bindParam(':id_', $id_, PDO::PARAM_STR);
            //$query2->bindParam(':mytable_', $table, PDO::PARAM_STR);
            $query2->execute();
            $user = $query2->fetch(PDO::FETCH_ASSOC);
            
            
        }
        
        return $user[$column];
    }
    public static function editUser($id_, $username, $mail, $password, $user_type, $name, $birthdate, $hiredate){
        //nu se poate schimba tipul unui utilizator -- TO DO
        
    }
    
    public static function insertUser($username_, $mail_, $password_, $user_type_, $name_, $birthdate_, $hiredate_){
        $handler = Connection::getInstance()->getConnection();
        if($user_type_ == 'superuser'){
            $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, 1, NULL, NULL)');
            $query2   = $handler->prepare('INSERT INTO `super_user` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        }else if($user_type_ == 'admin'){
            $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, 1, NULL)');
            $query2   = $handler->prepare('INSERT INTO `admin` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        }else{
            $query   = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, NULL, 1)');
            $query2   = $handler->prepare('INSERT INTO `secretar` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        }
        $query->bindParam(':username', $username_, PDO::PARAM_STR);
        $query->bindParam(':email', $mail_, PDO::PARAM_STR);
        $query->bindParam(':password', $password_, PDO::PARAM_STR);
        $query->execute();
    
        $handler = Connection::getInstance()->getConnection();
        $query   = $handler->prepare('SELECT `id` FROM `user` WHERE `username` = :username');
        $query->bindParam(':username', $username_, PDO::PARAM_STR);
        $query->execute();    
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        $created_at = date('Y-m-d H:m:s');
        $updated_at = date('Y-m-d H:m:s');
        $user_id = $result['id'];
        $handler = Connection::getInstance()->getConnection();
        $query2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query2->bindParam(':name', $name_, PDO::PARAM_STR);
        $query2->bindParam(':birth_date', $birthdate_, PDO::PARAM_STR);
        $query2->bindParam(':hire_date', $hiredate_, PDO::PARAM_STR);
        $query2->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        $query2->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
        $query2->execute();          
    }
     
}
