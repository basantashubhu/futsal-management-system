<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    {{$title}}
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
                                    <input type="text" class="form-control m-input" id="cname" disabled name="cname"
                                        style="width: 92%;" value="{{ $organization->name }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    License Number <span class="required">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control m-input" id="lic_no" disabled name="lic_no"
                                        style="width: 92%;" value="{{ $organization->details('lic_no')->value ?? '' }}">
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
                                            <input type="text" class="form-control m-input" id="phone" disabled name="phone" value="{{ $organization->contact->cell_phone ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row no-pd-i">
                                        <div class="col-lg-12">
                                            <label class="col-form-label">
                                                Email <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" id="company_email" disabled name="company_email" value="{{ $organization->contact->email ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row no-pd-i">
                                        <div class="col-lg-12">
                                            <label class="col-form-label">
                                                Website <span class="required">*</span>
                                            </label>
                                            <input type="text" disabled name="url" class="form-control m-input" id="url" value="{{ $organization->contact->url ?? '' }}"
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
                                            <input type="text" class="form-control m-input" id="add1" disabled name="add1" value="{{ $organization->address->add1 ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row no-pd-i">
                                        <div class="col-lg-12">
                                            <label class="col-form-label">
                                                Address 2
                                            </label>
                                            <input type="text" class="form-control m-input" id="add2" disabled name="add2" value="{{ $organization->address->add2 ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row no-pd-i">
                                        <div class="col-lg-4">
                                            <label class="col-form-label">City <span class="required">*</span></label>
                                            <input type="text" class="form-control m-input" placeholder="City" disabled name="city" value="{{ $organization->address->city ?? '' }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-form-label">Zip <span class="required">*</span></label>
                                            <input type="text" class="form-control m-input" data-lookup="lookup/zip/all" value="{{ $organization->address->zip_code ?? '' }}"
                                                   placeholder="ZIP" disabled name="zip">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="col-form-label">State <span class="required">*</span></label>
                                            <input type="text" class="form-control m-input" placeholder="State" value="{{ $organization->address->state ?? '' }}"
                                                   disabled name="state">
                                            {{-- <input type="hidden" disabled name="county" value="USA"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" disabled name="type" value="{{$title}}">
                </form>
            </div>
    
            <!-- Modal Footer -->
            <div class="modal-footer" style="display: inline-block;">
                <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                    Cancel
                </button>
                <button type="button" class="btn btn-success m-btn--pill float-right makeEditable"
                        data-target="organizationCreate">
                    Edit
                </button>
                <button type="button" class="d-none btn btn-success m-btn--pill float-right" id="submitOrganization"
                        data-target="organizationCreate">
                    Update
                </button>
            </div>
        </div>
    </div>
    
    <script>
        $('#submitOrganization').off('click').on('click', function (e) {
            e.preventDefault();
    
            const form = $(this).attr('data-target');
            var request = {
                url: '/organizations/{{ $organization->id }}/update',
                method: 'post',
                data: new FormData(document.getElementById(form))
            };
    
            sendAjax(request, function(response) {
                toastr.success('Organization updated successfully.');
                processModal();
            }, function(errResponse) {
                formValidation(errResponse, true);
            });
        });
    </script>