

// Dropzone configuration
Dropzone.autoDiscover = false;

function loadIETable(dataQuery='') {
    var appOpenData = [{name: $('#applicationIDFilter').attr('name'), value: $('#applicationIDFilter').val()}, {name: $('#applicationSourceFiltertest').attr('name'), value: $('#applicationSourceFiltertest').val()}, {name: $('#applicationStatusFilter').attr('name'), value: $('#applicationStatusFilter').val()}];
    var ieTable = $('#applicationTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/application/all',
                    method: 'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    params: {
                        // custom parameters
                        query: {
                            // 'status': [
                            //     'New', 'Pending', 'Review',
                            // ],
                        }
                    },
                },
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            theme: 'default',
            scroll: false,
            footer: false
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
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },

        search: {
            input: $('#generalSearch'),
        },

        rows: {
            autoHide: true,
            afterTemplate: function (row, data, index) {
                $('tbody .m-datatable__row').first().addClass('active_row');
            },
        },

        // columns definition
        columns: [
            {
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                width: 80,
                template: function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'id',
                title: 'ID',
                width: 80,
                template: function (row) {
                    if (std.config.alt_id == 'true' && row.alt_id) {
                        return 'IE' + row.alt_id.toString().padStart(5, '0');
                    }
                    return row.id;
                }
            },

            {
                field: 'org_id',
                title: 'Type',
                sortable: true,
                width: 50,
                template: function (row) {
                    if (row.org_id) {
                        if (row.org_id != row.providerId)
                            return 'Rescue';
                        else
                            return 'NP';
                    }
                    else {
                        return 'IE';
                    }

                }
            },
            {
                field: 'fname',
                title: 'Owner/Care Taker',
                sortable: false,
                width: 190,
                template: function (row) {
                    if (row.fname == null) {
                        return '';
                    }
                    if (row.mname != null)
                        return row.fname.ucfirst() + ' ' + row.mname.ucfirst() + ' ' + row.lname.ucfirst();
                    else
                        return row.fname.ucfirst() + ' ' + row.lname.ucfirst();
                },
            },
            {
                field: 'no_of_pet',
                title: 'Total Pets',
                width: 80
            },
            {
                field: 'service_provider',
                title: 'Service Provider',
                sortable: false,
                width: 200,
                template: function (row) {
                    if (row.service_provider == null)
                        return '<span class="m-badge m-badge--danger m-badge--wide c-p">Not assigned</span>';

                    else
                        return row.service_provider.ucfirst();
                }
            },
            {
                field: 'inv_amt',
                title: 'Inv Amt.',
                sortable: false,
                width: 100,
                textAlign: 'right',
                template: function (row) {
                    if (row.inv_amt)
                        return '$' + row.inv_amt.toFixed(2);
                    else
                        return '';
                }
            },
            {
                field: 'status',
                title: 'Status',
                width: 140,
                template: function (row) {
                    if (!row.status) {
                        return '<span class="m-badge  m-badge--info m-badge--wide c-p">New</span>';
                    }
                    if (row.status == 'New') {
                        var type = 'm-badge--info newStatus';

                    } else if (row.status == 'Pending') {
                        var type = 'm-badge--warning';
                    } else if (row.status == 'Approved') {
                        var type = 'm-badge--success';
                    } else if (row.status == 'Invoiced') {
                        var type = 'm-badge--warning';
                    }else if (row.status == 'Review') {
                        var type = 'm-badge--primary';
                    }
                    else {
                        var type = 'm-badge--danger';
                    }
                    return '<span class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                }
            },
            {
                field: 'source',
                title: 'Source',
                width: 100,
                template: function (row) {
                    if (row.source) {
                        return '<h6>' + row.source + '</h6>'
                    }
                    return '';
                },
            },
            {
                field: 'action',
                title: 'Action',
                width: 80,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" \
                            data-route="application/' + row.id + '" title="View Application">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';

                    if(row.source && (row.source=='FixedAndFab' || row.source=='WebSite' || row.source=='FF') && row.is_provider_view!=1)
                    {
                        btn+='&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" ' +
                            'data-modal-title=" Delete Application" data-modal-route="/application/delete/'+row.id+'" data-modal-type="delete">' +
                            '<i class="la la-trash"></i></button>'
                    }

                    return btn;
                },
            },]
    });

    ieTable.on('m-datatable--on-init', function (e) {
        $('.newStatus').closest('tr').addClass('newStatus');
    });

    $('#applicationIDFilter').on('blur', function(e){
        ieTable.search($(this).val(), 'applicationID');
        appOpenData.splice(0, 1, {name: 'applicationID', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationSourceFiltertest').off('change').on('change', function () {
        $('#applicationStatusFilter_advance').selectpicker('val',$(this).val());
        $(this).selectpicker('val',$(this).val());
        ieTable.search($(this).val(), 'source');
        appOpenData.splice(1, 1,{name: 'source', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationStatusFilter').off('change').on('change', function () {
        $(this).selectpicker('val',$(this).val());
        $('#applicationStatusFilter_advance').selectpicker('val',$(this).val());
        ieTable.search($(this).val(), 'status');
        appOpenData.splice(2, 1, {name: 'status', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationStatusFilter_advance').off('change').on('change', function () {
        $(this).selectpicker('val',$(this).val());
        $('#applicationStatusFilter').selectpicker('val',$(this).val());
    });

    $('#applicationTypeFilter').off('change').on('change', function () {
        ieTable.search($(this).val(), 'type');
        appOpenData.push({name: $(this).attr('name'), value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
        $(this).selectpicker('val', $(this).val());
    });

    $('#applicationSsnFilter').off('blur').on('blur', function () {
        ieTable.search($(this).val(), 'ssn');
    });
    $('#applicationDateFilter').off('blur').on('blur', function () {
        ieTable.search($(this).val(), 'dateRange');
    });
    $('#m_application_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        ieTable.search(dateRange, 'dateRange');
    });

    $(document).off('click', '.submitAppFilter').on('click', '.submitAppFilter', function (e) {
        var id = $(this).attr('data-target');
        data = $('#'+id).serializeArray();
        setCookie('application',JSON.stringify(data));
        ieTable.search(data, 'advancedFilter');
        $('#showApplicationAdvanceSearch').trigger('click');
    });

    $(document).off('click', '#appQuickButton').on('click', '#appQuickButton', function (e) {
        var id = $(this).attr('data-target');
        data = $('#'+id).serializeArray();
        ieTable.search(data, 'advancedFilter');
    });

}


//== Class definition
var ApplicationWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddWizard');
    var formEl = $('#applicationForm');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddWizard').mWizard({
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
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();
        if ($("#legalName") && $("#legalName").val().length) {
            $('.application-form-summary-list').removeClass('hidden');
            $(".eligiliblity").removeClass('hidden');
        }

        if (applicationWizard.currentStep == 1) {
            $("#petSummaryList").addClass('hidden');
            $(".application-form-summary-list").addClass('hidden');
        }

        // Owner Eligilibily
        if (applicationWizard.currentStep == 2) {
            $('#commLists').html('');
            $.each($('input.getComunicationPreference[data-checked]'), function (index, val) {
                var val = '<span title="' + $(this).next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
                    '<i class="la la-check fs-12"></i> &nbsp;' + $(this).next('p').text() + '</span>';
                $('#commLists').append(val);
            });


            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
            if ($("#legalName") && $("#legalName").val().length) {
                $('#app_summary_header').text($("#legalName").val());
                $('#clientEmail').removeClass('m-widget4__sub');
                $('#clientEmail').addClass('m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow');
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
            $('#applicationCreateModal .petInformation[id!=""]').each(function (index, element) {
                var petName = $(this).find('.petName').text();
                var breed = $(this).find('.breeds').clone().children()
                    .remove()
                    .end()
                    .text().trim();
                var species = $(this).find('.species').clone().children()
                    .remove()
                    .end()
                    .text().trim();
                petInfoHtml += '<li class="decimal-list-style">' + petName + ' / ' + species + ' / ' + breed + '</li>';
            });

            $("#petSummaryList").removeClass('hidden').find('ul').html(petInfoHtml);

            /**
             * Pet Validation
             */
            $('#onlyForPetValidation').addClass('pet_validation');
            $(document).off('click', '.pet_validation').on('click', '.pet_validation', function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationForm'
                }, function (response) {
                    processForm(response);
                });
            });
        }
        else {
            $('#onlyForPetValidation').removeClass('pet_validation');
        }
    });
    $(document).off('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_4']").on('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });
    $(document).off('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_5']").on('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_5']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });
};

/**
 * Application DataTable
 */
var ApplicationTable = function () {

    var applicationDataTable = function (id) {
        var datatable = $('#application_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/application/pets/' + id,
                        method: 'GET'
                    },
                },
                pageSize: 10,
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
                        pageSizeSelect: [10, 20, 30, 50, 100],
                    },
                },
            },

            search: {
                input: $('#generalSearch'),
            },

            rows: {
                // auto hide columns, if rows overflow
                autoHide: false,
            },

            // columns definition
            columns: [
                {
                    field: 'pet_name',
                    title: 'Pet Name',

                },

                {
                    field: 'species',
                    title: 'species',
                },
                {
                    field: 'breed',
                    title: 'Breed',
                },
                {
                    field: 'color',
                    title: 'Color',
                },

                {
                    field: 'action',
                    title: 'Action',
                    width: 130,
                    sortable: false,
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' onclick=showModal("/pet/edit/' + row.id + '")>' +
                            '<i class="fa fa-edit"></i>' +
                            '</button> &nbsp;' +
                            ' <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' onclick=showModal("/pet/delete/' + row.id + '")>' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>';
                    },
                },
            ]
        });

    };

    return {
        // public functions
        init: function (id) {
            applicationDataTable(id);
        },
    };
}();

/**
 * Application Input Mask
 */
$("input[name=cell_phone], input[name=alt_phone], input[name=phone]").inputmask("mask", {
    "mask": "(999) 999-9999"
});


/**
 * application pet species bredd lookup change
 */
$(document).off('change', '.speciesName').on('change', '.speciesName', function () {
    $('.breed').attr('data-lookup', '/breed/getPetData/' + $(this).val())
});

/**
 * Modal Event
 */
$(document).off('click', '#SubmitPet').on('click', '#SubmitPet', function (e) {
    var data = arrangeData(['client', 'pet', 'application']);
    var request = {
        url: '/application/store',
        method: 'post',
        data: data
    };
    ajaxRequest(request, function (response) {
        processForm(response, function () {
            reloadDatatable('.m_datatable');
        });
    });
});

/**
 * Application Form
 */


var applicationForm = "applicationForm";

$(document).off('keypress', 'input[name=vol_ssn]').on('keypress', 'input[name=vol_ssn]', function (e) {
    if ($(this).val().length > 7) {
        e.preventDefault();
    }
});

/**
 * Comunication Preferences Focus
 */
$(document).off('focusin', '.getComunicationPreference').on('focusin', '.getComunicationPreference', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).siblings('span').addClass('showFocus');
    $(this).closest('.m-portlet').css({
        'margin': -1,
        'border': '1px solid #36a3f7'
    });
});

$(document).off('focusout', '.getComunicationPreference').on('focusout', '.getComunicationPreference', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).closest('.m-portlet').removeAttr('style');
});

/**
 * Comunication Preferences Focus
 */
$(document).off('focusin', '.eligibilityFocus').on('focusin', '.eligibilityFocus', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).siblings('span').addClass('showFocus');
    $(this).closest('.m-portlet').css({
        'margin': '15px -1px -1px -1px',
        'border': '1px solid #36a3f7'
    });
});

$(document).off('focusout', '.eligibilityFocus').on('focusout', '.eligibilityFocus', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).closest('.m-portlet').removeAttr('style');
});


/**
 * Client Summary Events
 */
var checked_pref = [];
var index_pref = 0;
$(document).off('change', 'input.getComunicationPreference').on('change', 'input.getComunicationPreference', function (e) {
    var self = $(this);

    if (!$('.getComunicationPreference[data-checked]').length) {
        checked_pref = [];
    }

    if (self.prop('checked')) {

        self.val(1);
        if (!checked_pref['comunication_preferences']) {
            checked_pref['comunication_preferences'] = [];
        }

        self.attr('data-checked', index_pref);

        var t = '<span title="' + self.next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.next('p').text() + '</span>';
        checked_pref['comunication_preferences'][index_pref] = t;
        index_pref++;

    } else {
        if (checked_pref['comunication_preferences'] && self.attr('data-checked')) {
            self.val(0);
            delete checked_pref['comunication_preferences'][self.attr('data-checked')];
            self.removeAttr('data-checked');
        }
    }

    /**
     * Append Check list
     */
    if (checked_pref) {
        if (typeof checked_pref["comunication_preferences"] !== undefined) {
            $("#commLists").html("");
            $.each(checked_pref["comunication_preferences"], function (index, val) {
                $("#commLists").append(val);
            });
        }
    }
});


/**
 * Prevent Form Submitting on Enter
 * @type {[type]}
 */
$(document).off('keypress', '#' + applicationForm).on('keypress', '#' + applicationForm, function (e) {
    var keyCode = e.keyCode || e.which;
    if (e.keyCode == 13) {
        e.preventDefault();
    }
});


/*
 * Application Form Create For Client
 */
$(document).off('submit', '#' + applicationForm).on('submit', '#' + applicationForm, function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file', 'survey']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: applicationForm
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * After Inserted Successfully Reset Form
             */
            if (response && response.status === 200) {
                $("#commLists, #federalLists, #stateLists").html('');
                $('#applicationCreateModal .application-form-summary-list').addClass('hidden');
                $('#applicationCreateModal .dynamicShownImages').remove();
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

                $('#applicationCreateModal .fileDetail').html(initFileUploadInfo);
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
                $('#applicationCreateModal').modal('hide');
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')) {
                    routes.executeRoute('application/{id}', {
                        url: 'application/' + response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/*
    Application create form for NP
 */
$(document).off('submit', '#applicationNpForm').on('submit', '#applicationNpForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);

    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationNpForm'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * After Inserted Successfully Reset Form
             */
            if (response && response.status === 200) {

                $('#applicationNpCreateModal .dynamicShownImages').remove();
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

                $('#applicationNpCreateModal .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#npSearchResultLists .selectNp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#npSearchResultLists .m-widget4__title').removeClass('text-success');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Np').html('');

                document.getElementById("applicationNpForm").reset();
                // reloadDatatable('.m_datatable');
                $('#applicationCreateModal').modal('hide');
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')) {
                    routes.executeRoute('application/{id}', {
                        url: 'application/' + response.data[0].element.app_id
                    });
                }
            }
        });
    });
});


// $(document).off('blur', '#email').on('blur', '#email', function (e) {
//     var val = $(this).val();
//     if (val) {
//         var request = {
//             url: '/client_detail/' + val,
//             method: 'get'
//         };
//         ajaxRequest(request, function (response) {
//             $('#var_pet_name').css('display', 'block');
//             $.each(response.data, function (i, v) {
//                 $('#' + i).val(v);
//             });
//             $.each(response.data.pets, function (i, v) {
//                 var data = '<li class="petData" data-value="' + v.pet_name + '" data-target="pet_name" data-pet-id="' + v.id + '" onclick="petData(this)">' + v.pet_name + '</li>';
//                 $('#var_pet_name').append(data);
//             });
//         });
//     }
// });

$(document).off('click', '.enable_lookup').on('click', '.enable_lookup', function () {
    $('#var_pet_name').css('display', 'block');
});

function petData(event) {
    var target = $(event).attr('data-target');
    var value = $(event).attr('data-value');
    var pet_id = $(event).attr('data-pet-id');
    $('#' + target).val(value);

    var request = {
        url: '/pet_detail/' + pet_id,
        method: 'get'
    };

    ajaxRequest(request, function (response) {
        $.each(response.data, function (i, val) {
            $('#' + i).val(val);
        });
    });
};

/* ---------------------------
    Add New Pet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    appendDiv = null,
    const_i = 1;
$(document).off('click', '.addNewPet').on('click', '.addNewPet', function (e) {
    var self = $(this);
    var url = self.data('url');
    var request = {
        url: url + '/' + const_i,
        method: 'get'
    }
    var limit = self.attr('data-number');

    var appendPetOn = "#" + self.prev('.dynamicPetAppendSection').attr('id');

    addFormLoader();
    ajaxRequest(request, function (response) {
        removeFormLoader();
        appendDiv = $(appendPetOn);

        if (appendDiv.find('.m-accordion').length > limit) {
            if (petCount >= limit) {
                petCount = 2;
            }
            return toastr.error('Can\'t add more');
        }

        $(".m-accordion").find('.collapse').removeClass('show');

        /**
         * Append Response
         */
        appendDiv.append(response.data);

        /**
         * Ready Dynamic Accordion
         */
        prepareDynamicAccordion(templateId);

        /**
         * Collapse all accordion and Show Last
         */
        appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

        templateId++;
        petCount++;
    });
    const_i++;
});

function prepareDynamicAccordion(templateId) {

    var template = $(".addedPets[data-order=last]");
    if (!template) {
        return console.warn('template not found');
    }

    template.find('.countPets').html(petCount);
    template.find('.m-accordion').attr('id', 'm_pet_accordion_' + templateId);
    template.find('.m-accordion__item-body[data-parent]').attr('data-parent', '#m_pet_accordion_' + templateId);

    // Accordian Header
    var templateHeader = 'm_pet_accordion_item_' + templateId + '_head';
    template.find('.m-accordion__item-head').attr('id', templateHeader);
    template.find('.m-accordion__item-body[aria-labelledby]').attr('aria-labelledby', templateHeader);

    // Accordian Body
    var templateBody = 'm_pet_accordion_item_' + templateId + '_body';
    template.find('.m-accordion__item-body').attr('id', templateBody);
    template.find('#' + templateHeader).attr('href', '#' + templateBody);
    template.removeAttr('data-order');

}

// function reverseOldAccordion(templateId) {

//     var template = $(".addedPets[data-order=last]");
//     if (!template) {
//         return console.warn('template not found');
//     }

//     template.find('.countPets').html('');
//     template.find('.m-accordion').attr('id', '');
//     template.find('.m-accordion__item-body[data-parent]').attr('data-parent', '');

//     // Accordian Header
//     template.find('.m-accordion__item-head').attr('id', '');
//     template.find('.m-accordion__item-body[aria-labelledby]').attr('aria-labelledby', '');

//     // Accordian Body
//     var templateHeader = 'm_pet_accordion_item_' + templateId + '_head';
//     template.find('.m-accordion__item-body').attr('id', '');
//     template.find('#' + templateHeader).attr('href', '');
// }

/**
 * Application Upload Files
 */
function uploadFiles() {

    var dropZoneRef = "#uploadApplicationFile";
    if ($(dropZoneRef).length) {

        var myDropzone_1 = new Dropzone(dropZoneRef, {
            maxFiles: 10
        });

        myDropzone_1.on("complete", function (response) {
        });
    }

}

/**
 * Autosize
 */

function initAutoSize() {
    var autosizeClass = '.autosize';
    autosize($(autosizeClass));
}


/**
 * Set Legal Name
 */
var lastName = 'input[rel=lastName]';

function loadLegalName() {
}

/**
 * UcFirst on Blur of Application add modal
 */




$(document).off('blur', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
    .on('blur', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
        setLegalName();
    });


function setLegalName() {
    if($('input[rel=person_title]').length > 0){
        var title = $('input[rel=person_title]').val().length ? $('input[rel=person_title]').val() + ' ' : '';
    }
    var fname = $('input[rel=firstName]').val().length ? $('input[rel=firstName]').val() + ' ' : '';
    var mname = $('input[rel=midName]').val().length ? $('input[rel=midName]').val() + ' ' : '';
    var lname = $(lastName).val().length ? $(lastName).val() : '';

    $("#legalName").val("");
    if (fname.length) {
        if($('input[rel=person_title]').length > 0){
            var legalName = title + fname + mname + lname;
        }else{
            var legalName = fname + mname + lname;
        }
        $("#legalName").val(legalName);
    }
}


/**
 * Client Summary Events
 */
var checked = [];
var index = 0;
$(document).off('change', 'input.getChecked').on('change', 'input.getChecked', function (e) {
    var self = $(this);

    if (!$('.getChecked[data-checked]').length) {
        checked = [];
    }

    if (self.prop('checked')) {
        self.val(1);
        if (!checked[self.attr('data-title')]) {
            checked[self.attr('data-title')] = [];
        }
        self.attr('data-checked', index);
        var t = '<span title="' + self.next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.next('p').text() + '</span>';
        checked[self.attr('data-title')][index] = t;
        index++;

    } else {
        if (checked[self.attr('data-title')] && self.attr('data-checked') >= 0) {
            self.val(0);
            delete checked[self.attr('data-title')][self.attr('data-checked')];
            self.removeAttr('data-checked');
        }
    }

    renderCheckedLists(checked);
});

function renderCheckedLists(checked) {
    if (checked) {
        if (typeof checked["State"] !== undefined) {
            $("#stateLists").html("");
            $.each(checked["State"], function (index, val) {
                $("#stateLists").append(val);
            });
        }

        if (typeof checked["Federal"] !== undefined) {
            $("#federalLists").html("");
            $.each(checked["Federal"], function (index, val) {
                $("#federalLists").append(val);
            });
        }
    }
}


/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name="species[]"]').on('change', 'select[name="species[]"]', function (e) {
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


$(document).off('keyup', '*[name=pet_name]').on('keyup', '*[name=pet_name]', function (e) {
    var self = $(this);
    if (self.val().length) {
        self.closest('.m-accordion__item').find(petNameClass).html(self.val());
    } else {
        self.closest('.m-accordion__item').find(petNameClass).html('Pet');
    }
});


/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '*[rel=getExtraUpload]').on('click', '*[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('.extra-upload').length > 4) {
        return toastr.error('Can\'t add more than 5 upload Section');
    }

    var uploadId = 'upload_' + index;
    var uploadHTML = '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 m-b-20">\
                        <input type="text" class="form-control form-control-sm m-b-15 extra-upload no-m-left" name="document_name[]" placeholder="Type Your Document Name" value="">\
                        <label class="m-dropzone dropzone ApplicationFiles full-width p-rel" for="' + uploadId + '">\
                        <input type="file" class="hidden uploadApplicationFiles" name="documents[]" id="' + uploadId + '">\
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
                        <button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeUploadSection" title="Remove">\
                            <i class="flaticon-circle"></i>\
                        </button>\
                    </div>';

    $("#extraUploadSection").after(uploadHTML);

    index++;
});

$(document).off('click', '.removeUploadSection').on('click', '.removeUploadSection', function(e){
    e.preventDefault();
    var self = $(this);
    self.parent().remove();
});

// Select Upload files

var uploadedImages = 1;
$(document).off('change', '.uploadApplicationFiles').on('change', '.uploadApplicationFiles', function (e) {
    e.preventDefault();
    var self = this;
    var name = '';
    var size = '';

    if($(this).hasClass('clear-option')){
        $('.clear-option').show();
    }else if($(this).hasClass('clear-option1')){
        $('.clear-option1').show();
    }

    if (this.files && this.files.length) {
        var img = '<img src="" class="dynamicShownImages" alt="" id="uploadedImage_' + uploadedImages + '">';

        for (var i = 0; i < this.files.length; i++) {
            if ($(self).prev('img')) {
                $(self).prev('img').remove();
            }

            $(img).insertBefore($(self));

            if (this.files[i].type == "image/png" ||
                this.files[i].type == "image/jpeg" ||
                this.files[i].type == "image/gif" ||
                this.files[i].type == "image/x-icon") {

                readURL({
                    input: self,
                    img: $("#uploadedImage_" + uploadedImages)[0]
                });

            } else if (this.files[i].type == "application/pdf") {
                $("#uploadedImage_" + uploadedImages).attr('src', '/assets/images/file-icon/pdf.svg');
            }

            name = this.files[i].name;
            size = this.files[i].size / 1024;

            // 5 MB
            if (size > 5012) {
                $(this).closest('.ApplicationFiles').addClass('error').attr('title', 'Upload max size exceeded');
            } else {
                $(this).closest('.ApplicationFiles').removeClass('error').removeAttr('title');
            }

            $(this).closest('.ApplicationFiles').find('.m-dropzone__msg-title').html(name);
            $(this).closest('.ApplicationFiles').find('.m-dropzone__msg-desc').html('File Size <strong>' + (Math.round(size)) + ' KB </strong>');
        }
        uploadedImages++;
    }
});

$(document).off('click', '*[rel=clearUpload]').on('click', '*[rel=clearUpload]', function(e){
    e.preventDefault();
    $(this).parent().next().next().find('img').remove();
    $(this).parent().next().next().find('.m-dropzone__msg-title').html('Drop a file here or click to upload');
    $(this).parent().next().next().find('.m-dropzone__msg-desc').html('Maximum upload size: <strong> 4.00 MB </strong>');
    $(this).hide();
});

function loadNotes(id) {
    ajaxRequest({
        url: 'notes/application/' + id,
        method: 'get'
    }, function (response) {
        $('#ApplicationNotes').empty();
        $.each(response.data, function (index, value) {
            var markup = '<div class="m-timeline-3__item m-timeline-3__item--info">\n' +
                '                                <span class="m-timeline-3__item-time" style="font-size:10px">' + moment(value.created_at).fromNow() + '</span>\n' +
                '                                <div class="m-timeline-3__item-desc">\n' +
                '\t\t\t\t\t\t\t\t<span class="m-timeline-3__item-text">\n' +
                value.title.ucfirst() +
                '\t\t\t\t\t\t\t\t</span><br>\n' +
                '                                    <span class="m-timeline-3__item-user-name">\n' +
                '\t\t\t\t\t\t\t\t<a href="#" class="m-link m-link--metal m-timeline-3__item-link">\n' +
                value.notes.ucfirst() +
                '\t\t\t\t\t\t\t\t</a>\n' +
                '\t\t\t\t\t\t\t\t</span>\n' +
                '                                </div>\n' +
                '                            </div>';
            $('#ApplicationNotes').append(markup);
        });
    })
}

/**
 * Load Date Filter
 */
function applicationTopDateLoader() {
    var daterangepickerInit = function () {
        if ($('#m_application_date_filter').length == 0) {
            return;
        }

        var picker = $('#m_application_date_filter');
        var start = moment().startOf('year');
        var end = moment().endOf('month');

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);
            range = start.format('Y/MM/DD') + ' - ' + end.format('Y/MM/DD');
            $('.data-range-input').val(range);
        }


        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    daterangepickerInit();
}

function TopDateLoader(id) {
    var daterangepickerInit = function () {
        if ($(id).length == 0) {
            return;
        }

        var picker = $(id);
        var start = moment().startOf('year');
        var end = moment().endOf('month');

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);
        }

        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    daterangepickerInit();
}

/**
 * IE Service Proider Function
 */


var initIE_ServiceProviderDate = function (dateInputId) {
    $("#" + dateInputId).datepicker({
        autoclose: true,
        todayHighlight: true,
    });
};

// var initIE_ServiceProviderEndDate = function (dateInputId) {
//     $("#" + dateInputId).datepicker({
//         autoclose: true,
//         todayHighlight: true,
//     });
// };

var initDatepicker = function () {
    $(".dpicker").datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        todayHighlight: true,
    });
};
var initTimepicker = function () {
    $(".tpicker").timepicker({
        minuteStep: 1,
        defaultTime: "",

    });
};


function citySelected(id,origin) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $(".floatLabelForm *[name=city]").focus();
            $(".floatLabelForm *[name=city]").val(response.data[0].city);
            $(".floatLabelForm *[name=state]").focus();
            $(".floatLabelForm *[name=state]").val(response.data[0].state);
            $(".floatLabelForm *[name=zip_code]").focus();
            $(".floatLabelForm *[name=zip]").val(response.data[0].zip_code);
            $(".floatLabelForm *[name=zip]").focus();
            $(".floatLabelForm *[name=zip_code]").val(response.data[0].zip_code);
            $(".floatLabelForm *[name=county]").focus();
            $(".floatLabelForm *[name=county]").val(response.data[0].county);
        }
        // $(".floatLabelForm *[name=zip]").focus();
    })
}

function breedInputFnc(id,origin) {
    if(typeof origin!='undefined')
    {
        origin.trigger('input');
    }

}
function tabToTarget(id,origin) {
    var target=origin.attr('data-target');
    $("#applicationForm *[name="+target+"]").focus()
}
/**
 * Service Provider Button SPHolder on Row Click
 */
$(document).off('click', '#SPHolder .m-widget4__item').on('click', '#SPHolder .m-widget4__item', function () {
    $(this).find('.selectSp').trigger('click');
});


function loadServiceProvider(zip) {
    ajaxRequest({
        url: 'application/search/suggestorg',
        data: {
            'zip_code': zip
        }
    }, function (response) {
        if (response.data)
            loadSP(response.data);
    });
}

function loadSP(data) {

    var add3;
    $('#SPHolder').empty();
    $.each(data, function (index, value) {
        if (value.address != null)
            add3 = value.address.add1 + '\n' +
                value.address.add2 + '\n' +
                value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
        else
            add3 = "";
        var markup = '  <div class="m-widget4__item choose-provider">\n' +
            '                                <div class="m-widget4__info">\n' +
            '                                    <span class="m-widget4__title">\n' +
            value.cname.ucfirst() +
            '                                    </span>\n' +
            '                                    <br>\n' +
            '                                    <span class="m-widget4__sub">\n' +
            add3 +
            '                                    </span>\n' +
            '                                </div>\n' +
            '                                <div class="m-widget4__ext">\n' +
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectSp" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#SPHolder').append(markup);
        if (data.length) {
            $('#NearBySpHolder').removeClass('hidden');
            $('#NearBySpHolder').show();
        }
        else {
            $('#NearBySpHolder').hide();
            $('#NearBySpHolder').addClass('hidden');
        }
    });
}

/**
 * Service Provider Choose Options
 */
$(document).off('click', '.selectSp').on('click', '.selectSp', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        /**
         * Load Vet
         */
        addFormLoader();

        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {

            removeFormLoader();
            if (response.data) {
                $('#loadSelectedSpNp').html('');
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
                    $('#loadSelectedSpNp').append(markup);
                });
                $(".selectedServiceProviderVetHolder").removeClass('hidden');
            }
        });

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#SP_ID').val($(this).attr('data-id'));
        $(document).find('.selectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedServiceProviderVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#SP_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});

$(document).off('keyup', '.serviceProviderL').on('keyup', '.serviceProviderL', function (e) {
    e.preventDefault();
    ajaxRequest({
        url: "application/search/suggestorg?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        $('#SearchSPText').text('Service Provider');
        loadSP(response.data);
    });
});


/**
 * Init Signature
 */

function initSignature() {
    var canvas = $("#signpad_canvas")[0],
        signaturePad;

    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    signaturePad = new SignaturePad(canvas);


    $(document).off('click', "*[data-action=clear]").on('click', "*[data-action=clear]", function () {
        signaturePad.clear();
    });

    $(document).off('click', '#saveSig').on('click', '#saveSig', function () {

        $("#signature-pad").addClass('hidden');

        if (!$("input[name=initial_signature_name]").val())
            return toastr.error("Please provide initial name.");

        if (signaturePad.isEmpty()) {
            toastr.error("Please provide signature first.");
        } else {
            $("#signature-pad").removeClass('hidden');
            $("#signatureName").text($("input[name=initial_signature_name]").val());
            $("#signatureImage").attr('src', signaturePad.toDataURL());
            $("#signatureImage").attr('alt', $("input[name=initial_signature_name]").val());
            $(modalConfig.container).modal('hide');
        }
    });
}


/**
 * Table Export
 */

$(document).off('click', '.ietable-export').on('click', '.ietable-export', function (e) {
    e.preventDefault();
    var self = $(this),
        exportType = self.attr("data-export-type");
    if (exportType) {
        $("#applicationTable table").tableExport({
            type: exportType,
            escape: 'false',
            fileName: "ietable",
            ignoreColumn: [9]
        });
    }
});

$(document).off('click', '.app-approve').on('click', '.app-approve', function (e) {

    var sign = $(document).find('#signatureImage').attr('src');
    var signName = $(document).find('#signatureName').text();
    var id = $(this).attr('data-id');

    var request = {
        url: '/application/approve/' + id,
        method: 'post',
        data: {signature: sign, signature_holder: signName},
    };

    showProcess();
    ajaxRequest(request, function (response) {
        clearProcess();
        processForm(response, function () {
            routes.executeRoute('application/{id}', {
                url: 'application/' + id
            });
            $('html, body').stop().animate({scrollTop:0}, 500, 'swing', function() {
            });
        });

    });
});


var approveProcess = null;

function showProcess() {
    $('#contentHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Processing..</div></div>');
    approveProcess = setInterval(function () {
        ajaxRequest({
            url: 'application/approve/getProcess'
        }, function (response) {
            if (response && response.data && response.data.process) {
                $('#contentHolder').find('.text-loader .process-status').animate({
                    opacity: '0'
                }, 500, function () {
                    $(this).text('');
                    $('#contentHolder').find('.text-loader .process-status').animate({
                        opacity: '1'
                    }, 500, function () {
                        $(this).text(response.data.process);
                    });
                });
            }
        });
    }, 3000);
}


function clearProcess() {
    clearInterval(approveProcess);
    $('#contentHolder').remove('.text-loader');
}


$(document).off('click', '.generateInvoice').on('click', '.generateInvoice', function () {
    var id = $(this).attr('data-id');
    var request = {
        url: '/application/generateInvoice/' + id,
        method: 'post',
    };

    addFormLoader();
    ajaxRequest(request, function (response) {
        removeFormLoader();
        processForm(response, function () {
            routes.executeRoute('application/{id}', {
                url: 'application/' + id
            });
        });

    });
});

/*-------------------------------------------Non Profit------------------------------------------------------*/
$(document).off('input', '.nonProfit').on('input', '.nonProfit', function () {
    var imp = $(this).val();
    var request = {
        url: '/application/getNonProfit',
        data: {cname: imp},
        method: 'post',
        cancelPrevious: true
    };
    ajaxRequest(request, function (response) {
        if (imp != "")
            $('#SearchNPText').text('Search Result for ' + imp);
        else
            $('#SearchNPText').html('Choose <abbr title="Non Profit">NP</abbr>');
        $('#NP_ID').val();
        $('#npSearchResultLists').empty().append(response.data);
    });
});

$(document).off('click', '.selectNp').on('click', '.selectNp', function (e) {
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
        $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
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
        $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});


/*-------------------------------------------Rescue Provider------------------------------------------------------*/
$(document).off('input', '.rescueProvider').on('input', '.rescueProvider', function (e) {
    e.preventDefault();
    var imp = $(this).val();
    ajaxRequest({
        url: "application/search/suggestorg?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        if (imp != "")
            $('#SearchSPRText').text('Search Result for ' + imp);
        else
            $('#SearchSPRText').html('Choose Provider');

        $('#SPR_ID').val();

        loadSPR(response.data);
    });
});

function loadSPR(data) {

    var add3;
    $('#sprSearchResultLists').empty();
    $.each(data, function (index, value) {
        if (value.address != null)
            add3 = value.address.add1 + '\n' +
                value.address.add2 + '\n' +
                value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
        else
            add3 = "";
        var markup = '  <div class="m-widget4__item choose-provider">\n' +
            '                                <div class="m-widget4__info">\n' +
            '                                    <span class="m-widget4__title">\n' +
            value.cname.ucfirst() +
            '                                    </span>\n' +
            '                                    <br>\n' +
            '                                    <span class="m-widget4__sub">\n' +
            add3 +
            '                                    </span>\n' +
            '                                </div>\n' +
            '                                <div class="m-widget4__ext">\n' +
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectSpr" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#sprSearchResultLists').append(markup);
        if (data.length) {
            $('#sprSearchResults').removeClass('hidden');
            $('#sprSearchResults').show();
        }
        else {
            $('#sprSearchResults').hide();
            $('#sprSearchResults').addClass('hidden');
        }
    });
}

$(document).off('click', '.selectSpr').on('click', '.selectSpr', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        /**
         * Load Vet
         */
        addFormLoader();

        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {

            removeFormLoader();
            if (response.data) {
                $('#loadSelectedSprVets').html('');
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
                    $('#loadSelectedSprVets').append(markup);
                });
                $(".selectedSprVetHolder").removeClass('hidden');
            }
        });

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#SPR_ID').val($(this).attr('data-id'));
        $(document).find('.selectSpr').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedServiceProviderVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#SP_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectSpr').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});

/*-------------------------------------------Rescu------------------------------------------------------*/
$(document).off('input', '.rescue').on('input', '.rescue', function (e) {
    e.preventDefault();
    var imp = $(this).val();
    ajaxRequest({
        url: "application/search/rescue?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        if (imp != "")
            $('#SearchRescueText').text('Search Result for ' + imp);
        else
            $('#SearchRescueText').html('Choose Rescue');

        $('#rescue_ID').val();

        loadRescue(response.data);
    });
});

function loadRescue(data) {

    var add3;
    $('#rescueSearchResultLists').empty();
    $.each(data, function (index, value) {
        if (value.address != null)
            add3 = value.address.add1 + '\n' +
                value.address.add2 + '\n' +
                value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
        else
            add3 = "";
        var markup = '  <div class="m-widget4__item choose-provider">\n' +
            '                                <div class="m-widget4__info">\n' +
            '                                    <span class="m-widget4__title">\n' +
            value.cname.ucfirst() +
            '                                    </span>\n' +
            '                                    <br>\n' +
            '                                    <span class="m-widget4__sub">\n' +
            add3 +
            '                                    </span>\n' +
            '                                </div>\n' +
            '                                <div class="m-widget4__ext">\n' +
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectRescue" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#rescueSearchResultLists').append(markup);
        if (data.length) {
            $('#rescueSearchResults').removeClass('hidden');
            $('#rescueSearchResults').show();
        }
        else {
            $('#rescueSearchResults').hide();
            $('#rescueSearchResults').addClass('hidden');
        }
    });
}

$(document).off('click', '.selectRescue').on('click', '.selectRescue', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#rescue_ID').val($(this).attr('data-id'));
        $(document).find('.selectRescue').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#rescue_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectRescue').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }
});


// $(document).off('blur','input[rel=personal_email]').on('blur','input[rel=personal_email]',function () {
//     var email=$(this).val();
//     var request = {
//         url: '/checkClientEmail?email='+email,
//         method: 'get',
//         cancelPrevious: true
//     };
//     ajaxRequest(request,function (response) {
//         var data=response.data;
//         if(data)
//         {
//            replaceValue(data);
//         }

//     });
// });

// function replaceValue(data) {
//     $('input[name=title]').val(data.title);
//     $('input[name=fname]').val(data.fname);
//     $('input[name=mname]').val(data.mname);
//     $('input[name=lname]').val(data.lname);
//     $('input[name=dob]').val(data.dob);
//     var legalname='';
//     if(data.mname)
//         legalname=data.title+' '+data.fname+' '+data.mname+' '+data.lname;
//     else
//         legalname=data.title+' '+data.fname+' '+data.lname;

//     $('input[name=legalName]').val(legalname);
//     $('input[name=add1]').val(data.address.add1);
//     $('input[name=add2]').val(data.address.add2);
//     $('input[name=city]').val(data.address.zip.city);
//     $('input[name=state]').val(data.address.zip.state);
//     $('input[name=zip]').val(data.address.zip.zip_code);

//     $('input[name=cell_phone]').val(data.contact.cell_phone);
//     $('input[name=alt_phone]').val(data.contact.alt_phone);

// }


$('.refreshApp').off('click').on('click', function () {
    routes.executeRoute('application/{id}', {
        url: 'application/{{$application->id}}'
    });
});

/**
 * Invoice Edit Options
 */
var amountUnit = '$';
$(document).off('click', '.changeAmount').on('click', '.changeAmount', function (e) {
    var amount = $(this).text().numval();

    if (amount) {
        var edit = '<input type="number" name="amount" class="change-amount-input" value="' + amount + '">';
        removePrevEditAmount();
        $(this).html(edit);
    }
});

function removePrevEditAmount() {
    var editAmountInput = $('.change-amount-input');
    if (editAmountInput) {
        editAmountInput.each(function (index, element) {
            if (index > (editAmountInput.length - 1)) return;
            var val = amountUnit + $(element).val();
            $(element).replaceWith(val);
        });
    }
}

function refreshInvoiceTotal() {
    var t = 0;
    $(".parent").find('.rowAmountTotal').each(function (index, element) {
        if (typeof $(element).text().numval() !== "undefined") {
            t += $(element).text().numval();
        }
    });
    $("#invoice-total").find('.netInvoiceTotal').text(t);
}

var rowTotal = 0;
$(document).off('input blur', '.change-amount-input').on('input blur', '.change-amount-input', function (e) {
    var self = $(this);

    var parent = self.closest('tr').attr('data-parent-id');

    if (parent) {
        rowTotal = self.val().numval();
        $('*[data-parent-id=' + parent + ']').find('.changeAmount').each(function (index, element) {
            if (typeof $(element).text().numval() !== "undefined") {
                rowTotal += $(element).text().numval();
            }
        });
        $('#' + parent).find('.rowAmountTotal').text(amountUnit + rowTotal);
        refreshInvoiceTotal();

    }

    if (e.type == "focusout") {
        self.replaceWith(amountUnit + self.val());
    }
});


/**
 * Jump To Process
 */

$(document).off('click', ".jumpToProcess").on('click', ".jumpToProcess", function (e) {
    e.preventDefault();
    if ($(".next_step").length) {
        $('html, body').animate({
            scrollTop: ($(".next_step").offset().top - 90)
        }, 600);
    }
});


/**
 * Edit Eligilibility
 */



$(document).off('click', '#editEligibility').on('click', '#editEligibility', function (e) {
    var self = $(this),
        form = self.attr('data-target'),
        requestURL = self.attr('data-url');

    var request = {
        url: requestURL,
        method: 'post',
        form: form
    };

    ajaxRequest(request, function (response) {
        processForm(response, function () {
            reloadDatatable('.m_datatable');

            // If Application Detail refresh partial dom
            if ($("#applicantDetail").length) {
                routes.executeRoute('application/{id}', {
                    url: 'application/' + (document.param ? document.param : '')
                });
            }
        });
    });
});


function loadCitizanModalJs() {
    initIE_ServiceProviderDate("aplicationClientDob");
    BootstrapSelect.init();
    ApplicationWizard();
    initAutoSize();
    loadNpPets();
    loadLegalName();
    uploadFiles();
}

/**
 * ------------------------------------------------
 * Application Add
 * On blur Event for focus on : save and continue
 * -----------------------------------------------
 */

var inputs = 'input[name="alt_phone"], input[name="is_vad"], textarea[name="where_obtained[]"]';
$(document).off('focusout', inputs).on('focusout', inputs, function (e) {
    $('*[data-wizard-action="next"]').focus();
});


/**
 * Clear Aplication From
 */

$(document).off('click', '.clearApplicationForm').on('click', '.clearApplicationForm', function () {
    $("#commLists, #federalLists, #stateLists").html('');
    $('#applicationCreateModal .application-form-summary-list').addClass('hidden');
    $('#applicationCreateModal .dynamicShownImages').remove();
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

    $('#applicationCreateModal .fileDetail').html(initFileUploadInfo);
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
});


/**
 * Clear Np Form
 */

$(document).off('click', '.clearNpApplicationForm').on('click', '.clearNpApplicationForm', function () {
    $('#applicationNpCreateModal .dynamicShownImages').remove();
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

    $('#applicationNpCreateModal .fileDetail').html(initFileUploadInfo);
    $("#extraUploadSection").nextAll().remove();

    /**
     * Remove Selected SP
     */
    $('#SP_ID').val('');
    $('#npSearchResultLists .selectNp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
    $('#npSearchResultLists .m-widget4__title').removeClass('text-success');

    // Remove Dynamic Pet
    $('#newPet_Template_Append_Np').html('');
});
$(document).off('click', '.server-applicationexporter').on('click', '.server-applicationexporter', function (e) {
    var exporttype = $(this).attr('data-export-type');
    var url = 'application/report/' + exporttype + '?';
    var data = $('#ApplicationFilter').serialize() + '&' + $('#ApplicationQuickSearch').serialize();
    window.open(url + data);
});


/*---------------------------------------Draft Js------------------------------*/
$(document).off('click', '.saveDraft').on('click', '.saveDraft', function (e) {
    e.preventDefault();
    var section = $(this).attr('data-target');
    var data = $('.' + section).serializeArray();
    if(data[0] && data[0].value != ''){

        var modal_url = '/draft/saveConfirm/' + section;
        var parent = $(this).closest('.modal.show').attr('data-modal-id');
        ++modalId;
        showModal(modal_url, {
            relation: "child",
            parentId: parent,
        });

        $('.modal.show[data-modal-id=' + parent + ']').modal('hide');
    }
});

function checkData() {

}




// $('.loadDraft').on('click',function (e) {
//    e.preventDefault();
//     var section=$(this).attr('data-target');
//
//     var modal_url='/draft/load/'+section;
//     var parent = $(this).closest('.modal.show').attr('data-modal-id');
//     ++modalId;
//     showModal(modal_url, {
//         relation: "child",
//         parentId: parent,
//     });
//
//     $('.modal.show[data-modal-id='+parent+']').modal('hide');
// });