<!-- Single row field -->
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Zip Code
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="ZipCodeCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <label for="zip_code" class="col-3 col-form-label">
                        Zip Code <span class="required">*</span>
                    </label>
                    <div class="col-9">
                        <input type="text" class="form-control m-input" id="zip_code" name="zip_code" placeholder="19701" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="city" class="col-3 col-form-label">
                        City <span class="required">*</span>
                    </label>
                    <div class="col-9">
                        <input type="text" class="form-control m-input" id="city" name="city" placeholder="City" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="state" class="col-3 col-form-label">
                        State <span class="required">*</span>
                    </label>
					<div class="col-9">
                        <input type="text" class="form-control m-input" id="state" name="state" placeholder="State" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="county" class="col-3 col-form-label">
                        County <span class="required">*</span>
                    </label>
					<div class="col-9">
                        <input type="text" class="form-control m-input" id="county" name="county" placeholder="county" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success float-right m-btn--pill" id="SubmitZipCode" data-target="ZipCodeCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#SubmitZipCode').on('click', '#SubmitZipCode', function (e) {
        var request = {
            url: '/zip_code/add',
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();
        ajaxRequest(request,function (response) {
            processForm(response, function() {
                reloadDatatable('.m_datatable');
removeFormLoader();
            });

        });

    });
</script>