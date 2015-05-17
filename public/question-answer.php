<!DOCTYPE html>
<?php
include_once '../library/class/Question.php';
include_once '../library/class/Answer.php';
?>

<html>
    <head>
        <title>Intrebari si Raspunsuri</title>
        <link href="../css/application.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="utf-8">
    </head>    
    <body class="background-dark">
    <a href="add-question.php" style="margin-left: 40%; margin-top: 5%" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-plus"></span> Adauga intrebare</a>
         <?php
            $questions = Question::getAllVisibleQuestions();
            foreach ($questions as $question) {
                                        ?>
        <br>
        <br>
        <h3  class="text-left" style="color: salmon; margin-left: 10%"><b>Titlu: </b><?php echo Question::getQuestionById($question['id'], "title"); ?></h3>
        <h4  class="text-left" style="color: salmon; margin-left: 10%"><b>Continut:</b></h4> <h4 style="color: salmon; margin-left: 10%"><?php echo Question::getQuestionById($question['id'], "content"); ?></h4>
        <!--<div class="wrap"> -->
        <br><br>    
        <h3  class="text-left" style="color: turquoise; margin-left: 10%"><b>Raspunsuri: </b></h3>     
        <div class="content container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $answers = Answer::getAllAnswersByQuestionId($question['id']);
                    foreach ($answers as $answer) {
                        ?>
                    <h5 style="margin-left:5%"><?php echo $answer['id'] ?></h5>
                    <h4 style="margin-left:10%"><?php echo $answer['content'] ?></h4>
                    <?php } ?>                
                </div>
            </div>
        </div>
        <?php }?>
       
        <a href="../privat-questions/question-list.php"><h4 style="margin-left: 46%; margin-top: 5%">Inapoi</h4></a>



        <!-- jquery and friends -->
        <script src="../lib/jquery/jquery-2.0.3.min.js"></script>
        <script src="../lib/jquery-pjax/jquery.pjax.js"></script>


        <!-- jquery plugins -->
        <script src="../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../lib/sparkline/jquery.sparkline.js"></script>
        <script src="../lib/jquery-ui-1.10.3.custom.js"></script>
        <script src="../lib/jquery.slimscroll.js"></script>

        <!-- d3, nvd3-->
        <script src="../lib/nvd3/lib/d3.v2.js"></script>
        <script src="../lib/nvd3/nv.d3.custom.js"></script>

        <!-- nvd3 models -->
        <script src="../lib/nvd3/src/models/scatter.js"></script>
        <script src="../lib/nvd3/src/models/axis.js"></script>
        <script src="../lib/nvd3/src/models/legend.js"></script>
        <script src="../lib/nvd3/src/models/multiBar.js"></script>
        <script src="../lib/nvd3/src/models/multiBarChart.js"></script>
        <script src="../lib/nvd3/src/models/line.js"></script>
        <script src="../lib/nvd3/src/models/lineChart.js"></script>
        <script src="../lib/nvd3/stream_layers.js"></script>

        <!--backbone and friends -->
        <script src="../lib/backbone/underscore-min.js"></script>
        <script src="../lib/backbone/backbone-min.js"></script>
        <script src="../lib/backbone/backbone.localStorage-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../lib/bootstrap/transition.js"></script>
        <script src="../lib/bootstrap/collapse.js"></script>
        <script src="../lib/bootstrap/alert.js"></script>
        <script src="../lib/bootstrap/tooltip.js"></script>
        <script src="../lib/bootstrap/popover.js"></script>
        <script src="../lib/bootstrap/button.js"></script>
        <script src="../lib/bootstrap/tab.js"></script>
        <script src="../lib/bootstrap/dropdown.js"></script>

        <!-- basic application js-->
        <script src="../js/app.js"></script>
        <script src="../js/settings.js"></script>

        <!-- page specific -->
        <script src="../js/index.js"></script>
        <script src="../js/chat.js"></script>

        <script type="text/template" id="message-template">
            <div class="sender pull-left">
            <div class="icon">
            <img src="img/2.jpg" class="img-circle" alt="">
            </div>
            <div class="time">
            just now
            </div>
            </div>
            <div class="chat-message-body">
            <span class="arrow"></span>
            <div class="sender">Tikhon Laninga</div>
            <div class="text">
            <%- text %>
            </div>
            </div>
        </script>

        <script type="text/template" id="settings-template">
            <div class="setting clearfix">
            <div>Background</div>
            <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-sm btn-transparent <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-sm btn-transparent <%= light? 'active' : '' %>">Light</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>Sidebar on the</div>
            <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-transparent <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-transparent <%= onRight? 'active' : '' %>">Right</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>Sidebar</div>
            <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-transparent <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-transparent <%= display? '' : 'active' %>">Hide</button>
            </div>
            </div>
            <div class="setting clearfix">
            <div>White Version</div>
            <div>
            <a href="white/" class="btn btn-sm btn-transparent">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
            </div>
            </div>
        </script>

        <script type="text/template" id="sidebar-settings-template">
            <% auto = sidebarState == 'auto'%>
            <% if (auto) {%>
            <button type="button"
            data-value="icons"
            class="btn-icons btn btn-transparent btn-sm">Icons</button>
            <button type="button"
            data-value="auto"
            class="btn-auto btn btn-transparent btn-sm">Auto</button>
            <%} else {%>
            <button type="button"
            data-value="auto"
            class="btn btn-transparent btn-sm">Auto</button>
            <% } %>
        </script>

    </body>
</html>
