<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span>Are you sure want to delete this support?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <div class="modal-body">
        	<form class="m-form m-form--fit m-form--label-align-left" id="editSupportForm">
				<div class="form-group m-form__group row no-pd">
					<label for="title" class="col-sm-12 col-form-label">
						Title
					</label>
					<div class="col-sm-12">
						<input class="form-control m-input" type="text" id="title" name="title" autocomplete="off" value="{{$support->title}}">
					</div>
				</div>
				<div class="form-group m-form__group row">
					<label for="description" class="col-12 col-form-label">
						Description
					</label>
					<div class="col-12">
						<textarea name="description" class="form-control m-input" id="description">{!! $support->description !!}</textarea>
					</div>
				</div>
			</form>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="reset" class="btn m-btn--pill btn-success" data-target="editSupportForm" id="updateSupport">
				Save
			</button>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#description').summernote(std.config.editorConfig);

});
$(document).off('click', '#updateSupport').on('click', '#updateSupport', function(e){
	e.preventDefault();
	var target = $(this).attr('data-target');
	var request = {
		url: 'support/update/{{$support->id}}',
		method: 'post',
		form: target
	}
	addFormLoader();
	ajaxRequest(request, function(response){
		processForm(response, function(){
			removeFormLoader();
			if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')) {
                routes.executeRoute('support/viewSingle/{id}', {
                    url: 'support/viewSingle/' + response.data[0].element.support_id
                });
            }
            reloadDatatable('.template_datatable');
		});
	});
});
</script>