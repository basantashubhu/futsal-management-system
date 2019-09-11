<style>
    .modal-header-danger {
        background-color: #fb7b91 !important;
        border-color: #fb7b91 !important;
    }    
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body" style="background: #fff;">
            <p>Are you sure you want to delete this holiday?</p>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block; background: #eee;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="holidayDelete"
                    data-target="EventCreate"
                    data-dismiss="modal">
                <span>
                    <span>Delete</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#holidayDelete').off('click').on('click', function (e) {
        var request = {
            url: '/holiday/delete/{{$holiday->id}}',
            method: 'post',
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            reloadDatatable('#holiday_data_table');            
            $("#m_holiday_calendar").fullCalendar("refetchEvents");
            processForm(response);
            removeFormLoader();
            toastr.success("Holiday Deleted");
        });
    });
</script>