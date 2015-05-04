<!DOCTYPE html>

<?php 
 
    include_once '/../library/class/User.php';
    include_once '/../library/class/Superuser.php';
    include_once '/../library/class/Admin.php';
    include_once '/../library/class/Secrt.php';
    
    if(isset($_POST['login'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = new User($username, $password);
        
        
        if($user->loginUser() != NULL){;     
            $type = $user->getType();
        
            $_SESSION['user']['is_logged'] = true;
            $_SESSION['user']['username'] = $user->getUsername();
            $_SESSION['user']['password'] = $user->getPassword();
            $_SESSION['user']['type'] = $type;
            
            if($type == 'IS_SUPERUSER'){
                $suser = new Superuser($user);
                header('location: superuser/superuser.php');
                exit;
            }
            else if($type == 'IS_ADMIN'){
                header('location: admin/admin.php');
                exit;
            }
            else if($type == 'IS_SECRETAR'){
                header('location: secretar/secretar.php');
                exit;
            }
        }

    }
            
 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../style/bootstrap/bootstrap.css"">
        <link rel="stylesheet" type="text/css" href="../style/bootstrap/bootstrap-theme.css">
    </head>
    <body>
        <script src="../script/jquery/jquery.js"></script>
        <script src="../script/bootstrap/bootstrap.js"></script>
        <div class="container-fluid">
            <form method="post" action="login.php">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn btn-default">Submit</button>
            </form>
        </div>
    </body>
</html>
