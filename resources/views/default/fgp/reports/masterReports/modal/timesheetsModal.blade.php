<div class="modal-dialog" style="max-width:650px;" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                TimeSheet Summary
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->

        <div class="modal-body has-divider">
            <form id="timesheets" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">

                    <div class="col-md-4">
                        <label for="ReportStatus" class="col-form-label">Status</label>
                        <select title="All"
                            class="form-control m-input form-control-sm m-input--air" 
                            name="tsStatus[]" 
                            multiple
                            id="ReportStatus">
                            @foreach ($tsStatus as $status)
                                <option value="{{ $status }}">{{ ucwords($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label for="ReportPeriod" class="col-form-label">Period</label>
                        <select title="All"
                            class="form-control m-input form-control-sm m-input--air" 
                            name="period_no[]" 
                            multiple
                        id="ReportPeriod"></select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="ReportSupervisor" class="col-form-label">Supervisor</label>
                        <select title="All"
                            class="form-control m-input form-control-sm m-input--air" 
                            name="ts_supervisor[]" 
                            multiple
                            id="ReportSupervisor">
                            @foreach ($supervisors as $supervisor)
                                <option value="{{ $supervisor->member->fullname() }}">{{ $supervisor->member->fullname() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label for="ReportSites" class="col-form-label">Sites</label>
                        <select title="All"
                            class="form-control m-input form-control-sm m-input--air" 
                            name="sites[]" 
                            multiple
                            id="ReportSites">
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
                                               data-target="timesheets">
                Save
            </button>

            {{-- <button data-sub-modal-route="reports/template/loadView?section=timesheets" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button> --}}


            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReport"
                    data-target="timesheets">
                Generate
            </button>

            <select class="form-control form-control-sm m-bootstrap-select m-input m-input--air selectPicker float-right m-r-10-i"
                    id="format" name="format"
                    title="Report Format" data-live-search="true"
                    data-actions-box="true" data-width="200"
                    data-selected-text-format="count > 3">
                @foreach($reportFormat as $format)
                    @if($format!='excel')
                        <option value="{{$format}}">{{strtoupper($format)}}</option>
                    @endif
                @endforeach
            </select>
        </div>

    </div>
</div>

<script>
    $(function() {

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
            saveTemplate('statement', loadedData, self);
        });
    
        const selectPicker = $('#ReportPeriod').selectpicker({
            width: '100%', showTick: false,
            actionsBox: true, liveSearch: true,
            selectedTextFormat: 'count',
            doneButton: true, doneButtonText: 'Apply'
        });

        function load_stipend_periods(url) {
            sendAjax(url, function (resp) {
                resp = resp.map(function ({id, text}) {
                    if(false) {
                        const index = text.lastIndexOf('(');
                        text = text.slice(0, index);
                    }
                    return `<option value="${ id }" data-content="${ text }">${ text }</option>`;
                });
                selectPicker.html(resp.join('')).selectpicker('refresh');
                selectPicker.parent().find('.dropdown-menu.inner').addClass('scrollbar-light-blue');
            });
        }

        load_stipend_periods('/stipend-period/lists?filtered=both');
        
        $('#ReportSupervisor, #ReportStatus, #ReportSites').selectpicker({
            width: '100%', showTick: false,
            actionsBox: true, liveSearch: true,
            selectedTextFormat: 'count',
            doneButton: true, doneButtonText: 'Apply'
        }).on('hide.bs.select', function() {
            if(this.id == 'ReportStatus') {
                if($(this).val().length == 1) {
                    let value = $(this).val()[0];
                    if(value.toLowerCase() == 'posted') value = 'closed';
                    load_stipend_periods('/stipend-period/lists?filtered='+ value);
                } else {
                    load_stipend_periods('/stipend-period/lists?filtered=both');
                }
            }
        });
    
        $('#generateReport').off('click').on('click', function () {
            var format = $('#format').val();
            var request = {
                url: '/fgp_generate/timesheetReport/'+format,
                form: $(this).attr('data-target'),
                data:{format:format},
                method: 'post'
            };
    
            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    reloadTable('timesheets');
                    removeFormLoader();
                });
            });
        });
    });

</script>