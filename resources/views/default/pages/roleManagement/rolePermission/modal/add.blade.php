<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Assign Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="rolePermissionCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed no-checkBox">

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                           Role <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" name="role_id" id="role_id">
                            <option value="">Select</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Action <span class="required">*</span>
                        </label>
                        <div class="row" id="action-holder">

                        </div>
                        {{--<input type="text" class="form-control m-input" id="action" name="action" placeholder="multiple action separate By |" autocomplete="off">--}}
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRolePermission" data-target="rolePermissionCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapSelect.init();
    $(document).off('click', '#submitRolePermission').on('click', '#submitRolePermission', function (e) {
        var request = {
            url: '/rolePermission/add',
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.m_datatable');
removeFormLoader();
            });
        });

    });


    $(document).ready(function (e) {
        var id = $(this).val();
        var request = {
            url: '/permission/getPermission/',
            method: 'get'
        };

        ajaxRequest(request, function (response) {
            var data = response.data;
            var content="";
            $(data).each(function (k, v) {
                content+='<div class="col-sm-3"><label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                        '<input class="no-checkBox" type="checkbox" name="permissions[]" value="'+v.id+'">'+
                        v.name.ucfirst()+
                        '<span></span> </label> </div>';
            });
            $('#action-holder').html('').html(content);
        })
    })
</script>