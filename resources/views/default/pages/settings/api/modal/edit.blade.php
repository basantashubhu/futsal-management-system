<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit The Client Credentials
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="ApiEditForm" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" placeholder="Name "
                               autocomplete="off" value="{{$client->name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value">
                            Redirect <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="redirect" name="redirect"
                               placeholder="http:dhss.zeuslogic.com"
                               autocomplete="off" value="{{$client->redirect}}">
                    </div>

                </div>

            </form>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label for="value">
                        Client Id <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control m-input  " name="secretKey"
                           placeholder="http:dhss.zeuslogic.com"
                           autocomplete="off" value="{{$client->id}}" >
                </div>

            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label for="value">
                        Secret <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control m-input copyClick " name="secretKey"
                           placeholder="http:dhss.zeuslogic.com" id="CopyToClip"
                           autocomplete="off" value="{{$client->secret}}" >
                </div>

            </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="editApi"
                    data-target="ApiEditForm" data-dismiss="modal">
                update
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#editApi').on('click', '#editApi', function (e) {
        var request = {
            url: '/clientapi/update/{{$client->id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.client_api_database');
                removeFormLoader();
            });

        });

    });
    $(document).off('click', '.copyClick').on('click', '.copyClick', function (e) {
        var copyText = document.getElementById("CopyToClip");
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("Copy");

        /* Alert the copied text */
        toastr.success('Copied to Clipboard');
    });
</script>