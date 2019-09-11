<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Save Email Template
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="templateSave" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Template Name
                        </label>
                        <input type="text" class="form-control m-input" id="TempCode" name="code" autocomplete="off"
                               value="{{$code}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" id="btnCancel" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitForm"
                    data-target="templateSave" data-form="{{$id}}">
                Save
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#btnCancel').on('click', '#btnCancel', function (e) {
        var request = {
            url: 'deleteSetEmail/{{$id}}',
            method: 'get'
        }
        ajaxRequest(request, function (response) {
        });
    });
    $(document).off('click', '#submitForm').on('click', '#submitForm', function (e) {
        var request = {
            url: 'save/' + $('#TempCode').val(),
            method: 'post',
            form: $(this).attr('data-form')
        }
        ajaxRequest(request, function (response) {
            processForm(response, function (response) {
                $('.close').trigger('click');
            });
        });
    });
</script>