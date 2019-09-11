<style>
    .modal-header-danger {
        background-color: #fb7b91 !important;
        border-color: #fb7b91 !important;
    }    
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body" style="background: #fff;">
            <p>Are you sure you want to delete this Note?</p>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block; background: #eee;">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="deleteNote"
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
    $(document).off('click', '#deleteNote').on('click', '#deleteNote', function (e) {
        var request = {
            url: '/note/delete/{{$note->id}}',
            method: 'post'
        };
        addFormLoader();
            ajaxRequest(request, function (response) {
                if(response.status == 200){
                    toastr.success(response.data[0].data);
                    reloadDatatable('.note_datatable');
                }else {
                    toastr.danger(response.data[0].data);
                }
            removeFormLoader();
        });
    });
</script>