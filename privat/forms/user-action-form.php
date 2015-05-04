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
//back button
        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            //delete from type
            User::deleteUserTypeById($_GET['id']);
            //delete from user
            User::deleteUserById($_GET['id']);
            echo "Inregistrare stearsa \n";
        }
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {

        }
        if (isset($_GET['action']) && $_GET['action'] == 'view') {

        }
        if (isset($_GET['action']) && $_GET['action'] == 'add') {
            if (isset($_POST['save'])){
                $username = $_POST['user'];
                $mail = $_POST['mail'];
                $password = $_POST['password'];
                $user_type = $_POST['usertype'];
                $name = $_POST['name'];
                $birthdate = $_POST['birthdate'];
                $hiredate = $_POST['hiredate'];
                User::insertUser($username, $mail, $password, $user_type, $name, $birthdate, $hiredate);
                header("location: ../superuser/superuser.php");
            }
        ?>
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

        <form method="post">
            <table>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="user"/>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="mail"/>
                    </td>
                </tr>
                <tr>
                    <td>Parola:</td>
                    <td>
                        <input type="password" name="password"/>
                    </td>
                </tr>
                <tr>
                    <td>Tip utilizator:</td>
                    <td>
                        <select name="usertype" class="form-control">
                            <option value="superuser">Superuser</option>
                            <option value="admin">Admin</option>
                            <option value="secrt">Secretara</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nume:</td>
                    <td>
                        <input type="text" name="name"/>
                    </td>
                </tr>
                <tr>
                    <td>Data nasterii:</td>
                    <td>
                        <input type="date" name="birthdate"/>
                    </td>
                </tr>
                <tr>
                    <td>Data angajarii:</td>
                    <td>
                        <input type="date" name="hiredate"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="save" value="Salveaza"/>
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
</html>
