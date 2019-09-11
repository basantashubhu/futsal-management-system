<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to @if($rate_plan->is_active) Deactive @else Active @endif this Rate Plan?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #3f4047 !important;">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn @if($rate_plan->is_active) btn-danger @else btn-success @endif m-btn--icon m-btn--pill float-right" id="changeStatus"
            data-target="EventCreate"
            data-dismiss="modal">
                <span>
                    <span>@if($rate_plan->is_active) Deactive @else Active @endif</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#changeStatus').on('click', '#changeStatus', function (e) {
        var request = {
            url: '/rate_plan/updateStatus/{{$rate_plan->id}}',
            method: 'get',
        };
addFormLoader();
        ajaxRequest(request, function (response) {
                reloadDatatable('.rate_plan_datatable');
removeFormLoader();
        });
    });
</script>