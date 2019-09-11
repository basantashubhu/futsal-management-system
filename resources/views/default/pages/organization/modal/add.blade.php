<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Add {{$title}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form class="m-form m-form--label-align-right" id="organizationCreate">
                <div class="m-portlet m-portlet--mobile"
                     style="margin-top: 1rem; margin-bottom: 3rem;">
                    <div class="m-portlet__body bc-lightblue">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Name <span class="required">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="cname" name="cname"
                                       style="width: 92%;">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                License Number <span class="required">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="lic_no" name="lic_no"
                                       style="width: 92%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-portlet m-portlet--creative m-portlet--bordered-semi no-m-bottom bc-lightblue" >
                            <div class="m-portlet__head no-height" >
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="flaticon-statistics"></i>
                                    </span>
                                        <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                        <span>
                                            Contact
                                        </span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body bc-lightblue">
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Phone <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control m-input" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control m-input" id="company_email" name="company_email">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Website <span class="required">*</span>
                                        </label>
                                        <input type="text" name="url" class="form-control m-input" id="url"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="m-portlet m-portlet--creative m-portlet--bordered-semi no-m-bottom bc-lightblue">
                            <div class="m-portlet__head no-height">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="flaticon-statistics"></i>
                                    </span>
                                        <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                        <span>
                                            Address
                                        </span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body bc-lightblue">
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Address 1 <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control m-input" id="add1" name="add1">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Address 2
                                        </label>
                                        <input type="text" class="form-control m-input" id="add2" name="add2">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">City <span class="required">*</span></label>
                                        <input type="text" class="form-control m-input" placeholder="City" name="city">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">Zip <span class="required">*</span></label>
                                        <input type="text" class="form-control m-input" data-lookup="lookup/zip/all"
                                               placeholder="ZIP" name="zip">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">State <span class="required">*</span></label>
                                        <input type="text" class="form-control m-input" placeholder="State"
                                               name="state">
                                        <input type="hidden" name="county" value="USA">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="type" value="{{$title}}">
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitOrganization"
                    data-target="organizationCreate" data-dismiss="modal">
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