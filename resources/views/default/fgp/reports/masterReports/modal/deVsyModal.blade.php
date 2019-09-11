<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                DE VSY
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->

        <div class="modal-body has-divider">
            <form id="holiday" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-6">
                        <label for="vsy_date_range" class="col-form-label">Date Range</label>
                        <input type="text" id="vsy_date_range" class="form-control">
                    </div>
                    
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                                               data-target="holiday">
                Save
            </button>

           {{--  <button data-sub-modal-route="reports/template/loadView?section=holiday" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button>
 --}}

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
                    @if($format != 'excel')
                        <option value="{{ $format }}">{{ strtoupper($format) }}</option>
                    @endif
                @endforeach
            </select>
        </div>

    </div>
</div>

<script>
$(function() {
    $('#format').selectpicker('val', 'csv');

    // $('.saveTemplate').off('click').on('click', function () {
    //     var form = $(this).data('target');
    //     var loadedData = $('#' + form).serializeArray();
    //     var self = $(this);
    //     saveTemplate('statement', loadedData, self);
    // });
    $('#vsy_date_range').daterangepicker({
        showCustomRangeLabel: false,
        format: 'mm/dd/yyyy',
        // startDate, endDate,
        // ranges
    });

    sendAjax('/vsy-calendar-fetch', function({data:calendars}) {
        let dateRange = [], startDate, endDate;
        const ranges = Object.fromEntries(calendars.map(x => {
            let dates = [x.start_date, x.end_date].map(d => moment(new Date(d.split(' ')[0].replace(/-/g, ','))));
            dateRange = dates;
            return [x.calendar_name, dates];
        }));
        if(dateRange.length === 2) {
            [startDate, endDate] = dateRange;
        } else {
            ranges["No range defined"] = [moment().startOf('year'), moment().endOf('year')];
            [startDate, endDate] = [moment().startOf('year'), moment().endOf('year')];
        }
        $('#vsy_date_range').daterangepicker({
            showCustomRangeLabel: false,
            format: 'mm/dd/yyyy',
            startDate, endDate,
            ranges
        });
    });
    

    $('#generateReport').off('click').on('click', function () {
        var format = $('#format').val();
        var request = {
            url: '/export/fgp_vsy_report/'+format+'?'+$.param({ returnFileName: '1', dateRange: $('#vsy_date_range').val() }),
            method: 'get'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadTable('de_vsy');
                removeFormLoader();
            });
        });
    });
});
</script>