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
    <title>Light Blue - Admin Template</title>
    <link href="../css/application.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <script src="../lib/jquery/jquery-2.0.3.min.js"> </script>
    <script src="../lib/jquery-pjax/jquery.pjax.js"></script>
    <script src="../lib/backbone/underscore-min.js"></script>
    <script src="../js/settings.js"> </script>
</head>
<body>
<div class="single-widget-container">
    <section class="widget login-widget">
        <header class="text-align-center">
            <h4>Login to your account</h4>
        </header>
        <div class="body">
            <form class="no-margin"
                  action="login.php" method="post" >
                <fieldset>
                    <div class="form-group no-margin">
                        <label for="email" >Username</label>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="eicon-user"></i>
                                </span>
                            <input id="username" type="text" class="form-control input-lg" name="username"
                                   >
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password" >Password</label>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                            <input id="password" type="password" class="form-control input-lg"  name="password"
                                   >
                        </div>

                    </div>
                </fieldset>
                <div class="form-actions">
                    <button type="submit" class="btn btn-block btn-lg btn-danger" name="login">
                        <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                        <small>Sign In</small>
                    </button>
                    <div class="forgot"><a class="forgot" href="#">Forgot Username or Password?</a></div>
                </div>
            </form>
        </div>
        <footer>
            <div class="facebook-login">
                <a href="index.html"><span><i class="fa fa-facebook-square fa-lg"></i> LogIn with Facebook</span></a>
            </div>
        </footer>
    </section>
</div>
</body>
</html>