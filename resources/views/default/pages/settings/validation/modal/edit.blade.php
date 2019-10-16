<!-- Single row -->
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <i class="la la-edit cust_plus_icon"></i>
                <span>Update Lookup</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider bg-white">
            <form id="ValidationUpdate" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Section
                        </label>
                        <select name="section" class="form-control m-bootstrap-select m-input" id="sectionSelect">
                            @foreach($sections as $value))
                            <option value="{{$value->section}}"
                                    @if($validation->section == $value->section) selected @endif>{{ $value->section }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Code
                        </label>
                        <input type="text" class="form-control m-input" id="code" name="code" autocomplete="off"
                               value="{{$validation->code}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value" class="required">
                            Value
                        </label>
                        <textarea class="form-control m-input" rows="5" name="value"
                                  id="value">{{$validation->value}}</textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Description
                        </label>
                        <textarea class="form-control m-input" rows="3" name="description"
                                  id="description">{{$validation->description}}</textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <!-- <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button> -->
            <button type="button" class="btn btn-success m-btn--pill float-right" id="updateValidation"
                    data-target="ValidationUpdate">Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('#sectionSelect').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true
    });
    $(document).off('click', '#updateValidation').on('click', '#updateValidation', function (e) {
        var request = {
            url: '/validation/update/{{$validation->id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.validation_datatable');
                removeFormLoader();
            });
        });
    });
</script>