<div class="modal-dialog" style="max-width: 970px;" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Map CSV Headers
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form id="uploadCSVhead" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="row">
                    @foreach($new_headers as $header)
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label @if($has = isset($mapping_headers[$header])) class="text-success" @else class="required" @endif>{{ $header }}</label>
                            <select name="map[{{ $header }}]" class="form-control mapping_index">
                                @if($has)
                                <option value="{{ $header }}" selected>{{ $header }}</option>
                                @else
                                <option></option>
                                    @foreach($mapping_headers as $h => $v)
                                        <option value="{{ $h }}">{{ $h }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitMappedCSV">
                Save
            </button>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('.mapping_index').select2({width: '100%', placeholder: 'Choose', dropdownParent: $('.modal.show')});

        $('#submitMappedCSV').off('click').on('click', function(e) {
            e.preventDefault();
            const request = {
                url: '/importer/uploadcsv',
                method: 'post',
                data: new FormData(document.getElementById('uploadCSVhead'))
            };
            request.data.append('table', '{{ request()->table }}');
            request.data.append('filename', '{{ $filename }}');
            request.data.append('skip_rows', '{{ request()->skip_rows }}');

            sendAjax(request, function(response) {
                processModal();
                toastr.success("Successfully Imported!");
                var jsonHtmlTable = ConvertJsonToTable(response.data);
                $('#fileImportTable').html(jsonHtmlTable);
            }, function(error) {
                toastr.error(error.data.message);
            });
        });
    });
</script>
