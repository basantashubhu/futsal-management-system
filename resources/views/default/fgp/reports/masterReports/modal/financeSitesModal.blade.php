<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Finance Sites
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
                        <label for="ReportStipendPeriod" class="col-form-label">Stipend Period</label>
                        <select name="period_id[]" id="ReportStipendPeriod" class="form-control" title="All" multiple></select>
                    </div>
                    <div class="col-sm-6">
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
    const selectPick = $('#ReportStipendPeriod').selectpicker({
        width: '100%', doneButton: true, doneButtonText: 'Apply',
        liveSearch: true, actionsBox: true, selectedTextFormat: 'count'
    });
    sendAjax('/stipend-period/lists?filtered=closed', function(results) {
        const options = results.map(x => {
            let text = $('<div></div>').html(x.text);
            text.find('span').append('&nbsp; &nbsp; &nbsp;');
            text = text.html();
            return `<option value='${ x.id }' data-content='${ text }'>${ x.text }</option>`;
        });
        selectPick.html(options.join('')).selectpicker('refresh');
    });

    $('#ReportSites').selectpicker({
        width: '100%', doneButton: true, doneButtonText: 'Apply',
        liveSearch: true, actionsBox: true, selectedTextFormat: 'count'
    })

    $('#generateReport').off('click').on('click', function () {
        var format = $('#format').val();
        var request = {
            url: '/fgp_generate/postedSiteReport/'+format,
            method: 'post',
            data : {
                filtered: 'false',
                query: {
                    period_no: selectPick.val().join(','),
                    site_name: $('#ReportSites').val().join('|')
                },
                saveLog: '1'
            }
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadTable('fiscal_sites');
                removeFormLoader();
            });
        });
    });
});
</script>