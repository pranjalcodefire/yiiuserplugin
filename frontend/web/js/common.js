$('.datepicker').datepicker({dateFormat:"dd-mm-yy"});
$('.ableToDeleteMyAccount').click(function(){
        if(confirm('This will delete all your user activity on the site. Are you sure to delete your account?')){ 
            var url = $(this).attr('url');
            $.ajax({
               url:url,
               type:"POST",
               dataType:'json',
               beforeSend:function(){   $('.loading-img').show();  },
               success:function(response){
                     if(response.status == 'success'){
                        window.location = response.redirectUrl;
                     }else{
                         alert('Deletion not successful');
                     }
               },
               complete:function(){  $('.loading-img').hide();   },
               error:function(){ alert('There was a problem while requesting to delete your account. Please try again');   }
            });
        }    
    });

