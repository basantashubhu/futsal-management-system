
<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span> Delete Settings</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill" id="deleteUserSettings"
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
    $(document).off('click', '#deleteUserSettings').on('click', '#deleteUserSettings', function (e) {
        var request = {
            url: '/settings/delete/{{$settings->id}}',
            method: 'post',
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            reloadDatatable('.m_datatable');
removeFormLoader();
        });
    });
</script>