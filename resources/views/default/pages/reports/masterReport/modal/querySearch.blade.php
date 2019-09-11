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
            <form id="rawQuery" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                    <div class="form-group m-form__group col-sm-12">
                        <label for="exampleTextarea">Sql Query</label>
                        <textarea class="form-control m-input m-input--air" id="sqlQuery" rows="10" name="rawQuery"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill saveTemplate" id="SubmitPetbtn"
                    data-target="rawQuery">
                Save
            </button>

            <button data-sub-modal-route="reports/template/loadView?section=raw_query" type="button"
                    class="btn btn-secondary m-btn--pill">
                Load
            </button>

            <button type="button" class="btn btn-info m-btn--pill float-right" id="generateReport"
                    data-target="rawQuery">
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
    $('#format').selectpicker('val', 'csv');

    $('.saveTemplate').off('click').on('click', function () {
        var form = $(this).data('target');
        var loadedData = $('#' + form).serializeArray();
        var self = $(this);
        saveTemplate('raw_query', loadedData, self);
    });

    $('#generateReport').off('click').on('click', function () {
        var format = $('#format').val();
        var request = {
            url: '/generate/rawQueryReport/'+format,
            form: $(this).attr('data-target'),
            data:{format:format},
            method: 'post'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadTable('raw_query');
                removeFormLoader();
            });
        });

    });
</script>