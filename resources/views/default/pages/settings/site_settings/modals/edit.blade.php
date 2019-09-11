<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Update Site Setting</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="LookupUpdate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Section
                        </label>
                        <select name="section" class="form-control m-bootstrap-select m-input" id="sectionSelect" title="Select Section">
                            @foreach(Config('section') as $key=>$value))
                            <option value="{{$key}}" @if($setting->section == $key) selected @endif>{{$value}}</option>
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
                               value="{{$setting->code}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value" class="required">
                            Value
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="value" placeholder="Value"
                               value="{{$setting->value}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="5">{{$setting->description}}</textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <!-- <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button> -->
            <button type="button" class="btn btn-success m-btn--pill float-right" id="EditSiteSettings"
                    data-target="LookupUpdate" data-dismiss="modal">Save
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
        actionsBox: true,
    });
    // $('.custom_disable').find('input, textarea, select').each(function (event) {
    //     $(this).attr("disabled", true);
    // });
    $(document).off('click', '#EditSiteSettings').on('click', '#EditSiteSettings', function (e) {
        var request = {
            url: '/site_settings/update/{{$setting->id}}',
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