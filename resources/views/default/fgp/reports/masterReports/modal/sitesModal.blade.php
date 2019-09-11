<div class="modal-dialog modal-lg" role="document">

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
            <form id="sites" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">Region</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                        data-lookup="location/getData?type=region"
                               name="region[]" id="region" multiple title="All">
                    </div>
                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">County</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               name="county[]" data-lookup="location/getData?type=county"
                               id="county" multiple title="All">
                    </div>
                    <div class="col-sm-4">
                        <label for="example-text-input" class="col-form-label">City</label>
                        <input data-lookup="zip_code/getData/city"
                               class="form-control m-input form-control-sm m-input--air" type="text" value=""
                               name="city[]"
                               id="ledgerCity" multiple title="All">
                    </div>
                </div>
                <div class="form-group np-pd-left np-pd-bottom m-form__group row">
                    <div class="col-sm-4">
                        <label for="ReportSupervisors" class="col-form-label">Supervisors</label>
                        <select class="form-control" title="All"
                               name="supervisors[]"
                               id="ReportSupervisors" multiple>
                               @foreach ($supervisors as $supervisor)
                                   <option value="{{ $supervisor->id }}">{{ ucfirst($supervisor->member->fullname()) }}</option>
                               @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                                               data-target="sites">
                Save
            </button>
{{-- 
            <button data-sub-modal-route="reports/template/loadView?section=sites" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button>
 --}}

            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReport"
                    data-target="sites">
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
        $('#ReportSupervisors').selectpicker({
            width: '100%', doneButton: true, doneButtonText: 'Apply',
            liveSeach: true, actionsBox: true, selectedTextFormat: 'count'
        });
        replaceLookups(document.getElementById('sites'));

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
                url: '/fgp_generate/sitesReport/'+format,
                form: $(this).attr('data-target'),
                method: 'post'
            };

            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    reloadTable('sites');
                    removeFormLoader();
                });
            });
        });
    });
</script>