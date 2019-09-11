<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Error
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            Log off
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="LogOff" data-target="ClientCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $('#lockOffbtn').on('click', function (e) {
        var request = {
                url: '/userlog/kickout/{{$id}}',
                method: 'post',
            }
        ;

        ajaxRequest(request, function (response) {
            reloadDatatable('.m_datatable');
        });
    });
</script>
</script>