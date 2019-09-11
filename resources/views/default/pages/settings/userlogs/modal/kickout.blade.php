<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span>Log off ?</span>
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
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill" id="deleteRate"
                    data-target="EventCreate"
                    data-dismiss="modal">
                <span>
                    <i class="flaticon-logout"></i>
                    <span>Log off</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#deleteRate').on('click', function (e) {
        var request = {
            url: '/userlog/kickout/{{$id}}',
            method: 'post'
        };

        ajaxRequest(request, function (response) {
            reloadDatatable('.m_datatable');
        });
    });
</script>