/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

// Dropzone configuration
Dropzone.autoDiscover = false;

//== Class definition
var RescueWizard = function () {
    //== Base elements
    //== Base elements
    var wizardEl = $('#addRescueWizard');
    var formEl = $('#rescueForm');
    var validator;
    var wizard;


    //== Initialize form wizard
    wizard = wizardEl.mWizard({
        startStep: 1
    });

    //== Validation before going to next page
    wizard.on('beforeNext', function (wizard) {
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getRescueValidation",
            method: formEl.attr("method"),
            form: 'rescueForm'
        }, function (response) {
            processFormCustom(response);
        });
    })
};


/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name=pet_type]').on('change', 'select[name=pet_type]', function (e) {
    var self = $(this),
        selected = self.val().trim();

    switch (selected) {
        case 'dog':
            self.closest('.m-accordion__item').find(petIconClass).html(dogIcon);
            break;
        case 'cat':
            self.closest('.m-accordion__item').find(petIconClass).html(catIcon);
            break;
        default:
            break;
    }
});

/**
 * Application Form
 */
var rescueForm = "rescueForm";
$(document).off('submit', '#' + rescueForm).on('submit', '#' + rescueForm, function (e) {
    e.preventDefault();
        var self = this;


    addFormLoader();
        ajaxRequest({
            url: self.action,
            method: self.method,
            form: 'rescueForm'
        }, function (response) {
            removeFormLoader();
            processForm(response, function () {

                // reloadDatatable('.m_datatable');
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('org_id')){
                    routes.executeRoute('org/single/{id}', {
                        url: 'org/single/'+response.data[0].element.org_id
                    });
                }

            });
        });

});



function orgZipLoaded(id) {
    var zip = $('#zip').val();
    ajaxRequest({
        url: 'zip_code/' + id
    }, function (response) {
        if (response && response.data) {
            $("#rescueForm *[name=state]").val(response.data.state);
            $("#rescueForm *[name=zip]").val(response.data.zip_code);
        }
    })
}

/**
 * Set Vet Name
 */
var lastName = 'input[rel=lastName]';


    $(document).off('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
        .on('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
            setVetName();
    });



/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#rescueForm').on('keypress', '#rescueForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});