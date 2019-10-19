<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Add Court
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form class="m-form m-form--label-align-right" id="courtCreateForm">
                <div class="m-portlet m-portlet--mobile" style="margin-bottom: 2rem;">
                    <div class="m-portlet__body bc-lightblue">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Name <span class="required">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    style="width: 91%;">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Organization <span class="required">*</span>
                            </label>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-11">
                                        <select name="organization_id" id="courtorg_id" class="form-control">
        
                                        </select>
                                    </div>
                                    <div class="col-md-1 pl-0">
                                        <button type="button" class="btn m-btn btn-sm btn-info"
                                            data-sub-modal-route="organizations/create"
                                            data-sub-modal-callback="selectOrganization" title="Add new organization">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                                                Contact
                                            </span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body bc-lightblue">
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12 mt-3">
                                        <label class="m-checkbox checkbox-yellow">
                                            <input type="checkbox" class="saveAsOrg" value="contact">
                                            <p>Same As Organization Contact</p>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Phone <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control m-input" id="cell_phone" name="cell_phone">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row no-pd-i">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control m-input" id="company_email"
                                            name="email">
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
                                    <div class="col-lg-12 mt-3">
                                        <label class="m-checkbox checkbox-yellow">
                                            <input type="checkbox" class="saveAsOrg" value="address">
                                            <p>Same As Organization Address</p>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
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
                                            placeholder="ZIP" name="zip_code">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">State <span class="required">*</span></label>
                                        <input type="text" class="form-control m-input" placeholder="State"
                                            name="state">
                                        {{-- <input type="hidden" name="county" value="USA"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitCourt"
                data-target="courtCreateForm">
                Save
            </button>
        </div>
    </div>
</div>

<script>

    $(function () {
        const organization = $('#courtorg_id').select2({
            width: '100%',
            placeholder: 'Choose',
            dropdownParent: $('#courtCreateForm'),
            ajax: {
                url: 'organizations/select2',
                processResults(results) {
                    return {
                        results
                    };
                }
            }
        });

        $('.saveAsOrg').off('change').on('change', function(e) {
            if(!organization.val()) return;
            const route = `organizations/${ organization.val() }/${ this.value }`;
            sendAjax(route, function(response) {
                const form = $('#courtCreateForm');
                for(let[name, value] of Object.entries(response)) {
                    if(!value) continue;
                    form.find(`[name="${ name }"]`).val(value);
                }
            });
        });

        $('#submitCourt').off('click').on('click', function (e) {
            e.preventDefault();

            const form = $(this).attr('data-target');
            var request = {
                url: '/courts/store',
                method: 'post',
                data: new FormData(document.getElementById(form))
            };

            sendAjax(request, function (response) {
                toastr.success('Court added successfully.');
                processModal();
            }, function (errResponse) {
                formValidation(errResponse, true);
            });
        });
    });

</script>
