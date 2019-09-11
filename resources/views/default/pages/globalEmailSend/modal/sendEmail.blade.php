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
                <input type="hidden" name="table" value="{{$table}}">
                <input type="hidden" name="appid" value="{{$id}}">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="from">
                            From <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="from" name="from" autocomplete="off"
                               value="{{$from}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="to">
                            To <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="to" name="to" autocomplete="off"
                               value="@if(isset($to)) {{$to}} @endif">
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
                            <input type="file" class="form-control hidden" id="myFile" multiple>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6">
                        <div class="myFiles">
                            <ul id="hereFiles">
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
            <button type="button" class="btn btn-secondary m-btn--pill float-left" id="loadForm"
                    data-sub-modal-route="loadSaveEmail?table={{$table}}" data-modal-callback="true">
                Load
            </button>
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
    /* $(document).ready(function(){
         var data = $('#ApplicationFilter').serialize()+'&'+  $('#ApplicationQuickSearch').serialize();
         ajaxRequest({
             url: 'sendExport/{{$table}}?'+data,
            method: 'get'
        }, function(response){
            if(response.data){
                $.each(response.data, function(index,val){
                    var myfile = '<li class="c-p"><span class="c-p fileView" data-file="'+val+'"><input name="file[]" value="'+val+'" class="form-control m-input c-p" readonly></span><span class="pull-right removeFile"><i class="fa fa-remove"></i></span></li>';
                    $('#hereFiles').append(myfile);
                });
            }
        });
    });*/
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
            url: '/sendEmail',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                $('#submitForm').parent().siblings('.modal-header').find('.close').trigger('click');
            });
        });
    });
    var count_i = 0;
    $(document).off('click', '.removeFile').on('click', '.removeFile', function (e) {
        e.preventDefault();
        if (count_i < 3) {
            var field = $(this).parent().remove();
            count_i++;
        } else {
            return toastr.error('Can\'t Remove! Atleast One file should be attached');
        }

    });
    $(document).off('change', '#myFile').on('change', '#myFile', function (e) {
        var files = this.files;
        // console.log(files);
        if (files) {
            console.log(files.length);
            $.each(files, function (index, val) {
                console.log(val.name);
                var size = Math.round(val.size / 1024);
                var myfile = '<li>' + val.name + ' - ' + size + ' bytes.<span class="pull-right removeFile"><i class="fa fa-remove"></i></span></li>';
                $('#hereFiles').append(myfile);
            });
        }
    });
    $(document).off('click', '#cancelBtn').on('click', '#cancelBtn', function (e) {
        $('#myFile').val('');
    });
</script>