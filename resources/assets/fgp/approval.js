
function appendApprovedTimesheetButton(datas) {
    var markup = '<div class="m-form__group row">\n' +
        '<div class="col-xl-6">' +
        '                            <div class="m-form__label m-form__label-no-wrap float-left">\n' +
        '                                <label class="m--font-bold m--font-danger" style="margin-top:3px;">Selected\n' +
        '                                    <span id="m_datatable_selected_number1">' + datas + '</span> records:</label>\n' +
        '                            </div>\n' +
        '<div class="m-form__control">\n' +
        '                                <div class="btn-toolbar"">\n' +
        '                                    <button class="hidden beforeAction" type="hidden"></button><button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllTimesheet" data-target="applicationForm" style="margin-left:10px;">' +
        '<span>' +
        'Approve All' +
        '</span>' +
        '</button>' +
        '\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            </div>\n' +
        '                </div>';
    $('#approvedTimesheet').html(markup);
}
function appendInitialButton() {
    var t = `<div class="m-form__group row">
                    <div class="col-xl-6">
                        <div class="m-form__label m-form__label-no-wrap float-left">
                            <label class="m--font-bold m--font-danger" style="margin-top:3px;">
                                Please Select Items:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <div class="btn-toolbar">
                                <button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllFinance" data-target="financeForm" style="margin-left:10px;"><span>Approve All</span></button>
                            </div>
                        </div>
                    </div>
                </div>`;
    $('#approvedTimesheet').html(t);
}


$(document).off('click', '.approveAllTimesheet').on('click', '.approveAllTimesheet', function (e) {
    e.stopPropagation();
    setCookie('forward_period_id', $(this).data('period-id'));
    processApproval.call(this, $(this).data('period-id'));
});

$(document).off('click', '.beforeAction1').on('click', '.beforeAction1', function (e) {
    e.stopPropagation();
});

function processApproval(period_id) {

    event.stopPropagation();

    const targets = $('.demoCheckedtimesheet');
    const self = $(this);
    const form = $(this).attr('data-target');


    if (targets.length > 0) {
        let data = [];
        targets.each(function (i, v) {
            data.push(this.value);
        });
        data = data.toString();
        // return console.log(data, data.length, $('.selected_timesheets:checked').length, $('.selected_timesheets:not(:checked)').length);

        $('.beforeAction1[data-period="' + period_id + '"]').attr('data-modal-route', 'timesheetApprovalView?data=' + data).click();

        $(document).off('click', '.actionCondition').on('click', '.actionCondition', function (e) {
            $('.actionCondition').attr('disabled', 'disabled');
            var request = {
                url: 'timesheetApprovalView',
                method: 'post',
                form: form
            };
            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    // $('.text-loader').remove();
                    removeFormLoader();
                    reloadDatatable('#finance_tableContainer_period');
                    $('#approvedFinance').html(`<div class="m-form__group row">
                    <div class="col-xl-6">
                        <div class="m-form__label m-form__label-no-wrap float-left">
                            <label class="m--font-bold m--font-danger" style="margin-top:3px;">
                                Please Select Items:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <div class="btn-toolbar">
                                <button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllFinance" data-target="financeForm" style="margin-left:10px;"><span>Posting All</span></button>
                            </div>
                        </div>
                    </div>
                </div>`);
                    $('.close1').trigger('click');
                });
            });

            $('.close').trigger('click');

            if ($(this).hasClass('queue')) {
                setTimeout(function () {
                    $('.close2').trigger('click');
                    $('#launchBeforeActionModal').click();
                    $('#applicationForm').find('.demoCheckedFinance').parent().parent().parent().next().next().find('span').append('');
                }, 1000);
            } else {
                setTimeout(function () { $('.close2').trigger('click'); }, 1000);
            }
        });
        // });
    } else {
        $('.periodBySelect').siblings('span').css('background', '#dc3545');
        return toastr.error('Please Select the Items');
    }
}

$(document).off('change', '.periodBySelect').on('change', '.periodBySelect', function (e) {
    const self = $(this);
    //  console.log(self.checked);
    const period_id = self.attr("data-period");
    $('.stipend_row' + period_id).find('.selected_timesheets').prop('checked', this.checked).eq(0).change();
    $('.stipend_row' + period_id).find('.siteBySelect').prop('checked', this.checked)/* .change() */;
    if ($(this).prop("checked") == true) {
        $('.periodBySelect').siblings('span').css('background', '#716aca');
    } else {
        $('.periodBySelect').siblings('span').css('background', '#bdc3d4');
    }
});
$(document).off('change', '.siteBySelect').on('change', '.siteBySelect', function (e) {
    const self = $(this);
    // $('.periodBySelect').siblings('span').css('background','#716aca');
    // const period_id = self.attr('data-period');
    // $(`.active_period${period_id}_site${site_id}`).prop('checked', this.checked).eq(0).change();
    $(`.${self.data('hash')}`).prop('checked', this.checked).eq(0).change();

});
$(document).on('click', 'label > .siteBySelect+span', e => e.stopPropagation());


$(document).off('change', '.selected_timesheets').on('change', '.selected_timesheets', function (e) {
    const self = $(this);
    const stipend_id = self.attr('data-period');
    const site_id = self.attr('data-site');

    const stipend_row = $('.stipend_row' + stipend_id);
    const targets = stipend_row.find('.selected_timesheets');

    const selectedChild = targets.filter((i, el) => el.checked);

    const siteChild = $(`.active_period${stipend_id}_site${site_id}`);
    const selectedSiteChild = siteChild.filter((i, el) => el.checked);

    const toggleCheck = targets.length === selectedChild.length;
    const siteToggleCheck = siteChild.length === selectedSiteChild.length;

    $('.periodBySelect[data-period="' + stipend_id + '"]').prop('checked', toggleCheck);
    $('.siteBySelect[data-period="' + stipend_id + '"][data-site="' + site_id + '"]').prop('checked', siteToggleCheck);

    stipend_row.parent().siblings('.list-group-item').find('.siteBySelect,.periodBySelect,.selected_timesheets')
        .prop('checked', false).removeClass('demoCheckedtimesheet'); // other timesheets
    $('.approveAllTimesheet[data-period-id!=' + stipend_id + ']').css('display', 'none'); // other approve button
    targets.removeClass('demoCheckedtimesheet');
    selectedChild.addClass('demoCheckedtimesheet');

    // const displayValue = $('.demoCheckedtimesheet').length > 0 ? 'block' : 'none';
    // $('.approveAllTimesheet[data-period-id='+ stipend_id +']').css('display', displayValue);
});

//
$(document).off('click', '.time-sheets .stipend_item').on('click', '.time-sheets .stipend_item', function () {
    hideShow(this);
});


function hideShow(element, forceShow = false) {

    forceShow = this ? this.forceShow || forceShow : forceShow;

    let stipend_id = element.getAttribute('data-stipend');
    let target = $('#time_sheet_data_tableContainer' + stipend_id);
    let caret = element.querySelector('.m-datatable__toggle-detail i.fa');
    if (target.data('slideDown') === 'true' && !forceShow) {
        target.slideUp();
        target.closest('.stipend_row' + stipend_id).removeClass('checked');
        if (caret) caret.className = 'fa fa-caret-right';
        target.data('slideDown', 'false');
    } else {
        target.slideDown();
        target.closest('.stipend_row' + stipend_id).addClass('checked');
        if (caret) caret.className = 'fa fa-caret-down';
        target.data('slideDown', 'true')
        if (typeof load_stipend_period === 'function')
            load_stipend_period(stipend_id);
    }
}
