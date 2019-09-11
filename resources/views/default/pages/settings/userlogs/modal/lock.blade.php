<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span>Lock Out?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <div class="modal-body" style="background: #f1f2f6">
            <form class="m-form m-form--fit m-form--label-align-right" id="UserLockForm">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group m--margin-top-10">
                        <div class="alert m-alert m-alert--default" role="alert">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-user"></i> Kiran Chaulagain
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="m_datetimepicker_3">Lock Until</label>
                        <input type="text" class="form-control m-input" value=" {{date('Y/m/d h:m')}}"
                               id="m_datetimepicker_3" name="locked_until">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Remarks</label>
                        <textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill" id="lockOffbtn" data-dismiss="modal">
                <span>
                    <i class="flaticon-lock-1"></i>
                    <span>Lock Out</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>

    BootstrapDatetimepicker.init();
    $('#lockOffbtn').on('click', function (e) {
        var request = {
            url: '/userlogs/lock/{{$id}}',
            method: 'post',
           form:'UserLockForm'
    }
        ;

        ajaxRequest(request, function (response) {
            reloadDatatable('.m_datatable');
        });
    });
</script>