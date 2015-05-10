<!DOCTYPE html>

<?php 
 
    include_once '../../library/class/Admin.php';
    include_once '../../library/class/Theme.php';
   
?>

<html>
    <head>
        <link href="../../css/application.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body>
        <script src="../../library/js/myScript.js"></script>
        <form id="addForm" class="form-horizontal label-left"
                          novalidate="novalidate"
                          method="post"
                          data-parsley-priority-enabled="false" action="postAddCategory.php">
                        <fieldset>
                            <legend>Formular pentru adaugare de categorii</legend>
                        </fieldset>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="title">Titlu <span class="required">*</span></label>
                                <div class="controls form-group">
                                    <div class="col-sm-8"><input type="text" id="title" name="title" required="required" class="form-control"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="description">Descriere</label>
                                <div class="controls form-group">
                                    <div class="col-sm-4"><textarea id="description" name="description" class="form-control"></textarea></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vizibilitate</label>
                                <div class="controls form-group">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="visibility" value="0"> &nbsp; Vizibil &nbsp;
                                        </label>
                                        <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="visibility" value="1"> Nevizibil
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
    
        <script src="../../lib/jquery/jquery-2.0.3.min.js"> </script>
<script src="../../lib/jquery-pjax/jquery.pjax.js"></script>

<script src="../../library/js/myScript.js"></script>


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


<script src="../../js/ui-dialogs.js"></script> 

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