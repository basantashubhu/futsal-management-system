<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" >
                <span>Reset Layout Buiilder Setting ?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="resetLayoutBuilder" data-url="{{ route('resetLayoutBuilder') }}"
                    data-dismiss="modal">
                <span>
                    <i class="la la-recycle"></i>
                    <span>Reset</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#resetLayoutBuilder').on('click', '#resetLayoutBuilder', function (e) {
        e.preventDefault();
        var ajaxOptions = {
            url : $(this).attr('data-url')
        }

        addFormLoader();
        ajaxRequest(ajaxOptions, function(response){
            removeFormLoader();
            toastr.success("Setting Updated");
            if(window.location) {
                window.location.reload();
            }
        });
    });
</script>