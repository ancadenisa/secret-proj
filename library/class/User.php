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
include_once 'RightsConst.php';

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
        if (is_array($data) || is_object($data)) {
            echo("<script>console.log('PHP: " . json_encode($data) . "');</script>");
        } else {
            echo("<script>console.log('PHP: " . $data . "');</script>");
        }
    }

    /**
     * 
     */
    public function __construct($username_, $password_) {
        $this->username = $username_;
        $this->password = md5($password_);
        $this->type = NULL;
    }

    private function checkUser() {
        $handler = Connection::getInstance()->getConnection();
        $username = $this->username;
        $sql = 'SELECT * FROM `user` WHERE `username` = :username';
        $query = $handler->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();       
        $user = $query->fetch(PDO::FETCH_ASSOC);
        var_dump($user);
        return $user;
    }

    public function loginUser() {
        var_dump($this->checkUser());
        if ($user = $this->checkUser()) {
            //var_dump($user);
            //$user = $user->fetch(PDO::FETCH_ASSOC);
            //var_dump($user);
            if ($user['password'] == $this->password) {
                if ($user['is_suser'] != NULL) {
                    $this->type = 'IS_SUPERUSER';
                } else if ($user['is_admin'] != NULL) {
                    $this->type = 'IS_ADMIN';
                } else if ($user['is_secrt'] != NULL) {
                    $this->type = 'IS_SECRETAR';
                }
                return $user;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username_) {
        $this->username = $username_;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password_) {
        $this->password = $password_;
    }

    public function getType() {
        return $this->type;
    }

    public static function getAllUsers() {
        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `user`');
        $query->execute();
        $allUsers = array();
        while ($currUser = $query->fetch(PDO::FETCH_ASSOC))
            $allUsers[] = $currUser;
        return $allUsers;
    }

    public static function deleteUserTypeById($id_) {
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user['is_suser'] != NULL) {
            Superuser::deleteUserById($id_);
        } else if ($user['is_admin'] != NULL) {
            Admin::deleteUserById($id_);
        } else if ($user['is_secrt'] != NULL) {
            Secrt::deleteUserById($id_);
        }
    }

    public static function deleteUserById($id_) {
        $handler = Connection::getInstance()->getConnection();
        $sql = 'DELETE FROM `user` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        //TO DO return - in Superuser, Admin, Secrt
    }

    public static function getInfo($id_, $column) {
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        //get other info too
        //User::debug_to_console($query);
        if ($column == "superuser") {
            if ($user['is_suser'] == 1)
                return "selected";
            else
                return "";
        }else if ($column == "admin") {
            if ($user['is_admin'] == 1)
                return "selected";
            else
                return "";
        }else if ($column == "secrt") {
            if ($user['is_secrt'] == 1)
                return "selected";
            else
                return "";
        }


        else if ($column == "hire_date" || $column == "birth_date" || $column == "name") {
            if ($user['is_suser'] != NULL) {
                $table = "super_user";
                $sql2 = 'SELECT * FROM `super_user` WHERE `fk_user_id` = :id_';
            } else if ($user['is_admin'] != NULL) {
                $table = "admin";
                $sql2 = 'SELECT * FROM `admin` WHERE `fk_user_id` = :id_';
            } else if ($user['is_secrt'] != NULL) {
                $table = "secretar";
                $sql2 = 'SELECT * FROM `secretar` WHERE `fk_user_id` = :id_';
            }


            $query2 = $handler->prepare($sql2);
            $query2->bindParam(':id_', $id_, PDO::PARAM_INT);
            $query2->execute();
            $user = $query2->fetch(PDO::FETCH_ASSOC);
        }

        return $user[$column];
    }

    public static function editUser($id_, $username, $mail, $password, $name, $birthdate, $hiredate) {
        
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);        
        if ($user['is_suser'] != NULL) {
            $sql2 = 'SELECT * FROM `super_user` WHERE `fk_user_id` = :id_';
            $sql4 = 'UPDATE super_user SET `name` = :name_, `birth_date` = :birthdate_, `hire_date` = :hiredate_ WHERE `id` =:userid';
        } else if ($user['is_admin'] != NULL) {
            $sql2 = 'SELECT * FROM `admin` WHERE `fk_user_id` = :id_';
            $sql4 = 'UPDATE admin SET `name` = :name_, `birth_date` = :birthdate_, `hire_date` = :hiredate_ WHERE `id` =:userid';
        } else if ($user['is_secrt'] != NULL) {
            $sql2 = 'SELECT * FROM `secretar` WHERE `fk_user_id` = :id_';
            $sql4 = 'UPDATE secretar SET `name` = :name_, `birth_date` = :birthdate_, `hire_date` = :hiredate_ WHERE `id` =:userid';
        }
        $query2 = $handler->prepare($sql2);
        $query2->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query2->execute();
        $user2 = $query2->fetch(PDO::FETCH_ASSOC);     
        
        //update
        $sql3 = 'UPDATE user SET `username` = :username_, `email` = :mail_, `password` = :password_ WHERE `id` =:id_';
        $query3 = $handler->prepare($sql3);
        $query3->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query3->bindParam(':mail_', $mail, PDO::PARAM_STR);
        $query3->bindParam(':password_', md5($password), PDO::PARAM_STR);
        $query3->bindParam(':username_', $username, PDO::PARAM_STR);        
        $query3->execute();
        
        //update user details        
        $query4 = $handler->prepare($sql4);
        $query4->bindParam(':name_', $name, PDO::PARAM_STR);
        $query4->bindParam(':birthdate_', $birthdate, PDO::PARAM_STR);
        $query4->bindParam(':hiredate_', $hiredate, PDO::PARAM_STR);
        $query4->bindParam(':userid', $user2['id'], PDO::PARAM_INT);        
        $query4->execute();
 
    }

    public static function insertUser($username_, $mail_, $password_, $user_type_, $name_, $birthdate_, $hiredate_) {
        $handler = Connection::getInstance()->getConnection();
        if ($user_type_ == 'superuser') {
            $query = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, :one, NULL, NULL)');
            $query2 = $handler->prepare('INSERT INTO `super_user` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        } else if ($user_type_ == 'admin') {
            $query = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, :one, NULL)');
            $query2 = $handler->prepare('INSERT INTO `admin` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        } else {
            $query = $handler->prepare('INSERT INTO `user` VALUES (NULL, :username, :email, :password, NULL, NULL, :one)');
            $query2 = $handler->prepare('INSERT INTO `secretar` VALUES (NULL, :user_id, :name, :birth_date, :hire_date, 1, :created_at, :updated_at)');
        }
        $query->bindParam(':username', $username_, PDO::PARAM_STR);
        $query->bindParam(':email', $mail_, PDO::PARAM_STR);
        $query->bindParam(':password', md5($password_), PDO::PARAM_STR);
        $query->bindParam(':one', md5($password_), PDO::PARAM_INT);
        $query->execute();

        $handler = Connection::getInstance()->getConnection();
        $query = $handler->prepare('SELECT * FROM `user` WHERE `username` = :username');
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

    public static function getUserRights($id_) {
        $permissions = array();
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user['is_suser'] != NULL) {
            $table = "super_user";
            $sql2 = 'SELECT * FROM `super_user` WHERE `fk_user_id` = :id_';
        } else if ($user['is_admin'] != NULL) {
            $table = "admin";
            $sql2 = 'SELECT * FROM `admin` WHERE `fk_user_id` = :id_';
        } else if ($user['is_secrt'] != NULL) {
            $table = "secretar";
            $sql2 = 'SELECT * FROM `secretar` WHERE `fk_user_id` = :id_';
        }


        $query2 = $handler->prepare($sql2);
        $query2->bindParam(':id_', $id_, PDO::PARAM_INT);
        $query2->execute();
        $user = $query2->fetch(PDO::FETCH_ASSOC);

        $sql = 'SELECT * FROM `permission` WHERE `id` = :id_';
        $query = $handler->prepare($sql);
        $query->bindParam(':id_', $user['fk_permission'], PDO::PARAM_INT);
        $query->execute();
        $permission = $query->fetch(PDO::FETCH_ASSOC);

        if ($permission['add_aviz'] == 1) {
            $permissions[] = RightsConst::add_aviz;
        }
        if ($permission['del_aviz'] == 1) {
            $permissions[] = RightsConst::del_aviz;
        }
        if ($permission['add_categ_aviz'] == 1) {
            $permissions[] = RightsConst::add_categ_aviz;
        }
        if ($permission['del_categ_aviz'] == 1) {
            $permissions[] = RightsConst::delete_categ_aviz;
        }
        if ($permission['modify_theme'] == 1) {
            $permissions[] = RightsConst::modify_theme;
        }
        if ($permission['users_alter'] == 1) {
            $permissions[] = RightsConst::users_alter;
        }
        if ($permission['forum_answer'] == 1) {
            $permissions[] = RightsConst::forum_answer;
        }
        if ($permission['edit_aviz'] == 1) {
            $permissions[] = RightsConst::edit_aviz;
        }
        return $permissions;
    }
    
    public static function getCurrentUserId($username){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `username` = :username';
        $query = $handler->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

}
