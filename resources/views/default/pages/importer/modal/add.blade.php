<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Upload CSV Format
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form id="uploadCSV" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <label class="m-dropzone dropzone ApplicationFiles full-width" for='photoId'>
                    <input type="file" class="hidden uploadApplicationFiles" name="file" id="photoId">
                    <div class="m-dropzone__msg dz-message needsclick">
                        <h3 class="m-dropzone__msg-title">
                            Drop a file here or click to upload
                        </h3>
                        <span class="m-dropzone__msg-desc">
                            Maximum upload size:
                            <strong>
                                8.39MB
                            </strong>
                        </span>
                    </div>

                </label>
                <div class="form-group m-form__group row">
                    <div class="col-md-6 col-lg-6">
                        <label for="skip_rows">Skip Rows</label>
                        <input type="number" name="skip_rows" class="form-control m-input" value="3" id="skip_rows">
                    </div>
                    <div class="col-md-6 col-lg-6">
                            <label for="exampleSelect1">Import to</label>
                            <select class="form-control m-input m-input--square tableName" name="table">
                                <option value="volunteers" @if($table == 'volunteers') selected @endif>Vounteers</option>
                                <option value="holiday" @if($table == 'holiday') selected @endif>Holiday</option>
                                <option value="address" @if($table == 'address') selected @endif>Address</option>
                                 <option value="sites" @if($table == 'sites') selected @endif>Sites</option>
                                <option value="pay_periods" @if($table == 'pay_periods') selected @endif>Stipend Period</option>
                            </select>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitCSV">
                Save
            </button>
            <button type="button" class="btn btn-accent m-btn--pill float-right mr-10" id="mapHeadersBefore">
                Map and Save
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">

    var checkImport;
    var count;

    BootstrapSelect.init();
    uploadFiles();
    $(document).off('click', '#submitCSV').on('click', '#submitCSV', function (e) {
        addCSVLoader();
        e.preventDefault();
        var field=$('.tableName').val();
        if(field=='application')
            window.open('#importer/monitor/application');

        var request = {
            url: '/importer/uploadcsv',
            method: 'post',
            form: $(this).attr('data-target')
        };

        ajaxRequest(request, function (response) {
            removeCSVLoader();
            if (response.data.status == 500){
                toastr.error(response.data.message);
            } else{
                toastr.success("Successfully Imported!");
                var jsonHtmlTable = ConvertJsonToTable(response.data);
                $('#fileImportTable').html(jsonHtmlTable);
            }
        });
        // removeCSVLoader();
    });

    $('#mapHeadersBefore').off('click').on('click', function(e) {
        const request = {
            url: 'importer/uploadcsv-headers',
            method: 'post',
            data: new FormData(document.getElementById('uploadCSV')),
            loader: true
        };
        sendAjax(request, function(response) {
            $('.modal.show').html(response);
        }, function(errorResponse) {
            if(errorResponse.status !== 422) return;
            const message = [];
            for(const [name, msg] of Object.entries(errorResponse.responseJSON.errors))
                message.push(msg);
            toastr.error(message.flat(1).join('<br>'));
        })
    });


    function callAjax(count) {
        setTimeout(function () {
            var request = {
                url: 'import/test',
                method: 'post',
                data: {count: i},
                beforeSend: changeLoader(i, count)
            };
            /*
                        ajaxRequest(request, function (response) {
                            console.log(response);
                        })*/
            $.ajax({
                url: 'demo/import',
                method: 'post',
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.data.count >0){
                        setTimeout(function () {
                            callAjax(response.date.count);
                        },500)
                    }

                }
            });
        }, 1000);
    }

    function changeLoader(count, total) {
        $('#CustomTableHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Importing ' + count + ' of ' + total + '</div></div>');
    }

    function beforeSend() {
        addCSVLoader();
    }


</script>