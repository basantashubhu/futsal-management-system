<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to delete this rate type?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #3f4047 !important;">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>


        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger float-right m-btn--icon m-btn--pill" id="deleteRate"
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
    $(document).off('click', '#deleteRate').on('click', '#deleteRate', function (e) {
        var request = {
            url: '/rate_type/delete/{{$rate_type->id}}',
            method: 'post'
        };
addFormLoader();
        ajaxRequest(request, function (response) {
            reloadDatatable('.rate_type_datatable');
removeFormLoader();
        });
    });
</script>