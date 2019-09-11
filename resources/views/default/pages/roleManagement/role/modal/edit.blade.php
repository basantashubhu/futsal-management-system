<div class="modal-dialog custom_disable modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Role
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="roleEdit" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Role Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" placeholder="dashboard" autocomplete="off" value="{{$role->name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Label <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="label" name="label" placeholder="multiple action separate By |" autocomplete="off" value="{{$role->label}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="float-right btn btn-accent m-btn--pill enable_form">Edit</button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="submitRole" data-target="roleEdit" data-id="{{$role->id}}"  style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find(':input').not('button').attr("disabled", true);

    $(document).off('click', '#submitRole').on('click', '#submitRole', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/role/update/'+id,
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();
        ajaxRequest(request,function (response) {
            processForm(response, function() {
                reloadDatatable('.m_datatable');
removeFormLoader();
            });
        });

    });
</script>