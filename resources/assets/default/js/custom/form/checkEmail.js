$(document).off('blur', 'input[rel=email]').on('blur', 'input[rel=email]', function(e){
   e.preventDefault();
   var self = $(this);
   var email = $(this).val();
   var oldEmail = $(this).data('email');
   // if(email === oldEmail){
      if(email){
          ajaxRequest({
          url: 'checkEmail?email='+email,
          cancelPrevious: true,
          method: 'get',
         }, function(response){
              if(response.hasOwnProperty('data') && response.data != "not"){
                $('.btnsubModal').attr('data-sub-modal-route', 'getEmailInfo/'+response.data);
                $('.btnsubModal').trigger('click');
              }else{
                $('#emailExistOnly').text('');
              }
          });
     }
   // }
});

$(document).off('blur', 'input[rel=company_email]').on('blur', 'input[rel=company_email]', function(e){
   e.preventDefault();
   var email = $(this).val();
   var parent = $(this).closest('.modal.show').attr('data-modal-id');
   if(email){
        ajaxRequest({
        url: 'checkOrgEmail?email='+email,
        cancelPrevious: true,
        method: 'get',
       }, function(response){
            if(response.hasOwnProperty('data') && response.data != "false" &&response.data.hasOwnProperty('id')){
                $('#applicationNpCreateModal').modal('hide');
                $('#btnsubModal').attr('data-sub-modal-route', 'getOrgInfo/'+response.data.id);
                $('#btnsubModal').trigger('click');
            }else{
                $('#emailExistOnly').text('');
              }
        });
   }
});

function showPrevModal() {
    $('#applicationCreateModal').modal('show');
}


$(document).off('blur', 'input[rel=siteEmail]').on('blur', 'input[rel=siteEmail]', function(e){
    e.preventDefault();
    var self = $(this);
    var email = $(this).val();
    var oldEmail = $(this).data('email');
    // if(email === oldEmail){
    if(email){
        ajaxRequest({
            url: 'checkSiteEmail?email='+email,
            cancelPrevious: true,
            method: 'get',
        }, function(response){
            if(response.hasOwnProperty('data') && response.data != "not"){
                $('.btnsubModal').attr('data-sub-modal-route', 'getSiteEmailInfo/'+response.data);
                $('.btnsubModal').trigger('click');
            }else if(response.data == "not"){
                 $('p#email_exists').hide();
                $('#saveSite').show();
            }
            else{
                $('#emailExistOnly').text('');
               
            }
        });
    }
    // }
});

