//== Class definition
var ApplicationCitizenWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddPage');
    var formEl = $('#applicationFormCitizen');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddPage').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    applicationWizard.on('beforeNext', function (applicationWizard) {
        ajaxRequest({
            url: "/application/getApplicationValidation",
            method: formEl.attr("method"),
            form: 'applicationFormCitizen'
        }, function (response) {
            processFormPage(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();
        if ($("#legalName") && $("#legalName").val().length) {
            $('.application-form-summary-list').removeClass('hidden');
            $(".eligiliblity").removeClass('hidden');
        }

        if (applicationWizard.currentStep == 1){
            $("#petSummaryList").addClass('hidden');
            $(".application-form-summary-list").addClass('hidden');
        }

        // Owner Eligilibily
        if (applicationWizard.currentStep == 2) {
            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
            if ($("#legalName") && $("#legalName").val().length) {
                $('#app_summary_header').text($("#legalName").val());
                $('#clientEmail').text($("input[rel=personal_email]").val());
            }
        }

        /**
         * 1. Pet Validation Process begin at this step
         * 2. List Pet on Summary
         */
        if (applicationWizard.currentStep == 4) {

            /**
             * Get Pet Details
             */

            var petInfoHtml = '';
            $('#contentHolder .petInformation[id!=""]').each(function(index, element){
                var petName = $(this).find('.petName').text();
                var breed   = $(this).find('.breeds').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                var species = $(this).find('.species').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                petInfoHtml += '<li class="decimal-list-style">'+petName+' / '+breed+' / '+species+'</li>';
            });

            $("#petSummaryList").removeClass('hidden').find('ul').html(petInfoHtml);

            /**
             * Pet Validation
             */
            $('#onlyForPetCitizenValidation').addClass('pet_validation');
            $(document).off('click', '.pet_validation').on('click', '.pet_validation', function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });

        }
        else{
            $('#onlyForPetCitizenValidation').removeClass('pet_validation');
        }

        $(document).off('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_4']").on('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });
        $(document).off('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_5']").on('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_5']", function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });
    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#applicationFormCitizen').on('keypress', '#applicationFormCitizen', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

function citySelectedCitizen(id) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $("#applicationFormCitizen *[name=state]").val(response.data[0].state);
            $("#applicationFormCitizen *[name=zip]").val(response.data[0].zip_code);
        }
    })
}

/*
 * Application Form Create For Client
 */
$(document).off('submit', '#applicationFormCitizen').on('submit', '#applicationFormCitizen', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationFormCitizen'
    }, function (response) {
        processFormPage(response, function () {
            removeFormLoader();
            /**
             * After Inserted Successfully Reset Form
             */
            if(response && response.status === 200) {
                $("#commLists, #federalLists, #stateLists").html('');
                $('#contentHolder .application-form-summary-list').addClass('hidden');
                $('#contentHolder .dynamicShownImages').remove();
                /**
                 * File Upload Section
                 */
                var initFileUploadInfo = '<h3 class="m-dropzone__msg-title">\
                                               Drop a file here or click to upload\
                                            </h3>\
                                            <span class="m-dropzone__msg-desc">\
                                                Maximum upload size:\
                                                <strong>\
                                                    8.39 MB\
                                                </strong>\
                                            </span>';

                $('#contentHolder .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
                $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

                // Reset Selected Sp
                $(".serviceProviderL").val('').trigger('keyup');
                $('#loadSelectedSpNp').empty();
                $('.selectedServiceProviderVetHolder').addClass('hidden');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Citizan').html('');
                document.getElementById(applicationForm).reset();
                // reloadDatatable('.m_datatable');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                    routes.executeRoute('application/{id}', {
                        url: 'application/'+response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '#applicationFormCitizen *[rel=getExtraUpload]').on('click', '#applicationFormCitizen *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#applicationFormCitizen #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#applicationFormCitizen .extra-upload').length > 4) {
        return toastr.error('Can\'t add more than 5 upload Section');
    }

    var uploadId = 'upload_' + index;
    var uploadHTML = '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 m-b-20">\
                        <input type="text" class="form-control form-control-sm m-b-15 extra-upload no-m-left" name="extraFiles[]" placeholder="Type Your Document Name" value="">\
                        <label class="m-dropzone dropzone ApplicationFiles full-width p-rel" for="' + uploadId + '">\
                        <input type="file" class="hidden uploadApplicationFiles" name="addinationalPhotos[]" id="' + uploadId + '">\
                            <div class="m-dropzone__msg dz-message needsclick fileDetail">\
                                <h3 class="m-dropzone__msg-title">\
                                   Drop a file here or click to upload\
                                </h3>\
                                <span class="m-dropzone__msg-desc">\
                                    Maximum upload size:\
                                    <strong>\
                                        8.39MB\
                                    </strong>\
                                </span>\
                            </div>\
                        </label>\
                    </div>';

    $("#applicationFormCitizen #extraUploadSection").after(uploadHTML);

    index++;
});
