<!DOCTYPE html>
<?php
include_once '../../library/config.php';
include_once '../../library/class/Avizier.php';


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
        <title>Secretar</title>
        <link href="../../css/application.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="utf-8">
    </head>
    <body class="background-dark">

        <!--<div class="wrap"> -->
        <div class="content container">
            <div class="row">
                <div class="col-md-8">
                    <section class="widget">
                        <header>
                            <h4>
                                <i class="fa fa-list-ol"></i>
                                Aviziere
                            </h4>
                        </header>
                        <div class="body">
                            <table class="table table-striped table-images">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titlu</th>
                                        <th>Categorie</th>
                                        <th></th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aviziere = Avizier::getAllAviziere();
                                    if ($aviziere != NULL) {
                                        foreach ($aviziere as $avizier) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $avizier['id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $avizier['title']; ?>   
                                                </td>
                                                <td>
                                                    <?php echo Avizier::getAvizierCatNameById($avizier['id_cat']); ?> 
                                                </td>
                                                <td>
                                                    <a href ="secret-edit-aviz-post-list.php?id=<?php echo $avizier['id'] ?>&tip=<?php echo Avizier::getAvizierCatNameById($avizier['id_cat']); ?>" class="btn btn-sm btn-danger">Editeaza</a>
                                                    <a  onclick="myFunction(<?php echo $avizier['id']; ?>)" class="btn btn-sm btn-success">Stergere</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="col-md-4">
                    <div class="row margin-bottom text-align-center">
                        <div class="col-md-8 col-md-offset-2">
                            <a href="secretar-add-aviz-form.php" class="btn btn-lg btn-success btn-block">Adauga avizier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jquery and friends -->
        <script src="../../lib/jquery/jquery-2.0.3.min.js"></script>
        <script src="../../lib/jquery-pjax/jquery.pjax.js"></script>


        <!-- jquery plugins -->
        <script src="../../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../../lib/sparkline/jquery.sparkline.js"></script>
        <script src="../../lib/jquery-ui-1.10.3.custom.js"></script>
        <script src="../../lib/jquery.slimscroll.js"></script>

        <!-- d3, nvd3-->
        <script src="../../lib/nvd3/lib/d3.v2.js"></script>
        <script src="../../lib/nvd3/nv.d3.custom.js"></script>

        <!-- nvd3 models -->
        <script src="../../lib/nvd3/src/models/scatter.js"></script>
        <script src="../../lib/nvd3/src/models/axis.js"></script>
        <script src="../../lib/nvd3/src/models/legend.js"></script>
        <script src="../../lib/nvd3/src/models/multiBar.js"></script>
        <script src="../../lib/nvd3/src/models/multiBarChart.js"></script>
        <script src="../../lib/nvd3/src/models/line.js"></script>
        <script src="../../lib/nvd3/src/models/lineChart.js"></script>
        <script src="../../lib/nvd3/stream_layers.js"></script>

        <!--backbone and friends -->
        <script src="../../lib/backbone/underscore-min.js"></script>
        <script src="../../lib/backbone/backbone-min.js"></script>
        <script src="../../lib/backbone/backbone.localStorage-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../../lib/bootstrap/transition.js"></script>
        <script src="../../lib/bootstrap/collapse.js"></script>
        <script src="../../lib/bootstrap/alert.js"></script>
        <script src="../../lib/bootstrap/tooltip.js"></script>
        <script src="../../lib/bootstrap/popover.js"></script>
        <script src="../../lib/bootstrap/button.js"></script>
        <script src="../../lib/bootstrap/tab.js"></script>
        <script src="../../lib/bootstrap/dropdown.js"></script>

        <!-- basic application js-->
        <script src="../../js/app.js"></script>
        <script src="../../js/settings.js"></script>

        <!-- page specific -->
        <script src="../../js/index.js"></script>
        <script src="../../js/chat.js"></script>

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

        <script>
                                                function myFunction(id) {
                                                    if (confirm("Avizierul poate contine postari multiple. Sigur doriti stergerea acestuia?")) {
                                                        jQuery.ajax({
                                                            type: "POST",
                                                            url: 'json-content.php',
                                                            dataType: 'json',
                                                            data: {del: 'delAviz', id: id},
                                                            success: function (data) {
                                                                alert(id);
                                                            }
                                                        });
                                                        window.location.reload();
                                                    }                                                   
                                                }
        </script>

    </body>
</html>
