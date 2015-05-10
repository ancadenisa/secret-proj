<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../css/application.min.css" rel="stylesheet">
    </head>
    <body> -->
        <?php
       
            include_once '../../library/class/Theme.php';
        
            $type = $_SESSION['themeType'];
            if(isset($_GET['theme'])){
                if($type == 1){
                    $newType = 2;
                    Theme::changeTheme($newType);
                    $_SESSION['themeType'] = $newType;
                }
                else if($type == 2){
                    $newType = 1;
                    Theme::changeTheme($newType);
                    $_SESSION['themeType'] = $newType;
                }
            }
            header('location: admin.php');
        
        ?>
      
