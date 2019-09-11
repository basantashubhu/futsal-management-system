<style>
    .site_add_form {
        margin-bottom: 0 !important;
        box-shadow: none !important;
        background: #eeeeee !important;
    }

    .p5_0 {
        padding: 5px 0 !important;
    }

    .site_basic_info {
    }

    .site_additional_info {
        height: 482px;
    }

    .site_basic_info {
        margin-right: 0 !important;
    }

    .site_basic_info,
    .site_additional_info {
        background: #fafafa;
        padding: 30px 15px;
        -webkit-box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
        box-shadow: 0px 4px 10px 0px rgba(92, 75, 78, 0.08);

    }

    .custom_form_label {
        padding-left: 0;
        line-height: 2;
        font-weight: 500 !important;
    }

    legend#site_basic_info {
        font-size: 13px;
        background: #34bfa3;
        width: 133px;
        padding: 4px 10px;
        color: #fff;
        text-align: center;
        border-radius: 20px;
    }

    legend#site_additional_info,
    legend#site_address_info {
        font-size: 13px;
        background: #34bfa3;
        width: 170px;
        padding: 4px 10px;
        color: #fff;
        text-align: center;
        border-radius: 20px;
    }

    input[type="text"].site,
    input[type="email"].site {
        margin-bottom: 15px;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .site_basic_info, .site_additional_info {
        box-shadow: none;
    }

    .site_basic_info, .site_additional_info {
        background: #ffffff;
    }

    .custmt {
        margin-bottom: 20px;
        margin-top: 10px !important;
    }


</style>

<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                <i class="la la-plus cust_plus_icon"></i>
                <span>Add New Holiday</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider" style="background: #fff;">
            <!--begin::Form-->
            <div class="col-md-12" id="storedHolidaysContainer"
                 style="max-height: 200px; overflow-y: auto; display: none;">
                <fieldset class="site_basic_info pb-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>State</th>
                        </tr>
                        </thead>
                        <tbody id="storedHolidays">
                        </tbody>
                    </table>
                </fieldset>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed floatLabelForm"
                  id="holiday_add_form">
                <div class="row p-0">
                    <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                        <div class="row mp0">
                            <div class="col-sm-12 col-md-12 col-lg-12 mp0">
                                <fieldset class="site_basic_info" style="background: #e6e6e661;">
                                    <div class="form-group  row mp0">
                                        <div class="col-lg-4 field">
                                            <label class="required" for="ad_holiday_name">Holiday Name</label>
                                            <input type="text" name="name" id="ad_holiday_name" class="form-control m-input"
                                                   autocomplete="off">
                                        </div>
                                        <div class="col-lg-4 field">
                                            <label class="required" for="holidayDate">Date</label>
                                            <input type="text" name="hol_date" class="form-control" id="holidayDate"
                                                   autocomplete="off" value="{{$date}}">
                                        </div>
                                        <div class="col-lg-3 pr-0 field">
                                            <label class="required" for="cal_type">Holiday Type</label>
                                            <select name="cal_type" id="cal_type" class="cal_type">
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="m-input-icon">
                                                <a href="#" data-sub-modal-route="holiday_type_add" data-modal-callback="autoSelectHolType"
                                                   class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                                                    <i class="la la-plus"></i>
                                                </a>
                                            </div>
                                        </div>


                                        <input type="hidden" name="state_r" value="DE">

                                        <div class="col-lg-12 mt-25 field">
                                            <label for="exampleTextarea">Description</label>
                                            <textarea class="form-control m-input" name="description"
                                                      id="exampleTextarea" rows="3"></textarea>
                                        </div>
                                        <div class="col-lg-12 no-padding custmt">
                                            <div class="row">
                                                <div class="col-lg-4 no-left-pad field">
                                                    <label>Paid</label>
                                                    <span class="m-switch m-switch--outline m-switch--icon m-switch--accent">
                                                        <label>
                                                            <input type="checkbox" name="paid_flag">
                                                            <span class="mt-25"></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 no-right-pad field">
                                                    <label>Active</label>
                                                    <span class="m-switch m-switch--outline m-switch--icon m-switch--accent">
                                                        <label>
                                                            <input type="checkbox" name="is_active">
                                                            <span class="mt-25"></span>
                                                        </label>
                                                    </span>
                                                </div>

                                                <div class="col-lg-4 no-right-pad field">
                                                    <label>ETO Elig</label>
                                                    <span class="m-switch m-switch--outline m-switch--icon m-switch--accent">
                                                        <label>
                                                            <input type="checkbox" name="eto_eligibility">
                                                            <span class="mt-25"></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="saveHoliday"
                    data-target="holiday_add_form">
                Save
            </button>
        </div>
    </div>
</div>
@include('default.fgp.holiday.models.select2init')
<script>
    $(function () {
        $('#holidayDate').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'mm/dd/yyyy',
            parentEl: $('#holiday_add_form'),
        }).on("change", function () {
            $(this).closest('.field').find('label').first()
            .css({
                'position': 'absolute',
                'top': '-7px',
                'left': '30px',
                'background': 'white',
                'color': '#3780b7',
                'padding': '0 1px',
                'z-index': '9',
                'transition': '0.3s'
            });
        });
    })

    $('#holiday_add_form :input').each(function () {
        floatLabelInput(this, true, 30);
    }).bind('blur keypress keydown keyup', function () {
        floatLabelInput(this, true, 30);
    }).bind('focus', function () {
        floatLabelInput(this, false, 30);
    });

    $(document).off('click', '#saveHoliday').on('click', '#saveHoliday', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/holiday/store',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            if (response.response) {
                let formResponse = response.response.data;
                if ('errors' in formResponse) {
                    let messages = [];
                    for (let [key, message] of Object.entries(formResponse.errors)) {
                        messages.push(message);
                    }
                    toastr.error(messages.flat(1).join('<br>'));
                    return;
                }
            }
            toastr.success('Holiday added successfully.');
            reloadDatatable('#holiday_data_table');
            processModal();
        });
    });

    window.autoSelectHolType = (response) => {
        let data = response.data;
        if (!0 in data) return;
        data = data[0].data;
        $('#cal_type').html(`<option selected value="${data.id}">${data.value}</option>`);
    }
</script>