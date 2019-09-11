<div class="modal-dialog modal-md custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Procedure
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="updateTreatment">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="treatment_name" class="required">
                            Name
                        </label>
                        <input type="text" class="form-control m-input" id="treatment_name" name="treatment_name" autocomplete="off" value="{{$treatment->treatment_name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="treatment_type" class="required">
                            Procedure Type
                        </label>
                        <input type="text" class="form-control m-input" id="treatment_type" name="treatment_type" autocomplete="off" value="{{$treatment->treatment_type}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label class="m-checkbox">
                            <input type="checkbox" name="is_must" class="getChecked" @if($treatment->is_must) value="1" checked @else value="0" @endif>
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
                        <textarea class="form-control m-input" name="description" rows="6">{{$treatment->description}}</textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="treatmentUpdate" data-target="updateTreatment" style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
    $(document).off('click', '#treatmentUpdate').on('click', '#treatmentUpdate', function (e) {
        e.preventDefault();
        var request = {
            url: '/treatment/update/{{$treatment->id}}',
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