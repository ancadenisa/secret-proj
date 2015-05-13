<script>console.log("Intra aici!")</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../../library/class/Avizier.php';
//header('Content-Type: application/json');
//var_dump($_POST['delAviz']);
 if (isset($_POST['delAviz'])) {
    Avizier::deleteAvizierById($_POST['id']);
    //header("location: ../login.php")
}


?>