<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
         <link href="../css/application.min.css" rel="stylesheet">
        <?php
        if (isset($_SESSION['themeType'])) {
            if ($_SESSION['themeType'] == 1) {
                ?>
                <link href="../css/application.min.css" rel="stylesheet">
                <link rel="shortcut icon" href="img/favicon.png">

            <?php
            } else if ($_SESSION['themeType'] == 2) {
                ?>
                <link href="../white/css/application.min.css" rel="stylesheet">
            <?php }
        } ?>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//pagina va afisa o lista de drepturi cu posbilitatea de adaugare 
//pentru utilizatorul selectat a unui anumit drept sau de stergere
include '/../library/class/User.php';
include '/../library/class/FormUtils.php';
include '/../library/class/Permission.php';


if (isset($_POST['changeRights'])) {

    if (empty($_POST['check_list'])) {
        echo " Nu ati selectat niciun drept";
    } else {
        $permissionObj = new Permission();
        foreach ($_POST['check_list'] as $selected) {
            if ($selected == RightsConst::add_aviz) {
                $permissionObj->setAdd_aviz(1);
            }
            if ($selected == RightsConst::add_categ_aviz) {
                $permissionObj->setAdd_categ_aviz(1);
            }
            if ($selected == RightsConst::del_aviz) {
                $permissionObj->setDel_aviz(1);
            }
            if ($selected == RightsConst::delete_categ_aviz) {
                $permissionObj->setDel_categ_aviz(1);
            }
            if ($selected == RightsConst::modify_theme) {
                $permissionObj->setModify_theme(1);
            }
            if ($selected == RightsConst::users_alter) {
                $permissionObj->setUsers_alter(1);
            }
            if ($selected == RightsConst::forum_answer) {
                $permissionObj->setForum_answer(1);
            }
            if ($selected == RightsConst::edit_aviz) {
                $permissionObj->setEdit_aviz(1);
            }
        }
        if (($id = $permissionObj->getPermissionId()) != NULL) {
            $permissionObj->setId($id);
            $permissionObj->addThisPermisssionToCurrentUser($_GET['id']);
        } else {
            $permissionObj->insertPermissionToDB();
            $id = $permissionObj->getPermissionId();
            $permissionObj->setId($id);
            $permissionObj->addThisPermisssionToCurrentUser($_GET['id']);
        }
    }
}
?>
<body class="background-dark">
<h3 align="center"> Drepturi disponibile: </h3>
<div class="content container">
<table align="center" width="300" border="1">
    <?php
    $permissions = User::getUserRights($_GET['id']);
    foreach ($permissions as $permission) {
        ?>

        <tr><td><?php echo $permission; ?></td></tr>

        <?php
    }
    ?>
</table>
</div>

<h3> Sectiune de adaugare drepturi noi: </h3>
<?php $rights = FormUtils::getAllPossibleRights();
?>
<form  method="POST">
    <?php foreach ($rights as $right) { ?>
        <input type="checkbox" name="check_list[]" value = "<?php echo $right; ?>"><?php echo $right; ?>
        <br>
    <?php } ?>
    <input type="submit" name="changeRights" value="Submit"/>
    <a href="superuser/superuser.php">
    <span class="glyphicon glyphicon-arrow-left"></span></a>
</form>


   <!-- jquery and friends -->
        <script src="../lib/jquery/jquery-2.0.3.min.js"></script>
        <script src="../lib/jquery-pjax/jquery.pjax.js"></script>


        <!-- jquery plugins -->
        <script src="../lib/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="../lib/parsley/parsley.js"></script>
        <script src="../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../lib/select2.js"></script>


        <!--backbone and friends -->
        <script src="../lib/backbone/underscore-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../lib/bootstrap/transition.js"></script>
        <script src="../lib/bootstrap/collapse.js"></script>
        <script src="../lib/bootstrap/alert.js"></script>
        <script src="../lib/bootstrap/tooltip.js"></script>
        <script src="../lib/bootstrap/popover.js"></script>
        <script src="../lib/bootstrap/button.js"></script>
        <script src="../lib/bootstrap/dropdown.js"></script>
        <script src="../lib/bootstrap/modal.js"></script>

        <!-- bootstrap custom plugins -->
        <script src="../lib/bootstrap-datepicker.js"></script>
        <script src="../lib/bootstrap-select/bootstrap-select.js"></script>
        <script src="../lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
        <script src="../lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

        <!-- basic application js-->
        <script src="../js/app.js"></script>
        <script src="../js/settings.js"></script>

        <!-- page specific -->
        <script src="../js/forms.js"></script>

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
</html


