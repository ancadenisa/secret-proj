<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include_once '/../library/class/Question.php';
include_once '/../library/class/Answer.php';
?>

<a href="public/add-question.php" style="margin-left: 40%; margin-top: 5%" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-plus"></span> Adauga intrebare</a>

<section class="widget" style="margin-top: 30px;">
    <header>
        <h5>
            <i class="fa fa-tasks"></i>
            Forum
        </h5>
    </header>
    <div class="body">
        <div class="panel-group" id="accordion2">
            <?php
            $questions = Question::getAllQuestions();
            foreach ($questions as $question) {
                ?>
                <div class="panel">
                    <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $question['id']; ?>">
                            <?php
                            echo Question::getQuestionById($question['id'], "title")."<br>";
                            echo Question::getQuestionById($question['id'], "content");
                            ?>
                        </a>
                    </div>
                    <div id="collapse<?php echo $question['id']; ?>" class="panel-collapse in collapse" style="height: auto;">
                        <div class="panel-body">
                            <?php
                            $answers = Answer::getAllAnswersByQuestionId($question['id']);
                            foreach ($answers as $answer) {
                                echo $answer['content']."<br>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
<?php } ?>
        </div>

    </div>
</section>