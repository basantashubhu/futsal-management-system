<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Volunteer Summary
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->

        <div class="modal-body has-divider">
            <form id="volunteers" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="ReportRegion" class="col-form-label">Region</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                                placeholder="All" data-lookup="location/getData?type=region"
                               name="region[]" id="ReportRegion" multiple title="All">
                    </div>
                    <div class="col-sm-4">
                        <label for="ReportCounty" class="col-form-label">County</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               name="county[]" placeholder="All" data-lookup="location/getData?type=county"
                               id="ReportCounty" multiple title="All">
                    </div>
                    <div class="col-sm-4">
                        <label for="ReportCity" class="col-form-label">City</label>
                        <input placeholder="All" data-lookup="zip_code/getData/city"
                               class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               name="city[]"
                               id="ReportCity" multiple title="All">
                    </div>
                </div>
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="ReportSupervisor" class="col-form-label">Supervisors</label>
                        <select name="supervisors[]" id="ReportSupervisor" class="form-control" title="All" multiple>
                            @foreach ($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ ucwords($supervisor->member->fullname()) }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <label for="ReportSites" class="col-form-label">Sites</label>
                        <select name="sites[]" id="ReportSites" class="form-control" title="All" multiple>
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}">{{ ucwords($site->site_name) }}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                                               data-target="volunteers">
                Save
            </button>

            {{-- <button data-sub-modal-route="reports/template/loadView?section=volunteers" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button> --}}


            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReport"
                    data-target="volunteers">
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
    $(function() {
        $('#ReportSupervisor').selectpicker({
            width: '100%', doneButton: true, doneButtonText: 'Apply',
            liveSearch: true, actionsBox: true, selectedTextFormat: 'count'
        });
        $('#ReportSites').selectpicker({
            width: '100%', doneButton: true, doneButtonText: 'Apply',
            liveSearch: true, actionsBox: true, selectedTextFormat: 'count'
        });

        replaceLookups(document.getElementById('volunteers'));

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
            saveTemplate('statement', loadedData, self);
        });

        $('#generateReport').off('click').on('click', function () {
            var format = $('#format').val();
            var request = {
                url: '/fgp_generate/volunteerReport/'+format,
                form: $(this).attr('data-target'),
                data:{format:format},
                method: 'post'
            };

            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    reloadTable('volunteers');
                    removeFormLoader();
                });
            });
        });
    });
</script>