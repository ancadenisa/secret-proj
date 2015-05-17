<script>console.log("Intra aici!")</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../../library/class/Question.php';

    if(isset($_POST['delQuest']))
        Question::deleteQuestionById($_POST['id']);
    if(isset($_POST['makePublic']))
        Question::setVisible($_POST['id']);
    if(isset($_POST['makeHidden']))
        Question::setNotVisible($_POST['id']);

?>