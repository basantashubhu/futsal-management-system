<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Holiday Type</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider" style="background: #fff;">
            <!--begin::Form-->
         
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed floatLabelForm" id="form_holiday_typye">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 20px 15px;">
                       	<div class="form-group">
                            <label class="required">Holiday Type</label>
                            <input type="hidden" name="section" value="Holiday">
                            <input type="hidden" name="code" value="holidayType">
                            <input type="text" name="value" class="form-control" autocomplete="off">
                            <input type="hidden" name="description" value="">
                            <input type="hidden" name="datatype" value="string">
                            <input type="hidden" name="sequence_num" value="">
                       	</div>
                    </div>
                </div>       
            </form>
            <!--end::Form-->
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="saveHolidayType" data-target="form_holiday_typye">
                Save
            </button>
        </div>
    </div>
</div>

<script>
  

    $(document).off('click','#saveHolidayType').on('click','#saveHolidayType', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: 'lookup/add',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response);
        });
    });

</script>