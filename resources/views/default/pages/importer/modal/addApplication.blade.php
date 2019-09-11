<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
               {{ucfirst($table)}} Upload CSV Format
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
                <div class="form-group m-form__group">
                    <label for="exampleSelect1">Import to</label>
                    <select class="form-control m-input m-input--square" name="table">
                        <option value="zip_codes" @if($table == 'zip_codes') selected @endif>Zip Codes</option>
                        <option value="breeds" @if($table == 'breeds') selected @endif>Breeds</option>
                        <option value="organization" @if($table == 'organization') selected @endif>Providers</option>
                        <option value="vet" @if($table == 'vets') selected @endif>Vet</option>
                        <option value="client" @if($table == 'clients') selected @endif>client</option>
                        <option value="rate" @if($table == 'rate') selected @endif>Rates</option>
                        <option value="application" @if($table == 'application') selected @endif>Application</option>
                    </select>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitCSV" data-dismiss="modal"
                    data-target="uploadCSV">
                Save
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
        // var data = $('#uploadCSV').serializeArray();
        e.preventDefault();
        // var data = new FormData(document.getElementById('uploadCSV'));
        var request = {
            url: '/importer/application/uploadcsv',
            method: 'post',
            // data: data
            form: $(this).attr('data-target')
        };

        ajaxRequest(request, function (response) {
            // clearInterval(checkImport);
            removeCSVLoader();

            /*  count = response.data.count;
             if (count>0){
             callAjax(response.data.count);
             }*/
            var jsonHtmlTable = ConvertJsonToTable(response.data);
            $('#CustomTableHolder').html(jsonHtmlTable);
        });
        removeCSVLoader();
    });


    function runQueue() {
        var request = {
            url: '/importer/application/runQueue',
        };
        ajaxRequest(request, function (response) {});
    }


</script>