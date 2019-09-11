<div class="modal-dialog custom_disable modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit User
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="userEdit" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="fname" class="required">
                            First Name
                        </label>
                        <input type="text" class="form-control m-input" id="fname" name="fname" autocomplete="off" value="{{$user->self->first_name}}">
                    </div>
                    <div class="col-lg-6">
                        <label for="lname" class="required">
                            Last name
                        </label>
                        <input type="text" class="form-control m-input" id="lname" name="lname" autocomplete="off" value="{{$user->self->last_name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="name" class="required">
                            Username <span id="nameExistsWarning"></span>
                        </label>
                        <input type="text" class="form-control m-input checkUserName" id="name" name="name" value="{{$user->name}}" data-user-id="{{$user->id}}" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="required">
                            Email  <span id="emailExistWarning"></span>
                        </label>
                        <input type="email" class="form-control m-input checkEmailOnly" id="email" name="email" value="{{$user->email}}" autocomplete="off" data-user-id="{{$user->id}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="role_id" class="required">
                            Role
                        </label>
                        <select class="form-control m-input" name="role_id" id="role_id">
                            <option value="">Select</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" {{$user->role_id==$role->id?"selected":""}}>{{$role->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="alt_id">
                            Alt ID <label class="required">(M)</label>
                        </label>
                        <input type="text" class="form-control m-input" id="alt_id" name="alt_id" value="{{$user->alt_id}}" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-success float-right m-btn--pill" id="updateUser" data-target="userEdit" data-id="{{$user->id}}">Update</button>
        </div>
    </div>
</div>

<script>

    BootstrapSelect.init();

    $(document).off('click', '#updateUser').on('click', '#updateUser', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/user/update/'+id,
            method: 'post',
            data: $('#userEdit').serializeArray(),
            loader: true
        };
        sendAjax(request, function (response) {
            reloadDatatable('.m_datatable');
            processModal();
            toastr.success("User successfully updated");   
            
        }, function({responseJSON}){

            $('#userEdit').find(`input`).css('border-color', '#ccc');


            for(let name in responseJSON.errors){


                $('#userEdit').find(`[name="${name}"]`).css('border-color', '#b12704');

            }

            toastr.error("Please Check the Highlighted Fields")

        });
    });

    $(document).off('blur', '.checkEmailOnly').on('blur', '.checkEmailOnly', function (e) {
        e.preventDefault();
        var self = $(this);
        var email = self.val();
        let user_id = $(this).attr('data-user-id');

        if (email) {
            sendAjax({
                url: 'checkUserEmail?email=' + email+"&user_id="+user_id,
                cancelPrevious: true,
                method: 'get'
            }, function (response) {

                $('#emailExistWarning').html('');
                $('#updateUser').removeAttr('disabled');

            }, function(error){

                $('#emailExistWarning').html('<span style="color:#ffb822; font-size: 12px; margin-left: 4px; font-weight: normal;">Email already exist. Please use alternate email.</span>');
                $('#updateUser').attr('disabled', 'disabled');

                
            });
        }
    });

    $(document).off('blur', '.checkUserName').on('blur', '.checkUserName', function (e) {
        e.preventDefault();
        var self = $(this);
        var name = self.val();
        let user_id = $(this).attr('data-user-id');

        if (name) {
            sendAjax({
                url: 'checkUserName?name=' + name+"&user_id="+user_id,
                cancelPrevious: true,
                method: 'get'
            }, function (response) {

                $('#nameExistsWarning').html('');
                $('#updateUser').removeAttr('disabled');

            }, function(error){

                $('#nameExistsWarning').html('<span style="color:#ffb822; font-size: 12px; margin-left: 4px; font-weight: normal;">Username already exists</span>');
                $('#updateUser').attr('disabled', 'disabled');

                
            });
        }
    });

    $('#rpt_mgr_id').select2({
        dropdownParent: $('#modalContainer'),
        allowClear: true,
        width: "100%",
        placeholder:"Select",
        ajax : {
            url : 'lookup/reporting_mgr',
            processResults : results => ({ results }),
            delay: 500
        }
    }).on('select2:clear', function () {
        $(this).select2('close');
    });

    $('#selected_sites').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true
    });

    function reloadSites() {
        const picker = $('#selected_sites').empty();
        sendAjax('user/{{ $user->id }}/sites-list', function (results) {
            for (const site of results) {
                picker.append(`<option value="${site.id}">${site.site_name}</option>`);
            }
            picker.selectpicker('refresh').selectpicker('selectAll');
        });
    }
</script>