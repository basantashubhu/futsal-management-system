<style>
    .m-body .m-wrapper {overflow: visible;}
</style>
<div class="tab-pane active" id="update_profile">
    <form class="m-form m-form--fit m-form--label-align-right" id="profileForm">
        <div class="m-portlet__body">
            <div class="form-group m-form__group m--margin-top-10 m--hide">
                <div class="alert m-alert m-alert--default" role="alert">
                    The example form below demonstrates common HTML form elements that receive updated
                    styles from Bootstrap with additional classes.
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-10 ml-auto">
                    <h3 class="m-form__section">
                        1. Personal Details
                    </h3>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    Full Name
                </label>
                <div class="col-3">
                    <input class="form-control m-input" type="text" name="first_name" value="{{$client->first_name}}" placeholder="First Name" data-container="body" data-toggle="m-tooltip" data-placement="bottom" title="" data-original-title="Tooltip title">
                </div>
                <div class="col-2">
                    <input class="form-control m-input" type="text" name="middle_ename" value="{{$client->middle_name}}" placeholder="Middle Name">
                </div>
                <div class="col-2">
                    <input class="form-control m-input" type="text" name="last_name" value="{{$client->last_name}}" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    Email
                </label>
                <div class="col-7">
                <input class="form-control m-input" type="text" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    Phone No.
                </label>
                <div class="col-7">
                    <input class="form-control m-input" type="text" name="cell_phone" value="{{ $contact->cell_phone ?? '' }}">
                </div>
            </div>
            <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
            <div class="form-group m-form__group row">
                <div class="col-10 ml-auto">
                    <h3 class="m-form__section">
                        2. Address
                    </h3>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    Address
                </label>
                <div class="col-7">
                    <input class="form-control m-input" type="text" value="@if(isset($address->id)) {{$address->add1}} @endif" name="add1">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    City
                </label>
                <div class="col-7">
                    <input class="form-control m-input" type="text"
                           value="@if(isset($address->id)) {{$address->city}} @endif" name="city">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    State
                </label>
                <div class="col-7">
                    <input class="form-control m-input" type="text" value="@if(isset($address->id)) {{$address->state}} @endif" name="state">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    Zipcode
                </label>
                <div class="col-7">
                    <input class="form-control m-input" type="text" value="@if(isset($address->id)) {{$address->zip_code}} @endif" name="zip_code">
                </div>
            </div>
            
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-7">
                        <button type="reset" class="btn btn-accent m-btn m-btn--pill m-btn--custom profileUpdate"
                                data-target='profileForm' data-id="{{$client->id}}">

                            Save changes
                        </button>
                        &nbsp;&nbsp;
                        <button type="reset" class="btn btn-secondary m-btn m-btn--pill m-btn--custom">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.profileUpdate').off('click').on('click',function (e) {
        // var id= $(this).attr('data-id');
        e.preventDefault();
        var request = {
            url: '/user/profile/update/{{$client->user_id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                removeFormLoader();
                routes.executeRoute('userProfile/{id}', {
                    url: 'userProfile/{{$client->user_id}}'
                });
            });

        });
    });

    function citySelectedProfile(id) {
        ajaxRequest({
            url: '/zip_code/city/' + id
        }, function (response) {
            if (response && response.data && response.data[0]) {
                $("#profileForm *[name=state]").val(response.data[0].state);
                $("#profileForm *[name=zip]").val(response.data[0].zip_code);
            }
        })
    }

</script>