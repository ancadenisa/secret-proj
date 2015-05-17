<script>console.log("Intra aici!")</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



include_once '../../library/class/Avizier.php';
include_once '../../library/class/Post.php';

    if(isset($_POST['del']))
        Avizier::deleteAvizierById($_POST['id']);
    if(isset($_POST['delPost']))
        Post::deletePostById($_POST['id']);

?>