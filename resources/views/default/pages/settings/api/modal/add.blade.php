<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Api
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="ApiCreate" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="code" name="name" placeholder="Name of the Key"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value">
                            Redirect <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="redirect" placeholder="Redirect Url of Key"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                        <input type="hidden" name="user" value="1">
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitApiRequest"
                    data-target="ApiCreate" data-dismiss="modal">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitApiRequest').on('click', '#submitApiRequest', function (e) {
        var request = {
            url: '/client/api/store',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.client_api_database');
                removeFormLoader();
            });

        });

    });
</script>