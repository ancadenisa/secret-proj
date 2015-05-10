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
        if (isset($_SESSION['themeType'])) {
            if ($_SESSION['themeType'] == 1) {
                ?>
                <link href="../../css/application.min.css" rel="stylesheet">
                <link rel="shortcut icon" href="img/favicon.png">

            <?php
            } else if ($_SESSION['themeType'] == 2) {
                ?>
                <link href="../../white/css/application.min.css" rel="stylesheet">
            <?php }
        } ?>
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
                <div class="col-md-4">
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
                                    /* $users = User::getAllUsers();
                                      foreach ($users as $user) */ {
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

                <div class="col-md-4">
                    <div class="row margin-bottom text-align-center">
                        <div class="col-md-8 col-md-offset-2">
                            <a href="addCategory.php" class="btn btn-danger btn-lg btn-block add"
                                data-toggle="modal" data-target="#addCategory">Adauga categorie</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="addCategory" class="modal add fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                    </div>
                    <div class="modal-body add">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!-- jquery and friends -->
<script src="../../lib/jquery/jquery-2.0.3.min.js"> </script>
<script src="../../lib/jquery-pjax/jquery.pjax.js"></script>

<script src="../../library/js/myScript.js"></script>


<!-- jquery plugins -->
<script src="../../lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="../../lib/parsley/parsley.js"> </script>
<script src="../../lib/icheck.js/jquery.icheck.js"></script>
<script src="../../lib/select2.js"></script>


<!--backbone and friends -->
<script src="../../lib/backbone/underscore-min.js"></script>

<!-- bootstrap default plugins -->
<script src="../../lib/bootstrap/transition.js"></script>
<script src="../../lib/bootstrap/collapse.js"></script>
<script src="../../lib/bootstrap/alert.js"></script>
<script src="../../lib/bootstrap/tooltip.js"></script>
<script src="../../lib/bootstrap/popover.js"></script>
<script src="../../lib/bootstrap/button.js"></script>
<script src="../../lib/bootstrap/dropdown.js"></script>
<script src="../../lib/bootstrap/modal.js"></script>

<!-- bootstrap custom plugins -->
<script src="../../lib/bootstrap-datepicker.js"></script>
<script src="../../lib/bootstrap-select/bootstrap-select.js"></script>
<script src="../../lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
<script src="../../lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<!-- basic application js-->
<script src="../../js/app.js"></script>
<script src="../../js/settings.js"></script>

<!-- page specific js 
<script src="../../js/ui-dialogs.js"></script> -->



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