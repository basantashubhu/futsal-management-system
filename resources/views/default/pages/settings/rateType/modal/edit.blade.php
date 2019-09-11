<div class="modal-dialog modal-md custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Edit Rate Type
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="RateTypeUpdate">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="name">
                            Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" autocomplete="off" value="{{$rate_type->name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_metrics_type">
                            Rate Metrics Type <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" id="rate_metrics_type" name="rate_metrics_type">
                            <option value="weight" @if($rate_type->rate_metrics_type == 'weight') selected @endif>Weight</option>
                            <option value="age" @if($rate_type->rate_metrics_type == 'age') selected @endif>Age</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_metrics">
                            Rate Metrics <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="rate_metrics" name="rate_metrics" autocomplete="off" value="{{$rate_type->rate_metrics}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_unit">
                            Rate Unit <span class="required">*</span>
                        </label>
                        <div class="m-input-icon m-input-icon--left">
                            <input type="text" class="form-control m-input" id="rate_unit" name="rate_unit" autocomplete="off" value="{{$rate_type->rate_unit}}">
                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                <span>
                                    @if($rate_type->rate_metrics_type == 'weight') <i class="la la-krw" id="rateChangeIcon"></i> @endif
                                    @if($rate_type->rate_metrics_type == 'age') <i class="la la-birthday-cake" id="rateChangeIcon"></i> @endif

                                </span>
                            </span>
                        </div>
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
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRateType" data-target="RateTypeUpdate" style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
    $(document).off('click', '#submitRateType').on('click', '#submitRateType', function (e) {
        e.preventDefault();
        var request = {
            url: '/rate_type/update/{{$rate_type->id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        // console.log(request);
addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.rate_type_datatable');
removeFormLoader();
            });

        });
    });
    $(document).off('change', '#rate_metrics_type').on('change', '#rate_metrics_type', function(e){
        var self = $(this);
        var value = self.val();
        if(value == 'weight'){
            $('#rateChangeIcon').removeClass('la-birthday-cake');
            $('#rateChangeIcon').addClass('la-krw');
        }else{
            $('#rateChangeIcon').removeClass('la-krw');
            $('#rateChangeIcon').addClass('la-birthday-cake');
        }
    });
</script>