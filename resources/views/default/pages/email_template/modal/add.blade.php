<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Create New Template</span>
                
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="templateCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label for="temp_code">
                            Template Code
                        </label>
                        <input type="text" class="form-control m-input" id="temp_code" name="temp_code" autocomplete="off">
                    </div>
                    <div class="col-lg-3">
                        <label for="temp_name" class="required">
                            Template Name
                        </label>
                        <input type="text" class="form-control m-input" id="temp_name" name="temp_name" autocomplete="off">
                    </div>
                    <div class="col-lg-3">
                        <label for="temp_type" class="required">
                            Template Type
                        </label>
                        <input type="text" class="form-control m-input" id="temp_type" name="temp_type" data-lookup="/lookup/getData/temp_type" autocomplete="off">
                    </div>
                    <div class="col-lg-3">
                        <label for="section" class="required">
                            Section
                        </label>
                        <input type="text" class="form-control m-input" id="section" name="section" data-lookup="/lookup/getData/temp_section" data-lookup-callback="testLoad" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-l-15-i">
                            <input type="checkbox" class="makeDefault" name="is_default" id="is_default" value="0">
                                <p>Is this default template?</p>
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="temp_html" class="required">
                            Dynamic Fileds
                        </label>
                        <textarea class="form-control m-input" name="temp_json" id="temp_json" rows="2" placeholder="id,name"></textarea>
                        <span class="m-form__help">Each dynamic field should be seperated by '<strong style="font-size: 15px">,</strong>' (comma).</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="temp_html" class="required">
                            Template Html
                        </label>
                        <textarea class="form-control m-input" name="temp_html" id="temp_html"></textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="temp_instruction">
                            Template Instruction
                        </label>
                        <textarea class="form-control m-input" name="temp_instruction" id="temp_instruction"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitForm" data-target="templateCreate" data-dismiss="modal">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).ready(function() {
        $('#temp_html').summernote(std.config.editorConfig);
        $('#temp_instruction').summernote(std.config.editorConfig);
    });
    $(document).off('change', 'input.makeDefault').on('change', 'input.makeDefault', function(e){
        var self = $(this);
        if(self.prop('checked')){
            self.val(1);
            self.attr('data-checked', true);
        }else{
            self.val(0);
            self.removeAttr('data-checked', false);
        }
    });
    $(document).off('click', '#submitForm').on('click', '#submitForm', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/template/store',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function() {
                removeFormLoader();
                reloadDatatable('.template_datatable');
            });
        });
    });
</script>