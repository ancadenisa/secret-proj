/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {    
    
    $('a.add').on('click', function(e) {
			
        e.preventDefault();
        var url = $(this).attr('href');
        var timer = 0;

        $('.modal-body.add')
            .html('<iframe id="iFrameAdd" width="100%" scrolling="no" frameBorder="0" src="'+url+'"></iframe>');

        $('#iFrameAdd').load(function() {
            window.setTimeout(function() {
                var height = $("#iFrameAdd").contents().find("#addForm").height();
                $("#iFrameAdd").height(height);
            }, 25);
            timer =  setInterval(function(){
                var height = $("#iFrameAdd").contents().find("#addForm").height();
                $("#iFrameAdd").height(height);
            }, 10);
        });

        $('.modal.add').modal('show');

        $('#saveChanges').click(function() {
           $("#iFrameAdd").contents().find("#addForm").submit();
           $('.modal.add').modal('hide');
        });

        $('.modal.add').on('hidden.bs.modal', function(){
            clearInterval(timer);
        });
        
       
	
    });    
});

$(function() {    
    
    $('a.delete').on('click', function(e) {
			
        e.preventDefault();
        var url = $(this).attr('href');
        var deleted = $(this).closest('tr');
        var timer = 0;

        $('.modal-body.delete')
            .html('<iframe id="iFrameDelete" width="100%" scrolling="no" frameBorder="0" src="'+url+'"></iframe>');

        $('#iFrameDelete').load(function() {
            window.setTimeout(function() {
                var height = $("#iFrameDelete").contents().find("#user-action-form").height();
                $("#iFrameDelete").height(height);
            }, 25);
            timer =  setInterval(function(){
                var height = $("#iFrameDelete").contents().find("#user-action-form").height();
                $("#iFrameDelete").height(height);
            }, 10);
        });

        $('.modal.delete').modal('show');

        $('#saveChanges').click(function() {
           $("#iFrameDelete").contents().find("#user-action-form").submit();
           $('.modal.delete').modal('hide');
           deleted.fadeOut();
        });

        $('.modal.delete').on('hidden.bs.modal', function(){
            clearInterval(timer);
        });
        
       
	
    });    
});
