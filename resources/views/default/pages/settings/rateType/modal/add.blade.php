<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Rate Type
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body ">
            <form class="m-form m-form--label-align-right" id="RateTypeCreate">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="name">
                            Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_metrics_type">
                            Rate Metrics Type <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" id="rate_metrics_type" name="rate_metrics_type">
                            <option value="weight">Weight</option>
                            <option value="age">Age</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_metrics">
                            Rate Metrics <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="rate_metrics" name="rate_metrics" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="rate_unit">
                            Rate Unit <span class="required">*</span>
                        </label>
                        <div class="m-input-icon m-input-icon--left">
                            <input type="text" class="form-control m-input" id="rate_unit" name="rate_unit" autocomplete="off">
                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                <span>
                                    <i class="la la-krw" id="rateChangeIcon"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRateType"
                    data-target="RateTypeCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
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