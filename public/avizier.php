<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include_once '../library/class/Avizier.php';
include_once '../library/class/FileUnitProcessor.php';
include_once '../library/class/Theme.php';
    
        $themeType = Theme::getCurrentTheme();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/application.min.css" rel="stylesheet">
    </head>
    <body class="background-<?php if($themeType == 1){echo 'dark';} else {echo 'light';} ?>">
        <div class="container" style="margin-top: 30px;">
            <?php
            if (isset($_GET['id'])) {
                $posts = Avizier::getAllPostsByAvizierId($_GET['id']);
                if ($_GET['tip'] == 'docs') {
                    ?>
                    <section class="widget normal">
                        <header>
                            
                        </header>
                        <div class="body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($post = $posts->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $post['id']; ?></td>
                                            <td><?php echo $post['title']; ?></td>
                                            <td><?php
                                                $files = FileUnitProcessor::getAllFilesFromPostById($post['id']);
                                                while ($file = $files->fetch(PDO::FETCH_ASSOC)) {
                                                    echo $file['name'];
                                                    ?></td>
                                                <td><a class="btn btn-success btn-md" href="download.php?file=<?php echo $file['name']; ?>" >Download</a></td><?php } ?>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <?php
                }
                if ($_GET['tip'] == 'foto') {
                    while ($post = $posts->fetch(PDO::FETCH_ASSOC)) {
                    ?> 
            <div class="col-xs-4">
                <section class="widget normal">
                    <header>
                        <h4>
                            <i class="fa fa-arrow-right"></i>
                            <?php echo $post['title'];?>
                        </h4>
                       
                    </header>
                    <div class="body">
                        <img src="
                            <?php 
                                $files = FileUnitProcessor::getAllFilesFromPostById($post['id']);
                                while ($file = $files->fetch(PDO::FETCH_ASSOC)) {
                                    echo "../".$file['path'];
                                
                            ?>" class="center-block img-responsive"/>
                       
                    </div>
                    <?php } ?>
                </section>
            </div>    
                        
                        <?php
                }}
                else if ($_GET['tip'] == 'text'){
                    while ($post = $posts->fetch(PDO::FETCH_ASSOC)) {
                        ?> 
            <div class="col-xs-4">
                <section class="widget normal">
                    <header>
                       <?php echo $post['title']; ?>
                    </header>
                    <div class="body">
                        <?php echo $post['content']; ?>
                    </div>
                </section>
            </div>    
                            
                            
                     <?php 
                    }
                }
            }
            ?>
        </div>
        <script src="../lib/jquery/jquery-2.0.3.min.js"> </script>
        <script src="../lib/jquery-pjax/jquery.pjax.js"></script>

        <script src="../library/js/myScript.js"></script>


        <!-- jquery plugins -->
        <script src="../lib/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="../lib/parsley/parsley.js"> </script>
        <script src="../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../lib/select2.js"></script>


        <!--backbone and friends -->
        <script src="../lib/backbone/underscore-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../lib/bootstrap/transition.js"></script>
        <script src="../lib/bootstrap/collapse.js"></script>
        <script src="../lib/bootstrap/alert.js"></script>
        <script src="../lib/bootstrap/tooltip.js"></script>
        <script src="../lib/bootstrap/popover.js"></script>
        <script src="../lib/bootstrap/button.js"></script>
        <script src="../lib/bootstrap/dropdown.js"></script>
        <script src="../lib/bootstrap/modal.js"></script>

        <!-- bootstrap custom plugins -->
        <script src="../lib/bootstrap-datepicker.js"></script>
        <script src="../lib/bootstrap-select/bootstrap-select.js"></script>
        <script src="../lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
        <script src="../lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

        <!-- basic application js-->
        <script src="../js/app.js"></script>
        <script src="../js/settings.js"></script>

        <!-- page specific js 
        <script src="../../js/ui-dialogs.js"></script> -->



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
