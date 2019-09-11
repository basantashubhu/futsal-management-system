<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create new {{$code}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="LookupCreateFromMdl" class="m-form">

                <input type="hidden" class="form-control m-input" id="code" name="code" placeholder="Code"
                       autocomplete="off" value="{{$code}}">
                <div class="form-group m-form__group row">
                    <div class="col-lg-10">
                        <label for="value">
                            Value <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="value" placeholder="Value"
                               autocomplete="off">
                    </div>
                    <div class="col-lg-2">
                        <label for="sequence_num" data-container="body" data-toggle="m-tooltip" data-placement="bottom"
                               title data-original-title="Sequence Number" title="Sequence Number">
                            Num.
                        </label>
                        <input type="text" class="form-control m-input" id="sequence_num" name="sequence_num"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left cancelBtn" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitLookup"
                    data-target="LookupCreateFromMdl">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitLookup').on('click', '#submitLookup', function (e) {
        var request = {
            url: '/lookup/add',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.lookup_datatable');
                $('.cancelBtn').trigger('click');
                removeFormLoader();
            });

        });

    });
</script>