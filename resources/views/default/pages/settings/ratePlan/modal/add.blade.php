<div class="modal-dialog modal-lg" role="document">
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
            <form class="m-form m-form--label-align-right" id="RatePlanCreate">
                <div class="row form-group m-form__group">
                    <div class="col-lg-8">
                        <label for="plan_name" class="required">
                            Plan Name
                        </label>
                        <input type="text" name="plan_name" class="form-control form-control-sm m-input" autocomplete="off">
                    </div>
                    <div class="col-lg-2">
                        <label for="start_date" class="required">Start Date</label>
                        <input type="text" class="form-control form-control-sm m-input m_datepicker_1" name="start_date" id="start_date">
                    </div>
                    <div class="col-lg-2">
                        <label for="end_date" class="required">End Date</label>
                        <input type="text" class="form-control form-control-sm m-input m_datepicker_1" name="end_date" id="end_date">
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="description">Description</label>
                        <textarea class="m-input form-control form-control-sm autogrow" name="description" rows="5" id="description"></textarea>
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="includes">Includes</label>
                        <textarea class="m-input form-control form-control-sm autogrow" name="includes" rows="5" id="includes"></textarea>
                    </div>
                </div>
<!--                 <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="terms">Terms</label>
                        <textarea class="m-input form-control form-control-sm autogrow" name="terms" rows="5" id="terms"></textarea>
                    </div>
                </div>
                <div class="row form-group m-form__group">
                    <div class="col-lg-12">
                        <label for="notes">Notes</label>
                        <textarea class="m-input form-control form-control-sm autogrow" name="notes" rows="5" id="notes"></textarea>
                    </div>
                </div> -->
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRatePlan"
                    data-target="RatePlanCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapDatepicker.init();
    BootstrapSelect.init();
    $(document).ready(function() {
        $('#description').summernote();
        $('#includes').summernote();
        $('#terms').summernote();
        $('#notes').summernote();
    });
    $(document).off('click', '#submitRatePlan').on('click', '#submitRatePlan', function (e) {
        e.preventDefault();
        var request = {
            url: '/rate_plan/add',
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