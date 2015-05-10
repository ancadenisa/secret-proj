<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '/../../library/class/Admin.php';
include_once '/../../library/class/User.php';



    $title = $_POST['title'];
    $description = $_POST['description'];
    $visibility = $_POST['visibility'];
    
    $user_id = User::getCurrentUserId($_SESSION['user']['username']);
    
    Admin::addCategory($title, $description, $visibility, $user_id);
    
    //header('location: admin.php');
    


?>

