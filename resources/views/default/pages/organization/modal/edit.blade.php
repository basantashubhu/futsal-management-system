<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Organization
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form class="m-form m-form--label-align-right" id="organizationUpdate">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Organization Name <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="cname" name="cname"
                                       value="{{$organization->cname}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                License Number <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="lic_no" name="lic_no"
                                       value="{{$organization->lic_no}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Invoice Code <span class="required"></span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="invoice_code" name="invoice_code"
                                       value="{{$organization->invoice_code}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Add1 <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="add1" name="add1"
                                       value="{{$organization->address->add1}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Secondary Address <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="add2" name="add2"
                                       value="{{$organization->address->add2}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">City :</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input" placeholder="City" name="city"
                                       value="
                                        @if($organization->address->city)
                                       {{$organization->address->city}}
                                       @elseif(isset($organization->address->zip->city))
                                       {{$organization->address->zip->city}}
                                       @endif" autocomplete="off">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input" placeholder="State" name="state"
                                       value="
                                        @if($organization->address->state)
                                       {{$organization->address->state}}
                                       @elseif(isset($organization->address->zip->state))
                                       {{$organization->address->zip->state}}
                                       @endif" autocomplete="off">
                                <input type="hidden" name="county"
                                       value="
                                        @if($organization->address->county)
                                       {{$organization->address->county}}
                                       @elseif(isset($organization->address->zip->county))
                                       {{$organization->address->zip->county}}
                                       @endif">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control m-input" data-lookup="lookup/zip/all"
                                       placeholder="ZIP" name="zip"
                                       value="
                                         @if($organization->address->zip_code)
                                       {{$organization->address->zip_code}}
                                        @elseif(isset($organization->address->zip->zip_code))
                                       {{$organization->address->zip->zip_code}}
                                       @endif"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Phone <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input" id="phone" name="phone"
                                       value="{{$organization->contact->phone}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Email <span class="required">*</span> :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control m-input " rel="company_email" id="company_email"
                                       name="company_email" value="{{$organization->contact->company_email}}"
                                       autocomplete="off">
                                <button class="hidden" id="btnsubModal"></button>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Website :
                            </label>
                            <div class="col-lg-9">
                                <input type="text" name="url" class="form-control m-input" id="url" autocomplete="off"
                                       value="{{$organization->contact->url}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">
                                Organization Type :
                            </label>
                            <div class="col-lg-9">
                                <div class="m-input-icon">
                                    <input type="text" name="type" class="form-control m-input" id="type"
                                           data-lookup="/lookup/getData/organization_type" autocomplete="off"
                                           value="{{$organization->type}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Close
            </button>
            <!-- <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button> -->
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitOrganization"
                    data-target="organizationUpdate" data-id="{{$organization->id}}">Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    // $('.custom_disable').find('input, textarea, select').each(function (event) {
    //     $(this).attr("disabled", true);
    // });
    $('#submitOrganization').on('click', function (e) {
        var id = $(this).attr('data-id');
        var request = {
            url: '/organization/update/' + id,
            method: 'post',
            form: $(this).attr('data-target')
        };
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.m_datatable');
                routes.executeRoute('application/{id}', {
                    url: 'org/single/{{$organization->id}}'
                });
            });
        });
    });

</script>