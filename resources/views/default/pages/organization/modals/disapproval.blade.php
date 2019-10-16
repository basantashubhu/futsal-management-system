<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Are you sure want to dis approve this?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <div class="modal-body has-divider">
            <form id="disApproveReason" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="exampleTextarea">
                            Reason for Disapprove.
                        </label>
                        <textarea class="form-control m-input" id="exampleTextarea" name="comment" rows="3"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger m-btn--icon m-btn--pill float-right" id="disApproveOrganization"
                    data-target="disApproveReason" data-dismiss="modal">
                <span>
                    <span>Disapproved</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#disApproveOrganization').on('click', '#disApproveOrganization', function (e) {
        var request = {
            url: '/org_disApproval/{{$organization->id}}',
            method: 'post',
            form: $(this).data('target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            routes.executeRoute('org/single/{id}',{
                url : '/org/single/{{$organization->id}}'
            });
            removeFormLoader();
        });
    });
</script>