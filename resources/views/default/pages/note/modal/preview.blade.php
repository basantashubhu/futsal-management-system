
<div class="modal-dialog" role="document" style="max-width: 600px;">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Send on {{ newDate($notification->created_at) }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <div class="m-portlet mb-0">
                <div class="m-portlet__body">{{ $notification->message }}</div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill mr-auto" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill">
                Save
            </button>
        </div>
    </div>
</div>

