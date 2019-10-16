<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Are you sure want to approved this?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="approveORg"
            data-target="EventCreate"
            data-dismiss="modal">
                <span>
                    <span>Approved</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#approveORg').on('click', '#approveORg',  function (e) {
        var request = {
            url: '/org_appr/{{$organization->id}}',
            method: 'post',
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            routes.executeRoute('org/single/{id}',{
                 url : '/org/single/{{$organization->id}}'
            });
            removeFormLoader();
        });
    });
</script>