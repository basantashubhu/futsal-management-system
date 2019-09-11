<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Procedure
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="createTreatment">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="treatment_name" class="required">
                            Name
                        </label>
                        <input type="text" class="form-control m-input" id="treatment_name" placeholder="Procedure Name" name="treatment_name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="treatment_type" class="required">
                            Procedure Type
                        </label>
                        <input type="text" class="form-control m-input" id="treatment_type" name="treatment_type" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_must" value="0" class="getChecked">
                            Is Must
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_metrics">
                            Description
                        </label>
                        <textarea class="form-control m-input" name="description" rows="6"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitTreament"
                    data-target="createTreatment">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitTreament').on('click', '#submitTreament', function (e) {
        e.preventDefault();
        var request = {
            url: '/treatment/store',
            method: 'post',
            form: $(this).attr('data-target')
        };
        // console.log(request);
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.treatment_datatable');
removeFormLoader();
            });

        });
    });
</script>