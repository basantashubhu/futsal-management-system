<div class="modal-dialog modal-lg" role="document">
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
            <form id="changePassword" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="state">
                            Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control m-input" id="password" name="password"
                               autocomplete="off">
                    </div>

                    <div class="col-lg-6">
                        <label for="state">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control m-input" id="password_confirmation"
                               name="password_confirmation" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success float-right m-btn--pill" id="submitUserPassword" data-target="changePassword" data-id="{{$user->id}}">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitUserPassword').on('click', '#submitUserPassword', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/user/changePassword/'+id,
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function ({response}) {
                reloadDatatable('.m_datatable');
                removeFormLoader();
                const messages = [];
                for (let [name, message] of Object.entries(response.data.errors)) {
                    messages.push(message);
                }
                toastr.error(messages.flat(1).join('<br>'));
            });
        });
    });
</script>