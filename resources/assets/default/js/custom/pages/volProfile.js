$('.initDatePicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy',
});

$(document).off('click', '.backLocation').on('click', '.backLocation', function(e){
    e.preventDefault();
    history.back()
})

$(document).off('click', '.addPhoneRow').on('click', '.addPhoneRow', function(e){

    e.preventDefault();

    let totalPhoneRows = $('[name = "phone_type[]"]').length;

    if( !canAddPhoneRow(totalPhoneRows) ){

        return toastr.error("Cannot add more rows");

    }

    let phoneRow = `
        
        <div class="form-group m-form__group row no-pd-i" style="padding-bottom: 10px !important">
            <div class="col-lg-5">
                <label for="type">
                    Phone Type
                </label>
                <div class="input-group">
                    <select name="phone_type[]" class="form-control phone-type"></select>
                </div>
            </div>
            <div class="col-lg-7 d-flex justify-content-around align-items-center">
                <div>
                    <label for="">Number</label>
                    <input type="text" class="form-control m-input" 
                           name="number[]" autocomplete="off">
                </div>
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removePhoneRow m-l-10 m-t-25"><i class="la la-times"></i></a>
            </div>
        </div> 

    `.trim();


    $('.contactForm').append(phoneRow);

    $('.phone-type').select2({
        width: "100%",
        placeholder: "Phone Type",
        dropdownParent : $('.contactForm'),
        ajax : {
            url : '/fetch/phoneTypes',
            data : function(term, page){
                 // let selections = $('[name="phone_type[]"]').map(phoneType => $(phoneType).val());
                 let type = $('[name="phone_type[]"]');

                 let selections = [];

                 $(type).each(function(){
                    selections.push(this.value);
                 })

                 return {
                     term, 
                     selectedTypes : JSON.stringify(selections)
                 }
             },
             processResults : function(results){
                console.log({results})
                  return {results : results}
             }
        },
        

    });


});

$(document).off('click', '.removePhoneRow').on('click', '.removePhoneRow', function(e){

    e.preventDefault();

    $(this).closest('.form-group').remove();

});

function canAddPhoneRow(count){
    
    return count > 3 ? false : true;

}

$(document).off('click', '#updatePersonalInfo').on('click', '#updatePersonalInfo', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updatePersonalInfo/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;

            validationError($('#'+form), errors);    
        }else{
            toastr.error("Please contact for support");
        }

    })

});

function validationError(form, errors){ 

    clearValidationHighlights(form);   

    for(let key in errors){

        form.find(`[name = "${key}"]`).css("border-color", "#b12704");

    }

}

function clearValidationHighlights(form){
    form.find(`input`).css("border-color", "#ddd");
}

$(document).off('click', '#submitEmergencyContact').on('click', '#submitEmergencyContact', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/emergencyContact/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;

            validationError($('#'+form), errors);    
        }

    })

});


$(document).off('click', '#updateEmergencyContact').on('click', '#updateEmergencyContact', function(e){

    e.preventDefault();

    let emergencyContactId = $(this).data('id');

    let volunteer_id = $(this).data('related-vol-id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateEmergencyContact/'+emergencyContactId,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);    
        }

    })

});


$(document).off('click', '#updateHrBasic').on('click', '#updateHrBasic', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateHrBasic/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);    
        }

    })

});

$(document).off('click', '#updateHrDetails').on('click', '#updateHrDetails', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateHrDetails/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);
        }

    })

});

$(document).off('click', '#updateVolRemarks').on('click', '#updateVolRemarks', function(e){
    e.preventDefault();
    let volDeactivate = $(this).data('id')

    let volunteer_id = $(this).data('vol-id')
    
    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateVolRemarks/'+volDeactivate,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    });
})


$(document).off('click', '#addVolunteerFiles').on('click', '#addVolunteerFiles', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = new FormData($('#'+form)[0]);

    sendAjax({
        url : '/updatedProfile/uploadDocs/'+volunteer_id,
        data,
        method : "post",
        loader:true,
        processData : false,
        contentType : false
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    })

});

$(document).off('click', '.viewVolFile').on('click','.viewVolFile', function(e){
    let file = $(this).attr('data-file');
    window.open('/updatedProfile/viewDocs/'+file);
})

$(document).off('click', '.downloadVolFile').on('click','.downloadVolFile' , function(e){
    let file = $(this).attr('data-file');
    window.open('/updatedProfile/downloadDocs/'+file);
})



$(document).off('change', '#deActiveVol').on('change','#deActiveVol', function(e){

    let isChecked = $(this).prop('checked');

    if(isChecked){

        $('.deactivationDetails').slideDown();

    }else{

        $('.deactivationDetails').slideUp();

    }

});

$(document).off('click', '.unassignFromVol').on('click', '.unassignFromVol', function(e){

    e.preventDefault();

    let unassignType = $(this).attr('data-type');
    let id = $(this).attr('data-id')
    let volunteer_id = $(this).attr('data-vol-id')

    const self = $(this)

    function unassignFromVol(type){

        let url = '/';

        if(type == "supervisor"){

            url = `/updatedProfile/unassignSupervisorFromVol/`;                

        }else{

            url = `/updatedProfile/unassignSiteFromVol/`;

        }

        return url;


    }

    let unassignUrl = unassignFromVol(unassignType);

    confirmAction({

        "message" : `Are you sure you want to unassign this ${unassignType}?`,
        "action"   : "Ok",
        "btn" : "btn-danger",
        ajax : {
            url : unassignUrl+volunteer_id+'/'+id,
            success:function(){
                self.closest('tr').remove();

                toastr.success("Successfully unassigned")
            }
        }
    })
  

});


$(document).off('click', '.removeTemplate').on('click', '.removeTemplate', function(e){

    let template_id = $(this).attr('data-template-id')

    const self = $(this)

    confirmAction({

        "message" : " Are you sure you want to delete this timesheet?",
        "action"   : "Ok",
        "btn" : "btn-danger",
        ajax : {
            url : '/updatedProfile/removeTemplate/'+template_id,
            success:function(){
                toastr.success("Template Successfully Removed")
                self.closest('tr').remove();
            }
        }
    })

});

$(document).off('click', '.setHomeSite').on('click', '.setHomeSite', function(e){

    e.preventDefault();

    let site = $(this).attr('data-site-id')

    let volunteer = $(this).attr('data-volunteer-id')

    sendAjax({
        url : '/updatedProfile/setHomeSite/'+volunteer+"/"+site,
        method : "get",
        loader:true,
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer
        });
    })

});

$(document).off('click', '.setDefaultTemplate').on('click', '.setDefaultTemplate', function(e){

    e.preventDefault();

    let template = $(this).attr('data-template-id');

    let volunteer = $(this).attr('data-volunteer-id');

    sendAjax({
        url : '/updatedProfile/setDefaultTemplate/'+volunteer+"/"+template,
        method : "get",
        loader:true,
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer
        });
    })

});

