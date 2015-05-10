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
            var_dump($id);
            $permissionObj->setId($id);
            $permissionObj->addThisPermisssionToCurrentUser($_GET['id']);
        }
    }
}
?>
<html>
    <head>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
</head>
<h3 align="center"> Drepturi disponibile: </h3>
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


</html>