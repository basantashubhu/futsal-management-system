<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Page
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="pageCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Page Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="page_name" name="page_name" placeholder="dashboard" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Action <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="action" name="action" placeholder="multiple action separate By |" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="submitPages" data-target="pageCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitPages').on('click', '#submitPages', function (e) {
        var request = {
            url: '/pages/add',
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