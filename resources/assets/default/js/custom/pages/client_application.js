//== Class definition
var CitizenWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#clientWizard');
    var formEl = $('#client_applicationForm');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#clientWizard').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    applicationWizard.on('beforeNext', function (applicationWizard) {
        ajaxRequest({
            url: "/client_application/getApplicationValidation",
            method: formEl.attr("method"),
            form: 'client_applicationForm'
        }, function (response) {
            processFormCustom(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();

        // Owner Eligilibily
        if (applicationWizard.currentStep == 1) {
            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
        }

        /**
         * 1. Pet Validation Process begin at this step
         * 2. List Pet on Summary
         */
        if (applicationWizard.currentStep == 2) {

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

        }
        else{
            $('#onlyForPetCitizenValidation').removeClass('pet_validation');
        }

    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#client_applicationForm').on('keypress', '#client_applicationForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

/*
 * Application Form Create For Client
 */
$(document).off('submit', '#client_applicationForm').on('submit', '#client_applicationForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'client_applicationForm'
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
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                    routes.executeRoute('application/{id}', {
                        url: 'client_applicationSingle/'+response.data[0].element.app_id
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
$(document).off('click', '#client_applicationForm *[rel=getExtraUpload]').on('click', '#client_applicationForm *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#client_applicationForm #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#client_applicationForm .extra-upload').length > 4) {
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

    $("#client_applicationForm #extraUploadSection").after(uploadHTML);

    index++;
});
