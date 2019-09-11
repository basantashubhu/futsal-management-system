<div class="modal-dialog modal-lg custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Rate Plan
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
                        <form class="m-form m-form--label-align-right" id="RatePlanUpdate">
                <div class="row form-group m-form__group">
                    <div class="col-lg-8">
                        <label for="plan_name" class="required">
                            Plan Name
                        </label>
                        <input type="text" name="plan_name" class="form-control m-input" autocomplete="off" value="{{$rate_plan->plan_name}}">
                    </div>
                    <div class="col-lg-2">
                        <label for="start_date" class="required">Start Date</label>
                        <div class="input-group date">
                            <input type="text" class="form-control form-control-sm m-input m_datepicker_1" name="start_date" id="start_date" value="{{format_date($rate_plan->start_date)}}"  >
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="end_date" class="required">End Date</label>
                        <div class="input-group date">
                            <input type="text" class="form-control form-control-sm m-input m_datepicker_1" name="end_date" id="end_date" value="{{format_date($rate_plan->end_date)}}">
                        </div>
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="description">Description</label>
                        <textarea class="m-input form-control autogrow" name="description" rows="5" id="description">{{$rate_plan->description}}</textarea>
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="includes">Includes</label>
                        <textarea class="m-input form-control autogrow" name="includes" rows="5" id="includes">{{$rate_plan->includes}}</textarea>
                    </div>
                </div>
<!--                 <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="terms">Terms</label>
                        <textarea class="m-input form-control autogrow" name="terms" rows="5" id="terms">{{$rate_plan->terms}}</textarea>
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="notes">Notes</label>
                        <textarea class="m-input form-control autogrow" name="notes" rows="5" id="notes">{{$rate_plan->notes}}</textarea>
                    </div>
                </div> -->
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRatePlan" data-target="RatePlanUpdate" style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapDatepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
        $(document).ready(function() {
        $('#description').summernote();
        $('#includes').summernote();
        $('#terms').summernote();
        $('#notes').summernote();
    });
    $(document).off('click', '#submitRatePlan').on('click', '#submitRatePlan', function (e) {
        e.preventDefault();
        var request = {
            url: '/rate_plan/update/{{$rate_plan->id}}',
            method: 'post',
            form: $(this).attr('data-target')
        };
        // console.log(request);
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.rate_plan_datatable');
                removeFormLoader();
            });

        });
    });
</script>