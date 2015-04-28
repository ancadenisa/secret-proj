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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../../style/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../style/bootstrap/bootstrap-theme.css">
    </head>
    <body>
        <script src="../../script/jquery/jquery.js"></script>
        <script src="../../script/bootstrap/bootstrap.js"></script>
        <h1>Hello SUPERUSER!</h1>
        <a href="./superuser.php?logout" class="btn btn-danger">Logout</a>
        <?php      
        $users = User::getAllUsers();
        foreach ($users as $user) {
        ?>
        <table width="500" border="1">
        <tr>
            <td><?php print $user['username']; ?></td>
            <td><a href ="../forms/user-action-form.php?action=view" class="btn btn-link">Vizualizare</a></td>
            <td><a href ="../forms/user-action-form.php?action=edit" class="btn btn-link">Editare</a></td>
            <td><a href ="../forms/user-action-form.php?action=delete" class="btn btn-link">Stergere</a></td>
            <td><a href ="../alter-rights-page.php?user=<?php $user['username'] ?>" class="btn btn-warning">Alterare drepturi</a></td>
        </tr>
        </table>
        
        <?php
        }    
        ?>
</body>
</html>
