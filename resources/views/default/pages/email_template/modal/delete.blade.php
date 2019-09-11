<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span >Delete Template?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="deleteTemplate"
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
    $(document).off('click', '#deleteTemplate').on('click', '#deleteTemplate', function (e) {
        var request = {
            url: '/email_template/delete/{{$template->id}}',
            method: 'post',
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            reloadDatatable('.template_datatable');
            removeFormLoader();
        });
    });
</script>