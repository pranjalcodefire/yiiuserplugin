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


