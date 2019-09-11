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
var NonProfitWizard = function () {
    //== Base elements
    var wizardEl = $('#addNPWizard');
    var formEl = $('#npForm');
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
            url: "/organization/getOrganizationValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormCustom(response);
        });
    })

    $(document).off('click', "#addNPWizard [data-wizard-target='#m_wizard_form_step_4']").on('click', "#addNPWizard [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getVetValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormCustom(response);
        });
    });
};

/* ---------------------------
    Add New Vet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    template = null,
    appendDiv = null;
    provider_i = 1;
$(document).off('click', '#addNewVet').on('click', '#addNewVet', function (e) {

    var self = $(this);
    if(provider_i < 5){
            var request = {
            url: 'organization/addNewVet/'+provider_i,
            method: 'get'
        }

        ajaxRequest(request, function(response){
            appendDiv = $("#m_pet_accordion");

            if (appendDiv.find('.m-accordion').length > 3) {
                if (petCount >= 5) {
                    petCount = 2;
                }
                return toastr.error('Can\'t add more than 5');
            }

            prepareDynamicAccordion(templateId);
            $(".m-accordion").find('.collapse').removeClass('show');
            appendDiv.append(response.data);
            appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

            templateId++;
            petCount++;
        });
        provider_i++;
    }else{
        return toastr.error('Can\'t add more than 5');
    }

});

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
var npForm = "npForm";
$(document).off('submit', '#' + npForm).on('submit', '#' + npForm, function (e) {
    e.preventDefault();
        var self = this;


    addFormLoader();
        ajaxRequest({
            url: self.action,
            method: self.method,
            form: 'npForm'
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


function loadNpPets(id) {
    if (!id) {
        id = 30;
    }
    $('#npPetsTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/getNpPet/' + id,
                    method: 'GET'
                },
            },
            pageSize: 5,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // column sorting
        sortable: true,

        pagination: true,

        toolbar: {
            // toolbar items
            items: {
                // pagination
                pagination: {
                    // page size select
                    pageSizeSelect: [5, 10, 20, 30, 50, 100],
                },
            },
        },

        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--brand',
            scroll: false,
            height: 200,
        },

        // columns definition
        columns: [{
            field: 'ApplicationId',
            title: '#',
            sortable: false,
            width: 40,
            textAlign: 'center',
            selector: {class: 'm-checkbox--solid m-checkbox--brand'},
        },
            {
                field: 'pet_name',
                title: 'Pet Name',
                sortable: 'asc',
                width: 200,
                template: function (data) {
                    return '<div class="m-card-user m-card-user--sm">\
                                <div class="m-card-user__pic">\
                                    <img src="https://www.marshallspetzone.com/blog/wp-content/uploads/2017/01/golden-retriever1.jpg" class="m--img-rounded m--marginless" alt="photo">\
                                </div>\
                                <div class="m-card-user__details">\
                                    <span class="m-card-user__name">' + data.pet_name + '</span>\
                                </div>\
                            </div>';
                }
            },
            {
                field: 'species',
                title: 'Species',
                width: 150
            },
            {
                field: 'breed',
                title: 'Breed',
                width: 150
            },
            {
                field: 'color',
                title: 'Color',
                width: 100
            },
            {
                field: 'weight',
                title: 'Weight',
                template: function (row) {
                    return row.weight + ' KG';
                }
            },
            {
                field: 'age_type',
                title: 'Age Type',
            },
            {
                field: 'age_of_pet',
                title: 'Age',
            },
            {
                field: 'unique_traits',
                title: 'Unique Traits',
            },
            {
                field: 'comments',
                title: 'Comments',
            },
            {
                field: 'fname',
                title: 'Client',
                template: function (row) {
                    return row.title + ' ' + row.fname + ' ' + row.lname;
                },
            }]
    });
}

function orgZipLoaded(id) {
    var zip = $('#zip').val();
    ajaxRequest({
        url: 'zip_code/' + id
    }, function (response) {
        if (response && response.data) {
            $("#npForm *[name=state]").val(response.data.state);
            $("#npForm *[name=zip]").val(response.data.zip_code);
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


$("*[rel=cell_phone], *[rel=alt_phone]").inputmask("mask", {
    "mask": "(999) 999-9999"
});

function setVetName() {
    var title = $('input[rel=person_title]').val().length ? $('input[rel=person_title]').val() + ' ' : '';
    var fname = $('input[rel=firstName]').val().length ? $('input[rel=firstName]').val() + ' ' : '';
    var mname = $('input[rel=midName]').val().length ? $('input[rel=midName]').val() + ' ' : '';
    var lname = $(lastName).val().length ? $(lastName).val() : '';

    $(".vetName").text("");
    if (title.length) {
        var legalName = title + fname + mname + lname;
        $(".vetName").text(legalName);
    }
}

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#npForm').on('keypress', '#npForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});