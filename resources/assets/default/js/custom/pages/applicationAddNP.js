//== Class definition
$(".nonProfit").val('').trigger('input');
var ApplicationNPWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddPage');
    var formEl = $('#applicationFormNP');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddPage').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    $(".nonProfit").val('').trigger('input');
    applicationWizard.goFirst();
    loadNpPets();
    initAutoSize();
    uploadFiles();
    applicationWizard.on('beforeNext', function(applicationWizard){
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: 'post',
            form: 'applicationFormNP'
        }, function (response) {
            processFormPage(response);
        });
    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#applicationFormNP').on('keypress', '#applicationFormNP', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});


/*
 * Application Form Create For Client
 */
$(document).off('submit', '#applicationFormNP').on('submit', '#applicationFormNP', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationFormNP'
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
$(document).off('click', '#applicationFormNP *[rel=getExtraUpload]').on('click', '#applicationFormNP *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#applicationFormNP #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#applicationFormNP .extra-upload').length > 4) {
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

    $("#applicationFormNP #extraUploadSection").after(uploadHTML);

    index++;
});

/* ---------------------------
    Add New Pet Accordian
------------------------------*/
var const_np_i = 1;
$(document).off('click', '.addNewPetPage').on('click', '.addNewPetPage', function (e) {
    var self = $(this);
    var url = self.data('url');
    if(const_np_i < 5){
        var request = {
            url: url+'/'+const_np_i,
            method: 'get'
        }

        addFormLoader();
        ajaxRequest(request, function (response) {
            removeFormLoader();
            $(".m-accordion").find('.collapse').removeClass('show');
            $('#append_pet_from_page').append(response.data);
        });
        const_np_i++;
    }else{
        return toastr.error('Can\'t add more than 5');
    }
});
$(document).off('click', '.removePetFormPage').on('click', '.removePetFormPage', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.m-accordion').remove();
    const_np_i = const_np_i-1;
})


$(document).off('click', '.selectNpPage').on('click', '.selectNpPage', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var text = $(this).text();
    if (text != 'Selected') {
        addFormLoader();
        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {
            removeFormLoader();
            if (response.data) {
                $('#loadSelectedNpVets').html('');
                $.each(response.data, function (index, value) {
                    if (value.address != null)
                        add3 = value.address.add1 + '\n' +
                            value.address.add2 + '\n' +
                            value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                    else
                        add3 = "";
                    var markup = '<div class="m-widget4__item choose-provider full-width">\n' +
                        '<label class="m-radio">\n' +
                        '<input type="radio" class="selectVet" value="' + value.id + '" name="vet_id">\n' +
                        '                                <div class="m-widget4__info no-pd-i">\n' +
                        '                                    <label class="m-widget4__title">\n' +
                        value.fname.ucfirst() + ' ' + value.lname.ucfirst() +
                        '                                    </label>\n' +
                        '                                    <br>\n' +
                        '                                    <span class="m-widget4__sub">\n' +
                        add3 +
                        '                                    </span>\n' +
                        '                                </div>\n' +
                        '<span></span>\n' +
                        '</label>\n' +
                        '                            </div>';
                    $('#loadSelectedNpVets').append(markup);
                });
                $(".selectedNPVetHolder").removeClass('hidden');
            }
        });
        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#NP_ID').val($(this).attr('data-id'));
        $(document).find('.selectNpPage').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedNPVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#NP_ID').val();
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectNpPage').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});