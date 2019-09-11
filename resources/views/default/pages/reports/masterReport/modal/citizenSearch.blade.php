<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Citizen Report
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->

        <div class="modal-body has-divider">
            <form id="pet" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left no-pd-bottom m-form__group row">


                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Date</label>
                        <input class="form-control m-input form-control-sm m-input--air dateRangePicker" type="text"
                               value="" name="dateRange" id="dateRange">
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">City</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               data-lookup="zip_code/getData/city" name="city" id="city" placeholder="City">
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Zip Code</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               data-lookup="zip_code/getData/zip_code"  name="zipCode" id="zip_code" placeholder="Zip Code">
                    </div>
                </div>

                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">State</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               data-lookup="zip_code/getData/state" name="state" id="city" placeholder="State">
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Citizen Name</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               data-lookup="client/lookup" name="clientName" id="" placeholder="Citizen Name">
                    </div>

                </div>


            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                    data-target="pet">
                Save
            </button>

            <button data-sub-modal-route="reports/template/loadView?section=pet" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button>

            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReportPet"
                    data-target="pet">
                Generate
            </button>

            <select class="form-control form-control-sm m-bootstrap-select m-input m-input--air selectPicker float-right m-r-10-i"
                    id="format" name="format"
                    title="Report Format" data-live-search="true"
                    data-actions-box="true" data-width="200"
                    data-selected-text-format="count > 3">
                @foreach($reportFormat as $format)
                    @if($format->value!='excel')
                        <option value="{{$format->value}}">{{strtoupper($format->value)}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    $('.selectPicker').selectpicker();
    var start = moment().startOf('year');
    var end = moment().endOf('Year');
    $('.dateRangePicker').daterangepicker({
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
    });

    $('#format').selectpicker('val', 'csv');

    $('.saveTemplate').off('click').on('click', function () {
        var form = $(this).data('target');
        var loadedData = $('#' + form).serializeArray();
        var self = $(this);
        saveTemplate('pet', loadedData, self);
    });

    $('#generateReportPet').off('click').on('click', function () {
        var format = $('#format').val();
        var request = {
            url: '/generate/citizenReport/' + format,
            form: $(this).attr('data-target'),
            data: {format: format},
            method: 'post'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadTable('citizen');
                removeFormLoader();
            });
        });

    });
</script>