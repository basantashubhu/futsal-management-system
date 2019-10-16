<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Upload File
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body uploadFiles">
            <!--Begin::Main Portlet-->
            <form class="m-form m-form--label-align-right" id="uploadFileHere" enctype="multipart/form-data">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Document Name</label>
                        <input type="text" name="anualProofTitle" class="form-control m-input form-control-sm" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label>Document Type</label>
                        <div class="input-group m-input-group">
                            <select name="document_type" class="form-control m-input form-control-sm">
                                @foreach($types as $type)
                                <option value="{{$type->value}}">{{$type->value}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text " style="padding: 5px 10px;" data-sub-modal-route="lookup/get/document_type"><i class="fa fa-info"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="m-dropzone dropzone ApplicationFiles full-width p-rel justify-center" for='photoId'>
                    <input type="file" class="hidden uploadApplicationFiles" name="photoIdProof" id="photoId">
                    <div class="m-dropzone__msg dz-message needsclick fileDetail">
                        <h3 class="m-dropzone__msg-title">
                           Drop a file here or click to upload
                        </h3>
                        <span class="m-dropzone__msg-desc">
                            Maximum upload size:
                            <strong>
                                8.39 MB
                            </strong>
                        </span>
                    </div>
                </label>
            </form>
            <!--End::Main Portlet-->
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitFile" data-target="uploadFileHere">
                Save
            </button>
        </div>

    </div>
</div>


<script type="text/javascript">
    if($) {
        $(document).off('click', '#submitFile').on('click', '#submitFile', function(e){
            $(this).attr('disabled', true);
            e.preventDefault();
            // console.log($('#uploadFileHere').serializeArray());
            var request = {
                url: 'organization/uploadFile/{{$organization->id}}',
                method: 'post',
                form: $(this).attr('data-target')
            };
            addFormLoader();
            ajaxRequest(request, function(response){
                removeFormLoader();
                processForm(response, function () {
                    routes.executeRoute('org/single/{id}', {
                        url: 'org/single/{{$organization->id}}'
                    });
                });
            });
        });
    }
</script>