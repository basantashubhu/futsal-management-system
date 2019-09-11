<style>
    .modal-header-danger {
        background-color: #fb7b91 !important;
        border-color: #fb7b91 !important;
    }  
</style>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body" style="background: #fff;">
            <p>Are you sure you want to delete?</p>
             <form id="payperiodDelete">
                <input type="hidden" name="userd_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="id" value="{{$id}}">
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block; background: #eee;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="btnDeleteState"
                    data-target="payperiodDelete"
                    data-dismiss="modal">
                <span>
                    <span>Delete</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
//initializing date and time picker
initDatepicker();
initTimepicker();
$(function(){

    $(document).off('click','#btnDeleteState').on('click','#btnDeleteState', function (e) {
        e.preventDefault();
        var form = $(this).attr('data-target');
        var request = {
            url: '/location/district/delete',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            if (response.response && response.response.data && response.response.data.errors)
                return errorMessageFunc(response.response.data.errors);

            processForm(response, function (response) {
                removeFormLoader();
                $('#modalContainer').modal('hide');
                reloadDatatable('#district_data_table');
            });
        });
    });

})
function errorMessageFunc(response) {
    for(let i in response) {
        toastr.error(response[i]);
    }
}
</script>