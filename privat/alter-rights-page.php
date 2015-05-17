<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <link href="../css/application.min.css" rel="stylesheet">

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
<h3 align="center" style="color: springgreen" > Drepturi disponibile: </h3>
<div class="content container">
<table align="center" width="300" border="1">
    <?php
    $permissions = User::getUserRights($_GET['id']);
    foreach ($permissions as $permission) {
        ?>

    <tr><td><p align="center"><?php echo $permission; ?></p></td></tr>

        <?php
    }
    ?>
</table>
</div>
<div class="content container">
<h3 style="color: springgreen" > Sectiune de adaugare drepturi noi: </h3>
<?php $rights = FormUtils::getAllPossibleRights();
?>
<form  method="POST">
    <?php foreach ($rights as $right) { ?>
        <input type="checkbox" name="check_list[]" value = "<?php echo $right; ?>"><?php print "  ". $right; ?>
        <br>
    <?php } ?>
        <br><br><br>
        <input type="submit" name="changeRights" style="color: springgreen; font: larger" value="Submit"/>
</form>
</div>
<div align="center">
    <a href="superuser/superuser.php"><h3 style="color: springgreen" ><b>Inapoi</b></h3>
    <span class="glyphicon glyphicon-arrow-left"></span></a>
</div>
    </body>
</html


