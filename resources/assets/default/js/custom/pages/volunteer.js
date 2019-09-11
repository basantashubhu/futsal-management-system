/**
 * @author Suman Thaapa -- Lead 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Prabhat gurung 
 * @author Lekh Raj Rai 
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-28 16:34:11
 * @modify date 2019-03-28 16:34:11
 * @desc [description]
 */
//== Class definition
var VolunteerWizard = function (id, formid) {
    //== Base elements
    var volunteerAddWizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var volunteerWizard = '';

    volunteerWizard = $('#' + id).mWizard({
        startStep: 1
    });
    // volunteerWizard.goFirst();

    var prevStep = volunteerWizard.currentStep;
    var errors = "";
    var vol_id = '';

    volunteerWizard.on('beforeNext', function (volunteerWizard) {
        sendAjax({
            url: "/volunteer/getVolunteerValidation",
            method: "POST",
            data: $(formEl).serializeArray()
        }, function (response) {
            $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            // processForm(response);
        }, function ({ responseJSON }) {
            $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            volunteerWizard.goFirst();
            for (let key in responseJSON.errors) {
                let index = 0;
                if (key.indexOf('.') > -1) {
                    [key, index] = key.split('.');
                }
                $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
            }
        });

    });
    //== Change event
    volunteerWizard.on('change', function (volunteerWizard) {
        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]').val();

        $('.vendor--id').val(alt_id.padStart(10, '0'));

        if (volunteerWizard.currentStep == 1) {
            /* Validate alt_id */
            let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]');

            $('.vendor--id').val(alt_id.val());

            if (!$(alt_id).val())
                $(alt_id).addClass('input-required1');
            $(".volunteer-form-summary-list").addClass('hidden');

            // sendAjax({
            //     url: '' + volunteer_id,
            //     method: 'POST',
            //     data: $('#m_wizard_form_step_1 :input').serializeArray()
            // }, function () {
            //     reloadDatatable('#vol_data_table');
            // }, function ({ responseJSON }) {
            //     $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            //     volunteerWizard.goPrev();
            //     for (let key in responseJSON.errors) {
            //         let index = 0;
            //         if (key.indexOf('.') > -1) {
            //             [key, index] = key.split('.');
            //         }
            //         $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
            //     }
            // });


        }
        if (volunteerWizard.currentStep == 2) {
            $(".volunteer-form-summary-list").removeClass("hidden");
            $('.siteLocationSection').removeClass('hidden');
            $('#vol_summary_header').text($("#" + id).find("#first_name").val() + ' ' + $("#" + id).find("#middle_name").val() + ' ' + $("#" + id).find("#last_name").val());
            $('#volEmail').text($("input[rel=email]").val());
        }
        if (volunteerWizard.currentStep == 3) {
            $(".modal").find('.addSitesTemplate').show();
        } else {
            $(".modal").find('.addSitesTemplate').hide();
        }

        if (volunteerWizard.currentStep == 4) {
            //Check if a week is selected
            let isWeekSelected = $(document.getElementById('m_wizard_form_step_3')).find('[name="w_days[]"]').val().length;

            let rowsAddedForInsertion = $('#m_wizard_form_step_3 table.view-selected-table :input');

            let addIcon = $('.addTsVolData');

            if (isWeekSelected) {

                addIcon.removeClass('btn-success').addClass("btn-danger");

                volunteerWizard.goPrev()

                return toastr.error("Please click the red circled icon to save template.");

            }

            addIcon.hasClass('btn-danger') ? addIcon.addClass("btn-success") : '';

        }
    });
};


var VolunteerEditWizard = function (id, formid, volunteer_id) {
    //== Base elements
    var volunteerAddWizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var volunteerWizard = '';

    volunteerWizard = $('#' + id).mWizard({
        startStep: 1
    });

    var prevStep = volunteerWizard.currentStep;
    var errors = "";
    var vol_id = '';
    volunteerWizard.on('beforeNext', function (volunteerWizard) {

        if (volunteerWizard.currentStep === 1) {

            let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]').val();

            $('.vendor--id').val(alt_id.padStart(10, '0'));

            let hasValidationError = $('#m_wizard_form_step_1 .input-required1').length;

            if (hasValidationError > 0)
                return toastr.error("Please check the red fields");

            sendAjax({
                url: 'volunteer/updateGenerals/' + volunteer_id,
                method: 'POST',
                data: $('#m_wizard_form_step_1 :input').serializeArray()
            }, function () {
                $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
                reloadDatatable('#vol_data_table');
            }, function ({ responseJSON }) {
                $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
                volunteerWizard.goFirst();
                for (let key in responseJSON.errors) {
                    let index = 0;
                    if (key.indexOf('.') > -1) {
                        [key, index] = key.split('.');
                    }
                    $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
                }
            });

        } else if (volunteerWizard.currentStep === 2) { //volunteer detail            

            sendAjax({
                url: 'volunteer/updateDetails/' + volunteer_id,
                method: 'POST',
                data: $('#m_wizard_form_step_2 :input').serializeArray()
            }, function (response) {
                reloadDatatable('#vol_data_table');
            }, function (err) {
                volunteerWizard.goPrev();
            });

        } else { //(volunteerWizard.currentStep === 3){ //template           




        }



    });
    //== Change event
    volunteerWizard.on('change', function (volunteerWizard) {
        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        if (volunteerWizard.currentStep == 1) {
            $(".volunteer-form-summary-list").addClass('hidden');
        }
        if (volunteerWizard.currentStep == 2) {
            $(".volunteer-form-summary-list").removeClass("hidden");
            $('.siteLocationSection').removeClass('hidden');
            $('#vol_summary_header').text($("#" + id).find("#first_name").val() + ' ' + $("#" + id).find("#middle_name").val() + ' ' + $("#" + id).find("#last_name").val());
            $('#volEmail').text($("input[rel=email]").val());
        }
        if (volunteerWizard.currentStep == 3) {

        }

        if (volunteerWizard.currentStep == 4) {

            //Check if a week is selected
            let isWeekSelected = $(document.getElementById('m_wizard_form_step_3')).find('[name="w_days[]"]').val().length;

            let rowsAddedForInsertion = $('#m_wizard_form_step_3 table.view-selected-table :input');

            let addIcon = $('.addTsVolData');

            if (isWeekSelected) {

                addIcon.removeClass('btn-success').addClass("btn-danger");

                volunteerWizard.goPrev()

                return toastr.error("Please click the red circled icon to save template.");

            }

            let hasDefaultTemplate = $('.saveAndContBtn').attr('data-has-template');

            let bypassStep3 = $('.saveAndContBtn').attr('data-bypass-step-3');

            if (typeof bypassStep3 !== "undefined") {

                $('.saveAndContBtn').removeAttr('data-bypass-step-3');
                $('.saveAndContBtn').attr('data-has-template', "");
                return;

            }

            if (
                (typeof hasDefaultTemplate !== "undefined" && hasDefaultTemplate !== "")
                &&
                (rowsAddedForInsertion.length < 1)
            ) {
                volunteerWizard.goPrev();

                confirmAction({
                    message: "Do you want to delete this timesheet?",
                    action: "yes",
                    ajax: {
                        url: '/',
                        success: function () {
                            $('.saveAndContBtn').attr('data-bypass-step-3', 1);
                            volunteerWizard.goNext();
                        }
                    }
                })

                return;
            }


            $("#appendableTableDetails :input").prop("disabled", false);

            let template_id = $('.saveAndContBtn').attr('data-template-id');


            let url;

            if (!template_id) {
                url = 'volunteer/updateTemplate/' + volunteer_id;

            } else {


                url = 'volunteer/updateTemplate/' + volunteer_id + '/' + template_id;

            }

            sendAjax({
                url: url,
                method: 'POST',
                data: $('#m_wizard_form_step_3 :input').serializeArray()
            }, function () {

                addIcon.removeClass('btn-danger').addClass("btn-success");

                $("#appendableTableDetails :input").prop("disabled", true);

            }, function (err) {
                addIcon.removeClass('btn-danger').addClass("btn-success");

                volunteerWizard.goPrev();
            });
        }
    });

};


function templateFieldsClearer() {

    $('.modernFormAddTable .weekSelectpicker[name="w_days[]"]').val('default').selectpicker('refresh')
    $('#ts-v2-sites').val("").trigger("change")
    $('.modernFormAddTable select[name="w_item[label][]"]').val("").trigger("change")
    let itemValue = $('.modernFormAddTable select[name="w_item[value][]"]');
    itemValue.val("").trigger("change")
    itemValue.removeAttr('data-stipend-category')
    let inputsNames = ["w_time_in", "w_time_out", "w_break_out", "w_break_in", "w_total_hrs", "w_item[amount][]"];

    inputsNames.forEach((name) => {
        $(`.modernFormAddTable input[name="${name}"]`).val("");
    })

}



$(document).off('click', '.clearWidget').on('click', '.clearWidget', function (e) {
    e.preventDefault();

    let target = $('.m-wizard__step--current').attr('data-form-type');

    if (target === "template") {
        $('#modern_template_name').val("")
        $('#ts-v2-time-type').val("").trigger("change")

        templateFieldsClearer();
    }

})



$('.siteLocationSection').removeClass('hidden');
$('#siteLists').html('');
var clickedSite = 0;
$(document).off('change', '.siteChecked').on('change', '.siteChecked', function () {
    var self = $(this);
    if (self.prop('checked')) {
        var t = '<span title="' + self.attr("data-title") + '" data-id="' + self.attr("data-id") + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.attr("data-title") + '</span>';
        $('#siteLists').append(t);
        self.attr('name', 'site_id[]');
        self.val(self.attr("data-id"));

        if (clickedSite === 0) {
            var classHidden = "";
            var add = `<a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addWeekFormat" data-parent-id="parentRow_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + self.attr('data-id') + `" data-title="` + self.attr('data-title') + `" data-count="0">
                            <i class="la la-plus"></i>
                        </a>`;
        } else {
            var classHidden = "hidden";
            var add = `<a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeDataTemplate" data-parent-id="parentBody_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + self.attr('data-id') + `" data-count="0">
                            <i class="la la-remove"></i>
                        </a>`;
        }
        var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter required_input ` + classHidden + `"
        multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[0][]">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>`;
        function makeTemplateBody(countNum) {
            var demo = `<tr data-site="` + self.attr('data-id') + `" class="parentRow" id="parentRow_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `" data-parent="appendBodyTemplate_0">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ self.attr("data-title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <input type="text" class="form-control m-input required_input" name="time_type[`+ countNum + `][` + self.attr("data-id") + `][]" data-lookup="lookup/ts/time_type" data-count="0" data-next="` + self.attr("data-id") + `" placeholder="Time Type">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 40px;">
                            `+ add + `
                        </td>
                    </tr>
                    <tr data-site="`+ self.attr('data-id') + `" class="subParentRow_` + self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempLabel required_input" name="" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="`+ countNum + `" data-next="` + self.attr("data-id") + `">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempValue required_input" name="" placeholder="Items" data-lookup-callback="itemSelected">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input appendAmount required_input" name="" placeholder="Amount">
                            <input type="hidden" class="stipend_item_id" name="">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `" data-id="` + self.attr('data-id') + `" data-count="0"  data-next="` + self.attr("data-id") + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr>`;
            return demo;
        }
        $('.templateTable tbody').each(function (i, v) {
            $(this).append(makeTemplateBody(i));
            $(this).attr("id", "appendBodyTemplate_" + i);
            $(this).addClass('bg-r');
        });
        $('.dayFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.timein_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '8:30 AM',
            showMeridian: false,
            template: false
        });
        $('.timeout_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
        $('.break_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });

        clickedSite++;
    } else {
        self.removeAttr('name');
        $('#siteLists').find('span[data-id="' + self.attr("data-id") + '"]').remove();
        $('.templateTable').find('tr[data-site="' + self.attr("data-id") + '"]').remove();
        $('.templateTable tbody').each(function (i, v) {

        });
        var main = $('.templateTable tbody').find('tr').first().attr("data-parent");
        var dayFilterl = $('#' + main).find('select.dayFilter').length;
        var hiddenl = $('#' + main).find('select.hidden').length;
        if (dayFilterl === hiddenl) {
            $('#' + main).find('select.dayFilter').first().removeClass("hidden");
            $('#' + main).find('div.dayFilter').first().removeClass("hidden");
            $('#' + main).find('tr').first().find('td').last().find('a').addClass('addWeekFormat btn-outline-info').removeClass('removeDataTemplate btn-outline-danger');
            $('#' + main).find('tr').first().find('td').last().find('a').find('i').addClass('la-plus').removeClass('la-remove');
        }
        clickedSite--;
    }
});
// var tbody_count = 1;
$(document).off('click', '.addWeekFormat').on('click', '.addWeekFormat', function (e) {

    e.preventDefault();
    var self = $(this);
    var tbody_count = $(this).attr("data-count");
    // var ind = $(this).attr("data-count");
    tbody_count++;
    if (tbody_count == 5) {
        return toastr.error("Cannot add more then " + tbody_count);
    }
    $('.templateTable').append('<tbody id="appendBodyTemplate_' + tbody_count + '"></tbody>');
    $('#siteLists span').each(function (i, v) {
        if (i == 0) {
            var classHidden = ""
        } else {
            var classHidden = "hidden"
        }
        var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter ` + classHidden + `"
        multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[`+ tbody_count + `][]">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>`;
        var add = `<a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeDataTemplate" data-parent-id="parentBody_` + $(this).attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + $(this).attr('data-id') + `">
                        <i class="la la-remove"></i>
                    </a>`;
        var demo = `<tr data-site="` + $(this).attr('data-id') + `" class="parentRow" id="parentRow_` + $(this).attr('data-id') + `" count="` + $(this).attr('data-id') + `" data-parent="appendBodyTemplate_` + tbody_count + `">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ $(this).attr("title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <input type="text" class="form-control m-input required_input" name="time_type[`+ tbody_count + `][` + $(this).attr("data-id") + `][]" data-lookup="lookup/ts/time_type" data-count="0" data-next="` + self.attr("data-id") + `" placeholder="Time Type">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 40px;">
                            `+ add + `
                        </td>
                    </tr>
                    <tr data-site="`+ $(this).attr('data-id') + `" class="subParentRow_` + $(this).attr('data-id') + `" data-count="` + $(this).attr('data-id') + `" data-parent="appendBodyTemplate_` + tbody_count + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempLabel required_input" name="" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="`+ tbody_count + `" data-next="` + $(this).attr('data-id') + `">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempValue required_input" name="" placeholder="Items" data-lookup-callback="itemSelected">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input appendAmount required_input" name="" placeholder="Amount">
                            <input type="hidden" class="stipend_item_id" name="">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ $(this).attr('data-id') + `" data-id="` + $(this).attr('data-id') + `" data-count="` + tbody_count + `" data-next="` + $(this).attr('data-id') + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr>`;
        $('.templateTable #appendBodyTemplate_' + tbody_count).append(demo);
        $('.templateTable #appendBodyTemplate_' + tbody_count).addClass('bg-r');
        $('.dayFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.timein_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '8:30 AM',
            showMeridian: false,
            template: false
        });
        $('.timeout_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
        $('.break_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
    });
    $(this).attr("data-count", tbody_count);
});
$(document).off('click', '.removeDataTemplate').on('click', '.removeDataTemplate', function (e) {
    e.preventDefault();
    var main = $(this).closest('tr').attr("data-parent");
    var trL = $('#' + main).find('tr').length;
    if (trL <= 2) {
        $('#' + main).remove();
    } else {
        $(this).closest('tbody').find('tr[data-site="' + $(this).attr('data-id') + '"]').remove();
        var dayFilterl = $('#' + main).find('select.dayFilter').length;
        var hiddenl = $('#' + main).find('select.hidden').length;
        if (dayFilterl === hiddenl) {
            $('#' + main).find('select.dayFilter').first().removeClass("hidden");
            $('#' + main).find('div.dayFilter').first().removeClass("hidden");
        }
    }
});
$(document).off('click', '.removeDataTemplateBody').on('click', '.removeDataTemplateBody', function (e) {
    e.preventDefault();
    $(this).closest('tbody').remove();
});
// var addtravelcount=0;
$(document).off('click', '.addTravelOption').on('click', '.addTravelOption', function (e) {
    e.preventDefault();
    var self = $(this);
    var count_i = self.closest('tbody').find('tr[data-site="' + self.attr("data-id") + '"]').length - 1;
    // console.log(count_i);
    if (count_i == 10) {
        return toastr.error("cannot add more than " + count_i);
    }
    var co = $(this).attr("data-count");
    var ne = $(this).attr("data-next");
    let site_id = self.attr('data-id');
    var options = `<tr data-site="` + self.attr('data-id') + `" class="subParentRow_` + self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                    <td colspan="3"></td>
                    <td colspan="2">
                        <input type="text" class="form-control m-input required_input tempLabel" name="travel_code[${co}][${site_id}][]" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="` + co + `" data-next="` + ne + `">
                    </td>
                    <td colspan="2">
                        <input type="text" class="form-control m-input required_input tempValue" name="travel_value[${co}][${site_id}][]" placeholder="Items" data-lookup-callback="itemSelected">
                    </td>
                    <td style="width: 80px;">
                        <input type="hidden" class="stipend_item_id" name="">
                        <input type="text" class="form-control m-input appendAmount required_input" name="travel_amt[${co}][${site_id}][]" placeholder="Amount">
                    </td>
                    <td style="width: 40px;">
                        <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `">
                            <i class="la la-remove"></i>
                        </a>
                    </td>
                </tr>`;
    self.closest('tr').after(options);
    // $('.templateTable').find('tbody[data-site="'+self.attr("data-id")+'"]').append(options);
    // addtravelcount++;
});
$(document).off('click', '.removeTravelOption').on('click', '.removeTravelOption', function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    // addtravelcount--;
});
$(document).off('focusin click', '.tempValue').on('focusin click', '.tempValue', function (e) {
    var c = $(this).closest('tr').find('.tempLabel').val();
    var count = $(this).closest('tr').find('.tempLabel').attr("data-count");
    var ne = $(this).closest('tr').find('.tempLabel').attr("data-next");
    if (c == "Mileage Reimbursements") {
        $(this).attr("data-lookup", 'lookup/getData/travel_option');
        $(this).attr("name", "travel_value[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.tempLabel').attr("name", "travel_code[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.appendAmount').attr("name", "travel_amt[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.stipend_item_id').attr("name", "travel_stipend_item_id[" + count + "][" + ne + "][]");
    } else if (c == "Food Service") {
        $(this).attr("data-lookup", 'lookup/getData/meal_option');
        $(this).attr("name", "meal_value[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.tempLabel').attr("name", "meal_code[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.appendAmount').attr("name", "meal_amt[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.stipend_item_id').attr("name", "meal_stipend_item_id[" + count + "][" + ne + "][]");
    }
})
function itemSelected(id) {
    ajaxRequest({
        url: 'itemSelection/' + id
    }, function (response) {
        if (response && response.data) {
            $('.modal').find('input[data-value="' + id + '"]').closest('tr').find('.appendAmount').val(response.data.amt);
            $('.modal').find('input[data-value="' + id + '"]').closest('tr').find('.stipend_item_id').val(response.data.id);
        }
    })
}
$(document).off('click', '.addSitesTemplate').on('click', '.addSitesTemplate', function (e) {
    e.preventDefault();
    var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter"
            multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[]">
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>`;
    var add = `<a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" data-parent-id="parentRow_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;">
                            <i class="la la-plus"></i>
                        </a>`;
    // }else{
    //     var weeks = '';
    //     var add = '';
    // }
    var demo = `<tbody data-site="` + self.attr('data-id') + `" class="parentBody" id="parentBody_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `">
                        <tr data-site="`+ self.attr('data-id') + `" class="parentRow" id="parentRow_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ self.attr("data-title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <select class="form-control m-input" name="time_type[`+ self.attr("data-id") + `][]">
                                <option value="regular">Regular Time</option>
                                <option value="jury">Jury Duty</option>
                            </select>
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ self.attr('data-id') + `][]">
                        </td>	
                        <td style="width: 40px;">
                            
                        </td>
                    </tr>
                    <tr class="subParentRow_`+ self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input" name="[]">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input" name="[]">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input" name="total_amt[]">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr></tbody>`;
    $('.templateTable').append(demo);
    $('.dayFilter').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true,
    });
    $('.timein_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '8:30 AM',
        showMeridian: false,
        template: false
    });
    $('.timeout_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '0:00',
        showMeridian: false,
        template: false
    });
    $('.break_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '0:00',
        showMeridian: false,
        template: false,
    });
});
/**
 * Autosize
 */



function initAutoSize() {
    var autosizeClass = '.autosize';
    autosize($(autosizeClass));
}
/**
 * volunteer Upload Files
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
function citySelectedWidget(id, origin) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $("#modalContainer *[name=city]").val(response.data[0].city);
            $("#modalContainer *[name=state]").val(response.data[0].state);
            $("#modalContainer *[name=zip]").val(response.data[0].zip_code);
        }
        // $("#volunteerFormWizard *[name=zip]").focus()
    })
}
$(document).off('keypress', 'input[name=vol_ssn]').on('keypress', 'input[name=vol_ssn]', function (e) {
    if ($(this).val().length > 7) {
        e.preventDefault();
    }
});
$(document).off('blur', '#selectSupervisor').on('blur', '#selectSupervisor', function (e) {
    e.preventDefault();
    var self = $(this);
    var v = self.val();
    if (v == '' || v == null) {
        return;
    }
    setTimeout(function () {
        var request = {
            url: 'getSupervisor/' + v,
            method: 'get'
        }
        ajaxRequest(request, function (response) {
            if (response.data === undefined || response.data.length == 0) {
                var p = self.offset();
                var top = p.top - 50;
                var left = p.left - 40;
                var t = `
                    <div id='lookup-popover' class='lookup-popover' style='will-change: transform;transform: translate3d(`+ left + `px, ` + top + `px, 0px);'>Not Found Supervisor</div>
                `;
                $('body').append(t);
                return;
            }
            $('#lookup-popover').remove();
            $.each(response.data, function (i, v) {
                $("#volunteerAddWizard").find('#supervisor').val(v.id);
                self.val(v.value);
            });
        });
    }, 1000);
});
function setSupervisor(id) {
    $('#supervisor').val(id);
}

var const_i = 1;
$(document).off('click', '#addFormVolunteerDetails').on('click', '#addFormVolunteerDetails', function (e) {
    e.preventDefault();
    if (const_i == 4) {
        return toastr.error("Cannot add more items");
    }
    var t = `
        <div class="col-md-12 widgetParentDiv m-t-10" data-count="`+ const_i + `">
            <div class="input-section">
                <input type="text" name="label[]" class="form-control form-control-sm" data-lookup="lookupForVolunteers1/volunteer_details" id="countLabel_`+ const_i + `" data-id="` + const_i + `">  
            </div>
            <div class="btn-section">
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField1" style="width:20px !important;height:20px !important;margin-top:5px;" data-count="`+ const_i + `">
                    <i class="la la-remove"></i>
                </a>
            </div>
        </div>
    `;
    $('#appendFormWidget').append(t);
    const_i++;
});

$(document).off('click', '.removeField1').on('click', '.removeField1', function (e) {
    e.preventDefault();
    var r = $(this).closest('.col-md-12[data-count=' + $(this).attr("data-count") + ']').find('input[name="label[]"]').val();
    var c = getCookie('volunteer_detail');
    var d = c.split(",");
    var index = d.indexOf(r);
    if (index > -1) {
        d.splice(index, 1);
    }
    var f = d.toString();
    setCookie('volunteer_detail', f);
    $(this).closest('.col-md-12[data-count=' + $(this).attr("data-count") + ']').remove();
    const_i--;
});
$(document).off('click', '.widgetParentDiv .lookup-list-items').on('click', '.widgetParentDiv .lookup-list-items', function (e) {
    e.preventDefault();
    var self = $(this);
    var id = self.attr('data-id');
    var parentid = self.closest('.lookup-lists').attr('data-lookup-id');
    var v = self.text();
    var c = getCookie('volunteer_detail');
    if (c !== '') {
        c = c + ',' + v;
    } else {
        c = v;
    }

    setCookie('volunteer_detail', c);
    var parent = $('input[data-value=' + id + '][data-ref=' + parentid + ']').attr("data-id");
    var target = $('#countLabel_' + parent).closest('.form-group');
    var co1 = $('#countLabel_' + parent).closest('.widgetParentDiv').attr("data-count");
    $('#countLabel_' + parent).closest('.form-group').find('input[target-id="countLabel_' + parent + '"]').closest('.col-md-12').remove();
    var t = `
        <div class="col-md-12" data-count="`+ co1 + `">
            <div class="input-section">
                <label for="value">`+ v + `</label>
                <input type="hidden" name="label[]" value="`+ v + `">
                <input type="text" name="value[]" class="form-control form-control-sm" target-id="countLabel_`+ parent + `" data-id="` + parent + `">  
            </div>
            <div class="btn-section">
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField1" style="width:20px !important;height:20px !important;margin-top:30px;" data-count="`+ co1 + `">
                    <i class="la la-remove"></i>
                </a>
            </div>
        </div>
    `;

    target.append(t);
    var targetInput = $('#countLabel_' + parent).closest('.form-group').find('input[target-id="countLabel_' + parent + '"]')

    targetInput.removeClass('m_datepicker');
    targetInput.removeAttr('data-lookup');
    if (v == "Stipend eligibility") {
        targetInput.removeClass('m_datepicker');
        targetInput.attr('data-lookup', 'lookupForVolunteers/stipend_eligibility');
    } else if (v == "Date of birth") {
        targetInput.removeAttr('data-lookup');
        targetInput.addClass('m_datepicker');
        $('.m_datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
        });
    } else {
        targetInput.removeAttr('data-lookup');
        targetInput.removeClass('m_datepicker');
    }
    targetInput.focus();
    $('#countLabel_' + parent).closest('.widgetParentDiv').remove();
});
/*
 * Volunteer Form 
 */
$(document).off('click', '#ApplicationSubmitBtn').on('click', '#ApplicationSubmitBtn', function (e) {
    e.preventDefault();
    deleteCookie('volunteer_detail');
    var self = this;
    // var data = arrangeData(['file']);

    let vols = $('.volunteer :input').serializeArray();
    let volunteer_detail = $('.volunteer_detail :input').serializeArray();
    let template_header = $('#modern-add-template :input').serializeArray();
    let template_body = $('#appendableTableDetails :input').serializeArray();


    // let vols = $('.volunteer :input').serializeArray();
    // let volunteer_detail = $('.volunteer_detail :input').serializeArray();
    // let template_header = $('#modern-add-template :input').serializeArray();
    // let template_body = $('#appendableTableDetails :input').serializeArray();


    // let combinedData = [...vols, ...volunteer_detail, ...template_header, ...template_body];

    $('#appendableTableDetails').find('input').prop('disabled', false);
    $('#appendableTableDetails').find('select').prop('disabled', false);

    var formData = new FormData($('#volunteerFormWizard')[0]);


    sendAjax({
        url: 'volunteerAddWidget/store',
        method: "post",
        data: formData,
        loader: true,
        processData: false,
        contentType: false
    }, function (response) {
        processModal();

        try {
            setCookie('volProfileView', response[0]['element']['volunteer_id']);
        } catch (e) {
            console.log(e.message);
        }
        // $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        // document.getElementById("volunteerFormWizard").reset();
        // $('.templateTable').find('tbody').remove();
        // $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
        // clickedSite=0;
        // tbody_count=0;
        // const_i=0;
        // $('#volunteerCreateModal').modal('hide');
        // $('#siteLists').empty();
        // $('.siteChecked').prop("checked", false);
        // if (response[0].hasOwnProperty('element') && response[0].element.hasOwnProperty('volunteer_id')) {
        //     routes.executeRoute('view/volunteer/{volunteer}', {
        //         url: 'view/volunteer/' + response[0].element.volunteer_id
        //     });
        // }
        // $('#vol_data_table').mDatatable('refresh');
        vDatatable.reload();

    })

    return;

    /*

    // Add loader
    addFormLoader();
    ajaxRequest({
        url: "volunteerAddWidget/store",
        method: "post",
        data : combinedData
        // form: 'volunteerFormWizard'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();
           
            if (response && response.status === 200) {
                
                // File Upload Section
                
                $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
                document.getElementById("volunteerFormWizard").reset();
                $('.templateTable').find('tbody').remove();
                $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
                clickedSite=0;
                tbody_count=0;
                const_i=0;
                $('#volunteerCreateModal').modal('hide');
                $('#siteLists').empty();
                $('.siteChecked').prop("checked", false);
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('volunteer_id')) {
                    routes.executeRoute('view/volunteer/{volunteer}', {
                        url: 'view/volunteer/' + response.data[0].element.volunteer_id
                    });
                }
            }
        });
    });
    */
});
// volunteer edit form
/*
 * Application Form Create For Client
 */
$(document).off('submit', '#volunteerEditFormWizard').on('submit', '#volunteerEditFormWizard', function (e) {
    e.preventDefault();
    deleteCookie('volunteer_detail');
    var self = this;

    // $('#appendableTableDetails').find('input').prop('disabled', false);
    // $('#appendableTableDetails').find('select').prop('disabled', false);

    var formData = new FormData($('#volunteerEditFormWizard')[0]);

    sendAjax({
        url: self.action,
        method: self.method,
        data: formData,
        loader: true,
        processData: false,
        contentType: false
    }, function (response) {

        processModal();
        toastr.success("Volunteer Successfully Updated");

        $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        document.getElementById("volunteerFormWizard").reset();
        $('.templateTable').find('tbody').remove();
        $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
        clickedSite = 0;
        tbody_count = 0;
        const_i = 0;
        $('#volunteerCreateModal').modal('hide');
        $('#siteLists').empty();
        $('.siteChecked').prop("checked", false);

        reloadDatatable('#vol_data_table');

    })

    // addFormLoader();
    // ajaxRequest({
    //     url: self.action,
    //     method: self.method,
    //     form: 'volunteerEditFormWizard'
    // }, function (response) {
    //     processForm(response, function () {
    //         removeFormLoader();
    //         /**
    //          * After Inserted Successfully Reset Form
    //          */
    //         if (response && response.status === 200) {
    //             /**
    //              * File Upload Section
    //              */
    //             $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
    //             document.getElementById("volunteerEditFormWizard").reset();
    //             $('.templateTable').find('tbody').remove();
    //             $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
    //             clickedSite=0;
    //             tbody_count=0;
    //             const_i=0;
    //             $('#volunteerCreateModal').modal('hide');
    //             $('#siteLists').empty();
    //             $('.siteChecked').prop("checked", false);
    //             reloadDatatable('#vol_data_table');
    //             if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('volunteer_id')) {
    //                 routes.executeRoute('view/volunteer/{volunteer}', {
    //                     url: 'view/volunteer/' + response.data[0].element.volunteer_id
    //                 });
    //             }
    //         }
    //     });
    // });
});
/*-------------------------------------------Site Location------------------------------------------------------*/
$(document).off('keyup', '.siteLocation').on('keyup', '.siteLocation', function () {
    var imp = $(this).val();
    var request = {
        url: '/volunteer/getsiteLocation',
        data: { site: imp },
        method: 'post',
        cancelPrevious: true
    };
    ajaxRequest(request, function (response) {
        if (imp != "") {
            $('#SearchSiteText').text('Search Result for ' + imp);
        }
        else {
            $('#SearchSiteText').html('Choose <abbr title="Site Location">Site Locaiton</abbr>');
        }
        $('#siteSearchResultLists').empty().append(response.data);
    });
});


$(document).off('blur', '#alt_id').on('blur', '#alt_id', function (e) {
    e.preventDefault();
    var id = $(this).val();
    let vol_id = $(this).attr('data-volunteer-id');

    ajaxRequest({ url: 'checkVolAlt/' + id + "?volunteer=" + vol_id }, function (response) {
        if (response.data == "exist") {

            $('#alt_id').addClass('input-required1');
            $('#alt_id').parent().find('#warning-span').html('Volunteer ID already exists.');


        } else {

            $('#alt_id').parent().find('#warning-span').html('');
            $('#alt_id').removeClass('input-required1');


            if (!vol_id) {
                $('.volAddTemplate').attr('data-sub-modal-route', `addTemplateVolunteer/${id}?requester=volEdit&reload=true&temporary=true`);
            }


        }
    });
});

$(document).off('blur', '#eStipendId').on('blur', '#eStipendId', function (e) {

    e.preventDefault();

    var eStipendId = $(this).val();
    const self = $(this);

    ajaxRequest({ url: 'checkEStipendId/"' + eStipendId + '"' }, function (response) {

        if (response.data === true) {
            self.next().html('eStipend Id Already Exists');
            self.addClass('input-required1');
        } else {
            self.next().html('');
            self.removeClass('input-required1')
        }

    })

});

function siteLocationSelected(data, data1) {
    if (data !== undefined) {
        $('#siteSearchResultLists').empty();
        $('#siteLists').empty();
        $.each(data, function (i, v) {
            var siteHeding = '<span title="' + data1[i].value + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
                '<i class="la la-check fs-12"></i> &nbsp;' + data1[i].value + '</span>';
            $('#siteLists').append(siteHeding);
            var t = `<a class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon">
                    <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                        <input type="checkbox" class="siteChecked" data-id="`+ v.value + `" data-title="` + data1[i].value + `" checked="checked" name="site_id[]" value="` + v.value + `">
                        <span></span>
                    </label>
                </span>
                <span class="m-list-search__result-item-text">`+ data1[i].value + `</span>
            </a>`;
            $('#siteSearchResultLists').append(t);
        });
        $('#volunteerAddWizard *[data-wizard-target="#m_wizard_form_step_2"]').find('a:first-child').trigger('click');
    }
}
$('.timein_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});
$('.timeout_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});
$('.break_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});

// $(document).off('blur', '.timeout_timepicker').on('blur', '.timeout_timepicker', function(){
//     var parent = $(this).closest('tr');
//     var start = parent.find('input.timein_timepicker').val();
//     var end = $(this).val();
//     var total = calculateTimeDiff(start, end);
//     parent.find('td:last-child').find('input').val(total);
// });

$(document).off('change', '.timein_timepicker, .timeout_timepicker').on('change', '.timein_timepicker, .timeout_timepicker', function () {

    var parent = $(this).closest('tr');

    var first = parent.find('input.timein_timepicker').val();
    var second = parent.find('input.timeout_timepicker').val();

    var total = calculateTimeDiff(first, second);

    parent.find('[name ^= "total_hr"]').val(total);
});

function diff(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);
    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}

function calculateTimeDiff(start, end) {
    start = start.split(":");
    end = end.split(":");
    if (end == '') return "0:00";
    var end = parseInt(end[0]) * 60 + parseInt(end[1]);
    var start = parseInt(start[0]) * 60 + parseInt(start[1]);
    var diff = Math.abs(end - start);
    let hours = parseInt(diff / 60);
    // return (int) hours+":"+diff%60;
    // return (hours < 9 ?"0"+hours : hours) + ":" + (diff%60 < 9 ? "0"+diff%60 : diff%60);
    return hours + ":" + (diff % 60 < 9 ? "0" + diff % 60 : diff % 60);
}
$('#supervisorFilter, .dayFilter').selectpicker({
    liveSearch: true,
    showTick: true,
    actionsBox: true,
});

function checkDefaultSite() {
    $('#siteSearchResultLists a input[name="default_site"]').each(function (index, input) {
        if (index === 0) {
            $(this).attr("checked", "checked");
        }
    });
}
