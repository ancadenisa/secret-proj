<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../css/application.min.css" rel="stylesheet">

    </head>
    <body>
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
include_once '/../../library/class/FormUtils.php';
//back button
        if (isset($_GET['action'])) {
            if (isset($_POST['save'])){
                $username = $_POST['user'];
                $mail = $_POST['mail'];
                $password = $_POST['password'];
                if($_GET['action'] == 'add')
                    $user_type = $_POST['usertype'];
                $name = $_POST['name'];
                $birthdate = $_POST['birthdate'];
                $hiredate = $_POST['hiredate'];
                if($_GET['action'] == 'add')
                    User::insertUser($username, $mail, $password, $user_type, $name, $birthdate, $hiredate);
                if($_GET['action'] == 'edit')
                    User::editUser($_GET['id'], $username, $mail, $password, $name, $birthdate, $hiredate);
              
                header("location: ../superuser/superuser.php");
            }
            if (isset($_POST['delete'])){
                User::deleteUserTypeById($_GET['id']);
                //delete from user
                User::deleteUserById($_GET['id']);
                header("location: ../superuser/superuser.php");
            }
        ?>


        
        <form id="user-form" class="form-horizontal label-left"
                          novalidate="novalidate"
                          method="post"
                          data-parsley-priority-enabled="false">
                        <fieldset>
                            <legend>Account Edit Form <small>Some explanation text</small></legend>
                        </fieldset>
                        <fieldset>
                            <legend class="section">Personal Info</legend>
                            <div class="control-group">
                                <label class="control-label" for="username">Username <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <div class="col-sm-8"><input type="text" id="user" name="user" required="required" class="form-control" <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?> value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "username");}else{echo "";}?>"/></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">Name<span class="required" >*</span></label>
                                <div class="controls form-group">
                                    <div class="col-sm-8"><input type="text" id="name" name="name" required="required" class="form-control" <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?> value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "name");}else{echo "";}?>"/></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="date-of-birth" class="control-label">Date Of Birth <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <div class="col-sm-6">
                                    <input type="date" name="birthdate"  class="form-control" <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?> value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "birth_date");}else{echo "";}?>"/></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="date-of-hire" class="control-label">Date Of Hire <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <div class="col-sm-6">
                                    <input type="date" name="hiredate"  class="form-control" <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?> value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "hire_date");}else{echo "";}?>"/></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label id="email-label" for="email" class="control-label">Email <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <div class="col-xs-12 col-sm-8">
                                        <input class="form-control" type="text" name="mail" <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?>  value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "email");}else{echo "";}?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="password" class="control-label">Password</label>
                                <div class="controls form-group">
                                    <div class="col-sm-8"><input type="password" class="form-control" name="password"  <?php echo FormUtils::isActionViewOrDel_readonly($_GET['action']);?>  value = "<?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "password");}else{echo "";}?>"/></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="state" class="control-label">Tip <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <select name="usertype" class="form-control" <?php echo FormUtils::isActionViewDelOrEdit_readonly($_GET['action']);?> >
                                        <option value="superuser" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "superuser");}else{echo "";}?>>Superuser</option>
                                        <option value="admin" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "admin");}else{echo "";}?> >Admin</option>
                                        <option value="secrt" <?php if(isset($_GET['id'])){echo User::getInfo($_GET['id'], "secrt");}else{echo "";}?>>Secretara</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
            <a href="../superuser/superuser.php">Inapoi</a>
                        <div class="form-actions" <?php echo FormUtils::isActionViewOrDel($_GET['action']);?>>
                            <input  type="submit" class="btn btn-primary" name="save" value="Salveaza"/>
                        </div>
                        <div class="form-actions" <?php echo FormUtils::isNotActionDel($_GET['action']);?>>
                            <input  type="submit" class="btn btn-primary" name="delete" value="Sterge"/>
                        </div>
                    </form>
         <?php
        }
        ?>
        
        
        
        
    <!-- jquery and friends -->
<script src="../../lib/jquery/jquery-2.0.3.min.js"> </script>
<script src="../../lib/jquery-pjax/jquery.pjax.js"></script>


<!-- jquery plugins -->
<script src="../../lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="../../lib/parsley/parsley.js"> </script>
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
