<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to delete this organization?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #3f4047 !important;">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row m-t-10-i">
                <div class="col-sm-12">
                    <form id="deleteZip">
                        <table class="table table-bordered m-table m-table--head-bg-success">
                            <thead>
                            <tr>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody id="appendZip">
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="deleteAll"
            data-target="deleteZip"
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
    $(document).off('click', '.removeZip').on('click', '.removeZip', function(e){
        $(this).closest('tr').remove();
    });
    $(document).off('click', '#deleteAll').on('click', '#deleteAll', function (e) {
        var request = {
            url: 'deleteAll',
            method: 'post',
            form: $(this).attr('data-target')
        };

        ajaxRequest(request, function (response) {
            processForm(response, function(){
                reloadDatatable('.zipcode_datatable');
            });
        });
    });
</script>