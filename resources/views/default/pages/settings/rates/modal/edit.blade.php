<div class="modal-dialog modal-md custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Rate
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="RateUpdate">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_type_id" class="required">
                            Rate Type
                        </label>
                        <select class="form-control m-input m-input--square" name="rate_type_id">
                            @if(isset($rate_types))
                            @foreach($rate_types as $type)
                            <option value="{{$type->id}}" @if($rate->rate_type_id == $type->id) selected @endif>{{ucfirst($type->name)}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="treatment_type" class="required">
                            Treatment Type
                        </label>
                        <select class="form-control m-input m-input--square" name="treatment_id">
                            @if(isset($treatments))
                            @foreach($treatments as $type)
                            <option value="{{$type->id}}" @if($rate->treatment_id == $type->id) selected @endif>{{ucfirst($type->treatment_name)}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="animal_type" class="required">
                            Animal Type
                        </label>
                        <select class="form-control m-input m-input--square" name="animal_type">
                            <option value="dog" @if($rate->animal_type == "dog") selected @endif>Dog</option>
                            <option value="cat" @if($rate->animal_type == "cat") selected @endif>Cat</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="sex" class="required">
                            Sex
                        </label>
                        <select class="form-control m-input m-input--square" name="sex">
                            <option value="Male" @if($rate->sex == "Male") selected @endif>Male</option>
                            <option value="Female" @if($rate->sex == "Female") selected @endif>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="cost" class="required">
                            Max Contingent
                        </label>
                        <input type="text" name="cost" class="form-control m-input" autocomplete="off" value="{{$rate->cost}}">
                        <input type="hidden" name="plan_id" class="form-control m-input" autocomplete="off" value="{{$rate->plan_id}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="updateRate" data-target="RateUpdate" style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
    $(document).off('click', '#updateRate').on('click', '#updateRate', function (e) {
        e.preventDefault();
        var request = {
            url: '/rate/update/{{$rate->id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        // console.log(request);
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.rate_datatable');

removeFormLoader();
            });

        });
    });
</script>