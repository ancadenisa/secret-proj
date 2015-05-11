<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permission
 *
 * @author Anca
 */
class Permission {
    //put your code here
    protected $id;
    protected $add_aviz = 0;
    protected $del_aviz = 0;
    protected $add_categ_aviz = 0;
    protected $del_categ_aviz = 0;
    protected $modify_theme = 0;
    protected $users_alter = 0;
    protected $forum_answer = 0;
    protected $edit_aviz = 0;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getAdd_aviz() {
        return $this->add_aviz;
    }

    public function getDel_aviz() {
        return $this->del_aviz;
    }

    public function getAdd_categ_aviz() {
        return $this->add_categ_aviz;
    }

    public function getDel_categ_aviz() {
        return $this->del_categ_aviz;
    }

    public function getModify_theme() {
        return $this->modify_theme;
    }

    public function getUsers_alter() {
        return $this->users_alter;
    }

    public function getForum_answer() {
        return $this->forum_answer;
    }

    public function getEdit_aviz() {
        return $this->edit_aviz;
    }

    public function setAdd_aviz($add_aviz) {
        $this->add_aviz = $add_aviz;
        return $this;
    }

    public function setDel_aviz($del_aviz) {
        $this->del_aviz = $del_aviz;
        return $this;
    }

    public function setAdd_categ_aviz($add_categ_aviz) {
        $this->add_categ_aviz = $add_categ_aviz;
        return $this;
    }

    public function setDel_categ_aviz($del_categ_aviz) {
        $this->del_categ_aviz = $del_categ_aviz;
        return $this;
    }

    public function setModify_theme($modify_theme) {
        $this->modify_theme = $modify_theme;
        return $this;
    }

    public function setUsers_alter($users_alter) {
        $this->users_alter = $users_alter;
        return $this;
    }

    public function setForum_answer($forum_answer) {
        $this->forum_answer = $forum_answer;
        return $this;
    }

    public function setEdit_aviz($edit_aviz) {
        $this->edit_aviz = $edit_aviz;
        return $this;
    }

    public function getPermissionId(){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `permission` WHERE `add_aviz` = :add_aviz AND `add_categ_aviz`= :add_categ_aviz
                AND `del_aviz` = :del_aviz AND `del_categ_aviz` = :del_categ_aviz AND `modify_theme` = :modify_theme
                AND `users_alter` = :users_alter AND `forum_answer` = :forum_answer AND `edit_aviz` = :edit_aviz';
        $query = $handler->prepare($sql);
        $query->bindParam(':add_aviz', $this->add_aviz, PDO::PARAM_INT);
        $query->bindParam(':add_categ_aviz', $this->add_categ_aviz, PDO::PARAM_INT);
        $query->bindParam(':del_aviz', $this->del_aviz, PDO::PARAM_INT);
        $query->bindParam(':del_categ_aviz', $this->del_categ_aviz, PDO::PARAM_INT);
        $query->bindParam(':modify_theme', $this->modify_theme, PDO::PARAM_INT);
        $query->bindParam(':users_alter', $this->users_alter, PDO::PARAM_INT);
        $query->bindParam(':forum_answer', $this->forum_answer, PDO::PARAM_INT);
        $query->bindParam(':edit_aviz', $this->edit_aviz, PDO::PARAM_INT);
        $query->execute();
        $perm = $query->fetch(PDO::FETCH_ASSOC);
        if($perm == NULL){
            return NULL;
        }
        return $perm['id'];
    }
    public function insertPermissionToDB(){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'INSERT INTO `permission` (`add_aviz`, `add_categ_aviz`, `del_aviz`, `del_categ_aviz`, `modify_theme`, `users_alter`, `forum_answer`, `edit_aviz`) 
                VALUES(:add_aviz, :add_categ_aviz, :del_aviz, :del_categ_aviz, :modify_theme, :users_alter, :forum_answer, :edit_aviz )';                
        $query = $handler->prepare($sql);
        $query->bindParam(':add_aviz', $this->add_aviz, PDO::PARAM_INT);
        $query->bindParam(':add_categ_aviz', $this->add_categ_aviz, PDO::PARAM_INT);
        $query->bindParam(':del_aviz', $this->del_aviz, PDO::PARAM_INT);
        $query->bindParam(':del_categ_aviz', $this->del_categ_aviz, PDO::PARAM_INT);
        $query->bindParam(':modify_theme', $this->modify_theme, PDO::PARAM_INT);
        $query->bindParam(':users_alter', $this->users_alter, PDO::PARAM_INT);
        $query->bindParam(':forum_answer', $this->forum_answer, PDO::PARAM_INT);
        $query->bindParam(':edit_aviz', $this->edit_aviz, PDO::PARAM_INT);
        $query->execute();
    }
    
    public function addThisPermisssionToCurrentUser($userid_){
        $handler = Connection::getInstance()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE `id` = :userid_';
        $query = $handler->prepare($sql);
        $query->bindParam(':userid_', $userid_, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);       
        if ($user['is_suser'] != NULL) {
            $sql2 = 'UPDATE super_user SET `fk_permission` = :permissionid_ WHERE `fk_user_id` = :id_';
        } else if ($user['is_admin'] != NULL) {
            $sql2 = 'UPDATE admin SET `fk_permission` = :permissionid_ WHERE `fk_user_id` = :id_';
        } else if ($user['is_secrt'] != NULL) {
            $sql2 = 'UPDATE secretar SET `fk_permission` = :permissionid_ WHERE `fk_user_id` = :id_';
        }
        $query2 = $handler->prepare($sql2);
        $query2->bindParam(':id_', $userid_, PDO::PARAM_INT);
        $query2->bindParam(':permissionid_', $this->getId(), PDO::PARAM_INT);
        $query2->execute();
    }
}
