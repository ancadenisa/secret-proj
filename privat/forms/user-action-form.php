<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//un formular care in functie de tipul de actiune dorita va avea ca buton de submit\
//editare(alveaza informatii editeaza + campurile formularului vor fi read write)
//stergere(se sterge inregistrarea curenta + campurile vor fi read only)
//vizualizare (campuri read -only)


include_once '/../../library/class/User.php';
include_once '/../../library/class/FormUtils.php';
//back button
        if (isset($_GET['action'])) {
            if (isset($_POST['save'])){
                $username = $_POST['user'];
                $mail = $_POST['mail'];
                $password = $_POST['password'];
                $user_type = $_POST['usertype'];
                $name = $_POST['name'];
                $birthdate = $_POST['birthdate'];
                $hiredate = $_POST['hiredate'];
                if($_GET['action'] == 'add')
                    User::insertUser($username, $mail, $password, $user_type, $name, $birthdate, $hiredate);
                if($_GET['action'] == 'edit')
                    User::editUser($_GET['id'], $username, $mail, $password, $user_type, $name, $birthdate, $hiredate);
              
                header("location: ../superuser/superuser.php");
            }
            if (isset($_POST['delete'])){
                User::deleteUserTypeById($_GET['id']);
                //delete from user
                User::deleteUserById($_GET['id']);
                header("location: ../superuser/superuser.php");
            }
        ?>


        <form method="post">
            <table>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="user" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "username");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="mail" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "email");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Parola:</td>
                    <td>
                        <input type="password" name="password" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "password");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Tip utilizator:</td>
                    <td>
                        <select name="usertype" class="form-control">
                            <option value="superuser" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "superuser");}else{echo " ";}?>>Superuser</option>
                            <option value="admin" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "admin");}else{echo " ";}?> >Admin</option>
                            <option value="secrt" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "secrt");}else{echo " ";}?>>Secretara</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nume:</td>
                    <td>
                        <input type="text" name="name" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "name");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Data nasterii:</td>
                    <td>
                        <input type="date" name="birthdate" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "birth_date");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Data angajarii:</td>
                    <td>
                        <input type="date" name="hiredate" value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "hire_date");}else{echo " ";}?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input <?php echo FormUtils::isActionViewOrDel($_GET['action']);?> type="submit" name="save" value="Salveaza"/>
                        <input <?php echo FormUtils::isNotActionDel($_GET['action']);?> type="submit" name="delete" value="Stergere"/>
                    </td>
                    <td></td>
                    <td><a href="../superuser/superuser.php">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        }
        ?>
    </body>
</html
