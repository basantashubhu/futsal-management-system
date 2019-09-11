<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to delete this Procedure?</span>
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
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="deleteTreatment"
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
    $(document).off('click', '#deleteTreatment').on('click', '#deleteTreatment', function (e) {
        var request = {
            url: '/treatment/delete/{{$treatment->id}}',
            method: 'post'
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            reloadDatatable('.treatment_datatable');
removeFormLoader();
        });
    });
</script>