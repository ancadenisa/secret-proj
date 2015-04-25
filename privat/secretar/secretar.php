<!DOCTYPE html>
<?php
    
    include_once '../../library/config.php';

    if(isset($_GET['logout'])){
        if(isset($_SESSION['user']['is_logged'])){
            unset($_SESSION['user']['is_logged']);
            unset($_SESSION['user']['username']);
            unset($_SESSION['user']['password']);
            unset($_SESSION['user']['type']);
            header("location: ../login.php");
            exit;
        }
        else {
            header("location: ../login.php");
            exit;
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../../style/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../style/bootstrap/bootstrap-theme.css">
    </head>
    <body>
        <script src="../../script/jquery/jquery.js"></script>
        <script src="../../script/bootstrap/bootstrap.js"></script>
        <h1>Hello SECRETAR!</h1>
        <a href="./secretar.php?logout" type="button" class="btn btn-danger">Logout</a>
    </body>
</html>
