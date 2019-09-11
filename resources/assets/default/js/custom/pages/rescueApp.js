//== Class definition
var RescueApplicationWizard = function () {
    //== Base elements
    var rescueAppWizard = $('#rescueAppWizard');
    var formEl = $('#rescueAddForm');
    var validator;
    var applicationRescueWizard = '';

    applicationRescueWizard = $('#rescueAppWizard').mWizard({
        startStep: 1
    });
    applicationRescueWizard.goFirst();
    initAutoSize();
    uploadFiles();
    //== Validation before going to next page
    applicationRescueWizard.on('beforeNext', function (applicationRescueWizard) {
        ajaxRequest({
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'rescueAddForm'
        }, function (response) {
            processForm(response);
        });
    });
};

/*
    Application create form for NP From Service Provider Login
 */
$(document).off('submit', '#rescueAddForm').on('submit', '#rescueAddForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['pet', 'application', 'file']);

    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'rescueAddForm'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * File Upload Section
             */
            document.getElementById("rescueAddForm").reset();
            // reloadDatatable('.m_datatable');
            if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                routes.executeRoute('application/{id}', {
                    url: 'application/'+response.data[0].element.app_id
                });
            }
        });
    });
});

var rescue_i = 1;
$(document).off('click', '.addNewPetRescue').on('click', '.addNewPetRescue', function(e){
    var self = $(this);
    if(rescue_i < 5){
        var accordionLength=$('#newPet_Template_Append_Rescue').children().length;
        rescue_i=accordionLength+1;
        addFormLoader();
        ajaxRequest(
        {
            url: 'rescueAddTreatments/'+rescue_i,
            method: 'get'
        }, function(response){
            $(".m-accordion").find('.collapse').removeClass('show');
            $('#newPet_Template_Append_Rescue').append(response.data);
        });
        rescue_i++;
    }else{
         return toastr.error('Can\'t add more than 5 pets');
    }
});
$(document).off('click','.removeAccordion').on('click','.removeAccordion', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.m-accordion').remove();
    rescue_i = rescue_i-1;
});