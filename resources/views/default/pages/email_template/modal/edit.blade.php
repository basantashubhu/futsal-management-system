<style>
    a.m-list-badge__item.insertintoTemp{
        line-height: 3;
    }
</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-edit cust_plus_icon"></i>
                <span>Update Template</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="templateEdit" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <input type="hidden" name="temp_code" value="{{$template->temp_code}}">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label for="temp_name">
                            Template Name
                        </label>
                        <input type="text" class="form-control m-input" id="temp_name" name="temp_name"
                               value="{{$template->temp_name}}" autocomplete="off">
                    </div>
                    <div class="col-lg-4">
                        <label for="temp_type" class="required">
                            Template Type
                        </label>
                        <input type="text" class="form-control m-input" id="temp_type" name="temp_type"
                               data-lookup="/lookup/getData/template_type" value="{{$template->temp_type}}"
                               autocomplete="off">
                    </div>
                    <div class="col-lg-4">
                        <label for="section" class="required">
                            Section
                        </label>
                        <input type="text" class="form-control m-input" id="section" name="section"
                               data-lookup="/lookup/getData/section" data-lookup-callback="testLoad" autocomplete="off"
                               value="{{$template->section}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-l-15-i">
                            <input type="checkbox" class="makeDefault" name="is_default" id="is_default" @if($template->is_default) value="1" data-checked="true" checked @else value="0" @endif>
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
                        <textarea class="form-control m-input" name="temp_json" id="temp_json" rows="2" placeholder="id,name">{{$template->temp_json}}</textarea>
                        <span class="m-form__help">Each dynamic field should be seperated by '<strong style="font-size: 15px">,</strong>' (comma).</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="temp_html" class="required">
                            Template Html
                        </label>
                        <textarea class="form-control m-input" name="temp_html" id="temp_html"
                                  rows="10">{{$template->temp_html}}</textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitForm"
                    data-target="templateEdit" data-id="{{$template->id}}">
                Save
            </button>
        </div>
    </div>
</div>

<script>

    // BootstrapDatetimepicker.init();
    // BootstrapSelect.init();
    // $('#temp_html').summernote(std.config.editorConfig);
    $(document).off('change', 'input.makeDefault').on('change', 'input.makeDefault', function(e){
        var self = $(this);
        if(self.prop('checked')){
            self.val(1);
            self.attr('data-checked', true);
        }else{
            self.val(0);
            self.attr('data-checked', false);
            self.removeAttr('checked');
        }
    });
    $(document).off('click', '#submitForm').on('click', '#submitForm', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/email_template/update/{{$template->id}}',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.template_datatable');
                removeFormLoader();
            });
        });
    });
    $(document).off('change', '#merge_field').on('change', '#merge_field', function(e){
        e.preventDefault();
        var mergeData = $('#merge_field option:selected').val();
        if(mergeData != 'no'){
            $('#temp_html').summernote('editor.insertText','{'+mergeData+'}');
        }
    });
</script>