<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Rate
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="RateCreate">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="rate_type_id" class="required">
                            Rate Type
                        </label>
                        <select class="form-control m-input m-input--square form-control-sm" name="rate_type_id">
                            @if(isset($rate_types))
                            @foreach($rate_types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="treatment_type" class="required">
                            Procedure Type
                        </label>
                        <select class="form-control m-input m-input--square form-control-sm" name="treatment_id">
                            @if(isset($treatments))
                            @foreach($treatments as $type)
                            <option value="{{$type->id}}">{{ucfirst($type->treatment_name)}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="animal_type" class="required">
                            Animal Type
                        </label>
                        <select class="form-control m-input m-input--square form-control-sm" name="animal_type">
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="sex" class="required">
                            Sex
                        </label>
                        <select class="form-control m-input m-input--square form-control-sm" name="sex">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label for="cost" class="required">
                            Max Contingent
                        </label>
                        <input type="text" name="cost" class="form-control m-input form-control-sm" autocomplete="off">
                        <input type="hidden" name="plan_id" class="form-control m-input" autocomplete="off" value="{{$id}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRate"
                    data-target="RateCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $(document).off('click', '#submitRate').on('click', '#submitRate', function (e) {
        e.preventDefault();
        var request = {
            url: '/rate/store',
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.rate_datatable');
removeFormLoader();
            });

        });
    });
</script>