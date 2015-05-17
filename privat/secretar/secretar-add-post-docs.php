<?php
        
        include_once '/../../library/class/Post.php';
        include_once '/../../library/class/FormUtils.php';
        


            if (isset($_POST['save'])) {
               $title = $_POST['title'];
               $content = $_POST['content'];
               //var_dump(isset($_FILES["uploaded_file"]));
               var_dump($_FILES['uploaded_file']);
               if((!empty($_FILES['uploaded_file'])) && ($_FILES['uploaded_file']['error'] == 0)) {
                    $filename = basename($_FILES['uploaded_file']['name']);
                    $ext = substr($filename, strrpos($filename, '.') + 1);
                    if ($_FILES["uploaded_file"]["size"] < 3500000){
                      //Determine the path to which we want to save this file
                        $newname = '../../uploads/docs/'.$filename;
                        $path = 'uploads/docs/'.$filename;
                        //Check if the file with the same name is already exists on the server
                        if (!file_exists($newname)) {
                          //Attempt to move the uploaded file to it's new place
                          if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
                             echo "It's done! The file has been saved as: ".$newname;
                             $post_id = Post::insertPost($title, $content, $_GET['avizierId']);
                             $handler = Connection::getInstance()->getConnection();
                             $sql = 'INSERT INTO `file` VALUES (NULL, :name, :type, :size, :path, :created_at, :updated_at)';
                             $query = $handler->prepare($sql);
                             $created_at = date('Y-m-d H:m:s');
                             $updated_at = date('Y-m-d H:m:s'); 
                             $query->bindParam(':name', $filename, PDO::PARAM_STR);
                             $query->bindParam(':type', $ext, PDO::PARAM_STR);
                             $query->bindParam(':path', $path, PDO::PARAM_STR);
                             $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
                             $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
                             $query->bindParam(':size', $_FILES["uploaded_file"]["size"], PDO::PARAM_INT);
                             $query->execute();
                             
                             $sql = 'SELECT `id` FROM `file` WHERE `name` = :name AND `size` = :size';
                             $query = $handler->prepare($sql);
                             $query->bindParam(':name', $filename, PDO::PARAM_STR);
                             $query->bindParam(':size', $_FILES["uploaded_file"]["size"], PDO::PARAM_INT);
                             $query->execute();
                             $file = $query->fetch(PDO::FETCH_ASSOC);
                             $file_id = $file['id'];
                             
                             $sql = 'INSERT INTO `file_post` VALUES(NULL, :id_post, :id_file)';
                             $query = $handler->prepare($sql);
                             $query->bindParam(':id_post', $post_id, PDO::PARAM_INT);
                             $query->bindParam(':id_file', $file_id, PDO::PARAM_INT);
                             $query->execute();
                             
                             
                          } else {
                             echo "Error: A problem occurred during file upload!";
                          }
                        } else {
                           echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
                        }
                    } else {
                       echo "Error: Only .jpg images under 350Kb are accepted for upload";
                    }
                  } else {
                   echo "Error: No file uploaded";
                  }
            }
            ?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if (isset($_SESSION['themeType'])) {
            if ($_SESSION['themeType'] == 1) {
                ?>
                <link href="../../css/application.min.css" rel="stylesheet">
                <link rel="shortcut icon" href="img/favicon.png">

            <?php
            } else if ($_SESSION['themeType'] == 2) {
                ?>
                <link href="../../white/css/application.min.css" rel="stylesheet">
            <?php }
        } ?>

    </head>
    <body>
        
        <form id="aviz-text-post-add-form" class="form-horizontal label-left"
                  novalidate="novalidate"
                  method="post"
                  data-parsley-priority-enabled="false" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="title">Titlu<span class="required" >*</span></label>
                        <div class="controls form-group">
                            <div class="col-sm-8"><input type="text" id="title" name="title" required="required" class="form-control"/></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="content">Continut<span class="required" >*</span></label>
                        <div class="controls form-group">
                            <div class="col-sm-8">
                                <textarea id="content" name="content" required="required" class="form-control"/></textarea>
                            </div>
                        </div>
                    </div>
                    Choose a file to upload: <input name="uploaded_file" type="file" />
                </fieldset>

                <a href="secret-edit-aviz-post-list.php?id=<?php echo $_GET['avizierId'];?>&tip=docs"><h4>Inapoi</h4><span class="glyphicon glyphicon-arrow-left"></span></a>
                <div class="form-actions">
                    <input  type="submit" class="btn btn-primary" name="save" value="Salveaza"/>
                </div>
            </form>




        <!-- jquery and friends -->
        <script src="../../lib/jquery/jquery-2.0.3.min.js"></script>
        <script src="../../lib/jquery-pjax/jquery.pjax.js"></script>


        <!-- jquery plugins -->
        <script src="../../lib/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="../../lib/parsley/parsley.js"></script>
        <script src="../../lib/icheck.js/jquery.icheck.js"></script>
        <script src="../../lib/select2.js"></script>


        <!--backbone and friends -->
        <script src="../../lib/backbone/underscore-min.js"></script>

        <!-- bootstrap default plugins -->
        <script src="../../lib/bootstrap/transition.js"></script>
        <script src="../../lib/bootstrap/collapse.js"></script>
        <script src="../../lib/bootstrap/alert.js"></script>
        <script src="../../lib/bootstrap/tooltip.js"></script>
        <script src="../../lib/bootstrap/popover.js"></script>
        <script src="../../lib/bootstrap/button.js"></script>
        <script src="../../lib/bootstrap/dropdown.js"></script>
        <script src="../../lib/bootstrap/modal.js"></script>

        <!-- bootstrap custom plugins -->
        <script src="../../lib/bootstrap-datepicker.js"></script>
        <script src="../../lib/bootstrap-select/bootstrap-select.js"></script>
        <script src="../../lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
        <script src="../../lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

        <!-- basic application js-->
        <script src="../../js/app.js"></script>
        <script src="../../js/settings.js"></script>

        <!-- page specific -->
        <script src="../../js/forms.js"></script>

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
</html


