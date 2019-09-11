<!-- Single row field -->
<div class="modal-dialog modal-md" role="document" id="modal_form">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Add New Validation</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider bg-white">
            <form id="ValidationCreate" class="m-form floatLabelForm">
                <div class="form-group m-form__group row">
                    <div class="col-lg-11 field">
                        <label for="ValidationSection1" class="required">
                            Section
                        </label>
                        <input name="section" class="form-control m-bootstrap-select m-input" autocomplete="off"
                               id="ValidationSection1" title="Select Section"
                               data-lookup="/lookup/search-section?lookupview=true" value="{{ $section }}">
                    </div>
                    <div class="col-lg-1 pl-0">
                        <div class="btn-section">
                            <a href="javascript:void(0)" data-sub-modal-route="/lookup/section/add" id="AddSectionFly"
                               class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                               style="width:20px !important;height:20px !important;margin-top:5px;"
                               data-modal-callback="AfterSectionFlyClose">
                                <i class="la la-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12 field">
                        <label for="code" class="required">
                            Code
                        </label>
                        <input type="text" class="form-control m-input" id="code" name="code" autocomplete="off"
                        data-lookup="/validations/code/{{ $section?:'oooo' }}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12 field">
                        <label for="value" class="required">
                            Value
                        </label>
                        <textarea class="form-control m-input" rows="3" name="value" id="value"></textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12 field">
                        <label for="description">
                            Description
                        </label>
                        <textarea class="form-control m-input" rows="3" name="description" id="description"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success float-right m-btn--pill" id="SubmitValidation"
                    data-target="ValidationCreate">
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
    $('.floatLabelForm').off('focus input', ':input').on('focus input', ':input', function (e) {
        floatLabelInput(this);
    }).on('blur', ':input', function (e) {
        floatLabelInput(this, true);
    }).find(':input').each(function (i, elem) {
        floatLabelInput(this, true);
    });

    // focus in in code for lookup
    $('#code').off('focus').on('focus', function (e) {
        let value = $('#ValidationSection1').val();
        $(this).attr('data-lookup', '/validations/code/'+ value);
    });

    $(document).off('click', '#SubmitValidation').on('click', '#SubmitValidation', function (e) {
        var request = {
            url: '/validation/add',
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
    $('#ValidationSection1').off('keyup').on('keyup', function (e) {
        $('#AddSectionFly').attr('data-sub-modal-route', '/lookup/section/add?section_name=' + this.value);
    });
    window.AfterSectionFlyClose = function (resp) {
        if (!resp || !resp.data || !(0 in resp.data) || !resp.data[0].element) return;
        $('#ValidationSection1').val(resp.data[0].element);
    };

</script>