<style>
    .myFiles ul li span:last-child {
        margin: -5px -15px !important;
    }
</style>
<div class="modal-dialog modal-custom-medium-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Email Form
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="templateCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed"
                  enctype="multipart/form-data">
                
                @csrf
                <input type="hidden" name="table" value="{{ isset($table) ? $table : '' }}">
                <input type="hidden" name="table_id" value="{{ isset($table_id) ? $table_id : '' }}">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="from">
                            From <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control m-input" id="from" name="from" autocomplete="off"
                        value="{{ $config->email }}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="to">
                            To <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control m-input" id="to" name="to" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="subject">
                            Subject <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="subject" name="subject" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="message">
                            Message <span class="required">*</span>
                        </label>
                        <textarea class="form-control m-input" name="message" id="message"></textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-3" style="padding: 0px">
                        <div class="my-form">
                            <label for="myFile" style="padding: 6px 25px; background-color: #ddd; cursor: pointer;">
                                &nbsp;Attached Files</label>
                            <input type="file" class="form-control hidden" name="myFile[]" id="myFile" multiple>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-12">
                        <div class="myFiles">
                            <ul id="hereFiles">
                                @foreach($files as $file)
                                <li class="existing">{{ $file }}<span class="pull-right removeFile"><i class="fa fa-remove"></i></span>
                                    <input type="hidden" name="files[]" value="{{ $file }}">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12" style="padding: 0px;">

                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            {{-- <button type="button" class="btn btn-secondary m-btn--pill float-left" id="loadForm"
                    data-sub-modal-route="loadSaveEmail?table={{$table}}" data-modal-callback="true">
                Load
            </button> --}}
            <button type="button" class="btn btn-secondary m-btn--pill float-left" id="saveForm"
                    data-target="templateCreate">
                Save
            </button>
            <button class="hidden" id="hiddenBtn" data-modal-callback="sendEmailGlobal"></button>
            <button type="button" class="btn btn-secondary m-btn--pill float-left" id="saveDraft"
                    data-target="templateCreate">Save as Draft
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitForm"
                    data-target="templateCreate">
                Send
            </button>
            <button type="button" class="btn btn-secondary m-btn--pill float-right" id="cancelBtn" data-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>

<script>

    $(document).off('click', '#saveDraft').on('click', '#saveDraft', function (e) {
        var form = $(this).attr('data-target');
        var data = $('#' + form).serializeArray();
        if (data[4] && (data[4].value != '' || data[5].value != '')) {
            var request = {
                url: 'saveAsDraft',
                method: 'post',
                form: form
            }
            ajaxRequest(request, function (response) {
                if (response.hasOwnProperty('data')) {
                    toastr.success(response.data[0].data);
                }
            });
        }
    });
    $(document).off('click', '#saveForm').on('click', '#saveForm', function (e) {
        var form = $(this).attr('data-target');
        var data = $('#' + form).serializeArray();
        if (data[4] && (data[4].value != '' || data[5].value != '')) {
            $('#hiddenBtn').attr('data-sub-modal-route', 'saveTemplate/' + form);
            $('#hiddenBtn').trigger('click');
          /*  var request = {
                url: 'saveEmailTemplate',
                method: 'post',
                form: form
            }
            ajaxRequest(request, function (response) {
                // console.log(response.data);
                $('#hiddenBtn').attr('data-sub-modal-route', 'saveTemplate/' + response.data);
                $('#hiddenBtn').trigger('click');
            });*/
        }

    });

    $(document).off('click', '.fileView').on('click', '.fileView', function (e) {
        e.preventDefault();
        var file = $(this).data('file');
        window.open('viewFile?file=' + file);
    })
    $(document).ready(function () {
        $('#message').summernote(std.config.editorConfig);
    });
    $(document).off('click', '#submitForm').on('click', '#submitForm', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/fgp/sendEmail',
            method: 'post', loader: true,
            data: new FormData(document.getElementById(form))
        };
        sendAjax(request, function(res) {
            processModal();
            toastr.success(res.message);
        }, err => {
            if(err.status !== 422) return toastr.error('Can not send email.');
            processAjaxForm(err)
        });

        /* addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                $('#submitForm').parent().siblings('.modal-header').find('.close').trigger('click');
            });
        }); */
    });
    
    $(document).off('click', '.removeFile').on('click', '.removeFile', function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });
    $(document).off('change', '#myFile').on('change', '#myFile', function (e) {
        var files = this.files;
        let template = '';
        $.each(files, function (index, val) {
            var size = Math.round(val.size / 1024);
            template += '<li>' + val.name + ' - ' + size + ' bytes.<span class="pull-right removeFile"><i class="fa fa-remove"></i></span></li>';
        });
        let existingFiles = $('#hereFiles .existing').clone();
        $('#hereFiles').empty().append(existingFiles).append(template);
    });
    $(document).off('click', '#cancelBtn').on('click', '#cancelBtn', function (e) {
        $('#myFile').val('');
    });
</script>