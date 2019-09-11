<div class="m-portlet m-portlet--full-height support-border-color">
	<!--begin::Form-->
	<form class="m-form m-form--fit m-form--label-align-left" id="addSupportForm">
		<div class="m-portlet__body">
			<div class="form-group m-form__group row">
				<label for="title" class="col-12 col-form-label">
					Title
				</label>
				<div class="col-12">
					<input class="form-control m-input" type="text" id="title" name="title" autocomplete="off">
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label for="description" class="col-12 col-form-label">
					Description
				</label>
				<div class="col-12">
					<textarea name="description" class="form-control m-input" id="description"></textarea>
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label for="description" class="col-12 col-form-label">
					File
				</label>
				<div class="col-6">
		            <label class="m-dropzone dropzone ApplicationFiles full-width p-rel justify-center" for='photoId'>
		                <input type="file" class="hidden uploadApplicationFiles" name="file" id="photoId">
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
				</div>
			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions">
				<div class="row">
					<div class="col-12">
						<button type="reset" class="btn m-btn--pill btn-md btn-success m-l-20" id="submitSupport" data-target="addSupportForm">
							Submit
						</button>
						<button type="reset" class="btn m-btn--pill btn-md btn-secondary">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
    $('#description').summernote(std.config.editorConfig);
});

$(document).off('click', '#submitSupport').on('click', '#submitSupport', function(e){
	e.preventDefault();
	var target = $(this).attr('data-target');
	var request = {
		url: 'support/store',
		method: 'post',
		form: target
	}
	addFormLoader();
	ajaxRequest(request, function(response){
		processForm(response, function(){
			removeFormLoader();
			if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('support_id')) {
                routes.executeRoute('support/viewSingle/{id}', {
                    url: 'support/viewSingle/' + response.data[0].element.support_id
                });
            }
            reloadDatatable('.support_table');
		});
	});
});
</script>