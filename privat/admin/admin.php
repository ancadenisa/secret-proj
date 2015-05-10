<!DOCTYPE html>
<?php
include_once '../../library/class/User.php';

if (isset($_GET['logout'])) {
    if (isset($_SESSION['user']['is_logged'])) {
        unset($_SESSION['user']['is_logged']);
        unset($_SESSION['user']['username']);
        unset($_SESSION['user']['password']);
        unset($_SESSION['user']['type']);
        header("location: ../login.php");
        exit;
    } else {
        header("location: ../login.php");
        exit;
    }
}
?>

<html>
    <head>
        <title>Light Blue - Admin Template</title>
        <?php
            if(isset($_SESSION['themeType'])){
                if($_SESSION['themeType'] == 1){
        
        ?>
        <link href="../../css/application.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
        
        <?php }
            else if($_SESSION['themeType'] == 2){       
        ?>
        <link href="../../white/css/application.min.css" rel="stylesheet">
        <?php }}?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="utf-8">
    </head>
    <body class="background-dark">

        <!--<div class="wrap"> -->
        <div class="content container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="page-title">Today at a Glance <small>Statistics and more</small></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <section class="widget">
                        <header>
                            <h4>
                                <i class="fa fa-list-ol"></i>
                                Today's Jobs
                            </h4>
                        </header>
                        <div class="body">
                            <table class="table table-striped table-images">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*$users = User::getAllUsers();
                                    foreach ($users as $user) */{
                                        ?>
                                        <tr>
                                            <td>
                                                <?php //echo $user['id']; ?>
                                            </td>
                                            <td>
                                                <?php //echo $user['username']; ?>
                                            </td>
                                            <td>
                                                <?php //echo $user['email']; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-lg btn-success">Success</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
               
                <div class="col-md-4">
                    <div class="row margin-bottom text-align-center">
                        <div class="col-md-8 col-md-offset-2">
                            <a href="changeTheme.php?theme" class="btn btn-lg btn-success btn-block">Schimba tema</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- jquery and friends -->
        <script src="../../lib/jquery/jquery-2.0.3.min.js"></script>
        <script src="../../lib/jquery-pjax/jquery.pjax.js"></script>


        <!-- jquery plugins -->
        <script src="../../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../../lib/sparkline/jquery.sparkline.js"></script>
        <script src="../../lib/jquery-ui-1.10.3.custom.js"></script>
        <script src="../../lib/jquery.slimscroll.js"></script>

        <!-- d3, nvd3-->
        <script src="../../lib/nvd3/lib/d3.v2.js"></script>
        <script src="../../lib/nvd3/nv.d3.custom.js"></script>

        <!-- nvd3 models -->
        <script src="../../lib/nvd3/src/models/scatter.js"></script>
        <script src="../../lib/nvd3/src/models/axis.js"></script>
        <script src="../../lib/nvd3/src/models/legend.js"></script>
        <script src="../../lib/nvd3/src/models/multiBar.js"></script>
        <script src="../../lib/nvd3/src/models/multiBarChart.js"></script>
        <script src="../../lib/nvd3/src/models/line.js"></script>
        <script src="../../lib/nvd3/src/models/lineChart.js"></script>
        <script src="../../lib/nvd3/stream_layers.js"></script>

        <!--backbone and friends -->
        <script src="../../lib/backbone/underscore-min.js"></script>
        <script src="../../lib/backbone/backbone-min.js"></script>
        <script src="../../lib/backbone/backbone.localStorage-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../../lib/bootstrap/transition.js"></script>
        <script src="../../lib/bootstrap/collapse.js"></script>
        <script src="../../lib/bootstrap/alert.js"></script>
        <script src="../../lib/bootstrap/tooltip.js"></script>
        <script src="../../lib/bootstrap/popover.js"></script>
        <script src="../../lib/bootstrap/button.js"></script>
        <script src="../../lib/bootstrap/tab.js"></script>
        <script src="../../lib/bootstrap/dropdown.js"></script>

        <!-- basic application js-->
        <script src="../../js/app.js"></script>
        <script src="../../js/settings.js"></script>

        <!-- page specific -->
        <script src="../../js/index.js"></script>
        <script src="../../js/chat.js"></script>

        <script type="text/template" id="message-template">
            <div class="sender pull-left">
            <div class="icon">
            <img src="img/2.jpg" class="img-circle" alt="">
            </div>
            <div class="time">
            just now
            </div>
            </div>
            <div class="chat-message-body">
            <span class="arrow"></span>
            <div class="sender">Tikhon Laninga</div>
            <div class="text">
            <%- text %>
            </div>
            </div>
        </script>

        <script type="text/template" id="settings-template">
            <div class="setting clearfix">
            <div>Background</div>
            <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-sm btn-transparent <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-sm btn-transparent <%= light? 'active' : '' %>">Light</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>Sidebar on the</div>
            <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-transparent <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-transparent <%= onRight? 'active' : '' %>">Right</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>Sidebar</div>
            <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-transparent <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-transparent <%= display? '' : 'active' %>">Hide</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>White Version</div>
            <div>
            <a href="white/" class="btn btn-sm btn-transparent">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
            </div>
            </div>
        </script>

        <script type="text/template" id="sidebar-settings-template">
            <% auto = sidebarState == 'auto'%>
            <% if (auto) {%>
            <button type="button"
            data-value="icons"
            class="btn-icons btn btn-transparent btn-sm">Icons</button>
            <button type="button"
            data-value="auto"
            class="btn-auto btn btn-transparent btn-sm">Auto</button>
            <%} else {%>
            <button type="button"
            data-value="auto"
            class="btn btn-transparent btn-sm">Auto</button>
            <% } %>
        </script>
        
    </body>
</html>