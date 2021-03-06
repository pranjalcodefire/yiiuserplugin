$('.datepicker').datepicker({dateFormat:"dd-mm-yy"});

$('.ableToChangeStatus').click(function(){
    if(confirm('Are you sure ?')){ 
         var id = $(this).attr('id');
         var url = $(this).attr('url');
         var recordId  = id.split('ableToChangeStatus')[1];
         $.ajax({
            url:url,
            type:"POST",
            data:'id='+recordId,
            dataType:'json',
            beforeSend:function(){    $('.loading-img').show();    },
            success:function(response){
                  if(response.status == 'success'){
                      if(response.recordStatus == 1){
                          $('#'+id+' span').attr('class', 'glyphicon glyphicon-ok');
                          $('#'+id).attr('title', 'Make Inactive');
                          $('#status_td'+recordId).html('Active');
                          $('#rowId'+recordId).attr('class', 'success');
                      }else{
                          $('#'+id+' span').attr('class', 'glyphicon glyphicon-ban-circle');
                          $('#status_td'+recordId).html('Inactive');
                          $('#rowId'+recordId).attr('class', 'danger');
                          $('#'+id).attr('title', 'Make Active');
                      }
                  }else{
                      alert('Status not updated successfully');
                  }
            },
            complete:function(){  $('.loading-img').hide();    },
            error:function(){ alert('There was a problem while requesting to change status. Please try again');   }
         });
    }
 });

$('.ableToDelete').click(function(){
        if(confirm('Are you sure ?')){ 
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            var recordId  = id.split('ableToDelete')[1];
            $.ajax({
               url:url,
               type:"POST",
               data:'id='+recordId,
               dataType:'json',
               beforeSend:function(){   $('.loading-img').show();  },
               success:function(response){
                     if(response.status == 'success' && response.recordDeleted == 1){
                         $('#rowId'+recordId).fadeOut();
                     }else{
                         alert('Deletion not successful');
                     }
               },
               complete:function(){  $('.loading-img').hide();   },
               error:function(){ alert('There was a problem while requesting to delete the record. Please try again');   }
            });
        }    
    });

$("#userRoleParent").change(function (){
	var id = $(this).val();
	var url = $(this).attr('url');
	$.ajax({
	   url:url,
	   type:"POST",
	   data:'id='+id,
	   //dataType:'json',
	   //beforeSend:function(){   $('.loading-img').show();  },
	   success:function(response){
			 $("#userRoleChild").html(response);
				var url = $("#userRoleChild").attr('url');
				var allControllerMode = $("#allControllerMode").val();
				var controller = $("#allControllerFilter").val();
				$.ajax({
				   url:url,
				   type:"POST",
				   data:'id='+id+'&controllerMode='+allControllerMode+'&controller='+controller,
				   //dataType:'json',
				   beforeSend:function(){   $('#window_progress').show();  },
				   success:function(response){
						 $("#permissionSectionBody tbody").html(response);
				   },
				   complete:function(){
						$('#window_progress').hide();  
				   },
				   error:function(){ 
						alert('There was a problem while requesting to delete the record. Please try again');   
				   }
				});
	   },
	   complete:function(){
			//$('.loading-img').hide();   
	   },
	   error:function(){ 
			alert('There was a problem while requesting to delete the record. Please try again');   
	   }
	});
});

$("#userRoleChild").click(function (){
	var parentId = $("#userRoleParent").val();
	var childId = $(this).val();
	var controller = $("#allControllerFilter").val();
	var allControllerMode = $("#allControllerMode").val();
	var url = $(this).attr('url');
	$.ajax({
	   url:url,
	   type:"POST",
	   data:'id='+parentId+'&child='+childId+'&controllerMode='+allControllerMode+'&controller='+controller,
	   //dataType:'json',
	   beforeSend:function(){   $('#window_progress').show();  },
	   success:function(response){
			 $("#permissionSectionBody tbody").html(response);
	   },
	   complete:function(){
			$('#window_progress').hide();  
	   },
	   error:function(){ 
			alert('There was a problem while requesting to delete the record. Please try again');   
	   }
	});
});

$("#allControllerMode").change(function (){
	var id = $(this).val();
	var controller = $("#allControllerFilter").val();
	var childRole = $("#userRoleChild").val();
	var parentId = $("#userRoleParent").val();
	var url = $("#userRoleChild").attr('url');
	$.ajax({
	   url:url,
	   type:"POST",
	   data:'controllerMode='+id+'&controller='+controller+'&child='+childRole+'&id='+parentId,
	   //dataType:'json',
	   beforeSend:function(){   $('#window_progress').show();  },
	   success:function(response){
			 $("#permissionSectionBody tbody").html(response);
	   },
	   complete:function(){
			$('#window_progress').hide();  
	   },
	   error:function(){ 
			alert('There was a problem while requesting to delete the record. Please try again');   
	   }
	});
});

$("#allControllerFilter").change(function (){
	var id = $(this).val();
	var mode = $("#allControllerMode").val();
	var childRole = $("#userRoleChild").val();
	var parentId = $("#userRoleParent").val();
	var url = $("#userRoleChild").attr('url');
	$.ajax({
	   url:url,
	   type:"POST",
	   data:'controller='+id+'&controllerMode='+mode+'&child='+childRole+'&id='+parentId,
	   //dataType:'json',
	   beforeSend:function(){   $('#window_progress').show();  },
	   success:function(response){
			 $("#permissionSectionBody tbody").html(response);
	   },
	   complete:function(){
			$('#window_progress').hide();  
	   },
	   error:function(){ 
			alert('There was a problem while requesting to delete the record. Please try again');   
	   }
	});
});

$('.ableToLogoutUser').click(function(){
    if(confirm('This user will be logged out from the moment. Are you sure ?')){ 
         var id = $(this).attr('id');
         var url = $(this).attr('url');
         var recordId  = id.split('ableToLogoutUser')[1];
         $.ajax({
            url:url,
            type:"POST",
            data:'id='+recordId,
            dataType:'json',
            beforeSend:function(){    $('.loading-img').show();    },
            success:function(response){
                  if(response.status == 'success'){
                      if(response.recordLoggedout == 1){
                          $('#'+id+' span').attr('style', 'display:none;');
                          $('#rowId'+recordId).attr('class', 'danger');
                      }
                  }else{
                      alert('User has been logged out successfully');
                  }
            },
            complete:function(){  $('.loading-img').hide();    },
            error:function(){ alert('There was a problem while logging out the user. Please try again');   }
         });
    }
 });













