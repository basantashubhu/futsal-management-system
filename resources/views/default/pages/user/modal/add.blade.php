<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New User
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="userCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="fname" class="required">
                            First Name
                        </label>
                        <input type="text" class="form-control m-input" id="fname" name="fname" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label for="lname" class="required">
                            Last name
                        </label>
                        <input type="text" class="form-control m-input" id="lname" name="lname" autocomplete="off">
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="name" class="required">
                            Username <span id="nameExistsWarning"></span>
                        </label>
                        <input type="text" class="form-control m-input checkUserName" id="name" name="name" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="required">
                            Email <span id="emailExistWarning"></span>
                        </label>
                        <input type="email" class="form-control m-input checkEmailOnly" id="email" name="email"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="password" class="required">
                            Password
                            <small>(minimum 6 characters required)</small>
                        </label>
                        <input type="password" class="form-control m-input" id="password" name="password"
                               autocomplete="off">
                    </div>

                    <div class="col-lg-6">
                        <label for="password_confirmation" class="required">
                            Confirm Password
                        </label>
                        <input type="password" class="form-control m-input" id="password_confirmation"
                               name="password_confirmation" autocomplete="off">
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
                                <option value="{{$role->id}}">{{$role->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="alt_id">
                            Alt ID <label class="required">(M)</label>
                        </label>
                        <input type="text" class="form-control m-input" id="alt_id" name="alt_id" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success float-right m-btn--pill" id="submitUser"
                    data-target="userCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitUser').on('click', '#submitUser', function (e) {

        var request = {
            url: '/user/add',
            method: 'post',
            data: $('#userCreate').serializeArray(),
            loader: true
        };
        const self = $(this);        

        sendAjax(request, function (response) {

            reloadDatatable('.m_datatable');
            processModal();
            toastr.success("User successfully created");     

        }, function({responseJSON}){

            $('#userCreate').find(`input`).css('border-color', '#ccc');
            const messages = [];
            for(let [name, message] of Object.entries(responseJSON.errors)){
                $('#userCreate').find(`[name="${name}"]`).css('border-color', '#b12704');
                messages.push(message);
            }
            toastr.error("Please Check the Highlighted Fields. <br><br>"+ messages.flat(1).join('<br>'));
        });
    });

    $(document).off('blur', '.checkEmailOnly').on('blur', '.checkEmailOnly', function (e) {
        e.preventDefault();
        var self = $(this);
        var email = self.val();
        if (email) {
            sendAjax({
                url: 'checkUserEmail?email=' + email,
                cancelPrevious: true,
                method: 'get'
            }, function (response) {

                $('#emailExistWarning').html('');
                $('#submitUser').removeAttr('disabled');

            }, function(error){

                $('#emailExistWarning').html('<span style="color:#ffb822; font-size: 12px; margin-left: 4px; font-weight: normal;">Email already exist. Please use alternate email.</span>');
                $('#submitUser').attr('disabled', 'disabled');

                
            });
        }
    });

    $(document).off('blur', '.checkUserName').on('blur', '.checkUserName', function (e) {
        e.preventDefault();
        var self = $(this);
        var name = self.val();
        if (name) {
            sendAjax({
                url: 'checkUserName?name=' + name,
                cancelPrevious: true,
                method: 'get'
            }, function (response) {

                $('#nameExistsWarning').html('');
                $('#submitUser').removeAttr('disabled');

            }, function(error){

                $('#nameExistsWarning').html('<span style="color:#ffb822; font-size: 12px; margin-left: 4px; font-weight: normal;">Username already exists</span>');
                $('#submitUser').attr('disabled', 'disabled');

                
            });
        }
    });

    // reporting manager select 2 dropdown
    $('#rpt_mgr_id').select2({
        dropdownParent: $('#modalContainer'), width: "100%", placeholder: "Select",
        allowClear: true,
        ajax: {
            url: 'lookup/reporting_mgr', delay: 500,
            processResults: results => ({results})
        },
    }).on('select2:clear', function (e) {
        $(this).select2('close');
    });
    // role select
    $('#role_id').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true
    }).on('change', function () {
    });
    // selected sites
    $('#selected_sites').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true
    });
    function reloadSites() {
        const picker = $('#selected_sites').empty();
        sendAjax('user/{{ Auth::id() }}/sites-list', function (results) {
            for (const site of results) {
                picker.append(`<option value="${site.id}">${site.site_name}</option>`);
            }
            picker.selectpicker('refresh').selectpicker('selectAll');
        });
    }
</script>