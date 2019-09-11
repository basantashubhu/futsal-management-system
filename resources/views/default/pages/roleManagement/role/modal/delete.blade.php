<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">Cancel</button>
            <button type="button" class="float-right btn btn-danger m-btn--icon m-btn--pill" id="deleteRole"
            data-target="EventCreate"
            data-dismiss="modal">
                <span>
                    <i class="la la-trash"></i>
                    <span>Delete</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#deleteRole').on('click', function (e) {
        var request = {
            url: '/role/delete/{{$role->id}}',
            method: 'post',
        };
addFormLoader();
        ajaxRequest(request, function (response) {
                reloadDatatable('.m_datatable');
removeFormLoader();
        });
    });
</script>