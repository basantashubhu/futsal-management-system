<style>
    .ApplicationFiles img {
        position: unset;
    }
</style>
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
               Upload Profile Picture
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form id="uploadProfile" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <label class="m-dropzone dropzone ApplicationFiles full-width" for='photoId'>
                    <div class="m-dropzone__msg dz-message needsclick">
                    <input type="file" class="hidden uploadApplicationFiles" name="photoIdProof" id="photoId">
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
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitImage" data-dismiss="modal" data-target="uploadProfile">
                Save
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    uploadFiles();
    $(document).off('click','#submitImage').on('click','#submitImage', function(e){
        e.preventDefault();
        var request = {
            url: '/profile/uploadProfile/{{$type}}/{{$id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };

        addFormLoader();
        ajaxRequest(request, function(response){
            removeFormLoader();
            processForm(response, function(){
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('profile')) {
                    $('.profile_picture').attr('src', 'data:image/gif;base64, '+response.data[0].element.profile);
                }else{
                    return toastr.error("Could not upload");
                }
            });
        });
    });
</script>