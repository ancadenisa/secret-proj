<!DOCTYPE html>

<?php include_once './library/class/Category.php' ;
      include_once './library/class/Theme.php';
    
        $themeType = Theme::getCurrentTheme();
?>

<html>
    <head>
        <title>Light Blue - Admin Template</title>
        
        
        
        <link href="css/application.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="utf-8">
        
    </head>
    <body class="background-<?php if($themeType == 1){echo 'dark';} else {echo 'light';} ?> landing">
        <div class="container">
            <?php 
                                
                              ?>
            <header class="page-header">
                <div class="navbar" id="side-nav">
                    <ul class="nav navbar-nav pull-right navbar-menu hidden-xs">
                        <li class="active">
                            <a href="./index.php">
                                Home
                            </a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Aviziere <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                              <?php 
                               $result = Category::getAllCategories();
                               while($category = $result->fetch(PDO::FETCH_ASSOC)){ 
                              ?>
                            <li><a href="./index.php?page=category&id=<?php echo $category['id'];?> "><?php 
                                    echo $category['name'];
                               }
                                ?></a></li>
                                
                          </ul>
                        </li>
                        <li></li>
                        <li>
                            <a href="./index.php?page=forum">
                                Forum
                            </a>
                        </li>
                        <li>
                            <a href="./index.php?page=contact">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </header>
        </div>
        <div id="about" class="widget widget-normal widget-about">
            <div class="container">
                <?php 
                    if(isset($_GET['page'])){
                        switch($_GET['page']){
                            case 'contact':
                                include_once './public/contact.php';
                                break;
                            case 'forum':
                                include_once './public/forum.php';
                                break;
                            case 'category':
                                include_once './public/category.php';
                                break;
                        }
                    } else {
                        require_once './public/home.php';
                    }
                ?>
            </div>
        </div>
        <h2 class="thanks text-align-center">Thanks for watching!</h2>
        <p class="lead text-align-center"><a class="back-to-top" href="#"> back to top <i class="fa fa-angle-up"></i></a></p>

        <!-- jquery and friends -->
        <script src="lib/jquery/jquery-2.0.3.min.js"> </script>
        <script src="lib/jquery-pjax/jquery.pjax.js"></script>
        
        <!-- bootstrap default plugins -->
        <script src="lib/bootstrap/transition.js"></script>
        <script src="lib/bootstrap/carousel.js"></script>

        <!-- page specific -->
        <script src="js/landing.js"></script>

        <script src="js/bootstrap.js"></script>

    </body>