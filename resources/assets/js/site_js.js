/*
* @Author: 
 /** 
 * DEVELOPERS 
 * ------------------------------------------------  
 * - SUMAN THAPA - LEAD(NEPALNME@GMAIL.COM) 
 * ------------------------------------------------  
 * - PRABHAT GURUNG 
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA 
 * - MANISH BUDDHACHARYA 
 * - LEKH RAJ RAJ 
 * - ASCOL PARAJULI 
 * ------------------------------------------------  
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019 
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
* @Date:   2019-03-15 13:36:50
* @Last Modified by:   Lekh Raj Rai
* @Last Modified time: 2019-05-21 18:05:32
*/

var SiteWizard = function (id, formid) {
    $("#updateSite").addClass('hidden');
    //== Base elements
    var site_add_wizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var site_wizard = '';

    site_wizard = $('#' + id).mWizard({
        startStep: 1
    });

    var prevStep = site_wizard.currentStep;
    var errors = "";
    var vol_id = '';
    site_wizard.on('beforeNext', function (site_wizard) {
        ajaxRequest({
            url: "/sites/getSiteValidation",
            method: "POST",
            form: formid
        }, function (response) {

            if (response.hasOwnProperty('request') && response.request.status === 422)
                processForm(response);
        });

    });

    //== Change event
    site_wizard.on('change', function (site_wizard) {

        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        if (site_wizard.currentStep == 1) {
            $(".volunteer-form-summary-list").addClass('hidden');
            $("#updateSite").addClass('hidden');
        }

        if (site_wizard.currentStep == 2) {
            $("#updateSite").removeClass('hidden');
            var req_count = 0;
            $(':input.required_input').each(function () {
                if ($(this).hasClass('hidden')) {

                } else {
                    let value = $(this).val();
                    if (typeof value === 'object' && !value.length) {
                        req_count = 1;
                        $(this).css("border", "1px solid #f4516c");
                    } else if (typeof value === 'string' && !value) {
                        req_count = 1;
                        $(this).css("border", "1px solid #f4516c");
                    } else {
                        $(this).css("border", "");
                    }
                }
            });
            if (req_count === 1) {
                $('#modalContainer *[data-wizard-target="#m_wizard_form_step_2').find('a:first-child').trigger('click');
                return toastr.error("Please fill the required fields.");
            }
            // else{
            //       ajaxRequest({
            //             url: "/sites/getVolunteers",
            //             method: "get",
            //             success:function(resp) {

            //             },
            //         }, function (response) {

            //             // processForm(response);
            //         });
            // }
        }
    });
};

var SiteWizardEdit = function (id, formid, siteId) {
    $("#updateSite").addClass('hidden');
    //== Base elements
    var site_add_wizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var site_wizard = '';

    site_wizard = $('#' + id).mWizard({
        startStep: 1
    });

    var prevStep = site_wizard.currentStep;
    var errors = "";
    var vol_id = '';
    site_wizard.on('beforeNext', function (site_wizard) {

        if (site_wizard.currentStep === 1) { //General Site Details           

            sendAjax({

                url: 'site/updateGenerals/' + siteId,
                method: 'POST',
                data: $('#m_wizard_form_step_1 :input').serializeArray()

            }, function (response) {

                reloadDatatable('#site_data_table');

            }, function ({ responseJSON }) {
                site_wizard.goPrev();
                highlightError(formEl, responseJSON);
            });
        }

    });

    //== Change event
    site_wizard.on('change', function (site_wizard) {

        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        if (site_wizard.currentStep == 1) {
            $(".volunteer-form-summary-list").addClass('hidden');
            $("#updateSite").addClass('hidden');
        }

        if (site_wizard.currentStep == 2) {
            $("#updateSite").removeClass('hidden');
            var req_count = 0;
            $(':input.required_input').each(function () {
                if ($(this).hasClass('hidden')) {

                } else {
                    let value = $(this).val();
                    if (typeof value === 'object' && !value.length) {
                        req_count = 1;
                        $(this).css("border", "1px solid #f4516c");
                    } else if (typeof value === 'string' && !value) {
                        req_count = 1;
                        $(this).css("border", "1px solid #f4516c");
                    } else {
                        $(this).css("border", "");
                    }
                }
            });
            if (req_count === 1) {
                $('#modalContainer *[data-wizard-target="#m_wizard_form_step_2').find('a:first-child').trigger('click');
                return toastr.error("Please fill the required fields.");
            }

        }
    });
};

function highlightError(form, errors) {

    clearErrors(form);

    for (let key in errors.errors) {

        form.find(`[name = ${key}]`).css('border-color', "#b12704");

    }

}

function clearErrors(form) {

    form.find(':input').css('border-color', "#ccc");

}


$(document).off('click', '#saveSiteWizardData').on('click', '#saveSiteWizardData', function (e) {
    e.preventDefault();
    let alldata = $('#vol_list :input').serializeArray();
    let volunteers = $('#siteFormWizard').serializeArray();
    let combinedData = [...alldata, ...volunteers];

    sendAjax({
        url: 'siteAddWidget/store',
        method: "post",
        data: combinedData,
        loader: true,
        success: function (resp) {
            toastr.success("Successful");
        }

    }, function (response) {
        processModal();

        processForm(response, function () {
            if (response.status === 200) {
                removeFormLoader();
                reloadDatatable('#site_data_table');
                try {
                    setCookie('highlightSite', response.site_id);
                } catch (e) { }
            }
        });
    });
    return;
});

$(document).off('click', '#updateSite').on('click', '#updateSite', function (e) {
    e.preventDefault();

    let site_id = $(this).attr('data-id')
    // let alldata = $('#vol_list :input').serializeArray();
    // let volunteers = $('#siteFormWizard').serializeArray();
    // let combinedData = [...alldata, ...volunteers];

    sendAjax({
        url: 'siteAddWidget/update/' + site_id,
        method: "post",
        data: $('#m_wizard_form_step_2 :input').serializeArray(),
        loader: true,
        success: function (resp) {
            toastr.success("Successful");
        }

    }, function (response) {
        processModal();
        processForm(response, function () {
            if (response.status === 200) {
                removeFormLoader();
                reloadDatatable('#site_data_table');
            }
        });
    });
    return;
});

function siteManagerSelected(data, data1) {
    if (data !== undefined) {

        $.each(data, function (i, v) {
            if ($('a[data-check-id="' + v.value + '"]').length) return;
            var siteHeding = '<span title="' + data1[i].value + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
                '<i class="la la-check fs-12"></i> &nbsp;' + data1[i].value + '</span>';
            $('#siteLists').append(siteHeding);
            var t = `<a class="m-list-search__result-item" style="width: 90% !important" data-check-id="${v.value}">
                <span class="m-list-search__result-item-icon">
                    <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                        <input type="checkbox" class="siteChecked" data-id="`+ v.value + `" data-title="` + data1[i].value + `" checked="checked" name="supervisors[]" value="` + v.value + `">
                        <span></span>
                    </label>
                </span>
                <span class="m-list-search__result-item-text" style="padding-top:10px;">`+ data1[i].value + `</span>
                <span style="margin-top: 5px !important;">
                    <button class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill deleteSupervisor" style="width: 20px !important;height: 20px !important;margin-top: 1px;">
                            <i class="la la-close" style="font-size: 12px"></i>
                        </button >
                </span>
            </a>`;
            $('#siteSearchResultLists').append(t);
        });
    }
}
