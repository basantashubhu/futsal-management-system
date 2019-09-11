<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Provider Report
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->

        <div class="modal-body has-divider">
            <form id="provider" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left no-pd-bottom m-form__group row">

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Provider</label>
                        <select class="form-control form-control-sm m-bootstrap-select m-input m-input--air selectPicker"
                                id="provider" name="providerId[]"
                                multiple title="All Provider" data-live-search="true"
                                data-actions-box="true"
                                data-selected-text-format="count > 3">
                            @foreach($providers as $provider)
                                <option value="{{$provider->id}}">{{$provider->cname}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Date</label>
                        <input class="form-control m-input form-control-sm m-input--air dateRangePicker" type="text"
                               value="" name="dateRange"
                               id="dateRange">
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Organization Type</label>
                        <select class="form-control form-control-sm m-bootstrap-select m-input m-input--air selectPicker"
                                id="organizationType" name="type"
                                title="All" data-live-search="true"
                                data-actions-box="true"
                                data-selected-text-format="count > 3">
                            <option value="SP">Service Provider</option>
                            <option value="NP">Non Profit</option>
                        </select>
                    </div>

                </div>

                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">City</label>
                        <input data-lookup="zip_code/getData/city"
                               class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               name="city"
                               id="ledgerCity">
                    </div>

                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Zip</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value="" name="zip" id="zip">
                    </div>

                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                    data-target="provider">
                Save
            </button>

            <button data-sub-modal-route="reports/template/loadView?section=provider" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button>


            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReport"
                    data-target="provider">
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
        saveTemplate('provider', loadedData, self);
    });

    $('#generateReport').off('click').on('click', function () {
        var format = $('#format').val();
        var request = {
            url: '/generate/providerReport/'+format,
            form: $(this).attr('data-target'),
            data:{format:format},
            method: 'post'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadTable('provider');
                removeFormLoader();
            });
        });

    });
</script>