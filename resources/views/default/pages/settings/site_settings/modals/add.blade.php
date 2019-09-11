<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Create New Site Setting</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="createSettings" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Section
                        </label>
                        <select name="section" class="form-control m-bootstrap-select m-input" id="sectionSelect"
                                title="Select Section">
                            @foreach(Config('section') as $key=>$value))
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Code
                        </label>
                        <input type="text" class="form-control m-input" id="code" name="code" placeholder="Code"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value" class="required">
                            Value
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="value" placeholder="Value"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="description">
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitSettings"
                    data-target="createSettings">
                Save
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
    $(document).off('click', '#submitSettings').on('click', '#submitSettings', function (e) {
        var request = {
            url: '/site_settings/add',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.site_datatable');
                removeFormLoader();
            });

        });

    });
</script>