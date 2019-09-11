<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
               Change Password
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
                    <div class="col-lg-12">
                        <label for="state">
                            Old Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control m-input" id="old_password" name="old_password"
                               autocomplete="off" onblur="checkPassword(this)">
                        <span id="wrong" style="color: red; display: none;">Doesn't Match With Your Old Password!</span>
                        <span id="wrong1" style="color: red; display: none;">Please Enter Old Password!</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            New Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control m-input" id="password" name="password"
                               autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control m-input" id="password_confirmation"
                               name="password_confirmation" autocomplete="off">
                        <span id="confirmation" style="color: red; display: none;">Password Do Not Match!</span>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="submitPass" data-target="userCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitPass').on('click', '#submitPass', function (e) {

        console.log(e);

        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        if(old_password){

            $('#old_password').css('border', '');
            $('#wrong1').css('display', 'none');
            if(new_password == confirm_password){
                $('#confirmation').css('display', 'none');
                    var request = {
                    url: '/profile/changePass',
                    method: 'post',
                    form: $(this).attr('data-target')
                };

                addFormLoader();
                ajaxRequest(request, function (response) {
                    removeFormLoader();
                    reloadDatatable('.m_datatable');
                });
            }
            else{
                $('#confirmation').css('display', 'block');
            }
        }
        else{
            $('#old_password').css('border', '1px solid red');
            $('#wrong1').css('display', 'block');
        }
    });

    function checkPassword(event){
        var old = $(event).val();
        var request = {
            url: '/profile/checkOldPass?pass='+old,
            method: 'get'
        };

        addFormLoader();
        ajaxRequest(request, function (response) {

            removeFormLoader();
            // console.log(response.data.pass);
            if(response.data.pass == 'true'){
                $('#old_password').css('border', '');
                $('#submitPass').removeAttr('disabled');
                $('#wrong').css('display', 'none');
            }
            else{
                $('#old_password').css('border', '1px solid red');
                $('#submitPass').attr('disabled', 'disabled');
                $('#wrong').css('display', 'block');
            }
            // processForm(response, function () {
            //     reloadDatatable('.m_datatable');
            // });
        });
    }
</script>