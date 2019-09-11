<!-- Single row field -->
<div class="modal-dialog modal-md" role="document" id="modal_form">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Settings
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="settingsCreate" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Code <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="code" name="code" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Type <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="type" name="type" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value">
                            Value <span class="required">*</span>
                        </label>
                        <textarea class="form-control m-input" rows="3" name="value" id="value"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="submitsetting" data-target="settingsCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitsetting').on('click', '#submitsetting', function (e) {
        var request = {
            url: '/user/settings/store',
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.validation_datatable');
removeFormLoader();
            });
        });
    });


</script>