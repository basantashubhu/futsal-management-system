<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Delete this permission.</span>
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
            <button type="button" class="btn btn-danger float-right m-btn--icon m-btn--pill" id="deletePermission"
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
    $(document).off('click', '#deletePermission').on('click', '#deletePermission', function (e) {
        var request = {
            url: '/permission/delete/{{$permission->id}}',
            method: 'post',
        };
addFormLoader();
        ajaxRequest(request, function (response) {
                reloadDatatable('.m_datatable');
removeFormLoader();
        });
    });
</script>