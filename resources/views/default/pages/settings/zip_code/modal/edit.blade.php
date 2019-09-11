<div class="modal-dialog modal-md custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Zip Code
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="ZipCodeUpdate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Zip Code <span class="required">*</span>
                        </label>
                            <input type="text" class="form-control m-input" id="zip_code" name="zip_code" placeholder="19701" value="{{$zip_code->zip_code}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="city">
                            City <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="city" name="city" placeholder="City" value="{{$zip_code->city}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            State <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="state" name="state" placeholder="State" value="{{$zip_code->state}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="county">
                            County <span class="required">*</span>
                        </label>
                            <input type="text" class="form-control m-input" id="county" name="county" placeholder="county" value="{{$zip_code->county}}" autocomplete="off">
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
            <button type="button" class="btn btn-success m-btn--pill float-right" id="UpdateZipCode" data-target="ZipCodeUpdate" style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
    $(document).off('click', '#UpdateZipCode').on('click', '#UpdateZipCode', function (e) {
        var request = {
            url: '/zip_code/update/{{$zip_code->id}}',
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