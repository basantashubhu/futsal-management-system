<div class="modal-dialog modal-lg custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Assign Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="userPermissionCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed no-checkBox">

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            User <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" name="user_id" id="user_id" disabled="">
                            <option value="">Select</option>
                            @foreach($users as $user)
                            @continue($data->users_id!=$user->id)
                                <option value="{{$user->id}}" selected>{{$user->member->fullname()}}</option>
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
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-accent m-btn--pill enable_form">Edit</button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="submitUserPermission" style="display: none;" data-id="{{$user->id}}"  data-target="userPermissionCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $(document).off('click', '#submitUserPermission').on('click', '#submitUserPermission', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/userPermission/update/'+id,
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
        BootstrapSelect.init();
        $('.custom_disable').find(':input').not('button').attr("disabled", true);
        var permissions='{{$data->permissions}}'.split(',');
        var id = $(this).val();
        var request = {
            url: '/permission/getPermission/',
            method: 'get'
        };

        ajaxRequest(request, function (response) {
            var data = response.data;
            var content="";
            $.each(data, function (k, v) {

                if(permissions.indexOf(''+v.id+'')>=0)
                {
                    content+='<div class="col-sm-4"><label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                            '<input class="no-checkBox" type="checkbox" checked name="permissions[]" value="'+v.id+'">'+
                            v.name.ucfirst()+
                            '<span></span> </label></div> ';
                }
                else
                {
                    content+='<div class="col-sm-4"><label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                            '<input class="no-checkBox" type="checkbox" name="permissions[]" value="'+v.id+'">'+
                            v.name.ucfirst()+
                            '<span></span> </label></div>';
                }
            });
            $('#action-holder').html(content);
            $('.custom_disable').find(':input').not('button').attr("disabled", true);
        })
    })
</script>