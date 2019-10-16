<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Organization
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="organizationCreate">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Organization Name <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="cname" name="cname">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                License Number <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="lic_no" name="lic_no" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                               Add1 <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                 <input type="text" class="form-control m-input" id="add1" name="add1">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Secondary Address <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="add2" name="add2">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">City</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input"  data-lookup="lookup/zip/all" placeholder="ZIP" name="zip">

                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input" placeholder="City" name="city">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input" placeholder="State" name="state">
                                <input type="hidden" name="country" value="USA">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Phone <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Email <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Website <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" name="url" class="form-control m-input" id="url" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Organization Type <span class="required">*</span>
                            </label>
                            <div class="col-lg-9">
                                <div class="m-input-icon">
                                    <input type="text" name="type" class="form-control m-input" id="type" data-lookup="/lookup/getData/organization_type" autocomplete="off">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="submitOrganization"
                    data-target="organizationCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('#submitOrganization').on('click', function (e) {
        e.preventDefault();
        var request = {
            url: '/organization/add',
            method: 'post',
            form: $(this).attr('data-target')
        };

        ajaxRequest(request, function (response) {

            processForm(response, function () {
                reloadDatatable('.m_datatable');
            });

        });
    });
</script>