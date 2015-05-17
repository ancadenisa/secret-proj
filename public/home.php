<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
    include '/../library/class/Avizier.php';
    include '/../library/class/Post.php';

  

    include '/../library/class/Question.php';
    include '/../library/class/Answer.php';
    
    $aviziere = Avizier::getNumberOfAviziere();
    $posts = Post::getNumberOfPosts();
    $questions = Question::getNumberOfQuestions();
    $answers = Answer::getNumberOfAnswers();
?>

<section class="widget">
    <header>
        <h3><i class="fa fa-home"></i> Home </h3>
    </header>
    <div class="body">
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="description">
                        <h3><strong><?php echo $aviziere; ?></strong> Aviziere</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="description">
                        <h3><strong><?php echo $posts; ?></strong> Postari</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <div class="description">
                        <h3><strong><?php echo $questions; ?></strong> Intrebari</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <div class="description">
                        <h3><strong><?php echo $answers; ?></strong> Raspunsuri</h3>
                    </div>
                </div>
            </div>
        </div>    
    </div>    
</section>