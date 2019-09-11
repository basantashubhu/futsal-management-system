<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to delete this Lookup?</span>
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
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="deleteLookup"
            data-target="EventCreate">
                <span>
                    <i class="la la-trash"></i>
                    <span>Delete</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#deleteLookup').on('click', function (e) {
        var request = {
            url: '/lookup/destroy/{{$lookup->id}}',
            method: 'post',
        };

        ajaxRequest(request, function (response) {
            processForm(response, function(response){
                reloadDatatable('.lookup_datatable');
            })
        });
    });
</script>